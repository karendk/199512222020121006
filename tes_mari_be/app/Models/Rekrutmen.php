<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Rekrutmen extends Model
{
    use HasFactory, Notifiable;

    // protected $connection = 'mysql';
    protected $table = 'rekrutmen';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'nip',
        'token',
    ];
}
