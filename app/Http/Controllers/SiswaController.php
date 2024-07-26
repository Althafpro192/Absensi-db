<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return response()->json(['data' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NISN' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'kelas_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid field', 'errors' => $validator->errors()]);
        }

        $siswa = Siswa::create([
            'NISN' => $request->nisn,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id,
        ]);
        return response()->json(['data' => $siswa]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) return $this->fail('siswa tidak ditemukan', 404);
        return $this->success($siswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) return $this->fail('siswa tidak ditemukan', 404);
        $siswa->update($request->all());
        return $this->message('Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) return $this->fail('siswa tidak ditemukan', 404);
        $siswa->delete();
        return $this->message('Berhasil hapus data');
    }
}