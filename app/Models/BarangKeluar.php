<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'tbl_barang_keluar';
    protected $fillable = [
        'id_barang', 'qty_keluar', 'tgl_keluar', 'no_transaksi_keluar','total_keluar'
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
