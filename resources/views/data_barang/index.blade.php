@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        {{-- Cek jika ada pesan sukses dan tampilkan alert sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Menampilkan alert jika ada error -->
        @if ($errors->has('error'))
            <script>
                alert("{{ $errors->first('error') }}");
            </script>
        @endif


        {{-- Cek jika ada pesan error dan tampilkan alert di bagian atas halaman --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h1>Daftar Barang</h1>
            </div>
            <div class="card-body">
                <a href="{{ route('data_barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Barang</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_barang as $barang)
                            <tr>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>
                                    <a href="{{ route('data_barang.show', $barang->id_barang) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('data_barang.edit', $barang) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('data_barang.destroy', $barang->id_barang) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                                    </form>
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
