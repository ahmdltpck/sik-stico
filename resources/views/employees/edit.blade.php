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
                            <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}">Pegawai</a></li>
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
                            <form action="{{ route('pegawai.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="card col-sm-3">
                                    <div class="card-body">
                                    @if (!empty($employee->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/employee/' . $employee->photo) }}" 
                                            alt="{{ $employee->name }}"
                                            width="150px" height="150px">
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor Induk Pegawai</label>
                                    <input type="text" name="code" required readonly value="{{$employee->code}} " 
                                        maxlength="10"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pegawai</label>
                                    <input type="text" name="name" required value="{{$employee->name}} " 
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="gender" id="gender" 
                                        required class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                        <option value="{{ $employee->gender }}">{{ $employee->gender }}</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                       
                                    </select>
                                    <p class="text-danger">{{ $errors->first('gender') }}</p>
                                </div>
                            <div class="form-group col-sm-3">
                                    <label for="">Tanggal Lahir</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date"name="birthDate" value="{{ $employee->birthDate }}"  width="20" class="form-control {{ $errors->has('birthDate') ? 'is-invalid':'' }}">
                                  </div>
                                    
                                    <p class="text-danger">{{ $errors->first('birthDate') }}</p>
                                </div>   
                               
                                <div class="form-group">
                                    <label for="">Gaji</label>
                                    <input type="number" name="charge" required value="{{ $employee->charge }}"
                                        class="form-control {{ $errors->has('charge') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('charge') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Telepon</label>
                                    <input type="text" name="mobile" required value="{{ $employee->mobile }}"
                                        class="form-control {{ $errors->has('mobile') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('mobile') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="{{ $employee->email }}"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Tinggi Badan</label>
                                    <input type="text" name="height" required value="{{ $employee->height }}"
                                        class="form-control {{ $errors->has('height') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('height') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Berat Badan</label>
                                    <input type="text" name="weight" required value="{{ $employee->weight }}"
                                        class="form-control {{ $errors->has('weight') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Simpan
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