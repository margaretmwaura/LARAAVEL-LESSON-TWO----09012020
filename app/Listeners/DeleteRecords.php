<?php


namespace App\Listeners;


use App\Events\MoreThanTwo;
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
    public function handle(MoreThanTwo $event)
    {
//        $email = $event->user->email;
//        $row = DB::table('writeups')->where('email', $email)->oldest()->first();
//        $id = $row->id;
//        DB::table('writeups')->where('id',$id)->delete();

    }

}
