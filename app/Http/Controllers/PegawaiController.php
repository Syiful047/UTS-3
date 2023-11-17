<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index() {
        // mendapatkan semua data pegawais
        $pegawais = Pegawai::all();

        $data = [
            "message" => "Get all resources",
            "data" => $pegawais
        ];

        // kirim data (json) dan  response code
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        // validasi data request
        $request->validate([
            "nama" => "required",
            "gender" => "required",
            "phone" => "required",
            "address" => "required",
            "email" => "required|email",
            "status" => "required",
            "hired_on" => "required"
        ]);

        // menangkap data request
        $input = [
            'nama' => $request->nama,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'status' => $request->status,
            'hired_on' => $request->hired_on,
        ];

        // menggunakan model pegawai untuk insert data
        $pegawai = Pegawai::create($input);

        $data = [
            'message' => 'Data berhasil ditambahkan',
            'data' => $pegawai,
        ];

        return response()->json($data, 201);
    }

    // mendapatkan detail resource pegawai
    // membuat method show
    public function show($id)
    {
        // cari id pegawai yang ingin didapatkan
        $pegawai = Pegawai::find($id);
        if ($pegawai) {
            $data = [
                'message' => 'Get detail pegawai',
                'data' => $pegawai,
            ];

            // mengambilkan data (json) dan kode 200
            return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'pegawai not found',
            ];

            // mengembalikan data (json) dan ode 404
            return response()->json($data, 404);
        }
    }

    public function update($id, Request $request)
    {
        // menangkap id dari parameter
        $pegawai = Pegawai::find($id);
        // cek apakah ada pegawai dengan id tersebut
        // dan jika yang di cari tidak ada, kirim kode 404
        if (!$pegawai) {
            $data = [
                'message' => 'Data tidak ditemukan',
            ];
            return response()->json($data, 404);
        }

        // $pegawai->update($request->all());

        // menangkap data request
        $nama = $request->input('nama');
        $gender = $request->input('gender');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $email = $request->input('email');
        $status = $request->input('status');
        $hired_on = $request->input('hired_on');

        // mengupdate nilai atribut pada pegawai
        $pegawai->nama = $nama ?? $pegawai->nama;
        $pegawai->gender = $gender ?? $pegawai->gender;
        $pegawai->phone = $phone ?? $pegawai->phone;
        $pegawai->address = $address ?? $pegawai->address;
        $pegawai->email = $email ?? $pegawai->email;
        $pegawai->status = $status ?? $pegawai->status;
        $pegawai->hired_on = $hired_on ?? $pegawai->hired_on;


        //Menyimpan data yang telah diubah
        $pegawai->save();

        $data = [
            'message' => 'Data Berhasil Diubah',
            'data' => $pegawai
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)

    {
        // mencari data pegawai berdasarkan id
        $pegawai = Pegawai::find($id);

        // mengecek apakah data tersebut ada atau tidak
        if (!$pegawai) {
            $data = [
                'message' => 'Data tidak berhasil ditemukan',
            ];

            return response()->json($data, 404);
        }

        // menghapus data pegawai 
        $pegawai->delete();

        $data = [
            'message' => 'Data berhasil dihapus',
        ];
        return response()->json($data, 203);
    }
}
