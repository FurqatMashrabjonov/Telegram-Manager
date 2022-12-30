<?php

namespace App\Http\Controllers;

use App\Jobs\TelegramWebhookHandle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class TelegramWebhookHandleController extends Controller
{
    public function index($token, Request $request)
    {
        TelegramWebhookHandle::dispatchSync($token, $request->all());
    }
}
