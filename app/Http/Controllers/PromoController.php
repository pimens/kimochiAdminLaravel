<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        return view('promo.promo', compact('promos'));
    }
    public function create()
    {
        return view('promo.addPromo');
    }
    public function store(Request $request)
    {
        $fileName = time().'.'.$request->file->extension();     
        $request->file->move(public_path('uploads'), $fileName); 
        $promo = new Promo([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'gambar' => $fileName,
        ]);
        $promo->save();
        return redirect('/promo');
    }

    public function edit($id)
    {
        $promo = promo::find($id);
        return view('promo.editPromo', compact('promo'));
    }
    public function update(Request $request, $id)
    {
        $promo = Promo::find($id);
        if($request->hasFile('file')){
            $fileName = time().'.'.$request->file->extension();     
            $request->file->move(public_path('uploads'), $fileName); 
            $promo->gambar = $fileName;
        }
        // $request->file->move(public_path('uploads'), $fileName);        
        $promo->judul = $request->input('judul');
        $promo->deskripsi = $request->input('deskripsi');
        $promo->save();
        return redirect('/promo')->with('alert', 'Update Berhasil!');;
    }
    public function destroy($id)
    {
        // $data = DB::delete("delete from makanans where id=$id");
        $promo = Promo::find($id);
        $promo->delete();
        // return redirect('/makanan')->with('alert', 'Update Berhasil!');;

        // echo $id;
		echo json_encode(array("status" => TRUE));
    }
}
