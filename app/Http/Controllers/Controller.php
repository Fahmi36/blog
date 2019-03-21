<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Pembelian;
use Redirect;
use Auth;

class Controller extends BaseController
{
	public function beli($link)
	{
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
	}else if($link=="pln"){
		$data = [
			'inquiry' => 'HARGA', // konstan
			'code' => 'PLN', // pilihan: pln, pulsa, game
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
	return dd($hasil);
	if ($link=="pulsa") {
		return view('admin/belipulsa', ['data'=>$hasil]);
	}else if($link=="voucergame"){
		return view('', ['data'=>$hasil]);
	}else if($link=="pln"){
		return view('admin/pln', ['data'=>$hasil]);
	}
	return view('404found', ['data'=>$hasil]);
}
public function proses($link)
{

	if(!empty(Session::get('user'))){
		$random = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$hitungrandom = strlen($random);
		$hasilrandom = '';
		for ($i=0; $i < 100 ; $i++) { 
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
			$users = User::find(Session::get('user')->id_user);
			if ($users->saldo < $query->harga) {
				return redirect('/history'); 
			}else{
				$url = 'https://portalpulsa.com/api/connect/';

				$header = [
					'portal-userid: P74054',
					'portal-key: c7134fde7cddf7aac0f1656cb37da787', // lihat hasil autogenerate di member area
					'portal-secret: 559a878e820e7e19c8fd085edf0ac2ff7ce9248934fb10e20fc1b9699fcf61a5', // lihat hasil autogenerate di member area
				];

				if ($link=='pulsa') {
					$data = [
						'inquiry' => 'I', // konstan
						'code' => $input['code'], // kode produk
						'phone' => $input['no_hp'], // no_hp pembeli
						'trxid_api' => $hasilrandom, // Trxid / Reffid dari sisi client
						'no' => '1',
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
					$data = [
						'inquiry' => 'PLN', // konstan
						'code' => $input['code'], // kode produk
						'phone' => $input['no_hp'], // no_hp pembeli
						'idcust' => $input['no_meter'],
						'trxid_api' => $hasilrandom, // Trxid / Reffid dari sisi client
						'no' => '1',
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
				$beli->nomer_hp = $input['no_hp'];
				if ($link=='tokenpln') {
					$beli->nomer_meteran = $input['no_meter'];
				}
				$beli->status = 'sukses';
				$beli->deskripsi = $hasil['message'];
				$beli->tanggal = date('Y-m-d H:i:s');
				try {
					$beli->save();
					return response()->json(['sukses' => true,'data' => $hasil]);
				} catch (Exception $e) {
					return response()->json(['sukses' => false,'data' => $hasil]);
				}

			}
		}
	}
	return View('login');
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

		return View('login');
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
			return view('admin/dashboard');
		}
		return View('login');
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
			'code' => 'PULSA', // pilihan: pln, pulsa, game
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

		$produk = new Produk;
		foreach ($$hasil['message'] as $key) {
			$produk->provider = $key->provider;
			$produk->provider_sub = $key->provider_sub;
			$produk->operator = $key->operator;
			$produk->operator_sub = $key->operator_sub;
			$produk->code = $key->code;
			$produk->description = $key->description;
			$produk->price = $key->price;
			$produk->status = $key->status;
		}
		try {
			$produk->save();
		} catch (Exception $e) {
			return redirect('dashboard');
		}
	}
	return View('login');
}
public function setting(Request $request)
{
	if(!empty(Session::get('user'))){
		$query = User::where('id_user','=',$request->session()->get('user')->id_user)->get();
		return view('admin.setting', ['users'=>$query]);;
	}
	return View('login');
}
public function dosetting()
{
	if(!empty(Session::get('user'))){

		$input = Input::all();
		$edit = User::find($input['id']);
		if ($input['password']!='') {
			$edit->username = $input['username'];
			$edit->password = $input['password'];
		}else{
			$edit->username = $input['username'];
		}
		try {
			$edit->save();

		} catch (Exception $e) {

		}

	}
	return View('login');
}

public function logout(Request $request)
{
	$request->session()->forget('user');
	return redirect('/login');
}
}
