<?php


namespace App\Listeners;


use App\Events\MoreThanTwo;
use App\Models\Writeup;
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
    public function handle(MoreThanTwo $event)
    {

        $id = $event->user->id;
        $row = Writeup::GetOldest($id);
        $id = $row->id;
        Writeup::DeleteWriteUps($id);

    }

}
