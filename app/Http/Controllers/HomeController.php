<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class HomeController extends Controller
{
    //ini controller untuk manajement barang
    
    public function index(){
        $barang = Barang::join('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id')
                ->select('tbl_barang.*', 'tbl_kategori.nama_kategori')
                ->withSum('stokIns', 'total')
                ->withSum('stokOut', 'total_keluar')
                ->get();
        $kat = Kategori::get();
        $data = array(
            'title' => 'Home Page',
            'barang' => $barang,
            'kategori' => $kat,
        );
        return view('home', $data);
    }

    public function store(Request $request)
    {
        Barang::create([
            'nama_barang' => $request->name,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'id_kategori' => $request->kategori
        ]);

        return redirect('home')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        $barang->delete();

        return redirect('home')->with('success', 'Data Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        $barang->update([
            'nama_barang' => $request->name,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'id_kategori' => $request->kategori
        ]);

        return redirect('home')->with('success', 'Data Berhasil Dirubah');
    }

    public function dashboard()
    {
        $barangmasuk = BarangMasuk::selectRaw("sum(total) as total, tgl_masuk")->groupby('tgl_masuk')->orderby('tgl_masuk')->get();
        $barangkeluar = BarangKeluar::selectRaw("sum(total_keluar) as total, tgl_keluar")->groupby('tgl_keluar')->orderby('tgl_keluar')->get();
        $masuk = [];
        $tgl = [];
        $keluar = [];
        $tglkeluar = [];
        foreach ($barangmasuk as $bm) {
            $masuk[] = $bm->total;
            $tgl[] = $bm->tgl_masuk;
        }
        foreach ($barangkeluar as $bm) {
            $keluar[] = $bm->total;
            $tglkeluar[] = $bm->tgl_keluar;
        }
        $data = array(
            'title' => 'Dashboard',
            'masuk' => $masuk,
            'tgl_masuk' => $tgl,
            'keluar' => $keluar,
            'tglkeluar' => $tglkeluar,
        );

        return view('admin.dashboard.index', $data);
    }
}
