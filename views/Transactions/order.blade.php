<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
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
                <p>Order</p>
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
                <form method="POST" action="{{ Route('order.save') }}">                    
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label>Order No</label>
                            <input type="text" name="order_no" id="order_no" class="form-control ins" readonly>
                        </div>
                        <div class="col-6">
                            <label>Date</label>
                            <input type="text" name="current_date" id="current_date" class="form-control ins" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="patid" id="inputid_1" class="form-control pat" placeholder=" Customer ID">
                            <input type="text" name="patname" id="inputid_2" class="form-control pat" placeholder=" Customer Name">
                            <input type="text" name="num" id="inputid_3" class="form-control pat" placeholder="Mobile No.">
                            <a href="#">
                                <img src={{ asset('img\search.png') }} alt="search" class="plus" style="width: 50px; height: 50px;">
                            </a>
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
                                <input type="hidden" name="product_id" id="product_id">
                            </a>
                        </div>
                    </div>
                    <div class="advance">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="advance" id="advance" placeholder="Advance" class="form-control pat">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="selected_customer_id" name="customer_id" value="">
                    <div id="customerResults"></div>
                    <div id="edit-section" style="display: none;">
                        <input type="text" id="edit-product-name" placeholder="Edit Product Name" />
                        <input type="number" id="edit-qty" placeholder="Edit Quantity" />
                        <button onclick="saveChanges()">Save</button>
                    </div>
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
                        <input type="hidden" name="action" id="action" value="">
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
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script>
        var lastVendorCodeNumber = 0;

        function generateOrderNO() {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var middleCodeLength = 2;
            var middleVendorCode = '';

            for (var i = 0; i < middleCodeLength; i++) {
                middleVendorCode += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            var OrderNO = 'RA' + middleVendorCode + 'C' + lastVendorCodeNumber;
            lastVendorCodeNumber++;
            return OrderNO;
        }

        window.onload = function() {
            document.getElementById('order_no').value = generateOrderNO();
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

            $('#product_id').val(id);
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
                    name: row.find('td').eq(1).text(),
                    quantity: row.find('td').eq(2).text(),
                    uom: row.find('td').eq(3).text()
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

        // function editProduct(productId) {
        //     var row = document.querySelector(`tr[data-id="${productId}"]`);
        //     var productName = row.querySelector('.product-name').textContent;
        //     var productQty = row.querySelector('.product-qty').textContent;

        //     document.getElementById('edit-section').style.display = 'block';
        //     document.getElementById('edit-product-name').value = productName;
        //     document.getElementById('edit-qty').value = productQty;

        //     document.getElementById('edit-section').setAttribute('data-edit-id', productId);
        // }

        //     function saveChanges() {
        //     var productId = document.getElementById('edit-section').getAttribute('data-edit-id');

        //     var newName = document.getElementById('edit-product-name').value;
        //     var newQty = document.getElementById('edit-qty').value;

        //     var row = document.querySelector(`tr[data-id="${productId}"]`);
        //     row.querySelector('.product-name').textContent = newName;
        //     row.querySelector('.product-qty').textContent = newQty;

        //     document.getElementById('edit-section').style.display = 'none';
        // }

        $(document).ready(function() {
            $('.plus').on('click', function(e) {
                e.preventDefault();

                var query = $('#inputid_1').val() || $('#inputid_2').val() || $('#inputid_3').val();

                $.ajax({
                    url: '{{ route('customers.search') }}',
                    type: 'GET',
                    data: { query: query },
                    success: function(response) {
                        var resultHtml = '';
                        if (response.length > 0) {
                            response.forEach(function(customer) {
                                resultHtml += `
                                    <div class="customer-item" data-id="${customer.customer_id}" data-name="${customer.customer_name}" data-mobile="${customer.mobile}">
                                        <p>ID: ${customer.customer_id} | Name: ${customer.customer_name} | Mobile: ${customer.mobile}</p>
                                        <button type="button" class="selectCustomer">Select</button>
                                    </div>
                                `;
                            });
                        } else {
                            resultHtml = '<p>No customers found</p>';
                        }

                        $('#customerResults').html(resultHtml);
                    }
                });
            });

            $('#customerResults').on('click', '.selectCustomer', function() {
                var selectedCustomerId = $(this).closest('.customer-item').data('id');
                var selectedCustomerName = $(this).closest('.customer-item').data('name');
                var selectedCustomerMobile = $(this).closest('.customer-item').data('mobile');

                $('#inputid_1').val(selectedCustomerId);
                $('#inputid_2').val(selectedCustomerName);
                $('#inputid_3').val(selectedCustomerMobile);

                $('#selected_customer_id').val(selectedCustomerId);
                $('#customerResults').html('');
            });
        });

    </script>
</body>
</html>
