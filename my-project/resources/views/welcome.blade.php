<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="container-fluid">

	<h1>Invoices</h1>

	<div class="container">
		<form class="row g-3 needs-validation" novalidate>
			<div class="col-10">
				<select id="client" class="form-select">
					<option selected>Filter by client</option>
					@foreach ($clients as $client)
					<option value="{{$client->id_client}}">{{$client->name}}</option>
					@endforeach
				</select>
				<div class="valid-feedback">
					Looks good!
				</div>
			</div>
			<div class="col-2">
				<label class="form-label">&nbsp;</label>
				<button class="btn btn-primary" onclick="search(event)" type="button">Go</button>
			</div>
		</form>

	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th> Invoice </th>
				<th> Client </th>
				<th> Posted Date </th>
				<th> Status </th>
				<th> Amount </th>
				<th> Actions </th>
			</tr>
		</thead>
		<tbody>
			@foreach($invoices as $invoice)
			<tr>
				<td> {{$invoice->invoice}} </td>
				<td> {{$invoice->client}} </td>
				<td> {{$invoice->posted_date}} </td>
				<td> {{$invoice->status}} </td>
				<td> ${{number_format($invoice->amount, 2, ',', '.')}} </td>
				<td> <button type="button" onclick="goToDetail('{{$invoice->invoice}}')" class="btn btn-primary">View</button> </td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script>
	function search() {
		let thisPage = new URL(window.location.href);
		thisPage.searchParams.set('client', document.getElementById('client').value);
		history.pushState(null, '', thisPage);
		window.location = thisPage;
	}

	function goToDetail(invoice) {
		console.log('..........', invoice);
		window.location.href = `/${invoice}/details`;
	}
</script>