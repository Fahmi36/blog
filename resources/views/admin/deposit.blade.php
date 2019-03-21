<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-success">
          <strong><h4 class="card-title">Perhatian</h4></strong>
          <div class="row">
            @foreach($bank as $list)
            <div class="col-md-3">Bank: {{$list->nama_bank}}<br>
              Nomer Rekening : {{$list->no_rek}}<br>
              Atas Nama : {{$list->atas_nama}}
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-success">
          <h4 class="card-title">Isi saldo</h4>
        </div>
        <div class="card-body">
          <form action="javascript:void(0);" method="post" id="Pembayaran"  accept-charset="utf-8">
            <!--             <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
<!--             <div class="col-md-12">
              <div class="form-group bmd-form-group">
                <label>Pilih Bank</label>
                <select name="bank" class="form-control">
                  <option value="" disabled selected>Pilih Bank</option>
                  @foreach($bank as $list)
                  <option value="{{ $list->nama_bank }}">{{ $list->nama_bank }} - {{ $list->atas_nama }}</option>
                  @endforeach
                </select>
              </div>
            </div> -->
            <div class="form-group bmd-form-group">
              <div class="col-md-12">
                <label class="control-label">Nominal Deposit</label>
                <input type="number" name="Nominal" id="Nominal" class="form-control" autocomplete="off" required>
              </div>
            </div>
            <div class="form-group bmd-form-group">
              <div class="col-md-12">
                <label class="control-label">Nama Peneransfer</label>
                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
              </div>
            </div>
            <button type="submit" class="btn btn-success pull-right"> Bayar</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
      @if(count($deposit) > 0)
      <div class="card table-responsive">
        <table class="table table-striped" id="historytable">
          <thead>
            <tr>
              <th>Nominal</th>
              <th>Nama Bank</th>
              <th>Atas Nama Bank</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($deposit as $data)
            <tr>
              @if ($data->USD!=NULL)
              <td>$ {{substr($data->USD, 0,4)}}</td>
              @else
              <td>{{$data->harga}}</td>
              @endif
              <td>{{$data->nama_bank}}</td>
              <td>{{$data->nama}}</td>
              <td>{{$data->status}}</td>
              <td>
                @if ($data->USD!=NULL)
                <div id="paypal-button<?=$data->id_topup?>"></div>
                <script type="text/javascript">
                  paypal.Button.render({
                    env: 'production',
                    client: {
                      production: 'AfAjgKbO-BazjJyvt0143JeI9es9-0ymsVn57ss54WnJ6k7btu1c2lKnwP-YViyZ_Rl7_VGObHc0DjE1'
                    },
                    payment: function (data, actions) {
                      return actions.payment.create({
                        transactions: [{
                          amount: {
                            total: '<?=substr($data->USD, 0,4)?>',
                            currency: 'USD'
                          },
                          description: 'The payment transaction description.',
                          custom: '<?=$data->id_topup?>',
                        }]
                      });
                    },
                    onAuthorize: function (data, actions) {
                      return actions.payment.execute()
                      .then(function () {
                        window.alert('Tunggu 3-5 menit, Admin Blm pernah transaksi pake paypal jadi nggak otomatis dulu ya');
                      });
                    }
                  }, '#paypal-button<?=$data->id_topup?>');
                </script>
                @else
                <a class="btn btn-info btn-simple" href="javascript:void(0);" onclick="snap.pay('{{ $donation->snap_token }}')">
                  Konfirmasi
                </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
    <div class="col-md-4">
      <div class="card card-profile">
        <div class="card-body">
          <h4 class="card-title">Perhatian</h4>
          <p class="card-description">
            <ol  style="text-align: left;">
              <li>Ketik jumlah Nominal deposit</li>
              <li>Pastikan Nominal deposit sesuai dengan yang anda Tranfer</li>
              <li>Pastikan Nama Peneransfer sama dengan yang ada masukan</li>
              <li>Jika jumlah deposit  Nama Peneransfer tidak sesuai maka pembayaran akan pending 1-3 hari</li>
            </ol>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{asset('/js/jq.js')}}"></script>
<script src="{{asset('/js/jquery-ui.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/2.9.0/jquery.serializejson.min.js"></script>
<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="SB-Mid-client-X0xcKcMd6eTP5FMf"></script>
<script type="text/javascript">
 $("#Pembayaran").submit(function (event) {
  var data = new FormData($(this)[0]);
  $.ajax({
    url: '/depositsaldo',
    type: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
    success: function (response) {
      console.log(response);
    //   snap.pay(response.snap_token, {
    //             // Optional
    //             onSuccess: function (result) {
    //               location.reload();
    //             },
    //             // Optional
    //             onPending: function (result) {
    //               location.reload();
    //             },
    //             // Optional
    //             onError: function (result) {
    //               location.reload();
    //             }
    //           });
  },
    error: function () {
      alert('Eror');
    },
  });
  return false;
});
</script>

