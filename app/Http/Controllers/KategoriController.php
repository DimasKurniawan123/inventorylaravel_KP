<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kat = Kategori::get();
        $data = array(
            'title' => 'Data User',
            'kategori' => $kat,
        );

        return view('admin.kategori.index', $data);
    }

    public function store(Request $request)
    {
        Kategori::create([
            'nama_kategori' => $request->name,
        ]);

        return redirect('kategori')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        $kategori->delete();

        return redirect('kategori')->with('success', 'Data Berhasil Dihapus');
    }
}
