<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory, Notifiable;

    // protected $connection = 'mysql';
    protected $table = 'satker';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'parent_id',
        'order',
        'nama',
        'nama_panjang',
        'kode_perkara',
        'kelas',
        'tingkat',
        'gambar',
        'logo',
        'cap',
        'alamat',
        'kota',
        'provinsi',
        'telepon',
        'fax',
        'email',
        'kode_pos',
        'url_website',
        'updated_at',
    ];
}
