<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/dashboard.css">
</head>
<style>
	.logos{
		width: 35%
	}
</style>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Reports</p>
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
    <div class="container-fluid dashboard_main">
		<div class="row dash_row">
			<div class="col-md-2 dash">
				<a href="Invoice-Report">
					<img class="logos" src="img\bill.png">
					<h6>Invoice Report</h6>
				</a>
			</div>
			{{-- <div class="col-md-2 dash">
				<a href="">
					<img class="logos" src="img\bill.png">
					<h6>Bill Report</h6>
				</a>
			</div> --}}
            <div class="col-md-2 dash">
				<a href="purchase_Report">
					<img class="logos" src="img\purchase.png">
					<h6>Purchase Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="price_Report">
					<img class="logos" src="img\purchase.png">
					<h6>Product Price</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="expiry">
					<img class="logos" src="img\expiry.png">
					<h6>Expiry Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="grnp_report">
					<img class="logos" src="img\online.png">
					<h6>GRNP Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="reorder">
					<img class="logos" src="img\reorder.png">
					<h6>Reorder Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="order_report">
					<img class="logos" src="img\order_report.png">
					<h6>Order Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="cancel_bill_report">
					<img class="logos" src="img\bill_report.png">
					<h6>Cancel Bill/Invoice Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="petty_cash">
					<img class="logos" src="img\roll.png">
					<h6>Petty Cash Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="outstanding_cash">
					<img class="logos" src="img\expiry.png">
					<h6>Outstanding Cash Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="cash_sales">
					<img class="logos" src="img\expiry.png">
					<h6>Cash Sales Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="vehicle_report">
					<img class="logos" src="img\reorder.png">
					<h6>Vehicle Expense Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="stock_report">
					<img class="logos" src="img\reorder.png">
					<h6>Stock Transfer Report</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="gst">
					<img class="logos" src="img\reorder.png">
					<h6>GST Report</h6>
				</a>
			</div>
		</div>
	</div>
</body>
</html>