<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'tbl_barang';
    protected $fillable = [
        'nama_barang', 'id_kategori', 'stok', 'harga',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function stokIns()
    {
        return $this->hasMany(BarangMasuk::class, 'id_barang', 'id');
    }
    public function stokOut()
    {
        return $this->hasMany(BarangKeluar::class, 'id_barang', 'id');
    }
    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id','id_kategori');
    }
}
