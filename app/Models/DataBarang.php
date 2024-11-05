<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $table = 'data_barang'; // Nama tabel yang sesuai
    protected $primaryKey = 'id_barang'; // Menetapkan primary key
    public $incrementing = false; // Jika primary key bukan auto-increment
    protected $keyType = 'int'; // Tipe data primary key
    protected $fillable = [
        'id_barang', // Kolom id_barang
        'nama_barang', // Kolom nama_barang
        'harga', // Kolom harga
        'stok', // Kolom stok
        'foto', // Kolom foto
    ];

    // Jika ada relasi dengan model lain, bisa didefinisikan di sini
}
