<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raj Retail POS</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z8vwu/6E3Z/s3vFq+8Wr5Q8x2Z83Z1i1HwEJfc" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/warehouse.css">
</head>
<style>
    .error{
        position: absolute;
        left: 71%;
    }
</style>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Warehouse</p>
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
            <div class="col-md-12">
                <form method="POST" action="{{ route('warehouse.store') }}" class="form-inline update" onsubmit="return validateForm()">
                    @csrf
                        <input type="text" name="newWarehouse" class="ins" placeholder="Add Warehouse">
                        <span id="warehouse_err" class="error"></span>
                        <input type="hidden" name="editWarehouse">
                        <button type="submit" name="addWarehouse" style="border: none; background-color:white;">
                            <img class="plus" src="img/add.png" alt="Add" style="width: 50px; height: 50px;">
                        </button>
                    <button type="button" class="btn btn2" name="cancelEdit" onclick="cancelEdit()" style="display: none;">Cancel</button>
                </form>
            </div>
        </div>    
        <div class="row table_sec">
            <table class="table">
                <thead class="table_head">
                    <tr>
                        <th class="table_data">Warehouse Name</th>
                        <th width="50"></th>
                        <th width="50"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($warehouse as $warehouses)
                        <tr>
                            <td class="table_data">
                                {{ $warehouses->warehouse_name }}
                            </td>
                            <td class="table_data">
                                <img src="img/edit.png" alt="edit" style="width: 50px; height: 50px;" onclick="editWarehouse({{ $warehouses->_id }}, '{{ $warehouses->warehouse_name }}')">
                            </td>
                            <td class="table_data">
                                <img src="img/delete.png" onclick="confirmDelete('{{ $warehouses->_id }}')" alt="delete" style="width: 50px; height: 50px;">
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body confirm">
                Are you sure you want to delete this warehouse?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn2 " id="confirmDeleteBtn">Delete</button>
                <button type="button" class="btn btn1 " data-dismiss="modal">Cancel</button>                
            </div>
        </div>
    </div>
</div>
{{-- <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $currentPage == 1 ? '#' : '?page=' . ($currentPage - 1) }}" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      @for ($i = 1; $i <= $totalPages; $i++)
        <li class="page-item {{ $currentPage == $i ? 'active' : '' }}"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
      @endfor
      <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $currentPage == $totalPages ? '#' : '?page=' . ($currentPage + 1) }}" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav> --}}
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<script>
    function validateForm() {
        var warehouse = document.querySelector('input[name="newWarehouse"]').value;

        var warehouseErr = "";

        // Validate Company Name
        if (warehouse.trim() === "") {
            warehouseErr = "warehouse name is required";
        }

        // Display validation errors for Company Name
        document.getElementById("warehouse_err").innerHTML = warehouseErr;

        // Check if there are no errors
        if (warehouseErr === "") {
            return true;
        } else {
            return false;
        }
    }

    var deleteUrl = '';
    function cancelEdit() {
        document.querySelector('form.form-inline.update').reset();
        window.location.reload();
    }
    function editWarehouse(_id, warehouse_name) {
        document.querySelector('input[name="newWarehouse"]').value = warehouse_name;
        document.querySelector('input[name="editWarehouse"]').value = _id;

        var form = document.querySelector('form.form-inline.update');
        form.action = '{{ route("warehouse.update") }}?editWarehouse=' + _id;
        document.querySelector('button[name="addWarehouse"]').innerHTML = 'Update';
        document.querySelector('button[name="addWarehouse"]').classList.add('btn2');
        document.querySelector('button[name="cancelEdit"]').style.display = 'inline';
    }
    function confirmDelete(warehouseId) {
        deleteUrl = '/warehouse/delete/' + warehouseId;
        $('#deleteConfirmationModal').modal('show');
    }   
    
    $('#confirmDeleteBtn').click(function() {
        if (deleteUrl !== '') {
            window.location.href = deleteUrl;
        }
    });
</script>
</body>
</html>