<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

    <title>Label K-Pop Populer Tahun 2020</title>
  </head>
  <body>

    <style type="text/css">
                  table tr td,
                  table tr th{
                    font-size: 9pt;
                  }
    </style>

    <center>
         <h4> Label K-Pop Populer Tahun 2020</h4></center>

            <table class="table table-bordered">
              <thead >
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Label</th>
                  <th scope="col">CEO Sekarang</th>
                   <<!-- th scope="col">Logo</th> -->
                  <th scope="col">Didirikan Pada</th>
                  <th scope="col">Instagram Akun</th>

                </tr>
              </thead>
              <tbody>
                @php $i=1 @endphp
                @foreach($kpops as $kpop)
                <tr>
                  <th scope="row">{{$i++}}</th>
                  <td>{{$kpop->nama}}</td>
                  <td>{{$kpop->ceo}}</td>
                 <!-- <td>
                     <img src="{{ url('public/gambar/'.$kpop->logo) }}" width="48px" class="rounded float-left d-block" alt="{{$kpop->nama}}">
                 </td> -->
                  <td>{{$kpop->berdiri}}</td>
                  <td><a href="https://www.instagram.com/{{$kpop->medsos}}" target="_blank">{{$kpop->medsos}}</a></td>
                </tr>
                @endforeach
              </tbody>
         </table>
        </div>
    </div>
</div>

   <!--  Optional JavaScript
   jQuery first, then Popper.js, then Bootstrap JS
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
  </body>
</html>

