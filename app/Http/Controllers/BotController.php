<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Bot/Index', [
            'bot' => Bot::query()->where('user_id', \auth()->user()->getAuthIdentifier())->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bot $bot
     * @return \Illuminate\Http\Response
     */
    public function show(Bot $bot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Bot $bot
     * @return \Illuminate\Http\Response
     */
    public function edit(Bot $bot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bot $bot
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        Bot::query()->where('user_id', \auth()->user()->getAuthIdentifier())
            ->update($request->only(['token']));
        return redirect()->back()->with('success', 'Bot updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Bot $bot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bot $bot)
    {
        //
    }


    public function webhook($token, Request $request)
    {
        Log::debug(json_encode($request->all()));
        $message = $request['message'];
        $bot = Bot::query()->where('token', $token)->first();
        $this->from($request['message'], $bot);
        return response()->json([]);
    }

    public function from($message, $bot)
    {
        $telegram_user = TelegramUser::query()
            ->where('bot_id', $bot->id)
            ->where('chat_id', $message['chat']['id'])->first();
        if (!$telegram_user){
            TelegramUser::query()->create([
                'chat_id' => $message['chat_id'],

            ]);
        }
    }
}
