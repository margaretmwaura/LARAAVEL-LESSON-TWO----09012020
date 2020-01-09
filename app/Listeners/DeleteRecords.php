<?php


namespace App\Listeners;


use App\Writeup;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DeleteRecords
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function handle()
    {
        $writeUps = Writeup::oldest()->first();

        $writeUps->delete();
    }

}
