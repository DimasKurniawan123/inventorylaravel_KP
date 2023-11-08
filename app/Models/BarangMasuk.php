<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'tbl_barang_masuk';
    protected $fillable = [
        'id_barang', 'qty_masuk', 'tgl_masuk', 'no_transaksi','total'
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
