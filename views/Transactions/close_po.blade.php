<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Closing PO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/vendor.css">
</head>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Closing PO</p>
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
    {{-- Seccounf Container --}}
    <div class="container seccon">
        <div class="row">
            <div class="col-6">
                <label for="po_no">Select PO Number:</label>
            </div>
            <div class="col-6">
                <label for="">date</label>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
            <form action="{{ route('close-po-close') }}" method="POST">
                @csrf
                @foreach ($purchaseOrders as $po)                                
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="po_no" value="{{ $po->po_no }}" id="po_{{ $po->po_no }}">
                    <label class="form-check-label" for="po_{{ $po->po_no }}">
                        {{ $po->po_no }}
                    </label>
                </div> 
                @endforeach               
            </div>
            <div class="col-6">   
                @foreach ($purchaseOrders as $po)             
                    {{ $po->server_time }}   <br>  
                @endforeach
            </div>
        </div>
        <div class="row btns">
            <div class="col-md-6 three_btns">
                <div class="savee">
                    <input type="submit" name="submit" value="Close" class="btn1">
                </div>
            </div>
            <div class="col-md-6 three_btns">
                <button type="button" class="btn2" onclick="cancelForm()">Cancel</button>
            </div>
        </div>
            </form>
    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    </body>
</html>