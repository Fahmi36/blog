    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">History Saldo</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-striped" id="historytable">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Produk</th>
                        <th>No Hp</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1 ?>
                    @foreach($data as $key)
                    <tr>    
                       <td class="text-center"><?php echo $no++?></td>
                       <td>Pulsa</td>
                       <td>{{$key->nomer_hp}}</td>
                       <td>{{$key->status}}</td>
                       <td>{{$key->deskripsi}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>