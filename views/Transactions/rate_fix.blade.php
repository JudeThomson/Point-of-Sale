<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rate Fixation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/transactions.css">
    <style>
        .selected {
            background-color: #007bff;
            color: white;
        }
        .grnp_ins {
            border: none;
            box-shadow: 0px 1px 0px 0px gray;
            display: inline;
        }
        .btns{
            margin-top: 16px !important;
        }
        .btn1{
            text-align: right !important;
        }
        .btn2{
            text-align: left !important ;
        }
    </style>
</head>
<body>
    <!--First Container-->
    <div class="container-fluid navigation">
        <div class="row">
            <div class="col-md-8 logo">
                <img src="img\logo.png">
                <p>GRNP</p>
            </div>
            <div class="col-md-4 hrl">
                <a href="/dashboard">
                    <img class="logo_home" src="img\home.png">
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
    <div class="container details" style="margin-top: 8%">
        <div class="row patrow">
            <div class="col-md-12">
                <form action="{{ route('rate.update') }}" method="POST">
                    @csrf
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">Product Category</label>
                        </div>
                        <div class="col-6">
                            <button type="button" id="categoryButton" class="btn" data-toggle="modal" data-target="#categoryModal">
                                Choose Category
                                <input type="hidden" id="selectedCategoryInput" name="selectedCategory">
                            </button>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">Product</label>
                        </div>            
                        <div class="col-6">
                            <button type="button" id="productButton" class="btn" data-toggle="modal" data-target="#productModal">
                                product
                            </button>
                            <input type="hidden" id="selectedProductInput" name="selectedProduct">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">Product Code</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="product_id" id="product_id" readonly>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="hsn">HSN</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="hsn" id="hsn" readonly>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">Batch No.</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="batch_no" id="batch_no" readonly>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">Qty</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="qty" id="qty" readonly>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">UMO</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="umoDisplay" id="umoDisplay" readonly>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">Purchase Rate</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="purchase_rate" id="purchase_rate" readonly>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">Selling Rate</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="selling_rate" id="selling_rate">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">CGST</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="cgst" id="cgst">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">SGST</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="sgst" id="sgst">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">IGST</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="igst" id="igst">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-6">
                            <label for="">RO Level</label>
                        </div>            
                        <div class="col-6">
                            <input class="grnp_ins" name="re_or" id="re_or">
                        </div>
                    </div>
                    <div class="row btns">
                        <div class="col-md-6 three_btns">
                            <div class="savee">
                                <input type="submit" name="submit" value="Save" class="btn1" id="submitProductsButton">
                            </div>
                        </div>
                        <div class="col-md-6 three_btns">
                            <button type="button" class="btn2" onclick="cancelForm()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Select Product Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="category-list">
                        @foreach($categories as $category)
                            <li class="list-group-item">{{ $category->category }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Modal -->   
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Select Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{ route('purchase.products') }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="query" placeholder="Product Name">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    <div id="productList" class="list-group">
                        @foreach($product as $products)
                            <a href="#" class="list-group-item list-group-item-action product-item" data-id="{{ $products->product_code }}" data-uom="{{ $products->unit_of_msrment }}">
                                <img src="{{ $products->photo }}" class="product-image" alt="{{ $products->product_name }}">
                                <span>{{ $products->product_name }}</span>
                            </a>                        
                        @endforeach
                        @if($product->isEmpty())
                            <p>No products found</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script>
       $(document).ready(function() {
        $('#category-list').on('click', '.list-group-item', function() {
            var selectedCategory = $(this).text();
            
            $('#categoryButton').text(selectedCategory);
            $('#selectedCategoryInput').val(selectedCategory);
            $('#categoryModal').modal('hide');
        });
    });
        $(document).ready(function() {
            $('#productModal').on('click', '.product-item', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var productName = $(this).find('span').text();

                $.ajax({
                    url: '/product/' + productId, 
                    method: 'GET',
                    success: function(response) {

                        $('#product_id').val(productId);
                        $('#productButton').val(response.productName); 
                        $('#umoDisplay').val(response.umo);
                        $('#hsn').val(response.hsn);
                        $('#selling_rate').val(response.selling_rate);
                        $('#cgst').val(response.cgst); 
                        $('#sgst').val(response.sgst); 
                        $('#igst').val(response.igst); 
                        $('#re_or').val(response.reorder_level); 
                        
                        $.ajax({
                            url: '/grnp_sub_data/' + productId, 
                            method: 'GET',
                            success: function(grnpResponse) {
                                
                                $('#batch_no').val(grnpResponse.batch_no); 
                                $('#qty').val(grnpResponse.qty); 
                                $('#purchase_rate').val(grnpResponse.purchase_rate); 

                                $('#productButton').text(productName);
                                $('#selectedProductInput').val(productId);
                                
                                $('#productModal').modal('hide');
                            },
                            error: function() {
                                alert('Error fetching grnp_sub details');
                            }
                        });
                    },
                    error: function() {
                        alert('Error fetching product details');
                    }
                });
            });
        });
        function cancelForm() {
            window.location.href = '/dashboard';
        }
    </script>
    </body>
</html>
