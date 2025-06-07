<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raj Retail POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/vendor.css">
</head>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Vendor</p>
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
        <div class="row patrow">
            <div class="col-md-12">
                <input type="text" name="patid" id="inputid" class="form-control pat" placeholder=" Vendor Code">
                <input type="text" name="patname" id="inputid" class="form-control pat" placeholder=" Vendor Name">
                <input type="text" name="num" id="inputid" class="form-control pat" placeholder=" Mobile No.">
                <img class="logo_search" src="img/search.png">
                <a href="/vendor/add">
                    <img class="logo_search" src="img/add.png">
                </a>
            </div>
        </div>
        <div class="row table_sec">
            <div class="col-md-12">
                <table>
                    <thead class="table_head">
                        <tr>
                            <th class="head_data" width="220">
                                Vendor Code
                            </th>
                            <th class="head_data" width="500">
                                vendor Name
                            </th>
                            <th class="head_data"width="200">
                                Mobile No.
                            </th>
                            <th class ="table_data"></th>
                            <th class ="table_data"></th>
                            <th class ="table_data"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendor as $vendors)
                            <tr>
                                <td class ="table_data">
                                    {{ $vendors->vendor_code }}
                                </td>
                                <td class ="table_data">
                                    {{ $vendors->vendor_name}}
                                </td>
                                <td class ="table_data">
                                    {{ $vendors->mobile}}
                                </td>
                                <td class="table_data">
                                    <a href="/vendor/edit/{{ $vendors->_id }}">
                                        <img src="img/edit.png" alt="edit" style="width: 50px; height: 50px;">
                                    </a>
                                </td>
                                <td class="table_data">
                                    <img src="img/delete.png" onclick="confirmDelete('{{ $vendors->_id }}')" alt="delete" style="width: 50px; height: 50px;">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body confirm">
                Are you sure you want to delete this Vendor?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn2 " id="confirmDeleteBtn">Delete</button>
                <button type="button" class="btn btn1 " data-dismiss="modal">Cancel</button>                
            </div>
        </div>
    </div>
</div>
</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<script>
    var deleteUrl = '';
    function confirmDelete(_id) {
        deleteUrl = '/vendor/delete/' + _id;
        $('#deleteConfirmationModal').modal('show');
    }
    $('#confirmDeleteBtn').click(function() {
        if (deleteUrl !== '') {
            window.location.href = deleteUrl;
        }
    });
</script>
</html>