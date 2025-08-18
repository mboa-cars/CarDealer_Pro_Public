<?php

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

it('crée un bookmark via store()', function () {
    $user = User::factory()->create();
    actingAs($user);

    $resp = postJson(route('bookmarks.store'), [
        'title' => 'Titre',
        'description' => 'Desc',
        'category' => 'general',
    ]);

    $resp->assertOk()
        ->assertJson(['success' => true]);

    expect(Bookmark::count())->toBe(1);
});

it('empêche les doublons pour store()', function () {
    $user = User::factory()->create();
    actingAs($user);

    // premier ajout
    postJson(route('bookmarks.store'), [
        'title' => 'A',
    ])->assertOk();

    // même URL (fullUrl renvoie la même route ici)
    $resp = postJson(route('bookmarks.store'), [
        'title' => 'A',
    ]);

    $resp->assertOk()->assertJson(['success' => false]);
});

it('toggleFavorite sécurise la propriété', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    actingAs($owner);
    $bookmark = Bookmark::createFromCurrentPage($owner, 'A');

    // autre utilisateur ne peut pas modifier
    actingAs($other);
    patchJson(route('bookmarks.toggle-favorite', $bookmark))->assertForbidden();

    // propriétaire le peut
    actingAs($owner);
    patchJson(route('bookmarks.toggle-favorite', $bookmark))
        ->assertOk()
        ->assertJson(['success' => true]);
});

it('quickStore fonctionne avec url explicite (JSON)', function () {
    $user = User::factory()->create();
    actingAs($user);

    $resp = postJson(route('bookmarks.quick-store'), [
        'url' => 'https://example.com/page',
    ]);

    $resp->assertOk()->assertJson(['success' => true]);
    expect(Bookmark::where('url', 'https://example.com/page')->exists())->toBeTrue();
});
