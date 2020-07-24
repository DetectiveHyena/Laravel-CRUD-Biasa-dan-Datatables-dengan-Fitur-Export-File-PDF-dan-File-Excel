@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center shadow p-3 mb-5 bg-white roundedz">
         <h1 style="margin-bottom: 25px;" class="alert alert-primary"> Label K-Pop Populer Tahun 2020</h1><br>

       <div class="col-lg">

          @if(count($result_lookfor))
            <div class="alert alert-success" role="alert">Ditemukan <b>{{ count($result_lookfor) }}</b> hasil dengan kata pencarian <b>{{$lookfor}}</b> 
            </div>

         @else
          <div class="alert alert-danger role="alert"">Kata pencarian <b>{{ $lookfor }}</b>  tidak ditemukan.
            <a href="/" class="btn btn-outline-danger">Kembali...</a>
          </div>
         @endif

          <a href="/printpdf" class="btn btn-info" target="_blank">Cetak Laporan PDF</a>
          <a href="/datatables" class="btn btn-success" target="_blank">CRUD Datatable</a>
          <form class="float-right mr-3" action="{{ route('kpops.lookfor') }}" method="get">@csrf
            <div>
              <input type="text" name="kata" maxlength="25" size="30" placeholder="Isi kata pencarian..." autofocus autocomplete="off">
            </div>
          </form>
          <a href="/export" class="btn btn-warning " target="_blank">Cetak Laporan Excel</a>
          <a href="kpops/create" class="btn btn-dark " >Tambah Data</a><br>
            <br>
            <table class="table table-hover">
              <thead class="thead-dark" >
                <tr>
                  <th >#</th>
                  <th >Nama Label</th>
                  <th>CEO Saat Ini</th>
                  <th >Logo</th>
                  <th>Berdiri Tanggal</th>
                  <th>Instagram</th>
                  <th width="120px">Aksi</th>

                </tr>
              </thead>
              <tbody>
                @php $i=1 @endphp
                @foreach($result_lookfor as $kpop)
                <tr>
                  <th scope="row">{{$i++}}</th>
                  <td>{{$kpop->nama}}</td>
                  <td>{{$kpop->ceo}}</td>
                  <td>
                      <img src="{{ asset('gambar/'.$kpop->logo) }}" class="rounded" id="zoomer" style="width: 58px; height: 52px; border: 1px solid black;" alt="{{$kpop->nama}}">
                  </td>

                  <td>{{$kpop->berdiri}}</td>
                  <td><a href="https://www.instagram.com/{{$kpop->medsos}}" target="_blank">{{$kpop->medsos}}</a></td>
                  <td >
                      <form action="{{ route('kpops.destroy', $kpop->id) }}" method="post">@csrf {{ method_field ('DELETE') }}
                        <a href="{{ route('kpops.edit', $kpop->id) }}" class="btn btn-warning btn-sm"> Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Dihapus??')">Hapus</button>
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
