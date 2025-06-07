<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raj Retail POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href={{ asset('css/product.css') }}>
</head>
<style>
    .star{
        color: red;
    }
    .error-message{
        color: red;
    }
    .error-message-mobile{
        color: red;
    }
</style>
<body>
<!--First Container-->
<div class="container-fluid navigation">
    <div class="row">
        <div class="col-md-8 logo">
            <img src={{ asset('img\logo.png') }}>
            <p>Staff</p>
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
<!--Secound container-->
<div class="container details">
    <div class="row patrow">
        <div class="col-md-12">
            <form action="{{ route('staff.update', $staff->_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Staff ID</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="staff_id" id="company_name" class="form-control ins" value="{{ $staff->staff_id }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Staff Name <span class="star">*</span></label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="staff_name" id="company_name" class="form-control ins" value="{{ $staff->staff_name }}">
                        @error('staff_name')
                            <div class="error-message">
                                *{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>Role</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <select name="role" id="role" class="form-control ins">
                            @foreach($role as $roles)
                                <option value="{{ $roles->role_id }}" {{ $staff->role_id == $roles->role_id ? 'selected' : '' }}>
                                    {{ $roles->role_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>                
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>Warehouse</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <select name="warehouse" id="warehouse" class="form-control ins">
                            @foreach($warehouse as $warehouses)
                                <option value="{{ $warehouses->warehouse_code }}" {{ $staff->warehouse_code == $warehouses->warehouse_code ? 'selected' : '' }}>
                                    {{ $warehouses->warehouse_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Address</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="address" class="form-control ins" value="{{ $staff->address }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Mobile No <span class="star">*</span></label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="mobile" id="" class="form-control ins" value="{{ $staff->mobile }}">
                        @error('mobile')
                            <div class="error-message-mobile">
                               * {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Email ID</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="email" name="email" id="" class="form-control ins" value="{{ $staff->email }}">
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
<script>
    function previewImage(event)
	{
		var input = event.target;
		var reader = new FileReader();

		reader.onload = function()
		{
			var imgElement = document.getElementById("preview_image");
			imgElement.src = reader.result;
		};
		reader.readAsDataURL(input.files[0]);
	}
    function cancelForm() {
        window.location.href = '/staff';
    }
    document.querySelector('input[name="staff_name"]').addEventListener('input', function() {
        var errorMessage = document.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    });
    document.querySelector('input[name="mobile"]').addEventListener('input', function() {
        var errorMessage = document.querySelector('.error-message-mobile');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    });
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>