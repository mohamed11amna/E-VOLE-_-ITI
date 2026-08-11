<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    protected $fillable = [
        'campaign_id', 'media_asset_id', 'platform', 'likes', 'shares', 'clicks', 'views', 'recorded_at'
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function mediaAsset()
    {
        return $this->belongsTo(MediaAsset::class);
    }
}
