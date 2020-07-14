<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory\json;
use App\Cabang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ApiWebCabang extends Controller
{
    //alldata cabang
    public function index()
    {
        $cabangs = Cabang::all();
		echo json_encode($cabangs);

    }
    //insert cabang
    public function insertCabang(Request $request)
    {
        $cabang = new Cabang([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('desk'),
            'alamat' => $request->input('alamat'),
        ]);
        $cabang->save();
    }
    //passing 1 data cabang
    public function getCabangById($id)
    {
        $cabang = Cabang::find($id);
        echo json_encode($cabang);
    }
    public function editCabang(Request $request)
    {
        $cabang = Cabang::find($request->input('id'));
        $cabang->nama = $request->input('nama');
        $cabang->alamat = $request->input('alamat');
        $cabang->deskripsi = $request->input('desk');
        $cabang->save();
    }
    public function deleteCabang($id)
    {
        $cabang = Cabang::find($id);
        $cabang->delete();
        echo json_encode(array("status" => TRUE));
    }
}
