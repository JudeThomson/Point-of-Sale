<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raj Retail POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href={{ asset('css/vendor_add.css') }}>
</head>
<body>
    <style>
        .star{
            color: red;
        }
        .error{
            position: absolute;
            color: red;
        }
    </style>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src={{ asset('img\logo.png') }}>
				<p>Vendor</p>
			</div>	
			<div class="col-md-4 hrl">
				<a href="/dashboard">
					<img class="logo_home" src={{ asset('img\home.png') }}>
				</a>
				<a href="#">
					<img class="logo_refr" src={{ asset('img\refresh.png') }}>
				</a>
				<a href="{{ route('logout') }}">
					<img class="logo_logout" src={{ asset('img\logout.png') }}>
				</a>
			</div>		
		</div>	
	</div>
<!--Secound Container-->
    <div class="container seccon">
        <div class="row patrow">
            <div class="col-md-12">
				<form action="{{ route('vendor.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
					<div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Vendor Code</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="vendor_code" id="vendor_code" class="form-control ins" readonly>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Vendor Name <span class="star">*</span></label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="vendor_name" id="company_name" class="form-control ins" value="{{ isset($vendor) ? $vendor->vendor_name : '' }}">
                            <span id="vendorname_err" class="error"></span>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Vendor Address</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="address" class="form-control ins" value="{{ isset($vendor) ? $vendor->address : '' }}">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Mobile No <span class="star">*</span></label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="mobile" id="mobile" class="form-control ins">
                            <span id="mobileNumberErr" class="error"></span>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Email ID</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="email" name="mail" id="" class="form-control ins" value="{{ isset($vendor) ? $vendor->email : '' }}">
                        </div>
                    </div>
                    <div class="row btns">
                        <div class="col-md-6">
                            <div class="savee">
                                <input type="submit" name="submit" value="Save" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn2" onclick="cancelForm()">Cancel</button>
                        </div>
                    </div>
                </form> 
			</div>   
        </div>
    </div>
</body>
<script>
function validateForm() {
        var vendorname = document.getElementById("company_name").value;
        var mobileNumber = document.getElementById("mobile").value;

        var vendornameErr = "";
        var mobileNumberErr = "";

        // Validate Company Name
        if (vendorname.trim() === "") {
            vendornameErr = "Vendor name is required";
        }
        // Validate Mobile Number
        if (mobileNumber.trim() === "") {
            mobileNumberErr = "Mobile number is required";
        } else if (!/^\d{10}$/.test(mobileNumber.trim())) {
            mobileNumberErr = "Please enter a valid 10-digit mobile number";
        }

        // Display validation errors for Company Name
        document.getElementById("vendorname_err").innerHTML = vendornameErr;
        document.getElementById("mobileNumberErr").innerHTML = mobileNumberErr;

        // Check if there are no errors
        if (vendornameErr === "" && mobileNumberErr === "") {
            return true;
        } else {
            return false;
        }
    }
    
	var lastVendorCodeNumber = 0;	
    function generateVendorCode() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var middleCodeLength = 2;
        var middleVendorCode = '';

        // Generate the middle part of the vendor code
        for (var i = 0; i < middleCodeLength; i++) {
            middleVendorCode += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        var vendorCode = 'RA' + middleVendorCode + 'C' + lastVendorCodeNumber;

        lastVendorCodeNumber++

        return vendorCode;
    }

    window.onload = function() {
        document.getElementById('vendor_code').value = generateVendorCode();
    };

    function cancelForm() {
        window.location.href = '/vendor';
    }

</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</html>