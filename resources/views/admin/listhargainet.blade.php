<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title">List Harga <b></b> <b> TRI</b></h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Provider</th>
                        <th>Jenis</th>
                        <th>Operator</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1 ?>
                    @foreach($data as $key)
                    @if($key->provider=='TRI' AND $key->provider_sub=='INTERNET')
                    <tr>    
                       <td class="text-center"><?php echo $no++?></td>
                       <td>{{$key->provider}}</td>
                       @if ($key->provider_sub=="INTERNET")
                       <td>Pulsa</td>
                       @else
                       <td>{{ $key->provider_sub }}</td>
                       @endif
                       <td>{{$key->operator}}</td>
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
<div class="col-md-6">
  <div class="card">
    <div class="card-header card-header-success">
        <h4 class="card-title">List Harga <b></b> <b> TELKOMSEL</b></h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Provider</th>
                    <th>Jenis</th>
                    <th>Operator</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                @foreach($data as $key)
                @if($key->provider=='TELKOMSEL' AND $key->provider_sub=='INTERNET')
                <tr>    
                   <td class="text-center"><?php echo $no++?></td>
                   <td>{{$key->provider}}</td>
                   @if ($key->provider_sub=="INTERNET")
                   <td>Pulsa</td>
                   @else
                   <td>{{ $key->provider_sub }}</td>
                   @endif
                   <td>{{$key->operator}}</td>
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
    <div class="col-md-6">
      <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title">List Harga <b></b> <b> INDOSAT</b></h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Provider</th>
                        <th>Jenis</th>
                        <th>Operator</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1 ?>
                    @foreach($data as $key)
                    @if($key->provider=='INDOSAT' AND $key->provider_sub=='INTERNET')
                    <tr>    
                       <td class="text-center"><?php echo $no++?></td>
                       <td>{{$key->provider}}</td>
                       @if ($key->provider_sub=="INTERNET")
                       <td>Pulsa</td>
                       @else
                       <td>{{ $key->provider_sub }}</td>
                       @endif
                       <td>{{$key->operator}}</td>
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
<div class="col-md-6">
  <div class="card">
    <div class="card-header card-header-success">
        <h4 class="card-title">List Harga <b></b> <b> AXIS</b></h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Provider</th>
                    <th>Jenis</th>
                    <th>Operator</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                @foreach($data as $key)
                @if($key->provider=='AXIS' AND $key->provider_sub=='INTERNET')
                <tr>    
                   <td class="text-center"><?php echo $no++?></td>
                   <td>{{$key->provider}}</td>
                   @if ($key->provider_sub=="INTERNET")
                   <td>Pulsa</td>
                   @else
                   <td>{{ $key->provider_sub }}</td>
                   @endif
                   <td>{{$key->operator}}</td>
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
    <div class="col-md-6">
      <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title">List Harga <b></b> <b> XL</b></h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Provider</th>
                        <th>Jenis</th>
                        <th>Operator</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1 ?>
                    @foreach($data as $key)
                    @if($key->provider=='XL' AND $key->provider_sub=='INTERNET')
                    <tr>    
                       <td class="text-center"><?php echo $no++?></td>
                       <td>{{$key->provider}}</td>
                       @if ($key->provider_sub=="INTERNET")
                       <td>Pulsa</td>
                       @else
                       <td>{{ $key->provider_sub }}</td>
                       @endif
                       <td>{{$key->operator}}</td>
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
<div class="col-md-6">
  <div class="card">
    <div class="card-header card-header-success">
        <h4 class="card-title">List Harga <b></b> <b> SMARTFREN</b></h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Provider</th>
                    <th>Jenis</th>
                    <th>Operator</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                @foreach($data as $key)
                @if($key->provider=='SMARTFREN' AND $key->provider_sub=='INTERNET')
                <tr>    
                   <td class="text-center"><?php echo $no++?></td>
                   <td>{{$key->provider}}</td>
                   @if ($key->provider_sub=="INTERNET")
                   <td>Pulsa</td>
                   @else
                   <td>{{ $key->provider_sub }}</td>
                   @endif
                   <td>{{$key->operator}}</td>
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
    <div class="col-md-6">
      <div class="card">
        <div class="card-header card-header-success">
            <h4 class="card-title">List Harga <b></b> <b> BOLT</b></h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Provider</th>
                        <th>Jenis</th>
                        <th>Operator</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1 ?>
                    @foreach($data as $key)
                    @if($key->provider=='BOLT' AND $key->provider_sub=='INTERNET')
                    <tr>    
                       <td class="text-center"><?php echo $no++?></td>
                       <td>{{$key->provider}}</td>
                       @if ($key->provider_sub=="INTERNET")
                       <td>Pulsa</td>
                       @else
                       <td>{{ $key->provider_sub }}</td>
                       @endif
                       <td>{{$key->operator}}</td>
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