<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raj Retail POS</title>
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
				<p>Raj Retail POS</p>
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
	{{-- Master Pages --}}
    <div class="container-fluid dashboard_main">
		<div class="row">
			<div class="col-md-12">
				<h4 class="masters">Masters</h4>
			</div>
		</div>
		<div class="row dash_row">
			<div class="col-md-2 dash">
				<a href="/company_profile">
					<img class="logos" src="img\company_profile.png">
					<h6>Company Name</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/warehouse">
					<img class="logos" src="img\warehouse.png">
					<h6>Warehouse</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/vendor">
					<img class="logos" src="img\vendor.png">
					<h6>Vendor</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/category">
					<img class="logos" src="img\package.png">
					<h6>Product Category</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/product">
					<img class="logos" src="img\product.png">
					<h6>Product</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/vehicleexpense">
					<img class="logos" src="img\delivery.png">
					<h6>Vehicle Expense</h6>
				</a>
			</div>
		</div>
	</div>
	<div class="container-fluid dashboard_main">
		<div class="row dash_row">
			<div class="col-md-2 dash">
				<a href="/role">
					<img class="logos" src="img\role.png">
					<h6>Role</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/staff">
					<img class="logos" src="img\staff.png">
					<h6>Staff</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/customer">
					<img class="logos" src="img\customer.png">
					<h6>Customers</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/petty">
					<img class="logos" src="img\roll.png">
					<h6>Petty Account</h6>
				</a>
			</div>
		</div>
	</div>
	{{-- Transaction Pages --}}
	<div class="container-fluid dashboard_main">
		<div class="row">
			<div class="col-md-12">
				<h4 class="masters">Transaction</h4>
			</div>
		</div>
		<div class="row dash_row">
			<div class="col-md-2 dash">
				<a href="/petty_entry">
					<img class="logos" src="img\roll.png">
					<h6>Petty Account</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/purchase">
					<img class="logos" src="img\purchase.png">
					<h6>Purchase</h6>
				</a>
			</div>
			{{-- <div class="col-md-2 dash">
				<a href="/cancelpo">
					<img class="logos" src="img\purchase.png">
					<h6>Cancel PO</h6>
				</a>
			</div> --}}
			<div class="col-md-2 dash">
				<a href="/grnp">
					<img class="logos" src="img\online.png">
					<h6>GRNP</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/rate">
					<img class="logos" src="img\rate.png">
					<h6>Rate Fixation</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/bill">
					<img class="logos" src="img\bill.png">
					<h6>Bill/Invoice</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/order">
					<img class="logos" src="img\order.png">
					<h6>Order</h6>
				</a>
			</div>
		</div>
	</div>
	<div class="container-fluid dashboard_main">
		<div class="row dash_row">

			<div class="col-md-2 dash">
				<a href="/cancel_bill">
					<img class="logos" src="img\bill.png">
					<h6>Cancel Bill/Invoice</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/vehicle">
					<img class="logos" src="img\delivery.png">
					<h6>Vehicle Expense</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/stock">
					<img class="logos" src="img\stock.png">
					<h6>Stock Transfer</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/closePO">
					<img class="logos" src="img\purchase.png">
					<h6>Closing PO</h6>
				</a>
			</div>
			<div class="col-md-2 dash">
				<a href="/reports">
					<img class="logos" src="img\purchase.png">
					<h6>Reports</h6>
				</a>
			</div>
		</div>
	</div>

</body>
</html>