<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vilager extends Model
{
    use HasFactory;

    // protected $table = 'vilagers';
   
    protected $fillable = [
        'name',
        'nik',
        'kk',
        'email',
        'phone',
        'status',
        'religion',
        'education',
        'job',
        'gender',
        'rt'
    ];

    public function services()
    {
        return $this->belongsTo(Services::class);
    }
}
