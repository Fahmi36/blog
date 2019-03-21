<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-success" >
          <h4 class="card-title">Beli Paket Internet</h4>
        </div>
        <div class="card-body">
          <form action="javascript:void(0);" method="post" accept-charset="utf-8" id="belipulsa">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group bmd-form-group">
              <div class="col-md-12">
                <label class="control-label">Nomer HP</label>
                <input type="text" name="no_hp" onkeyup="tranferpulsahp()" id="no_hp" class="form-control" autocomplete="off" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group bmd-form-group">
                <label>Pilih Produk</label>
                <select name="code"  id="selected" class="form-control">
                  <option value="" id="pilih" selected>Pilih Produk</option>
                </select>
              </div>
            </div>

            <input type="submit" class="btn btn-success pull-right"  value="Beli Paket Internet">
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-profile">
        <div class="card-body">
          <h4 class="card-title">Perhatian</h4>
          <p class="card-description">
            <ol  style="text-align: left;">
              <li>Masukan nomor meteran dengan benar, jika salah maka transaksi tidak bisa di lakukan</li>
              <li>Masukan nomor handphone anda dengan benar</li>
              <li>Pastikan saldo anda mencukupi sesuai dengan kebutuhan harga</li>
              <li>Jika ada keluhan silakan klik tombol di bawah</li>
            </ol>
          </p>
          <a href="#pablo" class="btn btn-success btn-round" >Chat</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#belipulsa").submit(function (event) {

      event.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: '/action/pulsa',
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
                $('.modal').modal('hide');
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
</script>