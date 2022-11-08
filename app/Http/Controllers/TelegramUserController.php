<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class TelegramUserController extends Controller
{
    public $flags = [
        'uz' => '🇺🇿',
        'ru' => '🇷🇺',
        'en' => '🇬🇧'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $telegram_users = TelegramUser::query()
            ->select(['first_name', 'last_name', 'username', 'is_premium', 'lang', 'created_at'])
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->paginate();

        for ($i = 0; $i < count($telegram_users); $i++) {
            $telegram_users[$i]['created_at_for_humans'] = Carbon::createFromTimeStamp(strtotime($telegram_users[$i]->created_at))->diffForHumans();
            $telegram_users[$i]['flag'] = $this->flags[$telegram_users[$i]['lang']];
        }
        return Inertia::render('TelegramUsers/Index', [
            'telegram_users' => $telegram_users
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
     * @param \App\Models\TelegramUser $telegramUser
     * @return \Illuminate\Http\Response
     */
    public function show(TelegramUser $telegramUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TelegramUser $telegramUser
     * @return \Illuminate\Http\Response
     */
    public function edit(TelegramUser $telegramUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TelegramUser $telegramUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelegramUser $telegramUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TelegramUser $telegramUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelegramUser $telegramUser)
    {
        //
    }
}
