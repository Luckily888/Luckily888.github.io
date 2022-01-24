<?php

namespace App\Listeners;

use App\Events\SendTransactionComplete;
use App\Model\UserContact;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class KeepContactRecord
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
     * @param  SendTransactionComplete  $event
     * @return void
     */
    public function handle(SendTransactionComplete $event)
    {
        try {
            UserContact::query()->firstOrCreate([
                'user_id'=>$event->senderId,
                'contact_user_id'=>$event->receiverId
            ]);

            UserContact::query()->firstOrCreate([
                'user_id'=>$event->receiverId,
                'contact_user_id'=>$event->senderId
            ]);
        }catch (\Exception $e){
            \Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
}
