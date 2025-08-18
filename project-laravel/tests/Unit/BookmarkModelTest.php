<?php

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('scopeFavorites et byCategory fonctionnent', function () {
    $user = User::factory()->create();

    $b1 = Bookmark::create([
        'user_id' => $user->id,
        'title' => 'A',
        'url' => 'https://a.test',
        'category' => 'general',
        'is_favorite' => true,
        'position' => 1,
    ]);

    $b2 = Bookmark::create([
        'user_id' => $user->id,
        'title' => 'B',
        'url' => 'https://b.test',
        'category' => 'cars',
        'is_favorite' => false,
        'position' => 2,
    ]);

    expect(Bookmark::favorites()->count())->toBe(1);
    expect(Bookmark::byCategory('cars')->count())->toBe(1);
});

it('existsForUser détecte les doublons', function () {
    $user = User::factory()->create();
    $url = 'https://dup.test';

    expect(Bookmark::existsForUser($url, $user->id))->toBeFalse();

    Bookmark::create([
        'user_id' => $user->id,
        'title' => 'Dup',
        'url' => $url,
        'position' => 1,
    ]);

    expect(Bookmark::existsForUser($url, $user->id))->toBeTrue();
});

it('createFromUrl applique les valeurs par défaut', function () {
    $user = User::factory()->create();

    $bookmark = Bookmark::createFromUrl($user, 'https://example.com/x');

    expect($bookmark->title)->toBe('Page sauvegardée')
        ->and($bookmark->category)->toBe('general')
        ->and($bookmark->icon)->not()->toBeEmpty();
});

it('toggleFavorite bascule bien le statut', function () {
    $user = User::factory()->create();

    $b = Bookmark::create([
        'user_id' => $user->id,
        'title' => 'Fav',
        'url' => 'https://fav.test',
        'is_favorite' => false,
        'position' => 1,
    ]);

    $b->toggleFavorite();
    $b->refresh();

    expect($b->is_favorite)->toBeTrue();
});
