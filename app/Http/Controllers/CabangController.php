<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::all();
        return view('cabang.cabang', compact('cabangs'));
    }
    public function create()
    {
        return view('cabang.addCabang');
    }
    public function store(Request $request)
    {
        $cabang = new Cabang([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
        ]);
        $cabang->save();
        return redirect('/cabang');
    }

    public function edit($id)
    {
        $cabang = Cabang::find($id);
        return view('cabang.editCabang', compact('cabang'));
    }
    public function update(Request $request, $id)
    {
        $cabang = Cabang::find($id);
        // echo $request->input('nama');
        $cabang->nama = $request->input('nama');
        $cabang->alamat = $request->input('alamat');
        $cabang->deskripsi = $request->input('deskripsi');
        $cabang->save();
        return redirect('/cabang')->with('alert', 'Update Berhasil!');;
    }
    public function destroy($id)
    {
        $cabang = Cabang::find($id);
        $cabang->delete();
        echo json_encode(array("status" => TRUE));
    }
}
