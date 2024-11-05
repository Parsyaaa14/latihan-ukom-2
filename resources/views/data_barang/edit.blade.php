@extends('layouts.app')

@section('content')
    <div class="container mt-5">

                {{-- Cek jika ada pesan error dan tampilkan alert di bagian atas halaman --}}
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <h1>Edit Barang</h1>

        <div class="card mt-4">
            <div class="card-body">
                <form action="{{ route('data_barang.update', $data_barang) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <table class="table">
                        <tbody>
                            <tr>
                                <th><label for="id_barang">ID Barang:</label></th>
                                <td><input type="text" name="id_barang" id="id_barang" class="form-control"
                                        value="{{ old('id_barang', $data_barang->id_barang) }}" required>
                                    @error('id_barang')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th><label for="nama_barang">Nama Barang:</label></th>
                                <td><input type="text" name="nama_barang" id="nama_barang" class="form-control"
                                        value="{{ old('nama_barang', $data_barang->nama_barang) }}" required></td>
                            </tr>
                            <tr>
                                <th><label for="harga">Harga:</label></th>
                                <td><input type="number" name="harga" id="harga" class="form-control"
                                        value="{{ old('harga', $data_barang->harga) }}" required></td>
                            </tr>
                            <tr>
                                <th><label for="stok">Stok:</label></th>
                                <td><input type="number" name="stok" id="stok" class="form-control"
                                        value="{{ old('stok', $data_barang->stok) }}" required></td>
                            </tr>
                            <tr>
                                <th><label for="foto">Foto:</label></th>
                                <td>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                    @if ($data_barang->foto)
                                        <img src="{{ asset('storage/uploads/foto/' . $data_barang->foto) }}"
                                            alt="Foto Barang" class="img-thumbnail mt-2" style="max-width: 150px;">
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success mt-3">Update</button>
                    <a href="{{ route('data_barang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
