<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory\json;
use App\Makanan;
use App\Cabang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ApiWeb extends Controller
{	
	//auth
	public function login(Request $request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$admin = DB::select("select * from users where email='$email'
		and password='$password'");
		echo json_encode($admin);
    }
    
    //makanan	
    function index()
	{
		$mkn = Makanan::get();		
		echo json_encode($mkn);
	}
	public function deleteMakanan($id)
    {
        $makanan = Makanan::find($id);
        $makanan->delete();
		echo json_encode(array("status" => TRUE));
    }
    
	public function insertMakanan(Request $request)
	{
        $fileName = time().'.'.$request->thumb->extension();     
        $request->thumb->move(public_path('uploads/data/thumb'), $fileName); 
        $makanan = new Makanan([
            'nama' => $request->input('judul'),
            'deskripsi' => $request->input('desk'),
            'harga' => $request->input('harga'),
            'tmp' => 0,
            'gambar' => $fileName,
            'kategori' => 1
        ]);
        $makanan->save();
	}
	public function getMakananById($id)
	{
        $makanan = Makanan::find($id);
		echo json_encode($makanan);
	}
	public function editMakanan(Request $request)
	{
		$makanan = Makanan::find($request->input('id'));
		if($request->input('image')!="kosong"){
			if($request->hasFile('thumb')){
				$fileName = time().'.'.$request->thumb->extension();     
				$request->thumb->move(public_path('uploads/data/thumb'), $fileName); 
				$makanan->gambar = $fileName;
			}
		}        
        $makanan->nama = $request->input('judul');
        $makanan->harga = $request->input('harga');
        $makanan->deskripsi = $request->input('desk');
		$makanan->tmp = 0;
        $makanan->kategori = 1;
        $makanan->save();
	}
	
	//dashboard
	public function pemasukan()
	{
		$today = date("Y-m-d");   
		$orderH = DB::select("select count(*) as jo from (SELECT DISTINCT notrx 
		FROM trxes where tanggal='$today') as d");
		$orderB = DB::select("select count(*) as jo from (SELECT DISTINCT notrx,month(tanggal) as tgl 
		FROM `trxes`) as d where d.tgl=month(now())");
		$harian = DB::select("select sum(subtotal) as total from trxes where tanggal='$today'");
		$bulanan = DB::select("select sum(subtotal) as total from (select month(tanggal) as t, 
		subtotal from trxes) as d where d.t=month(now()) GROUP by d.t");
		$b = $bulanan[0]->total; $h = $harian[0]->total;$oh =  $orderH[0]->jo;
		$ob = $orderB[0]->jo;
		if(!$h){$h = 0;}
		echo json_encode(array(
			"status" => $b, "harian" =>$h ,
			"oh" =>$oh, "ob" => $ob,
		));
	}


	//promo
	public function promo()
	{
		$d = $this->ModelWeb->getPromo();
		echo json_encode($d);
	}
	public function insertPromo()
	{
		$data['judul'] = $this->input->post('judul');
		$data['desk'] = $this->input->post('desk');
		$config['upload_path']    = "./data/promo/";
		$config['allowed_types']  = 'jpg';
		$config['max_size']       = '200000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload("thumb")) {
			echo json_encode(array("status" => FALSE));
		} else {
			$up = $this->upload->data();
			$v = $up['file_name'];
			$data['thumb'] = "data/promo/" . $v;
			$this->M_ad->insertPromo($data);
			echo json_encode(array("status" => TRUE));
		}
	}
	public function getPromoById($id)
	{
		$d = $this->M_ad->getPromoById($id);
		echo json_encode($d);
	}
	public function editPromo()
	{
		$data['judul'] = $this->input->post('judul');
		$data['desk'] = $this->input->post('desk');
		$data['id'] = $this->input->post('id');
		$th = $this->input->post('image');
		if ($th == "kosong") {
			echo "ksg";
			$data['thumb'] = "";
			$this->M_ad->editPromo($data);
		} else {
			if (!empty($_FILES["thumb"]["name"])) {
				$config['upload_path']    = "./data/promo/";
				$config['allowed_types']  = 'jpg';
				$config['max_size']       = '200000';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload("thumb")) {
					echo json_encode(array("status" => FALSE));
				} else {
					$up = $this->upload->data();
					$v = $up['file_name'];
					$data['thumb'] = "data/promo/" . $v;
					$this->M_ad->editPromo($data);
					//  echo json_encode(array("status" => TRUE));				   
				}
			}
		}
	}
	public function deletePromo($id)
	{
		$this->M_ad->deletePromo($id);
		echo json_encode(array("status" => TRUE));
	}
//cabang
	public function getCabang()
	{
		$d = $this->ModelWeb->getCabang();
		echo json_encode($d);
	}
	public function insertCabang()
	{
		$data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['desk'] = $this->input->post('desk');
		$data['t'] = ""; //preventif
		$this->M_ad->insertCabang($data);
		//  echo json_encode(array("status" => TRUE));				   
	}
	public function deleteCabang($id)
	{
		$this->M_ad->deleteCabang($id);
		echo json_encode(array("status" => TRUE));
	}
	public function getCabangById($id)
	{
		$d = $this->M_ad->getCabangById($id);
		echo json_encode($d);		
	}
	public function editCabang()
	{
		$data['nama'] = $this->input->post('nama');
		$data['desk'] = $this->input->post('desk');
		$data['alamat'] = $this->input->post('alamat');
		$data['id'] = $this->input->post('id');
		$data['thumb'] = "";
		$this->M_ad->editCabang($data);
	}


	public function getTrx($hp)
	{
		$d = $this->ModelWeb->getTrx($hp);
		echo json_encode($d);
	}
	public function getTrxById($notrx)
	{
		$d = $this->ModelWeb->getTrxById($notrx);
		echo json_encode($d);
	}
	public function getCabangOrder()
	{
		$d = $this->ModelWeb->getCabangOrder();
		echo json_encode($d);
	}
	public function getTrxByCabang($id)
	{
		$d = $this->ModelWeb->getTrxByCabang($id);
		echo json_encode($d);
	}
	public function finish($notrx, $status)
	{
		$d = $this->ModelWeb->finish($notrx, $status);
		echo json_encode($d);
	}
	public function deleteTrx($notrx)
	{
		$d = $this->ModelWeb->deleteTrx($notrx);
		echo json_encode($d);
	}
	public function getNewTrx()
	{
		$d = $this->ModelWeb->getNewTrx()->row();
		echo $d->jumlah;
	}
}
