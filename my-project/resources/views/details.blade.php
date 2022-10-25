<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<div class="container">

	<h1>Details</h1>
	<hr>
	<div class="row row-cols-1 row-cols-md-3 g-2">
		@foreach ($products as $product)
		<div class="col">
			<div class="card" style="width: 18rem;">
				<div class="card-header">
					{{$product->description}}
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">SKU: {{$product->sku}}</li>
					<li class="list-group-item">Price: ${{number_format($product->price, 2, ',', '.')}}</li>
					<li class="list-group-item">Quantity: {{$product->quantity}}</li>
				</ul>
			</div>
		</div>
		@endforeach
	</div>
</div>