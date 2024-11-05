@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        {{-- Cek jika ada pesan error dan tampilkan alert di bagian atas halaman --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="mb-4">Detail Barang</h1>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $data_barang->id_barang }}</td>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <td>{{ $data_barang->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ number_format($data_barang->harga, 0, ',', '.') }}</td> <!-- Format harga -->
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $data_barang->stok }}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if ($data_barang->foto)
                                    <img src="{{ asset('uploads/foto/' . $data_barang->foto) }}"
                                        alt="{{ $data_barang->nama_barang }}" style="width: 150px; height: auto;">
                                @else
                                    <p>Tidak ada foto</p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <a href="{{ route('data_barang.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Barang</a>
            </div>
        </div>
    </div>
@endsection
