@extends('include.header')
@section('content')
	<div class="container">
		
	<table id="list-harga" class="table table-striped table-bordered">

		<thead>
			<center>LIST HARGA PRODUK</center>
			<tr>
				<td>Nama Operator</td>
				<td>Produk</td>
				<td>Harga</td>
				<td>Status</td>
			</tr>
		</thead>
		<tbody>
		@foreach($data["message"] as $list)
			<tr>
				<td>{{ $list["operator"] }}</td>
				<td>{{ $list["description"] }}</td>
				<td>Rp. {{ number_format($list["price"],0,',','.')  }}</td>
				@if ($list["status"]=="normal")
				<td style="color: green;">{{ $list["status"] }}</td>
					
				@else
				<td style="color: red;">{{ $list["status"] }}</td>
			@endif

			</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection