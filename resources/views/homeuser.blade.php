@extends('layouts.app1')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3 class="text-center my-4">Data Bunga</h3>
                    <hr>
                    <table class="table table-bordered">
                   
                        <thead>
                            <tr>
                                <th scope="col">Nama Bunga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($flower as $flower)
                            <tr>
                                <td>{{ $flower->nama }}</td>
                                <td>{{ $flower->jumlah }}</td>
                                <td>{{ $flower->harga }}</td>
                                <td>
                                        @if($flower->image)
                                        <img src="{{ asset('storage/images/' . $flower->image) }}" alt="Gambar" style="max-width: 200px; max-height: 200px;">

                                        @else
                                        <p>Tidak ada gambar yang tersedia</p>
                                        @endif
                                    </td>
                                
                                    <td class="text-center">
                                    <form action="{{ route('flowers.beli', $flower->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin akan membeli {{ $flower->nama }}?')">
                                    @csrf
                                        <button type="submit" class="btn btn-success">Beli</button>
                                        </form>
                                    </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    <div class="alert alert-danger">
                                        Data produk belum tersedia.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection