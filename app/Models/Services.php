<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [       
        'topic',
        'content',
        'status',
        'contact',       
    ];

    public function vilager()
    {
        return $this->belongsTo(Vilager::class);
    }
}
