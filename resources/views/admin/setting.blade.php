<link rel="stylesheet" type="text/css" href="{{asset('/css/costum.css')}}">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-success">
          <h4 class="card-title">Data Profile</h4>
        </div>
        <div class="card-body">
         @foreach($users as $list)
         <form action="javascript:void(0);" method="post" accept-charset="utf-8" id="gantipassword">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" value="{{ $list->id_user }}">
          <div class="form-group bmd-form-group">
            <div class="col-md-10">
              <label class="control-label">Username</label>
              <input type="text" id="user" name="username" value="{{$list->username}}" class="form-control">
            </div>
          </div>
          <div class="form-group bmd-form-group">
            <div class="col-md-10">
              <label class="control-label">Nomor HP</label>
              <input type="number" id="no_hp" name="no_hp" value="{{$list->no_hp}}" class="form-control">
            </div>
          </div>
          <div class="form-group bmd-form-group">
            <div class="col-md-10">
              <label class="control-label">Password</label>
              <input type="text" name="password" class="form-control">
            </div>
          </div>
          <div class="form-group bmd-form-group">
            <div class="col-md-10">
              <label class="control-label">Email</label>
              <input type="text" id="email" name="email" value="{{$list->email}}" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <input type="submit" class="btn btn-success pull-right" value="Update">
          </div>
          <div class="clearfix"></div>
        </form>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-profile">
      <div class="card-body" >
        <h4 class="card-title">Perhatian</h4>
        <p class="card-description" >
          <ol style="text-align: left;">
            <li>Jika melakukan perubahan email maka ada verifikasi yang akan masuk ke email sebelumnya</li>
            <li>Jika tidak ingin mengganti password kosongkan saja kolom password</li>
            <li>Di harap tidak menggunakan angka " 0 "</li>
            <li>Nomor Hp di Gunakan Untuk Mengirim pulsa via sms </li>
          </ol>
        </p>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#gantipassword").submit(function (event) {

      event.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: '/dosetting',
        type: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend:function() {
          $('#modal1').modal('show');
        },
        success: function (dt) {
          setTimeout(function(){
            // console.log(dt);
            if (dt.sukses==true) {
              $.notify({
                icon: "notifications",
                message: ""+dt.data+""
              }, {
                type: 'success',
                timer: 4000,
                placement: {
                  from: 'top',
                  align: 'right'
                }
              });
            }else{
              $.notify({
                icon: "notifications",
                message: ""+dt.data+""
              }, {
                type: 'danger',
                timer: 4000,
                placement: {
                  from: 'top',
                  align: 'right'
                }
              });
            }
            $('#modal1').modal('hide');
          }, 2000);
          // $("#gantipassword")[0].reset();
        },
        error: function(){
          alert("Server sedang bermasalah silakan coba lagi");
        }
      });
      return false;
    });
  });
</script>