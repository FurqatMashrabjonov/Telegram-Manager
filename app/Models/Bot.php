<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

    protected $fillable = ['token', 'id', 'username', 'webhook_was_set'];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function users(){
        return $this->hasMany(TelegramUser::class);
    }
}
