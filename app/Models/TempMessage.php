<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempMessage extends Model
{
    use HasFactory;
    protected $fillable = ['chat_id', 'message_id'];
}
