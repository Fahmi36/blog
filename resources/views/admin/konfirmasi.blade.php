<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-success">
          <h4 class="card-title">Konfirmasi</h4>
        </div>
        <form action="javascript:void(0);" method="POST" enctype="multipart/form-data" id="konfirmasi">
          {!! csrf_field() !!}
          <div class="col-md-12">
            <div class="form-group bmd-form-group">
              <img src="http://placehold.it/100x100" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="file" id="inputgambar" name="gambar" class="validate" accept="image/*" required / >
              <input type="hidden" name="idnya" value="<?=$id?>" required / >
            </div>
          </div>
          <input type="submit" class="btn btn-success pull-right" value="Konfirmasi">
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#konfirmasi").submit(function (event) {

      event.preventDefault();
      var formData = new FormData($(this)[0]);

      $.ajax({
        url: '/konfirmasisaldo',
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
                message: ""+dt.message+""
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
                message: ""+dt.message+""
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
          $("#konfirmasi")[0].reset();
        },
        error: function(){
          alert("Server sedang bermasalah silakan coba lagi");
        }
      });
      return false;
    });
  });
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#showgambar').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#inputgambar").change(function () {
    readURL(this);
  });

</script>