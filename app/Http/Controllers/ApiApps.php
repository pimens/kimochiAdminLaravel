<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory\json;
use App\Makanan;
use App\Cabang;



use Illuminate\Support\Facades\DB;

class ApiApps extends Controller
{
	function get()
	{
		$mkn = Makanan::get();
		$mm = DB::select('select count(*) as jo from 
        (SELECT DISTINCT notrx,month(tanggal) as tgl FROM `trxes`) as d 
        where d.tgl=month(now())');
		echo json_encode($mm);
		// return response()->json(
		//     [
		//         "msg" => $mm
		//     ]
		// );
	}
	function post(Request $request)
	{
		// $nama = $request->input('nama');
		$cabang = new Cabang([
			'nama' => $request->input('nama'),
			'deskripsi' => $request->input('ttl'),
			'alamat' => $request->input('alamat'),
		]);
		$cabang->save();
		return response()->json(
			[
				"msg" => $cabang
			]
		);
	}
	function put($id)
	{
		$mkn = Makanan::find($id);
		return response()->json(
			[
				"msg" => $mkn
			]
		);
	}
	function delete($id)
	{
		$mkn = Makanan::find($id);
		return response()->json(
			[
				"msg" => $mkn
			]
		);
	}
	//=======================
	function getMakananOffset($s, $off)
	{
		// echo '[{"id":"2","nama":"ffffffff","harga":"78888",
		// 	"gambar":"1594566519.png","deskripsi":"Makanan sehat",
		// 	"kategori":"1","tmp":"0","created_at":null,"updated_at":null},
		// 	{"id":"3","nama":"boba","harga":"90000",
		// 	"gambar":"1593322488.png",
		// 	"deskripsi":"makanan penyegarr sekali","kategori":"1",
		// 	"tmp":"0","created_at":null,"updated_at":null}]';
		$d = DB::select("select * from makanans limit $s,$off");
		echo json_encode($d);
	}
	public function getMakanan()
	{
		$d = DB::select("select * from makanans");
		echo json_encode($d);
	}
	public function getMaxTrx()
	{
		$d = DB::select("select max(notrx) as x from trxes");
		echo json_encode($d);
	}
	public function getJUser($hp)
	{
		// $d = DB::select("select count(*) as j from customers where nomorhp=$hp");
		// echo json_encode($d);
		echo '[{"j":"0"}]';
	}
	//ini tes sama gak
	//beda harus cari spaya dia bisa row
	public function getJumlahOrder()
	{
		$today = date("Y-m-d");
		$d = DB::select("select count(*) as jo from 
		(SELECT DISTINCT notrx FROM `trxes` where tanggal='$today') as d");
		echo json_encode($d[0]);
	}
	//////


	public function insertInvoice(Request $request)
	{
		$hp = $request->input('hp');
		$nama = $request->input('nama');
		$makanan = $request->input('mkn');
		$jumlah = $request->input('jmlh');
		$trx = $request->input('trx');
		$st = $request->input('st');
		$outlet = $request->input('cab');
		$address = $request->input('alamat');
		$user = DB::select("select count(*) as j,id from customers where nomorhp=$hp group by id");
		if (sizeof($user) != 0) {
			DB::insert("insert into trxes 
			values(NULL,".$user[0]->id.",$makanan,$outlet,$jumlah,$st,
			now(),$trx,'$address',0,NULL,NULL)");
		} else {
			DB::insert("insert into customers values (NULL,'$nama','$hp',NULL,NULL)");
			$user = DB::select("select count(*) as j,id from customers where nomorhp=$hp group by id");
			DB::insert("insert into trxes 
			values(NULL,".$user[0]->id.",$makanan,$outlet,$jumlah,$st,
			now(),$trx,'$address',0,NULL,NULL)");
		}
	}

	///-=======================================
	public function insertUser($n, $hp)
	{
		$d = DB::insert("insert into customers values ('',$n,$hp,'','')");
	}
	public function promo()
	{
		$d = DB::select("select * from promos");
		echo json_encode($d);
	}
	public function getCabang()
	{
		$d = DB::select("select id,alamat,deskripsi,nama from cabangs");
		echo json_encode($d);
	}
	public function getTrx($hp)
	{
		$d = DB::select("select trxes.alamat as alamat,
		tanggal, cabangs.nama, 
		notrx,status, sum(subtotal) as total 
		from trxes, cabangs 
		where id_user=(select id from customers 
		where nomorhp='$hp') and cabangs.id=trxes.id_cabang
		group by alamat,
		tanggal, cabangs.nama, 
		notrx,status");
		echo json_encode($d);
	}
	public function getTrxById($notrx)
	{
		$d = DB::select("select status,
		customers.nama as user,nomorhp, 
		makanans.gambar as gambar, makanans.nama as nama, 
		trxes.jumlah as jumlah, subtotal 
		from trxes, makanans,customers 
		where customers.id=trxes.id_user and 
		makanans.id = trxes.id_makanan and notrx=$notrx");
		echo json_encode($d);
	}
	public function getCabangOrder()
	{
		$d = DB::select("select cabangs.id,COALESCE(jumlah, 0) as jumlah,cabangs.nama,
		cabangs.alamat from cabangs left join (select count(status) as jumlah,nama, id 
		from (SELECT cabangs.alamat as alamat, cabangs.id as id, 
		cabangs.nama as nama,status from cabangs, trxes 
		where cabangs.id=trxes.id_cabang and status<>1 GROUP by notrx,alamat,id,nama,status) as d 
		group by d.id,nama) as x on cabangs.id=x.id");
		echo json_encode($d);
	}
	public function getTrxByCabang($id)
	{
		$d = DB::select("select customers.nama as user, tanggal, 
		cabangs.nama, sum(subtotal) as total, notrx,
		trxes.alamat,status from trxes, cabangs,customers 
		where trxes.id_user=customers.id and id_cabang=$id 
		and cabangs.id=trxes.id_cabang 
		group by user, tanggal, 
		cabangs.nama, notrx,
		trxes.alamat,status order by status asc");
		echo json_encode($d);
	}
	public function finish($notrx, $status)
	{
		$d = DB::update("update trxes set status=$status where notrx=$notrx");
		echo json_encode($d);
	}

	public function deleteTrx($notrx)
	{
		$d = DB::delete("delete from trxes where notrx=$notrx");
		// echo json_encode($d);
	}
	public function getNewTrx()
	{
		$d = DB::select("select count(*) as jumlah 
		from (select notrx from trxes 
		where status=0 group by notrx) as data");
		echo $d['0']->jumlah;
	}
}
