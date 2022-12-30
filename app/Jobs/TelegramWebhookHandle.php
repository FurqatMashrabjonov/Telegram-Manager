<?php

namespace App\Jobs;

use App\Telegram\Handle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramWebhookHandle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $token;
    public array $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($token, $request)
    {
        $this->token = $token;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new Handle())->handle($this->token, $this->request);
    }
}
