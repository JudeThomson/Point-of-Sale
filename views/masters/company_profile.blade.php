<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raj Retail POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/company_profile.css">
</head>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Company Profile</p>
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
	<!--secound container-->
    <div class="container seccon">
        <div class="row patrow">
            <div class="col-12">
                <form action="{{ route('company.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Company Name <span class="star">*</span></label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="company_name" id="company_name" class="form-control ins" value="{{ $companyProfile->company_name ?? '' }}">
                            <span id="company_nameErr" class="error"></span>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Address 1</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="address_one" class="form-control ins" value="{{ $companyProfile->address1 ?? '' }}">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Address 2</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="address_two" id="" class="form-control ins" value="{{ $companyProfile->address2 ?? '' }}">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Address 3</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="address_three" id="" class="form-control ins" value="{{ $companyProfile->address3 ?? '' }}">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Mobile No <span class="star">*</span></label>
                            
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="mobile" id="mobile" class="form-control ins" value="{{ $companyProfile->mobile ?? '' }}">
                            <span id="mobileNumberErr" class="error"></span>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Email ID</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="email" name="mail" id="" class="form-control ins" value="{{ $companyProfile->email ?? '' }}">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="phone" id="" class="form-control ins" value="{{ $companyProfile->phone ?? '' }}">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Website</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="website" id="" class="form-control ins" value="{{ $companyProfile->website ?? '' }}">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Person Name <span class="star">*</span></label>
                            
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="preson" id="preson" class="form-control ins" value="{{ $companyProfile->person_name ?? '' }}">
                            <span id="personNameErr" class="error"></span>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Reg.No.</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="reg" id="" class="form-control ins" value="{{ $companyProfile->company_reg_no ?? '' }}">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>Currency</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <select name="currency" value="{{ $companyProfile->currency ?? '' }}" type="number" class="form-control ins">
                                <option value="1" {{ $companyProfile->currency == 1 ? 'selected' : '' }}>$</option>
                                <option value="2" {{ $companyProfile->currency == 2 ? 'selected' : '' }}>₹</option>
                                <option value="3" {{ $companyProfile->currency == 3 ? 'selected' : '' }}>€</option>
                                <option value="4" {{ $companyProfile->currency == 4 ? 'selected' : '' }}>£</option>
                                <option value="5" {{ $companyProfile->currency == 5 ? 'selected' : '' }}>¥</option>
                              </select>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-3 patname">
                            <label>GSTIN No.</label>
                        </div>
                        <div class="col-md-9 com_in">
                            <input type="text" name="gst" id="" class="form-control ins" value="{{ $companyProfile->tin_no ?? '' }}">
                        </div>
                    </div>
                    <div class="row btns">
                        <div class="col-md-6">
                            <div class="savee">
                                <input type="submit" name="submit" value="Save" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn2" id="cancelBtn">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    document.getElementById('cancelBtn').addEventListener('click', function() {
        window.location.href = '/dashboard';
    });
    function validateForm() {
        var companyName = document.getElementById("company_name").value;
        var mobileNumber = document.getElementById("mobile").value;
        var personName = document.getElementById("preson").value;

        var companyNameErr = "";
        var mobileNumberErr = "";
        var personNameErr = "";

        // Validate Company Name
        if (companyName.trim() === "") {
            companyNameErr = "Company name is required";
        }
        // Validate Mobile Number
        if (mobileNumber.trim() === "") {
            mobileNumberErr = "Mobile number is required";
        } else if (!/^\d{10}$/.test(mobileNumber.trim())) {
            mobileNumberErr = "Please enter a valid 10-digit mobile number";
        }

        // Validate Person Name
        if (personName.trim() === "") {
            personNameErr = "Person name is required";
        }

        // Display validation errors for Company Name
        document.getElementById("company_nameErr").innerHTML = companyNameErr;
        document.getElementById("mobileNumberErr").innerHTML = mobileNumberErr;
        document.getElementById("personNameErr").innerHTML = personNameErr;

        // Check if there are no errors
        if (companyNameErr === "" && mobileNumberErr === "" && personNameErr === "") {
            return true;
        } else {
            return false;
        }
    }
</script>
</body>
</html>