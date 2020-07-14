<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Makanan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class MakananController extends Controller
{
    public function index()
    {
        $today = date("Y-m-d");   
		$d = DB::select("select count(*) as jo from 
		(SELECT DISTINCT notrx FROM `trxes` where tanggal='$today') as d");
        $mkn = Makanan::all();
        return view('makanan.beranda', compact('mkn','d'));
    }
    public function create()
    {
        return view('makanan.addMakanan');
    }   
    public function store(Request $request)
    {
        $fileName = time().'.'.$request->file->extension();     
        $request->file->move(public_path('uploads/data/thumb'), $fileName); 
        $makanan = new Makanan([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'tmp' => 0,
            'gambar' => $fileName,
            'kategori' => 1
        ]);
        $makanan->save();
        return redirect('/makanan');
    }

    public function edit($id)
    {
        $makanan = Makanan::find($id);
        return view('makanan.editMakanan', compact('makanan'));
    }
    public function update(Request $request, $id)
    {
        $makanan = Makanan::find($id);
        if($request->hasFile('file')){
            $fileName = time().'.'.$request->file->extension();     
            $request->file->move(public_path('uploads/data/thumb'), $fileName); 
            $makanan->gambar = $fileName;
        }
        // $request->file->move(public_path('uploads'), $fileName);        
        $makanan->nama = $request->input('nama');
        $makanan->harga = $request->input('harga');
        $makanan->tmp = $request->input('tmp');
        $makanan->deskripsi = $request->input('deskripsi');
        $makanan->tmp = 0;
        $makanan->save();
        return redirect('/makanan')->with('alert', 'Update Berhasil!');;
    }
    public function destroy($id)
    {
        // $data = DB::delete("delete from makanans where id=$id");
        $makanan = Makanan::find($id);
        $makanan->delete();
        // return redirect('/makanan')->with('alert', 'Update Berhasil!');;

        // echo $id;
		echo json_encode(array("status" => TRUE));
    }
}
