<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanUpgraded extends Mailable
{
    use Queueable, SerializesModels;

    public string $plan;

    public function __construct(string $plan)
    {
        $this->plan = $plan;
    }

    public function build()
    {
        return $this->subject('Votre plan a été mis à niveau')
            ->markdown('emails.plan_upgraded', [
                'plan' => $this->plan,
            ]);
    }
}


