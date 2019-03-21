<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-success">
					<h4 class="card-title">Tambah Daftar Bank</h4>
				</div>
				<div class="card-body">
						<table id="daftarharga" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Jenis Pulsa</th>
									<th>Deskripsi</th>
									<th>Harga</th>
									<th>Nomor (0896,0895 dll)</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody id="tbodynya">
								@foreach ($data as $jasa)
									<tr>
										<td class="table_data" data-row_id="<?=$jasa->id_produk?>" ><?=$jasa->provider_sub?></td>
										<td class="table_data" data-row_id="<?=$jasa->id_produk?>" data-column_name="description"><?=$jasa->description?></td>
										<td class="table_data" data-row_id="<?=$jasa->id_produk?>" data-column_name="price" contenteditable><?=$jasa->price?></td>
										<td class="table_data" data-row_id="<?=$jasa->id_produk?>" data-column_name="prefix" ><?=$jasa->prefix?></td>
										<td class="table_data" data-row_id="<?=$jasa->id_produk?>" data-column_name="status"><?=$jasa->status?></td>
									</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$("#daftarharga").DataTable();
		$(document).on('blur', '.table_data', function(){
			var id = $(this).data('row_id');
			var table_column = $(this).data('column_name');
			var value = $(this).text();
			$.ajax({
				url:  "/updatehargapulsa",
				method:"post",
				data:{id_produk:id, nama:table_column, datanya:value},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success:function(data)
				{

				}
			})
		});
	});
</script>