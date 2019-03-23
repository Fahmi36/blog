<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Pembelian;
use App\Callback;
use Redirect;
use Auth;
use DB;
use Carbon\Carbon;
use App\Produk;
use App\topup;
use App\Http\Controllers\Controller;
use DateTime;
use Veritrans_Config;

class Homecontroller extends Controller
{
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;

        // Set midtrans configuration
		Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
		Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
		Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
		Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
	}
	public function beli($link)
	{
		if(!empty(Session::get('user'))){
			$url = 'https://portalpulsa.com/api/connect/';

			$header = [
				'portal-userid: P74054',
				'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
				'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
			];
			if ($link=='pulsa') {
				$data = [
				'inquiry' => 'HARGA', // konstan
				'code' => 'PULSA', // pilihan: pln, pulsa, game
			];
		}else if($link=='voucergame'){
			$data = [
				'inquiry' => 'HARGA', // konstan
				'code' => 'GAME', // pilihan: pln, pulsa, game
			];
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		$hasil = json_decode($result, true);
		//return dd($hasil);
		if ($link=="pulsa") {
			return view('admin/belipulsa', ['data'=>$hasil]);
		}else if($link=="voucergame"){
			return view('', ['data'=>$hasil]);
		}else{
			return view('404found', ['data'=>$hasil]);
		}
	}else{
		return redirect('/login');
	}
}
public function pln()
{
	if(!empty(Session::get('user'))){
		$hasil = Produk::where('provider_sub','=', 'PLN')->get();
		return view('admin/pln', ['data'=>$hasil]);
	}else{
		return redirect('/login');
	}
}
public function transfer()
{
	if(!empty(Session::get('user'))){
		$hasil = Produk::where('provider_sub','=', 'TRANsfer')->get();
		return view('admin/transferpulsa', ['data'=>$hasil]);
	}else{
		return redirect('/login');
	}
}
public function proses($link)
{

	if(!empty(Session::get('user'))){
		$random = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$hitungrandom = strlen($random);
		$hasilrandom = '';
		for ($i=0; $i < 15 ; $i++) { 
			$hasilrandom .= $random[rand(0,$hitungrandom - 1)];
		}

		if ($link=='pulsa') {
			$rules = array(
				'no_hp'=>'required',
				'code'=>'required'
			);
		}else if($link=='voucergame'){
			$rules = array(
				'no_hp'=>'required',
				'code'=>'required'
			);
		}else if($link=="tokenpln"){
			$rules = array(
				'no_meter'=>'required',
				'code'=>'required'
			);
		}

		$validasi = Validator::make(Input::all(), $rules);
		if ($validasi->fails()) {
			echo "Periksa Form anda";
		}else{

			$input = Input::all();
			$query = Produk::where('code','=',$input['code'])->get();
			$users = User::where('id_user',Session::get('user')->id_user)->get();
			if ($users[0]->saldo < $query[0]->price) {
				return response()->json(['sukses' => false,'data' => 'Maaf saldo anda tidak mecukupi']);
			}else{
				$url = 'https://portalpulsa.com/api/connect/';

				$header = [
					'portal-userid: P74054',
					'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
					'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
				];
				$parameter = array( 
							'inquiry' => 'S', // konstan
						);
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $parameter);
				$cek = curl_exec($curl);
				$saldo = json_decode($cek, true);
				if ($saldo["balance"] < $query[0]->price) {
					return response()->json(['sukses' => false,'data' => "Maaf Pembelian Tidak Dapat Di Proses Silakan Hubungi Admin"]);
				}else{
					if ($link=='pulsa') {
						$pembeli = Pembelian::where([
							['nomer_hp','=',$input['no_hp']],
							['tanggal','like','%'.date('Y-m-d').'%']
						])->count();
						$data = [
						'inquiry' => 'I', // konstan
						'code' => $input['code'], // kode produk
						'phone' => $input['no_hp'], // no_hp pembeli
						'trxid_api' => $hasilrandom, // Trxid / Reffid dari sisi client
						'no' => $pembeli+1,
					];
				}else if($link=='voucergame'){
					$data = [
						'inquiry' => 'I', // konstan
						'code' => $input['code'], // kode produk
						'phone' => $input['no_hp'], // no_hp pembeli
						'trxid_api' => $hasilrandom, // Trxid / Reffid dari sisi client
						'no' => '1',
					];
				}else if($link=="tokenpln"){
					$tokenpln = Pembelian::where([
						['nomer_meteran','=',$input['no_meter']],
						['tanggal','like','%'.date('Y-m-d').'%']
					])->count();
					$data = [
						'inquiry' => 'PLN', // konstan
						'code' => $input['code'], // kode produk
						'phone' => $input['no_hp'], // no_hp pembeli
						'idcust' => $input['no_meter'],
						'trxid_api' => $hasilrandom, // Trxid / Reffid dari sisi client
						'no' => $tokenpln+1,
					];
				}
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$result = curl_exec($ch);
				$hasil = json_decode($result, true);
				$beli = new Pembelian;
				$beli->id_users = Session::get('user')->id_user;
				$beli->id_produk = $input['code'];
				$beli->trxid = $hasilrandom;
				$beli->status = 'sukses';
				$beli->nomer_hp = $input['no_hp'];
				if ($link=='tokenpln') {
					$beli->nomer_meteran = $input['no_meter'];
				}
				$beli->deskripsi = $hasil['message'];
				$beli->tanggal = date('Y-m-d H:i:s');
				try {
					if ($hasil['result']=='failed') {
						return response()->json(['sukses' => false,'data' => "Gagal Di Proses"]);
					}else{
						$user = User::find(Session::get('user')->id_user);
						$user->saldo = $users[0]->saldo - $query[0]->price;
						$beli->save();
						$user->save();
						return response()->json(['sukses' => true,'data' => $hasil['result']]);
					}
				} catch (Exception $e) {
					return response()->json(['sukses' => false,'data' => $hasil['result']]);
				}
			}
		}
	}
}
return redirect('/login');
}
public function history($link)
{

	if(!empty(Session::get('user'))){
		if ($link=='pulsa') {
			if (Session::get('user')->role == 'admin') {
				$cek = Pembelian::where('nomer_meteran','=',NULL)->get();
				return view('admin.historypulsa',['data'=>$cek]);
			}else{
				$cek = Pembelian::where([["id_users", '=' ,Session::get('user')->id_user],['nomer_meteran','=',NULL]])->get();
				return view('admin.historypulsa',['data'=>$cek]);
			}
		}else{
			if (Session::get('user')->role == 'admin') {
				$cek = Pembelian::where('nomer_meteran','!=',NULL)->get();
				return view('admin.historypln',['data'=>$cek]);
			}else{
				$cek = Pembelian::where([["id_users", '=' ,Session::get('user')->id_user],['nomer_meteran','!=',NULL]])->get();
				return view('admin.historypln',['data'=>$cek]);
			}
		}
	}
	return redirect('/login');
}

public function ceksaldoadmin()
{
	if(!empty(Session::get('user'))){
		$url = 'https://portalpulsa.com/api/connect/';

		$header = [
			'portal-userid: P74054',
				'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
				'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
			];
			$data = [
				'inquiry' => 'S', // konstan
			];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			$hasil = json_decode($result, true);
		}

		return redirect('/login');
	}
	public function login()
	{
		if(!empty(Session::get('user'))){
			return Redirect::to('/dashboard');
		}
		return View('login');
	}
	public function register()
	{
		if(!empty(Session::get('user'))){
			return Redirect::to('/dashboard');
		}
		return View('register');
	}
	public function dashboard()
	{
		if(!empty(Session::get('user'))){
			$events = DB::select("SELECT (DATE(NOW()) - INTERVAL `day` DAY) AS `DayDate`, COUNT(`tanggal`) AS `credits` FROM ( SELECT 0 AS `day` UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 ) AS `week`  LEFT JOIN `pembelians` ON DATE(`tanggal`) = (DATE(NOW()) - INTERVAL `day` DAY) WHERE id_users = ".Session::get('user')->id_user." GROUP BY `tanggal` ORDER BY `tanggal` ASC ");
			// if (array_key_exists(date('Y-m-d'), $events[0]->DayDate)) {
			// 	$count = $events[0]->DayDate
			// }
			$join = DB::table('users')
			->where('users.id_user','=',Session::get('user')->id_user)
			->get();
			$pembelian = Pembelian::where([['id_users','=',Session::get('user')->id_user],['tanggal','LIKE','%'.date('Y-m-d').'%']])->get();
			$users = DB::table('users');
			$topup = Topup::where([['id_users','=',Session::get('user')->id_user],['status','=','pending']])->get();
			// return dd($events);
			return view('admin/dashboard',['data'=>$join, 'person'=>$users,'pembelian'=>$pembelian,'pending'=>$topup,'grafik'=>$events]);
		}else{
			return redirect('/login');

		}
	}
	public function topup()
	{

		if(!empty(Session::get('user'))){
			return view('admin/tambahsaldo');
		}
		return redirect('/login');
	}
	public function setting(Request $request)
	{
		if(!empty(Session::get('user'))){
			$query = User::where('id_user','=',$request->session()->get('user')->id_user)->get();
			return view('admin.setting', ['users'=>$query]);;
		}
		return redirect('/login');
	}
	public function dosetting()
	{
		if(!empty(Session::get('user'))){

			$input = Input::all();
			$edit = User::find($input['id']);
			if ($edit->ubah=='1') {
				return response()->json(['sukses' => false,'data' => "Perubahan data hanya bisa satu kali sehari"]);
			}else{
				if ($input['password']!='') {
					$edit->username = $input['username'];
					$edit->password = $input['password'];
					$edit->email = $input['email'];
					$edit->no_hp = $input['no_hp'];
					$edit->ubah = '1';
					$edit->tanggal_ubah = date('Y-m-d');
					$lihat = substr($edit->no_hp, 1);
					if ($lihat!=0) {
						$messages = array(
							'sender' => "Famitra",
							'messages' => array(
								array(
									'number' => '+62'.$edit->no_hp,
									'text' => rawurlencode('Data anda berhasil di ubah
										Password anda : '.$input['password'].'')
								)    )
						);

						$data = array(
							'apikey' => 'UVPpk8DCl9o-M7XAk3GFr1ZwhQa1ZkGB1DxCzC3CnQ',
							'data' => json_encode($messages)
						);

						$ch = curl_init('https://api.txtlocal.com/bulk_json/');
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$response = curl_exec($ch);
						curl_close($ch);
					}
				}else{
					$edit->username = $input['username'];
					$edit->email = $input['email'];
					$edit->no_hp = $input['no_hp'];
					$edit->ubah = '1';
					$edit->tanggal_ubah = date('Y-m-d');
				}
				try {	
					// return dd($response);
					$edit->save();
					return response()->json(['sukses' => true,'data' => "Data anda berhasil di ubah",'hasil'=>$edit]);
				} catch (Exception $e) {

					return response()->json(['sukses' => false,'data' => 'Data anda berhasil di ubah']);
				}
			}
		}
		return redirect('/login');
	}
	public function deposit()
	{
		if(!empty(Session::get('user'))){
			$banks = DB::table('banks')->get();
			$deposit = Topup::where([['id_users','=',Session::get('user')->id_user],['status','=','pending']])->get();
			return view('admin.deposit',['bank'=>$banks,'deposit'=>$deposit]);
		}else{
			return redirect('/login');
		}
	}
	public function refresh()
	{
		if(!empty(Session::get('user'))){
			$url = 'https://portalpulsa.com/api/connect/';

			$header = [
				'portal-userid: P74054',
					'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
					'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
				];
				$data = [
			'inquiry' => 'HARGA', // konstan
			'code' => 'game', // pilihan: pln, pulsa, game
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		$hasil = json_decode($result, true);

		Produk::insert($hasil['message']);
	}
	return redirect('/login');
}
public function refresh2()
{
	if(!empty(Session::get('user'))){
		$url = 'https://portalpulsa.com/api/connect/';

		$header = [
			'portal-userid: P74054',
					'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
					'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
				];
				$data = [
			'inquiry' => 'HARGA', // konstan
			'code' => 'pulsa', // pilihan: pln, pulsa, game
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		$hasil = json_decode($result, true);

		Produk::insert($hasil['message']);
	}
	return redirect('/login');
}
public function refresh3()
{
	if(!empty(Session::get('user'))){
		$url = 'https://portalpulsa.com/api/connect/';

		$header = [
			'portal-userid: P74054',
					'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
					'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
				];
				$data = [
			'inquiry' => 'HARGA', // konstan
			'code' => 'pln', // pilihan: pln, pulsa, game
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		$hasil = json_decode($result, true);

		Produk::insert($hasil['message']);
	}
	return redirect('/login');
}
public function listharga($link)
{
	$users = DB::table('produks')
	->get();
	if ($link=='pln') {
		return view('admin.listhargapln', ['data'=>$users]);
	}else if ($link=='inet') {
		return view('admin.listhargainet', ['data'=>$users]);
	}else{
		return view('admin.listharga', ['data'=>$users]);	
	}
}
public function konfirmasi($id)
{
	if(!empty(Session::get('user'))){
		return view('admin.konfirmasi',['id'=>$id]);
	}else{
		return redirect('/login');
	}
}
public function cekkonfirmasi()
{
	if(!empty(Session::get('user')) AND Session::get('user')->role == 'admin' ){
		$data = Topup::where('status','=','pending')->get();
		return view('admin.verify',['topup'=>$data]);
	}else{
		return redirect('/login');
	}
}
public function tambahbank()
{
	if(!empty(Session::get('user')) AND Session::get('user')->role == 'admin' ){
		$data = Callback::get();
		return view('admin.tambahbank',['bank'=>$data]);
	}else{
		return redirect('/login');
	}
}
public function ubahpulsa()
{
	if(!empty(Session::get('user')) AND Session::get('user')->role == 'admin' ){
		$data = Produk::where('provider_sub','=','REGULER')->get();
		return view('admin.ubahharga',compact('data'));
	}else{
		return redirect('/login');
	}
}
public function ubahpln()
{
	if(!empty(Session::get('user')) AND Session::get('user')->role == 'admin' ){
		$data = Produk::where('provider_sub','=','PLN')->get();
		return view('admin.ubahhargapln',compact('data'));
	}else{
		return redirect('/login');
	}
}
public function daftarharga()
{
	if(!empty(Session::get('user'))){
		$url = 'https://portalpulsa.com/api/connect/';

		$header = [
			'portal-userid: P74054',
				'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
				'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
			];
			$data = array( 
				'inquiry' => 'HARGA', // konstan
				'code' => 'pulsa', // pilihan: pln, pulsa, game
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			$data = json_decode($result, true);
			return view('list-harga',compact('data'));
		}
	}
	public function daftarhargapln()
{
	if(!empty(Session::get('user'))){
		$url = 'https://portalpulsa.com/api/connect/';

		$header = [
			'portal-userid: P74054',
				'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
				'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
			];
			$data = array( 
				'inquiry' => 'HARGA', // konstan
				'code' => 'pln', // pilihan: pln, pulsa, game
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			$data = json_decode($result, true);
			return view('list-harga',compact('data'));
		}
	}
	public function addcekmutasi()
	{
// I think 6 days range is good enough
		$startOfMonth = Carbon::now()->startOfMonth();
		$startDate    = Carbon::now()->subDays(6);
		$endDate      = Carbon::now();

// Some e-banking websites does not allow us to collect more than a month
// from current date
// Use first date of current month if 6 days are to much
		if ($startOfMonth->month != $startDate->month || $startOfMonth->year != $startDate->year) {
			$startDate = $startOfMonth;
		}

		$statementProvider = app(\Sule\BankStatements\Statement::class);
		dd($statementProvider->collect($startDate, $endDate));

	}
	public function apaantau()
	{
		$accountId = 0;

// Set specific statement type "CR" or "DB"
		$type = '';

// Set specific date range
		$fromDate = '';
		$toDate   = '';

		$statementProvider = app(\Sule\BankStatements\Statement::class);
		dd($collection = $statementProvider->search([
			'bank_account_id' => $accountId, 
			'type'            => $type, 
			'from_date'       => $fromDate, 
			'end_date'        => $toDate, 
			'order_by'        => 'id'
		]));

	}
	public function logout(Request $request)
	{
		$request->session()->forget('user');
		$request->session()->remove('user');
		$request->session()->flush();
		return redirect('/login');
	}


}
