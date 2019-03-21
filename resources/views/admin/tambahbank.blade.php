<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-success">
          <h4 class="card-title">Tambah Daftar Bank</h4>
        </div>
        <div class="card-body">
          <form action="/actbank" method="post" accept-charset="utf-8" id="tambahbank">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group bmd-form-group">
              <div class="col-md-12">
                <label class="control-label">Nama Bank</label>
                <input type="text" name="bank" class="form-control" autocomplete="off" required>
              </div>
            </div>
            <div class="form-group bmd-form-group">
              <div class="col-md-12">
                <label class="control-label">Atas Nama</label>
                <input type="text" name="an" class="form-control" autocomplete="off" required>
              </div>
            </div>
            <div class="form-group bmd-form-group">
              <div class="col-md-12">
                <label class="control-label">No Rekening</label>
                <input type="text" name="no_rek" class="form-control" autocomplete="off" required>
              </div>
            </div>

            <input type="submit" class="btn btn-success pull-right" value="Tambah">
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-success">
          <h4 class="card-title">Data Bank</h4>
        </div>
        <div class="card-body  table-responsive">
          <table class="table table-striped" id="historytable">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th>Bank</th>
                <th>Atas Nama</th>
                <th>No Rekening</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1 ?>
              @foreach($bank as $key)
              <tr>    
               <td class="text-center"><?php echo $no++?></td>
               <td>{{$key->nama_bank}}</td>
               <td>{{$key->atas_nama}}</td>
               <td>{{$key->no_rek}}</td> 
               <td><a href="javascript:void(0);" class="btn btn-success" onclick="delbank({{ $key->id_bank }})">Delete</a></td>
             </tr>
             @endforeach
           </tbody>
         </table>
       </div>
     </div>
   </div>

 </div>
</div>
<!-- <script type="text/javascript">
  $(document).ready(function () {
    $("#tambahbank").submit(function (event) {

      event.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: '',
        type: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend:function() {
          $('.modal').modal('show');
        },
        success: function (dt) {
          setTimeout(function(){
            $('.modal').modal('hide');
            window.location.replace("/dashboard");
          }, 2000);
          $("#belitoken")[0].reset();
        },
        error: function(){
          alert("Server sedang bermasalah silakan coba lagi");
        }
      });
      return false;
    });
  });
</script> -->