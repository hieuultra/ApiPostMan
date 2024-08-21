<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Games extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'profile_picture',
        'birth_date',
        'instrument',
        'biography',
    ];
    public $table = 'games';
    public $timestamp = false;

    protected $dates = ['deleted_at'];
}
