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
            <p>Customer</p>
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
        <div class="col-md-12" style="margin-top: 14px">
            <form action="{{ route('customer.update', $customer->_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Customer ID</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="customer_id" id="customer_id" class="form-control ins" value="{{ $customer->customer_id }}" readonly>
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Customer Name <span class="star">*</span></label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="customer_name" id="company_name" class="form-control ins" value="{{ $customer->customer_name }}">
                        @error('customer_name')
                            <div class="error-message">
                                *{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Mobile No <span class="star">*</span></label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="mobile" id="" class="form-control ins" value="{{ $customer->mobile }}">
                        @error('mobile')
                            <div class="error-message-mobile">
                               * {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Address 1</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="address1" class="form-control ins"  value="{{ $customer->address1 }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Address 2</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="address2" class="form-control ins"  value="{{ $customer->address2 }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Address 3</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="address3" class="form-control ins"  value="{{ $customer->address3 }}">
                    </div>
                </div>
                <!--Other State Input Here-->
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>Email ID</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="email" name="email" id="" class="form-control ins"  value="{{ $customer->email }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname">
                        <label>remark</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="remark" class="form-control ins"  value="{{ $customer->remark }}">
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
    
    window.onload = function() {
        document.getElementById('customer_id').value = generateVendorCode();
    };

    function cancelForm() {
        window.location.href = '/customer';
    }

    document.querySelector('input[name="customer_name"]').addEventListener('input', function() {
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