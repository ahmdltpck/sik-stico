@extends('layouts.master')
@section('title')
    <title>Tambah Data Pasien</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pasien.index') }}">Pasien</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
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
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            <form action="{{ route('pasien.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nomor Induk Kependudukan</label>
                                    <input type="text" name="code" required 
                                        maxlength="10"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pasien</label>
                                    <input type="text" name="name" required 
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="gender" id="gender" 
                                        required class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
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
                                    <input type="date"name="birthDate"  width="20" class="form-control {{ $errors->has('birthDate') ? 'is-invalid':'' }}">
                                  </div>
                                    
                                    <p class="text-danger">{{ $errors->first('birthDate') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="">Gol. Darah</label>
                                    <input type="text" name="bloodGroup" required 
                                        class="form-control {{ $errors->has('bloodGroup') ? 'is-invalid':'' }}">

                                    <p class="text-danger">{{ $errors->first('bloodGroup') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Gejala</label>
                                    <textarea name="symptoms" id="symptoms" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('symptoms') ? 'is-invalid':'' }}"></textarea>
                                    <p class="text-danger">{{ $errors->first('symptoms') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Telepon</label>
                                    <input type="text" name="mobile" required 
                                        class="form-control {{ $errors->has('mobile') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('mobile') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" required 
                                        class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="address" id="address" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}"></textarea>
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Berat & Tinggi Badan</label>
                                    <input type="text" name="size" required 
                                        class="form-control {{ $errors->has('size') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('size') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipe Penyakit</label>
                                    <input type="text" name="type" required 
                                        class="form-control {{ $errors->has('type') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('type') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Perawat</label>
                                    <select name="employee_id" id="employee_id" 
                                        required class="form-control {{ $errors->has('type') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($employees as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('employee_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Kasur</label>
                                    <select name="seat_id" id="seat_id" 
                                        required class="form-control {{ $errors->has('type') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($seats as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->seatNo) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('seat_id') }}</p>
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