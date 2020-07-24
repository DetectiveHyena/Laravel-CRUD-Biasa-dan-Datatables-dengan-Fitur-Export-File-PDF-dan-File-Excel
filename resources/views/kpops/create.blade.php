@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center shadow p-3 mb-5 bg-white rounded">
         <h1 style="margin-bottom: 25px;" class="alert alert-primary"> Label K-Pop Populer Tahun 2020</h1>  <br>

       <div class="col-md-8">
           <h3 align="center">Tambah Data Agensi</h3><br>
           <div>  
              @if(count($errors) > 0 )
                  <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach  
                  </ul>
              @endif
          </div>
          <form action="{{ route('kpops.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
              <label for="nama">Nama Agensi</label>
              <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" autofocus >
              <small id="nama" class="form-text text-muted">Tulis nama agensi.</small>
            </div>
           <div class="form-group">
              <label for="ceo">CEO Saat Ini</label>
              <input type="text" class="form-control" id="ceo" name="ceo" value="{{ old('ceo') }}" >
              <small id="ceo" class="form-text text-muted">Tulis nama lengkap CEO.</small>
           </div>
           <div class="form-group">
            <label for="logo">Pilih Logo Agensi</label>
            <input type="file" class="form-control-file" id="logo" name="logo" value="{{ old('logo') }}">
           </div>
           <div class="form-group">
              <label for="berdiri">Tanggal Berdiri</label>
              <input type="text" class="form-control" id="berdiri" name="berdiri" value="{{ old('berdiri') }}">
              <small id="berdiri" class="form-text text-muted">Tulis tahun berdirinya agensi.</small>
           </div>
           <div class="form-group">
              <label for="medsos">Akun Medsos</label>
              <input type="text" class="form-control" id="medsos" name="medsos" value="{{ old('medsos') }}">
              <small id="medsos" class="form-text text-muted">Tulis nama akun medsos agensi.</small>
           </div>
            <button type="submit" class="btn btn-success btn-lg">Kirim...</button>
            <a href="/" class="btn btn-danger btn-lg">Batal...</a>
          </form>
        </div>
    </div>
</div>

@endsection
