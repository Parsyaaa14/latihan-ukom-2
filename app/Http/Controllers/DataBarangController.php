<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data barang
        $data_barang = DataBarang::all();

        // Mengembalikan view dengan data barang
        return view('data_barang.index', compact('data_barang'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'string|unique:data_barang,id_barang',
            'nama_barang' => 'string',
            'harga' => 'integer',
            'stok' => 'integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
        ]);

        // Simpan foto
        $foto = $request->file('foto');
        $fotoName = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('uploads/foto'), $fotoName); // Simpan di folder uploads/foto

        DataBarang::create([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $fotoName,
        ]);

        return redirect()->route('data_barang.index')->with('success', 'Data barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            // Mencoba untuk mendapatkan data barang berdasarkan ID
            $data_barang = DataBarang::findOrFail($id); // Jika ID tidak ditemukan, akan memicu exception

            // Jika ditemukan, kembalikan tampilan dengan data barang
            return view('data_barang.show', compact('data_barang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika tidak ditemukan, tambahkan pesan error ke session dan redirect
            return redirect()->back()->with('error', 'Data barang dengan ID ' . $id . ' tidak ditemukan.');
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            // Coba untuk mendapatkan data barang berdasarkan ID
            $data_barang = DataBarang::findOrFail($id); // Jika tidak ditemukan, akan memicu exception

            // Jika ditemukan, kembalikan view dengan data barang
            return view('data_barang.edit', compact('data_barang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika tidak ditemukan, tambahkan pesan error ke session dan redirect
            return redirect()->route('data_barang.index')->with('error', 'Data barang dengan ID ' . $id . ' tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataBarang $data_barang)
    {
        $request->validate([
            'id_barang' => 'required|string|unique:data_barang,id_barang,' . $data_barang->id_barang . ',id_barang', // Validasi unik kecuali untuk data yang sedang di-update
            'nama_barang' => 'required|string',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'foto' => 'sometimes|image|max:2048', // Foto opsional saat update
        ], [
            'id_barang.unique' => 'ID Barang sudah ada, silakan masukkan ID lain.', // Pesan error untuk id_barang duplikat
        ]);

        // Jika ada foto baru, hapus foto lama dan simpan foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($data_barang->foto) {
                $oldPhotoPath = public_path('uploads/foto/' . $data_barang->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Simpan foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/foto'), $fotoName); // Simpan di folder uploads/foto
            $data_barang->foto = $fotoName; // Set nama foto baru
        }

        // Update data barang termasuk id_barang
        $data_barang->update($request->except('foto'));

        // Update id_barang secara manual jika diubah
        if ($request->id_barang !== $data_barang->id_barang) {
            $data_barang->id_barang = $request->id_barang;
            $data_barang->save();
        }

        return redirect()->route('data_barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    // Mencari barang berdasarkan ID
    $data_barang = DataBarang::find($id);

    // Cek apakah barang ditemukan
    if ($data_barang) {
        // Jika ditemukan, hapus barang
        $data_barang->delete();
        return redirect()->route('data_barang.index')->with('success', 'Barang berhasil dihapus.');
    } else {
        // Jika tidak ditemukan, kembalikan pesan error
        return redirect()->route('data_barang.index')->with('error', 'ID tidak ada.');
    }
}

}
