<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GRNP Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/vendor.css">
</head>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>GRNP Report</p>
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
            <!-- New Filters -->
            <div class="col-md-2">
                <label for="vendor_name">Vendor Name:</label>
                <input type="text" id="vendor_name" name="vendor_name" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="grnp_no">GRNP No.:</label>
                <input type="text" id="grnp_no" name="grnp_no" class="form-control">
            </div>

            <!-- Search Button -->
            <div class="col-md-2 align-self-end">
                <button id="searchBtn" class="btn btn-primary">Search</button>
            </div>
        </div>
        {{-- add anouther search options like vendor name and grnp no  --}}
        <!-- Table Section -->
        <div class="row table_sec">
            <div class="col-md-12">
                <table class="table">
                    <thead class="table_head">
                        <tr>
                            <th class="head_data" width="220">GRNP No.</th>
                            <th class="head_data" width="500">PO No.</th>
                            <th class="head_data" width="200">Vendor Name</th>
                            <th class="head_data" width="200">DN/Order No.</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grnpData as $record)
                            <tr>
                                <td>{{ $record->grnp_no }}</td>
                                <td>{{ $record->po_no }}</td>
                                <td>{{ $record->Vendor->vendor_name }}</td>
                                <td>{{ $record->dn_order_no }}</td>
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
    $(document).ready(function () {
    $('#searchBtn').click(function () {
        const fromDate = $('#from_date').val();
        const toDate = $('#to_date').val();
        const vendorName = $('#vendor_name').val();
        const grnpNo = $('#grnp_no').val();

        $.ajax({
            url: '/grnp-report', 
            type: 'GET',
            data: {
                from_date: fromDate,
                to_date: toDate,
                vendor_name: vendorName,
                grnp_no: grnpNo
            },
            success: function (response) {
                const tableBody = $('tbody');
                tableBody.empty();

                response.grnpData.forEach(record => {
                    const row = `<tr>
                        <td>${record.grnp_no}</td>
                        <td>${record.po_no}</td>
                        <td>${record.vendor_name}</td>
                        <td>${record.dn_order_no}</td>
                    </tr>`;
                    tableBody.append(row);
                });
            }
        });
    });
});

</script>
</body>
</html>
