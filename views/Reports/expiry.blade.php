<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expiry Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/vendor.css">
</head>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Expiry Report</p>
			</div>	
			<div class="col-md-4 hrl">
				<a href="/dashboard">
					<img class="logo_home" src="img\home.png"	>
				</a>
				<a href="#">
					<img class="logo_refr" src="img\refresh.png">
				</a>
				<a href="{{ route('logout') }}">
					<img class="logo_logout" src="img\logout.png">
				</a>
			</div>		
		</div>	
	</div>
<!--Secound Container-->
    <div class="container seccon">
        <!-- Date Filter Row -->
        <div class="row mb-3">
            <div class="col-md-2">
                <label for="from_date">From:</label>
                <input type="date" id="from_date" name="from_date" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="to_date">To:</label>
                <input type="date" id="to_date" name="to_date" class="form-control">
            </div>
            <div class="col-md-2 align-self-end">
                <button id="searchBtn" class="btn btn-primary">Search</button>
            </div>
        </div>
        <!-- Table Section -->
        <div class="row table_sec">
            <div class="col-md-12">
                <table class="table">
                    <thead class="table_head">
                        <tr>
                            <th class="head_data" width="220">Product</th>
                            <th class="head_data" width="500">Batch No.</th>
                            <th class="head_data" width="200">Expiry Date</th>
                            <th class="head_data" width="200">Stock</th>
                            <th class="head_data" width="200">UMO</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expiryData as $product)
                            <tr>
                                <td>{{ $product->product->product_name ?? 'N/A' }}</td>
                                <td>{{ $product->batch_code ?? 'N/A' }}</td>
                                <td>{{ $product->expiry_date ? \Carbon\Carbon::parse($product->expiry_date)->format('Y-m-d') : 'N/A' }}</td>
                                <td>{{ $product->reorder_level ?? '0' }}</td>
                                <td>{{ $product->product->unit_of_msrment ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
    $('#searchBtn').on('click', function() {
        var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();

        if (fromDate && toDate) {
            // Submit the form with selected dates
            window.location.href = '/expiry?from_date=' + fromDate + '&to_date=' + toDate;
        } else {
            alert('Please select both dates.');
        }
    });
</script>

</body>
</html>
