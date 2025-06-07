<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raj Retail POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href={{ asset('css/category.css') }}>
</head>
<body>
<!--First Container-->
<div class="container-fluid navigation">
    <div class="row">
        <div class="col-md-8 logo">
            <img src={{ asset('img\logo.png') }}>
            <p>Product Category</p>
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
            <form method="POST" action="{{ route('category.store') }}" class="form-inline update" onsubmit="return validateForm()">
                @csrf
                <input type="text" name="newCategory" class="ins" id="searchInput" placeholder="Enter Category">
                <span id="category_err" class="error"></span>
                <input type="hidden" name="editcategory">
                <a href="#" onclick="searchCategories()">
                    <img src={{ asset('img\search.png') }} alt="search" class="plus" style="width: 50px; height: 50px;">
                </a>
                <a href="" onclick="document.querySelector('form.form-inline.update').submit(); return false;" style="border: none; background-color:white; display: inline-block;">
                    <img class="plus add" src="img/add.png" alt="Add" style="width: 50px; height: 50px;">
                </a>
                <button type="submit" class="btn2 ml-2" name="saveEdit" style="display: none;">Save</button>
                <button class="btn1 ml-2" name="cancelEdit" onclick="cancelEdit()" style="display: none;">Cancel</button>
            </form>
        </div>
    </div>    
    <div class="row table_sec">
        <table class="table">
            <thead class="table_head">
                <tr>
                    <th class="table_data">Category Code</th>
                    <th class="table_data">Category Name</th>
                    <th width="50"></th>
                    <th width="50"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $categories)
                    <tr>
                        <td class="table_data">
                            {{ $categories->category_code }}
                        </td>
                        <td class="table_data">
                            {{ $categories->category }}
                        </td>
                        <td class="table_data">
                            <img src="img/edit.png" alt="edit" style="width: 50px; height: 50px;" onclick="editcategory({{ $categories->_id }}, '{{ $categories->category }}')">
                        </td>
                        <td class="table_data">
                            <img src="img/delete.png" onclick="confirmDelete('{{ $categories->_id }}')" alt="delete" style="width: 50px; height: 50px;">
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
                Are you sure you want to delete this Category?
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
    function validateForm() {
        var category = document.querySelector('input[name="newCategory"]').value;

        var categoryErr = "";
        document.getElementById("category_err").innerHTML = "";

        // Validate Category
        if (category.trim() === "") {
            categoryErr = "Category name is required";
        }

        // Display validation errors for Category
        document.getElementById("category_err").innerHTML = categoryErr;

        // Check if there are no errors
        if (categoryErr === "") {
            return true;
        } else {
            return false;
        }
    }

    var deleteUrl = '';
    function cancelEdit() {
        document.querySelector('form.form-inline.update').reset();
        window.location.href = window.location.href;
    }   
    function editcategory(_id, category) {
        document.querySelector('input[name="newCategory"]').value = category;
        document.querySelector('input[name="editcategory"]').value = _id;

        var form = document.querySelector('form.form-inline.update');
        form.action = '{{ route("category.update") }}?editcategory=' + _id;
        document.querySelector('button[name="cancelEdit"]').style.display = 'inline';
        document.querySelector('button[name="saveEdit"]').style.display = 'inline';

        document.querySelector('.add').style.display = 'none';
        document.querySelector('.plus').style.display = 'none';
    }
    function confirmDelete(_id) {
        deleteUrl = '/category/delete/' + _id;
        $('#deleteConfirmationModal').modal('show');
    }   
    
    $('#confirmDeleteBtn').click(function() {
        if (deleteUrl !== '') {
            window.location.href = deleteUrl;
        }
    });
    function searchCategories() {
        var searchQuery = document.getElementById('searchInput').value.toUpperCase();
        
        var rows = document.querySelectorAll('.table_sec tbody tr');
        
        rows.forEach(function(row) {
            var category = row.cells[1].textContent.toUpperCase(); 
            
            if (category.indexOf(searchQuery) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
</html>
