@extends('layouts.master')
@section('title')
    <title>Edit Data Produk</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}">Dokter</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                            
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
                            <form action="{{ route('dokter.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Kode Produk</label>
                                    <input type="text" name="code" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $doctor->code }}"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $doctor->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="address" id="address" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}">{{ $doctor->address }}</textarea>
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Telepon</label>
                                    <input type="text" name="mobile" required 
                                        value="{{ $doctor->mobile }}"
                                        class="form-control {{ $errors->has('mobile') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('mobile') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Gaji</label>
                                    <input type="number" name="charge" required 
                                        value="{{ $doctor->charge }}"
                                        class="form-control {{ $errors->has('charge') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('charge') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Keahlian</label>
                                    <select name="specialist_id" id="specialist_id" 
                                        required class="form-control {{ $errors->has('charge') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($specialists as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $doctor->specialist_id ? 'selected':'' }}>
                                                {{ ucfirst($row->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('specialist_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($doctor->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/doctor/' . $doctor->photo) }}" 
                                            alt="{{ $doctor->name }}"
                                            width="150px" height="150px">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> Update
                                    </button>
                                </div>
                            </form>
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