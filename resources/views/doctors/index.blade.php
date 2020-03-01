@extends('layouts.master')
@section('title')
    <title>Manajemen Dokter</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Dokter</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dokter</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            <a href="{{ route('dokter.create') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama dokter</th>
                                            <th>Telepon</th>
                                            <th>Gaji</th>
                                            <th>Keahlian</th>
                                            <th>Last Update</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    @forelse ($doctors as $row)
    <tr>
        <td>
            @if (!empty($row->photo))
                <img src="{{ asset('uploads/doctor/' . $row->photo) }}" 
                    alt="{{ $row->name }}" width="50px" height="50px">
            @else
                <img src="http://via.placeholder.com/50x50" alt="{{ $row->name }}">
            @endif
        </td>
        <td>
            <sup class="label label-success">({{ $row->code }})</sup>
            <strong>{{ ucfirst($row->name) }}</strong>
        </td>
        <td>{{ $row->mobile }}</td>
        <td>Rp {{ number_format($row->charge) }}</td>
        <td>{{ $row->specialist->name }}</td>
        <td>{{ $row->updated_at }}</td>
        <td>
            <form action="{{ route('dokter.destroy', $row->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
<div class="btn-group" role="group" aria-label="Basic example">

                <a href="{{ route('dokter.edit', $row->id) }}" 
                    class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center">Tidak ada data</td>
    </tr>
    @endforelse
</tbody>
                                </table>
                                <div class="float-right">
    {!! $doctors->links() !!}
</div>
                            </div>
                            @slot('footer')
​
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection