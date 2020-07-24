@extends('layouts.app')

@section('content')
     <br>
     <h1 align="center"> Label K-Pop Populer Tahun 2020.</h1>
     <hr>
     <br />
     <div align="left">
      <button type="button" name="create_record" id="create_record" class="btn btn-warning btn-md">Tambah Data Agensi</button>
     </div>
     <br />
  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>CEO</th>
                <th>Logo</th>
                <th>Berdiri Pada</th>
                <th>Instagram</th>
                <th width="120px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  </div>

<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel"></h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" >Nama : </label>
            <div class="col-md-8">
             <input type="text" name="nama" id="nama" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Ceo </label>
            <div class="col-md-8">
             <input type="text" name="ceo" id="ceo" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Pilih Logo : </label>
            <div class="col-md-8">
             <span id="store_image"></span>
             <br>
             <input type="file" name="logo" id="logo" />   
            </div>
            <script type="application/javascript">
                $('input[type="file"]').change(function(e){
                    var fileName = e.target.files[0].name;
                    $('.custom-file-label').html(fileName);
                });
            </script>
           </div>

           <div class="form-group">
            <label class="control-label col-md-4">Berdiri</label>
            <div class="col-md-8">
             <input type="text" name="berdiri" id="berdiri" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Instagram </label>
            <div class="col-md-8">
             <input type="text" name="instagram" id="instagram" class="form-control" />
            </div>
           </div>
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>


<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Perhatian !!!</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="left">Apakah Yakin Mau Dihapus ???</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Siap</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Ga Yakin</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

      var table = $('#user_table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('datatables.kpops') }}",

        columns: [
           {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'nama', name: 'nama' },
            { data: 'ceo', name: 'ceo' },
            { data: 'logo', name: 'logo' ,
                     render: function( data, type, full, meta ) {
                        return "<img src=\"/gambar/" + data + "\" height=\"50\"/>";
                    }
                },
            { data: 'berdiri', name: 'berdiri' },
            { data: 'medsos', name: 'medsos' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
  

 $('#create_record').click(function(){
     $('#action_button').val("Add");
     $('#action').val("Add");
     $('#formModal').modal('show');
     $('.modal-title').text("Tambah Agensi Baru");
 });

 $('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
   $.ajax({
    url:"{{ route('datatables.store') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#sample_form')[0].reset();
      $('#user_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   })
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('datatables.update') }}",
    method:"POST",
    data:new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#sample_form')[0].reset();
      $('#store_image').html('');

      $('#user_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   });
  }
 });

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"/datatables/"+id+"/edit",
   dataType:"json",
   success:function(html){
    $('#nama').val(html.data.nama);
    $('#ceo').val(html.data.ceo);
    $('#store_image').html("<img src={{ URL::to('/') }}/gambar/" + html.data.logo + " width='70' class='img-thumbnail' />");
    $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.logo+"' />");
    $('#berdiri').val(html.data.berdiri);
    $('#instagram').val(html.data.medsos);
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Edit Data Agensi");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#formModal').modal('show');
   }
  })
 });

 var user_id;

 $(document).on('click', '.deleteData', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"datatables/destroy/"+user_id,
   beforeSend:function(){
    $('#ok_button').text('Penghapusan Data Diproses...');
   },
   success:function(data)
   {
    setTimeout(function(){
     $('#confirmModal').modal('hide');
     $('#user_table').DataTable().ajax.reload();
    }, 4800);
   }
  })
 });

});
</script>
@endsection