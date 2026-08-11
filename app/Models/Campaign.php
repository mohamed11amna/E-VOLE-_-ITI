<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'user_scenario', 'extracted_prompt', 'market_research', 'status', 'generated_image_prompt', 'ad_caption', 'final_image_url'
    ];

    protected function casts(): array
    {
        return [
            'extracted_prompt' => 'array',
            'market_research' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mediaAssets()
    {
        return $this->hasMany(MediaAsset::class);
    }



    public function analytics()
    {
        return $this->hasMany(Analytics::class);
    }
}
