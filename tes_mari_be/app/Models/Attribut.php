<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Attribut extends Model
{
    use HasFactory, Notifiable;

    // protected $connection = 'mysql';
    protected $table = 'attribut';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'nip',
        'nama_lengkap',
        'satker',
        'alamat',
        'foto',
    ];
}
