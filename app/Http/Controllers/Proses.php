<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Produk;
use App\Topup;
use App\Callback;
use Redirect;
use Auth;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;

class Proses extends Controller
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

	public function dologin(request $request)
	{
		$rules = [
			'email' => 'required',
			'password' => 'required',
		];

		$validasi = Validator::make(Input::all(), $rules);
		if ($validasi->fails()) {
			return redirect('/login')
			->with('message', 'Silakan Periksa From')
			->with('status', 'danger')
				->withErrors($validasi) // send back all errors to the login form
				->withInput(Input::except('password')); 
			}else{			
				$cek_email = User::where('email', '=', Input::get('email'))->first();
				if ($cek_email=='') {
				// Email Kosong
					return redirect('/login')
					->with('message', 'Email anda blm terdaftar')
					->with('status', 'danger')
				->withErrors($validasi) // send back all errors to the login form
				->withInput(Input::except('password')); 
			}else if($cek_email->password==md5(Input::get('password'))){
				//Sukses Login
				$request->session()->put('user', $cek_email);
				return redirect('/dashboard')
				->with('message', 'Selamat Datang')
				->with('status', 'success')
				->withErrors($validasi) // send back all errors to the login form
				->withInput(Input::except('password')); 
			}else{
				// Password Salah
				return redirect('/login')
				->with('message', 'Password Anda salah')
				->with('status', 'danger')
				->withErrors($validasi) // send back all errors to the login form
				->withInput(Input::except('password')); 
			}
		}
	}
	public function doregis()
	{
		$rules = [
			'username' => 'required',
			'email' => 'required',
			'password' => 'required',
		];

		$validasi = Validator::make(Input::all(),$rules);

		if ($validasi->fails()) {
			return redirect('/register')
			->with('message', 'Silakan Periksa Form')
			->with('status', 'danger');
		}else{

			$cek_email = User::where('email', '=', Input::get('email'))->first();
			if ($cek_email > 1) {
				// Email Kosong
				return redirect('/login')
				->with('message', 'Email anda sudah terdaftar')
				->with('status', 'danger');
			}else{
				$input = Input::all();
				$users = new User;
				$users->username = $input['username'];
				$users->email = $input['email'];
				$users->password = md5($input['password']);
				$users->ulang_password = $input['password'];
				$users->saldo = '0';
				$users->role = 'member';
				$users->validasi_ktp = '';
				$users->tanggal = date('Y-m-d');
				try {
					$users->save();
					return redirect('/login')
					->with('message', 'Berhasil Mendaftar')
					->with('status', 'success');;
				} catch (Exception $e) {
					return redirect('/register')
					->with('message', 'Gagal Mendaftar')
					->with('status', 'danger');;
				}
			}
		}
	}
	public function getpulsa(Request $request)
	{

		if(!empty(Session::get('user'))){
			$validasi = Input::all();
			$key = '%'.$validasi['cari'].'%';
			$query = Produk::where([
				['prefix','LIKE', $key],
				['provider_sub','=', 'REGULER'],
				['status','!=', 'GANGGUAN']
			])->get();
		// return dd($key);
			if ($key=="%%" OR $key=='%0%' OR $key=='%08%') {
				echo "<option value=''>Pilih Produk</option>";
			}else{
				foreach ($query as $row){
					echo "<option value=$row->code>$row->description - Rp.".number_format($row->price)."</option>";
				}
			}
		}else{
			return redirect('/register');
		}

	}
	public function getdata(Request $request)
	{
		$validasi = Input::all();
		$key = '%'.$validasi['cari'].'%';
		$query = Produk::where([
			['prefix','LIKE', $key],
			['provider_sub','=', 'INTERNET'],
			['status','!=', 'GANGGUAN']
		])->get();
		// return dd($key);
		if ($key=="%%" OR $key=='%0%' OR $key=='%08%') {
			echo "<option value=''>Pilih Produk</option>";
		}else{
			foreach ($query as $row){
				echo "<option value=$row->code>$row->description - Rp.".number_format($row->price)."</option>";
			}
		}

	}
	public function gettxtfile()
	{
		$myFile = "./../public/save.txt";
		$lines = file($myFile);
		for ($i=0; $i < count($lines); $i++) { 
			dd($lines);
		}
		// Pembelian::insert($lines);
	}
	public function deposit()
	{
		if(!empty(Session::get('user'))){
			$rules = [
				'bank' => 'required',
				'Nominal' => 'required',
				'nama'=> 'required',
			];
			$validasi = Validator::make(Input::all(),$rules);

			if ($validasi->fails()) {
				return redirect('/dashboard')
				->with('message','Ada Data Yang Kosong')
				->with('status','danger');
			}else{
				$url = file_get_contents("https://free.currencyconverterapi.com/api/v6/convert?q=USD_IDR&compact=ultra");
				$result = json_decode($url, True);

				$input = Input::all();
				$tambah = new Topup();
				$tambah->id_users = Session::get('user')->id_user;
				$tambah->harga = $input['Nominal'];
				if ($input['bank']=='Paypal') {
					$tambah->usd = $input['Nominal'] / $result['USD_IDR'];
				}
				$tambah->nama_bank = $input['bank'];
				$tambah->nama = $input['nama'];
				$tambah->expired = date("Y-m-d", time() + 86400);
				$tambah->tanggal = date('Y-m-d');
				$payload = [
					'transaction_details' => [
						'order_id'      => $tambah->id,
						'gross_amount'  => $tambah->harga,
					],
					'customer_details' => [
						'first_name'    => $tambah->nama,
						'email'         => Session::get('user')->email,
					],
					'item_details' => [
						[
							'id'       => 'Pembayaran',
							'price'    => $tambah->harga,
							'quantity' => 1,
							'name'     => ucwords(str_replace('_', ' ', 'Pembayaran'))
						]
					]
				];
				$snapToken = Veritrans_Snap::getSnapToken($payload);
				$tambah->snap_token = $snapToken;
				$tambah->save();
            	$this->response['snap_token'] = $snapToken;
				return response()->json($snapToken);
			}
		}else{
			return redirect('/login');
		}
	}
	public function notificationHandler(Request $request)
	{
		$notif = new Veritrans_Notification();
		\DB::transaction(function() use($notif) {

			$transaction = $notif->transaction_status;
			$type = $notif->payment_type;
			$orderId = $notif->order_id;
			$fraud = $notif->fraud_status;
			$donation = Topup::findOrFail($orderId);

			if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
				if ($type == 'credit_card') {

					if($fraud == 'challenge') {
                // TODO set payment status in merchant's database to 'Challenge by FDS'
                // TODO merchant should decide whether this transaction is authorized or not in MAP
                // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
						$donation->setPending();
					} else {
                // TODO set payment status in merchant's database to 'Success'
                // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
						$donation->setSuccess();
					}

				}

			} elseif ($transaction == 'settlement') {

            // TODO set payment status in merchant's database to 'Settlement'
            // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
				$donation->setSuccess();

			} elseif($transaction == 'pending'){

            // TODO set payment status in merchant's database to 'Pending'
            // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
				$donation->setPending();

			} elseif ($transaction == 'deny') {

            // TODO set payment status in merchant's database to 'Failed'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
				$donation->setFailed();

			} elseif ($transaction == 'expire') {

            // TODO set payment status in merchant's database to 'expire'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
				$donation->setExpired();

			} elseif ($transaction == 'cancel') {

            // TODO set payment status in merchant's database to 'Failed'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
				$donation->setFailed();

			}

		});

		return;
	}
	public function konfirmasisaldo(Request $request)
	{

		if(!empty(Session::get('user'))){
			$rules = [
				'gambar' => 'required',
			];
			$validasi = Validator::make(Input::all(),$rules);

			if ($validasi->fails()) {
				return response()->json(['sukses' => false,'message' => "Gambar Harus di Isi"]);
			}else{
				$input = Input::all();
				$edit = Topup::find($input['idnya']);
				$file       = $request->file('gambar');
				$fileName   = $file->getClientOriginalName();
				$request->file('gambar')->move("images/", $fileName);
				$edit->bukti = $fileName;
				$edit->save();
				return response()->json(['sukses' => true,'message' => "Tunggu 3 - 10 menit"]);
			}
		}else{
			return redirect('/login');
		}
	}
	public function verifikasi($id)
	{

		if(!empty(Session::get('user'))  AND Session::get('user')->role == 'admin'){
			$edit = Topup::find($id);
			$query = User::find($edit->id_users);
			$edit->status = 'sukses';
			$query->saldo = $query->saldo + $edit->harga;
			if ($edit->save()===TRUE) {
				$query->save();
				return response()->json(['sukses' => true,'message' => 'Berhasil Verifikasi']);
			}else{
				return response()->json(['sukses' => false,'message' => 'Gagal Verifikasi']);
			}
		}else{
			return redirect('/login');
		}
	}
	public function actbank()
	{
		if(!empty(Session::get('user')) AND Session::get('user')->role == 'admin'){
			$rules = [
				'bank' => 'required',
				'no_rek' => 'required',
				'an'=> 'required',
			];
			$validasi = Validator::make(Input::all(),$rules);

			if ($validasi->fails()) {
				return redirect('/dashboard')
				->with('message','Ada Data Yang Kosong')
				->with('status','danger');
			}else{
				$input = Input::all();
				$bank = new Callback();
				$bank->nama_bank = $input['bank'];
				$bank->atas_nama = $input['an'];
				$bank->no_rek = $input['no_rek'];
				try {
					$bank->save();
					return redirect('/dashboard')
					->with('message','Data Berhasil Di Simpan')
					->with('status','success');
				} catch (Exception $e) {
					return redirect('/dashboard')
					->with('message','Data Gagal Di Simpan')
					->with('status','danger');
				}
			}
		}else{
			return redirect('/login');
		}
	}
	public function put()
	{
		$delete = Produk::truncate();
	}
	public function deletebank($id)
	{
		if(!empty(Session::get('user')) AND Session::get('user')->role == 'admin'){
			try {
				$delete = Callback::where('id_bank','=',$id)->delete();
				return redirect('/dashboard')
				->with('message','Data Berhasil Delete')
				->with('status','success');
			} catch (Exception $e) {
				return redirect('/dashboard')
				->with('message','Data Gagal Delete')
				->with('status','danger');
			}
		}else{
			return redirect('/login');
		}
	}
	public function updatehargapulsa(Request $request)
	{
		$input = Input::all();
		$edit = Produk::find($request->input('id_produk'));
		$edit->price = $request->input('datanya');
		$edit->save();
		return response()->json(['sukses' => true,'message' => "Sudah di Ubah"]);
	}
}