<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaAsset extends Model
{
    protected $fillable = [
        'campaign_id', 'type', 'content', 'platform', 'status', 'feedback'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function analytics()
    {
        return $this->hasMany(Analytics::class);
    }
}
