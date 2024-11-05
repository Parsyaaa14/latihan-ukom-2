@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Tambah Barang</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('data_barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <label for="id_barang">ID Barang:</label>
                            </td>
                            <td>
                                <input type="text" name="id_barang" class="form-control" value="{{ old('id_barang') }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="nama_barang">Nama Barang:</label>
                            </td>
                            <td>
                                <input type="text" name="nama_barang" class="form-control"
                                    value="{{ old('nama_barang') }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="harga">Harga:</label>
                            </td>
                            <td>
                                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="stok">Stok:</label>
                            </td>
                            <td>
                                <input type="number" name="stok" class="form-control" value="{{ old('stok') }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="foto">Foto:</label>
                            </td>
                            <td>
                                <input type="file" name="foto" class="form-control"> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('data_barang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
