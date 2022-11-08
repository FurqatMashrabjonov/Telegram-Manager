<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'username', 'is_premium', 'user_id', 'bot_id', 'chat_id', 'lang'];
}
