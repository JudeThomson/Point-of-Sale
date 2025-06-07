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
    .error{
        position: absolute;
        color: red;
    }
</style>
<body>
<!--First Container-->
<div class="container-fluid navigation">
    <div class="row">
        <div class="col-md-8 logo">
            <img src={{ asset('img\logo.png') }}>
            <p>Product</p>
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
            <form action="{{ route('product.update', $product->_id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="upimg">
                            <label for="profile_pic">
                                <img id="preview_image" src="{{ asset('storage/' . $product->image_path) }}">
                            </label>
                            <input type="file" id="profile_pic" name="photo" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                        </div>
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>Product Category</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <select name="category_code" id="category_code" class="form-control ins">
                            @foreach($categories as $category)
                                <option value="{{ $category->category_code }}" {{ $product->category_code == $category->category_code ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>Product Name</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="product_name" id="product_name" class="form-control ins" value="{{ $product->product_name }}">
                        <span id="productErr" class="error"></span>
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>HSN Code</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="hsn_code" id="hsn_code" class="form-control ins" value="{{ $product->hsn_code }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>UMO</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="unit_of_msrment" id="unit_of_msrment" class="form-control ins" value="{{ $product->unit_of_msrment }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>Selling Rate ($)</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="selling_rate" id="selling_rate" class="form-control ins" value="{{ $product->selling_rate }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>CGST(%)</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="cgst" id="cgst" class="form-control ins" value="{{ $product->cgst }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>SGST(%)</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="sgst" id="sgst" class="form-control ins" value="{{ $product->sgst }}">
                    </div>
                </div>

                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>IGST(%)</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="igst" id="igst" class="form-control ins" value="{{ $product->igst }}">
                    </div>
                </div>
                <div class="row com_row">
                    <div class="col-md-3 patname category">
                        <label>Reorder Level</label>
                    </div>
                    <div class="col-md-9 com_in">
                        <input type="text" name="reorder_level" id="reorder_level" class="form-control ins" value="{{ $product->reorder_level }}">
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
    document.getElementById('product_name').addEventListener('input', function() {
        var productErr = document.getElementById('productErr');
        if (this.value.trim() !== "") {
            productErr.innerHTML = "";
        }
    });
     function validateForm() {
        var productName = document.getElementById("product_name").value;

        var productErr = "";

        // Validate Company Name
        if (productName.trim() === "") {
            productErr = "Product name is required";
        }

        // Display validation errors for Company Name
        document.getElementById("productErr").innerHTML = productErr;

        // Check if there are no errors
        return productErr === "";
    }
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
        window.location.href = '/product';
    }
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>