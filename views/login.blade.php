<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS\login.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="icon" type="image/x-icon" href="img/logo.png">
	<title>Raj Retail POS</title>
</head>
{{-- <style>
	.box
	{
		background-image: url('img/logo.png');
		background-size: cover;
		background-position: center;
	}
</style> --}}
<body>
	<div class="container-fluid box">
		<!--row 1-->
		<div class="row">
			<div class="col-md-6 logo_1">
				<img src="img\logo.png">
			</div>
			<div class="col-md-6 logo_2">
				<img src="img\logo.png">
			</div>
		</div>
		<!--row 2-->
		<div class="row">
			<div class="col-md-12 headname">
				<p class="co_name">
					Raj Retail POS
				</p>
			</div>
		</div>
		<!--row 3-->
		<div class="row">
			<div class="col-md-12 last_row">
				<form action="{{ route('login') }}" method="POST">
					@csrf
				  	<div class="form-group">
				    	<input class="mail" id="Staffid" placeholder="User ID" name="staff_id" autocomplete="username">
				  	</div>
				  	<div class="form-group">
				    	<input type="password" class="pasword" id="password" placeholder="Password" name="password" autocomplete="current-password">
				  	</div>				 
				  	<input type="submit" class="in">
				  	<button type="button" class="forgot">Forgot Password?</button>
				</form>
			</div>	
			<div class="col-md-12 footer">
				<p>Powered by Raj InfotechBiz Solutions Pvt. Ltd.</p>
				<p>Mobile : +919444338475</p>
				<p>Office : +914652223969</p>
				<p>E-Mail : info@rajinfotechbiz.com</p>
				<p class="lastp">Web :www.rajinfotechbiz.com</p>
			</div>
		</div>
	</div> 
	{{-- <script type="text/javascript">
		function validate() {
		var Staff = document.getElementById("Staffid").value;
		var Password = document.getElementById("password").value;

		if (Staff == "" || Password == "") 
		{
			alert("Please Enter Both Staff Id and Password");
			return false;
		}
		else
		{
			window.location.href = "main_index/dashboard.php";
			return true;
		}
	}
	</script> --}}
</body>
</html>