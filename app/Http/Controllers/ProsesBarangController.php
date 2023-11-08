<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class ProsesBarangController extends Controller
{
    //ini controller untuk barang masuk dan keluar
    
    public function masuk()
    {
        $barang = Barang::get();
        $barangMasuk = BarangMasuk::select('tbl_barang_masuk.*','tbl_barang.nama_barang')->join('tbl_barang', 'tbl_barang.id', '=', 'tbl_barang_masuk.id_barang')->get();

        $data = array(
            'title' => 'Barang masuk',
            'barang' => $barang,
            'barangMasuk' => $barangMasuk,
        );
        return view('admin/proses/masuk', $data);
    }
    public function keluar()
    {
        $barang = Barang::get();
        $barangKeluar = BarangKeluar::select('tbl_barang_keluar.*','tbl_barang.nama_barang')->join('tbl_barang', 'tbl_barang.id', '=', 'tbl_barang_keluar.id_barang')->get();

        $data = array(
            'title' => 'Barang Keluar',
            'barang' => $barang,
            'barangKeluar' => $barangKeluar,
        );
        return view('admin/proses/keluar', $data);
    }

    public function masuk_store(Request $request)
    {
        $no_trans = $request->barang."/".date('Y')."/".date('His');
        BarangMasuk::create([
            'id_barang' => $request->barang,
            'qty_masuk' => $request->qty,
            'total' => $request->qty,
            'tgl_masuk' => date('Y-m-d',strtotime($request->tanggal)),
            'no_transaksi' => $no_trans
        ]);

        return redirect('barang-masuk')->with('success', 'Data Berhasil Disimpan');

    }

    public function masuk_destroy($id)
    {
        $barang = BarangMasuk::find($id);
        $barang->delete();
        return redirect('barang-masuk')->with('success', 'Data Berhasil Dihapus');
    }

    public function keluar_store(Request $request)
    {
        $b = Barang::withSum('stokIns', 'total')->withSum('stokOut', 'total_keluar')->where('id',$request->barang)->first();
        $stok = ($b->stok_ins_sum_total != '' ? $b->stok_ins_sum_total : 0) - ($b->stok_out_sum_total_keluar != '' ? $b->stok_out_sum_total_keluar : 0);
        if($request->qty > $stok){
            return redirect('barang-keluar')->with('success', 'Gagal menyimpan data, Stok awal barang tidak mencukupi');
        }

        $no_trans = $request->barang."/".date('Y')."/".date('His');
        BarangKeluar::create([
            'id_barang' => $request->barang,
            'qty_keluar' => $request->qty,
            'total_keluar' => $request->qty,
            'tgl_keluar' => date('Y-m-d',strtotime($request->tanggal)),
            'no_transaksi_keluar' => $no_trans
        ]);

        return redirect('barang-keluar')->with('success', 'Data Berhasil Disimpan');

    }

    public function keluar_destroy($id)
    {
        $barang = BarangKeluar::find($id);
        $barang->delete();
        return redirect('barang-keluar')->with('success', 'Data Berhasil Dihapus');
    }
    
}
