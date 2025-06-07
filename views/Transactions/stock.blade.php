<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Transfer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/transactions.css">
    <style>
        .selected {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <!--First Container-->
    <div class="container-fluid navigation">
        <div class="row">
            <div class="col-md-8 logo">
                <img src="img/logo.png">
                <p>Srock Transfer</p>
            </div>
            <div class="col-md-4 hrl">
                <a href="/dashboard">
                    <img class="logo_home" src="img/home.png">
                </a>
                <a href="#">
                    <img class="logo_refr" src="img/refresh.png">
                </a>
                <a href="{{ route('logout') }}">
                    <img class="logo_logout" src="img/logout.png">
                </a>
            </div>
        </div>
    </div>
    <!--Second Container-->
    <div class="container seccon">
        <div class="row patrow">
            <div class="col-12">
                <form method="POST" action="{{ route('stock.transfer.store') }}">                    
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label>Transfer No</label>
                            <input type="text" name="transfer_no" id="transfer_no" class="form-control ins" readonly>
                        </div>
                        <div class="col-6">
                            <label>Date</label>
                            <input type="text" name="current_date" id="current_date" class="form-control ins" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-6">
                            <label for="">From Warehouse</label>
                            <button type="button" id="fromWarehouseBtn" class="btn btn-primary" onclick="showWarehouses('from')">Select From Warehouse</button>
                            <input type="hidden" name="from_warehouse" id="from_warehouse">
                        </div>
                        <div class="col-6">
                            <label for="">To Warehouse</label>
                            <button type="button" id="toWarehouseBtn" class="btn btn-primary" onclick="showWarehouses('to')">Select To Warehouse</button>
                            <input type="hidden" name="to_warehouse" id="to_warehouse">
                        </div>
                    </div>  
                    <div class="row" style="margin-top: 16px">
                        <div class="col-1">
                            <a href="#" data-toggle="modal" data-target="#categoryModal">
                                <img class="logos" src="img/package.png" style="width: 80%;">
                                <h6 class="h6_heading" id="selected_category">Category</h6>
                                <input type="hidden" name="category_code" id="category_code">
                            </a>
                        </div>
                        <div class="col-1">
                            <a href="#" data-toggle="modal" data-target="#productModal">
                                <img class="logos" src="img/product.png" style="width: 80%;">
                                <h6 class="h6_heading" id="selected_product_name">Product</h6>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="advance">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="advance" id="advance" placeholder="Advance" class="form-control pat">
                            </div>
                        </div>
                    </div> --}}
                    <div class="row table_sec" style="margin-top: 14px">
                        <div class="col-md-12">
                            <table>
                                <thead class="table_head">
                                    <tr>
                                        <th class="head_data" width="500">Product Name</th>
                                        <th class="head_data" width="300">Qty</th>
                                        <th class="head_data" width="300">UOM</th>
                                        <th class="table_data"></th>
                                        <th class="table_data"></th>
                                        <th class="table_data"></th>
                                    </tr>
                                </thead>
                                <div id="editSection" style="display: none;">
                                    <label for="editProductName">Product Name:</label>
                                    <select name="product_code" id="editProductName" class="form-control">
                                        @foreach ($product as $products)
                                            <option value="{{ $products->product_name }}" 
                                                    {{ $products->product_code == $products->product_code ? 'selected' : '' }}>
                                                {{ $products->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="editProductQuantity">Quantity:</label>
                                    <input type="number" id="editProductQuantity">
                                    
                                    <button type="button" onclick="saveEdit()">Save</button>
                                </div>
                                
                                <tbody class="purchaseTable">

                                </tbody>
                            </table>
                            <input type="hidden" name="products" id="products" value="">
                        </div>
                    </div>            
                    <div class="row btns">
                        <div class="col-md-4 three_btns">
                            <div class="savee">
                                <input type="submit" name="submit" value="Save" class="btn1" id="submitProductsButton">
                            </div>
                        </div>
                        <div class="col-md-4 three_btns">
                            <div class="savee">
                                <input type="button" name="submit" onclick="clearall()" value="Clear All" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-4 three_btns">
                            <button type="button" class="btn2" onclick="cancelForm()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Quantity Modal -->
    <div class="modal fade" id="quantityModal" tabindex="-1" role="dialog" aria-labelledby="quantityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quantityModalLabel">Enter Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                                       
                    <div class="form-group">
                        <label for="quantityInput">Qty</label>
                        <input type="number" class="form-control" id="quantityInput" name="quantity">
                    </div>
                    <input type="hidden" id="hiddenProductId">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="addToTable()">Ok</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="vendorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorModalLabel">Select Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach ($category as $categories)
                            <li class="list-group-item" onclick="selectCategory('{{ $categories->category_code }}', '{{ $categories->category }}')">
                                {{ $categories->category }}
                            </li>
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
                            <a href="" class="list-group-item list-group-item-action product-item" data-id="{{ $products->product_code }}" data-uom="{{ $products->unit_of_msrment }}" onclick="selectProduct('{{ $products->product_code }}', '{{ $products->product_name }}')">
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
    {{-- Warehouse Model --}}
    <div class="modal fade" id="warehouseModal" tabindex="-1" role="dialog" aria-labelledby="warehouseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warehouseModalLabel">Select Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="warehouseList">
                    <!-- Warehouse list will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script>
        var lastVendorCodeNumber = 0;

        function generateTransferNO() {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var middleCodeLength = 2;
            var middleVendorCode = '';

            for (var i = 0; i < middleCodeLength; i++) {
                middleVendorCode += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            var stockbo = 'RA' + middleVendorCode + 'C' + lastVendorCodeNumber;
            lastVendorCodeNumber++;
            return stockbo;
        }

        window.onload = function() {
            document.getElementById('transfer_no').value = generateTransferNO();
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var month = monthNames[today.getMonth()];
            var year = today.getFullYear();
            var formattedDate = day + '/' + month + '/' + year;
            document.getElementById('current_date').value = formattedDate;
        };
        function selectCategory(id, name) {
            document.getElementById('category_code').value = id;
            document.getElementById('selected_category').innerText = name;
            $('#categoryModal').modal('hide');
            loadProductsByCategory(id);
        }
        function loadProductsByCategory(categoryId) {
            $.ajax({
                url: "{{ route('purchase.products') }}",
                type: "GET",
                data: { category_code: categoryId },
                success: function(response) {
                    $('#productList').html(response);
                }
            });
        }
        var productData = {}; 
        function selectProduct(id, name) {
            var productItem = $('#productList .product-item[data-id="' + id + '"]');
            var unit_of_msrment = productItem.data('unit_of_msrment'); 

            $('#selected_product_name').text(name);
            $('#hiddenProductId').val(id);
            $('#quantityModal').modal('show');
            $('#productModal').modal('hide');
            
            productData[id] = {
                product_code: id,
                name: name,
            };
        }
        function addToTable() {
            var productId = $('#hiddenProductId').val();
            var quantity = $('#quantityInput').val();
            
            if (productId && quantity) {
                var product = productData[productId];
                
                if (product) {
                    var row = `<tr data-product-code="${productId}">
                        <td>${product.name}</td>
                        <td>${quantity}</td>
                        <td>${product.unit_of_msrment || 'N/A'}</td>
                        <td class="table_data">
                            <a href="#">
                                <img src="img/edit.png" alt="edit" style="width: 50px; height: 50px;">
                            </a>
                        </td>
                        <td class="table_data">
                            <img src="img/delete.png" onclick="editProduct(1)" alt="delete" style="width: 50px; height: 50px;" class="deleteButton">
                        </td>
                    </tr>`;
                    
                    $('table tbody').append(row);
                    $('#quantityModal').modal('hide');
                    serializeTableData();
                }
            }
        }        
        function serializeTableData() {
            var products = [];
            $('table tbody tr').each(function() {
                var row = $(this);
                var productCode = row.data('product-code'); 
                console.log("Product Code:", productCode);
                var product = {
                    product_code: productCode,
                    quantity: row.find('td').eq(1).text(),
                };
                products.push(product);
            });
            console.log("Serialized Products Array:", products);
            $('#products').val(JSON.stringify(products));
        }
        function removeRow(button) {
            $(button).closest('tr').remove();
        }
        function clearall() {
            window.location.href = '/purchase';
        }
        function cancelForm() {
            window.location.href = '/dashboard';
        }
        function showWarehouses(type) {
            $.ajax({
                url: "{{ route('get.warehouses') }}", 
                type: "GET",
                success: function(response) {
                    $('#warehouseList').html(''); 
                    response.forEach(warehouse => {
                        let item = `<li class="list-group-item" onclick="selectWarehouse('${type}', '${warehouse.warehouse_code}', '${warehouse.warehouse_name}')">${warehouse.warehouse_name}</li>`;
                        $('#warehouseList').append(item);
                    });
                    $('#warehouseModal').modal('show');
                }
            });
        }

        function selectWarehouse(type, warehouse_code, warehouse_name) {
            if (type === 'from') {
                $('#fromWarehouseBtn').text(warehouse_name); 
                $('#from_warehouse').val(warehouse_name)
            } else {
                $('#toWarehouseBtn').text(warehouse_name);
                $('#to_warehouse').val(warehouse_name);
            }
            $('#warehouseModal').modal('hide');
        }


    </script>
</body>
</html>
