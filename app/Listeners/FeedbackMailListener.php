<?php

namespace App\Listeners;

use App\Events\FeedbackMailEvent;
use App\Mail\FeedbackMailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class FeedbackMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FeedbackMailEvent  $event
     * @return void
     */
    public function handle(FeedbackMailEvent $event)
    {
        Mail::to($event->data->email)->send(new FeedbackMailer($event->data));
    }
}
