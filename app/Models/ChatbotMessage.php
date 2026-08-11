<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotMessage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id', 'role', 'content'];

    public function session()
    {
        return $this->belongsTo(ChatbotSession::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
