<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-success">
          <h4 class="card-title">Beli Pulsa dan Paket Internet</h4>
        </div>
        <div class="card-body">
          <form action="javascript:void(0);" method="post" accept-charset="utf-8" id="belipulsa">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group bmd-form-group">
              <div class="col-md-12">
                <label class="control-label">Nomer HP</label>
                <input type="text" name="no_hp" onkeyup="nomerhp()" id="no_hp" class="form-control" autocomplete="off" required>
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

            <input type="submit" class="btn btn-success pull-right" value="Beli Pulsa">
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
              <li>Masukan nomor handphone anda dengan benar</li>
              <li>Pastikan saldo anda mencukupi sesuai dengan kebutuhan harga</li>
              <li>Jika ada keluhan silakan Chat admin</li>
              <li><p> Nomer Transaksi Dengan SMS <br>
                <b>AXIS: 083822494222<br></b>
                <b>INDOSAT: 085712727487<br></b>
                <b>INDOSAT: 081567770768<br></b>
                <b>TELKOMSEL: 082324433107<br></b>
                <b>TELKOMSEL: 085326603455<br></b>
                <b>TRI: 089512787772<br></b>
                <b>XL: 081818611733<br></b>
                Contoh Transaksi : "Nominal Nomer Hanphone 5678" || 10 081329333222 5678<br>
                Nominal Sesuai dengan yang ada di pilihan setiap operator
              </p></li>
            </ol>
          </p>
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
              $("#belipulsa")[0].reset();
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
        },
        error: function(){
          alert("Server sedang bermasalah silakan coba lagi");
        }
      });
      return false;
    });
  });
</script>