<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
	public function dashboard()
	{
		$users = User::all();
		return view('admin.dashboard', compact('users'));
	}

	public function showAddPenggunaForm()
	{
		return view('admin.tambah-pengguna');
	}

	public function addPengguna(Request $request)
	{
		$this->validator($request->all())->validate();

		$user = $this->create($request->all());

		return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil ditambahkan');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'username' => ['required', 'string', 'max:255'],
			'tanggal_lahir' => ['required', 'date'],
			'jenis_kelamin' => ['required', 'string', 'max:255'],
			'alamat' => ['required', 'string', 'max:255'],
			'no_telepon' => ['required', 'string', 'max:255'],
			'tipe_pengguna' => ['required', 'string', 'max:255'],
		]);
	}

	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'username' => $data['username'],
			'tanggal_lahir' => $data['tanggal_lahir'],
			'jenis_kelamin' => $data['jenis_kelamin'],
			'alamat' => $data['alamat'],
			'no_telepon' => $data['no_telepon'],
			'tipe_pengguna' => $data['tipe_pengguna'],
		]);
	}
}