<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header card-header-success">
          <h4 class="card-title">List Harga <b></b> <b> PLN</b></h4>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1 ?>
              @foreach($data as $key)
              @if($key->provider=='PLN')
              <tr>    
               <td class="text-center"><?php echo $no++?></td>
               <td>{{$key->provider}}</td>
               <td>{{$key->description}}</td>
               <td >{{$key->price}}</td>
               @if ($key->status=="normal")
               <td style="color: green;">{{ $key->status }}</td>
               @else
               <td style="color: red;">{{ $key->status }}</td>
               @endif
             </tr>

             @endif
             @endforeach
           </tbody>
         </table>
       </div>
     </div>
   </div>
 </div>
</div>
