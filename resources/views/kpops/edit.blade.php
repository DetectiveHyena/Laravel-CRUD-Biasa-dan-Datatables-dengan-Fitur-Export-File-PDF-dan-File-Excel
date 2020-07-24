@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center shadow p-3 mb-5 bg-white roundedz">
         <h1 style="margin-bottom: 25px;" class="alert alert-primary"> Label K-Pop Populer Tahun 2020</h1>  <br>

       <div class="col-md-8">
           <h3 align="center">Edit Data Agensi</h3>
          <form action="{{ route('kpops.update', $kpop->id) }}" method="post" enctype="multipart/form-data" >
            @csrf {{ method_field ('PATCH') }}
            <div class="form-group">
              <label for="nama">Nama Agensi</label>
              <input type="text" class="form-control" id="nama" name="nama" value="{{ $kpop->nama }}" autofocus>
              <small id="nama" class="form-text text-muted">Tulis nama agensi.</small>
            </div>
           <div class="form-group">
              <label for="ceo">CEO Saat Ini</label>
              <input type="text" class="form-control" id="ceo" name="ceo" value="{{ $kpop->ceo }}">
              <small id="ceo" class="form-text text-muted">Tulis nama lengkap CEO.</small>
           </div>
           <div class="form-group">
             <label>Logo</label>
             <br><img src="{{ asset('gambar/'.$kpop->logo) }}" style="width: 85px;">
           </div>
           <div class="form-group">
            <label for="gbr">Pilih Logo Agensi Baru</label>
            <input type="file" class="form-control-file" id="gbr" name="gbr"><br>
            <label class="alert alert-secondary">#) Bila logo tidak diubah maka biarkan saja logo yang lama.</label>
           </div>
           <div class="form-group">
              <label for="berdiri">Tanggal Berdiri</label>
              <input type="text" class="form-control" id="berdiri" name="berdiri" value="{{ $kpop->berdiri }}">
              <small id="berdiri" class="form-text text-muted">Tulis tahun berdirinya agensi.</small>
           </div>
           <div class="form-group">
              <label for="medsos">Email address</label>
              <input type="text" class="form-control" id="medsos" name="medsos" value="{{ $kpop->medsos }}">
              <small id="medsos" class="form-text text-muted">Tulis nama akun medsos agensi.</small>
           </div>
            <button type="submit" class="btn btn-primary btn-lg">Edit...</button>
            <a href="/" class="btn btn-danger btn-lg">Batal...</a>
          </form>
        </div>
    </div>
</div>

@endsection
