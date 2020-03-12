@extends('layouts.master')

@section('title')
    <title>Manajemen Kasur</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Kasur</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kasur</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        @card
                            @slot('title')
                            Edit
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​
                            <form role="form" action="{{ route('kasur.update', $seat->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                 <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="name">Nomor</label>
                                    <input type="text" value="{{ $seat->seatNo }}" 
                                    name="seatNo"
                                    class="form-control {{ $errors->has('seatNo') ? 'is-invalid':'' }}" id="name" required>
                                    <p class="text-danger">{{ $errors->first('seatNo') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Lantai</label>
                                    <input type="number" 
                                    name="seatFloor"
                                    value="{{ $seat->seatFloor }}"
                                    class="form-control {{ $errors->has('seatFloor') ? 'is-invalid':'' }}" id="name" required>
                                    <p class="text-danger">{{ $errors->first('seatFloor') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Tipe</label>
                                    <select name="seatType"  class="form-control {{ $errors->has('seatFloor') ? 'is-invalid':'' }}">
                                        <option>{{ $seat->seatType }}</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C" >C</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('seatType') }}</p>
                                </div>
                                <div class="form-group">
                                    
                                    <label for="">Foto</label>
                                    <input type="file" name="image" class="form-control">
                                    <p class="text-danger">{{ $errors->first('image') }}</p><img src="{{ asset('uploads/seat/'.$seat->image) }}" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="description">Ukuran</label>
                                    <input type="text" 
                                    name="size" value="{{ $seat->size }}"
                                    class="form-control {{ $errors->has('size') ? 'is-invalid':'' }}" id="name" required>
                                    <p class="text-danger">{{ $errors->first('size') }}</p>
                                </div>
                                <div class="form-group"> 
                                    <label for="status">Status</label>
                                 
                                                <select name="status"  class="form-control {{ $errors->has('rent') ? 'is-invalid':'' }}">
                                        <option >@if ($seat->status)
                                               Tersedia
                                                @else
                                                Terpakai
                                                @endif
                                            </td></option>
                                        <option value="1">Tersedia</option>
                                        <option value="0">Terpakai</option>
                                       

                                    </select>
                                <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                          

                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            @endslot
                        @endcard
                    </div>
                    <div class="col-md-8">
                        @card
                            @slot('title')
                            List Kasur
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
                                            <td>#</td>
                                            <td>Nomor Kasur</td>
                                            <td>Lantai</td>
                                            <td>Tipe</td>
                                            <td>Status</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($seats as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->seatNo }}</td>
                                            <td>{{ $row->seatFloor }}</td>
                                            <td>{{$row->seatType}}</td>
                                            <td> 
                                                @if ($row->status)
                                                <label class="badge badge-success">Tersedia</label>
                                                @else
                                                <label for="" class="badge badge-danger">Terpakai</label>
                                                @endif</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                
                                                <form action="{{ route('kasur.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                   
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('kasur.edit',$row->id) }} " class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                  <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                  
                                </div>
                                                </form> 

                                             
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @slot('footer')
​
                            @endslot
                        @endcard

                        {{$seats->links()}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection