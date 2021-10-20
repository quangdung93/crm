<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMailOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        Mail::send('themes.kangen.mail.mail-order', $data, 
            function($message) use ($data){
                $message->to($data['mail_to']);
                $message->subject('[Đơn Hàng] Thông Tin Đơn Hàng Mới - ngày '.date('d/m/Y' ,strtotime($data['order']->created_at)). ' lúc '.date('H:i' ,strtotime($data['order']->created_at)));
        });
    }
}
