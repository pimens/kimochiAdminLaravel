<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory\json;
use App\Promo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ApiWebPromo extends Controller
{
	//halamasemua data
    public function index()
    {
        $promo = Promo::get();		
		echo json_encode($promo);
    }
    //masukin data baru promo
    public function insertPromo(Request $request)
    {
        $fileName = time().'.'.$request->thumb->extension();     
        $request->thumb->move(public_path('uploads/data/thumb/'), $fileName); 
        $promo = new Promo([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('desk'),
            'gambar' => $fileName,
        ]);
        $promo->save();
    }
    //redirect ke halaman edit promo->get 1 data by id
    public function getPromoById($id)
    {
        $promo = promo::find($id);
        echo json_encode($promo);
    }
    //action edit
    public function editPromo(Request $request)
    {
        $promo = Promo::find($request->input('id'));
        if($request->input('image')!="kosong"){
			if($request->hasFile('thumb')){
                $fileName = time().'.'.$request->thumb->extension();     
                $request->thumb->move(public_path('uploads/data/thumb'), $fileName); 
                $promo->gambar = $fileName;
			}
		}        
        $promo->judul = $request->input('judul');
        $promo->deskripsi = $request->input('desk');
        $promo->save();
    }
    //delete
    public function deletePromo($id)
    {
        $promo = Promo::find($id);
        $promo->delete();
		echo json_encode(array("status" => TRUE));
    }
}
