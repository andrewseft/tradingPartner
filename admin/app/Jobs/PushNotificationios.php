<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Helper;

class PushNotificationios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $deviceToken;
    private $message;
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($deviceToken,$message,$url)
    {
        $this->deviceToken = $deviceToken;
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Helper::notification($this->deviceToken,$this->message,$this->url);
    }
}
