    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">Verify</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-striped" id="historytable">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Nominal</th>
                    <th>Bank</th>
                    <th>Atas Nama</th>
                    <th>Expired</th>
                    <th>Bukti</th>
                    <th>Cek Pembayaran</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1 ?>
                  @foreach($topup as $key)
                  <tr>    
                   <td class="text-center"><?php echo $no++?></td>
                   <td>{{$key->harga}}</td>
                   <td>{{$key->nama_bank}}</td>
                   <td>{{$key->nama}}</td> 
                   <td>{{$key->expired}}</td>
                   <td><a href="{{ asset ('/images/'.$key->bukti)}}" class="fancybox-button" rel="fancybox-button"><img class="img-responsive"  src="{{ asset ('/images/'.$key->bukti)}}" style="width: 60px;"></a></td>
                   <td><a href="javascript:void(0);" class="btn btn-success" onclick="verify({{ $key->id_topup }})">Verifikasi</a></td>
                 </tr>
                 @endforeach
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>