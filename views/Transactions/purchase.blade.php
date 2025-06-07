<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raj Retail POS</title>
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
                <p>Purchase</p>
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
                <form id="quantityForm" method="POST" action="/purchase/save">                    
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label>Purchase No</label>
                            <input type="text" name="po_no" id="po_no" class="form-control ins" readonly>
                        </div>
                        <div class="col-6">
                            <label>Date</label>
                            <input type="text" name="current_date" id="current_date" class="form-control ins" readonly>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 16px">
                        <div class="col-1">
                            <a href="#" data-toggle="modal" data-target="#vendorModal">
                                <img class="logos" src="img/vendor.png" style="width: 80%;">
                                <h6 class="h6_heading" id="selected_vendor_name">Vendor</h6>
                                <input type="hidden" name="vendor_id" id="vendor_id">
                            </a>
                        </div>
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
                        <div class="col-1">
                            <a href="#" data-toggle="modal" data-target="#purchaseModal">
                                <img class="logos" src="img/purchase.png" style="width: 80%;">
                                <h6 class="h6_heading" id="">Purchase</h6>
                            </a>
                        </div>
                    </div>
                    <div class="row table_sec" style="margin-top: 14px">
                        <div class="col-md-12">
                            <table>
                                <thead class="table_head">
                                    <tr>
                                        <th class="head_data" width="220">Image</th>
                                        <th class="head_data" width="500">Product Name</th>
                                        <th class="head_data" width="200">Qty</th>
                                        <th class="head_data" width="200">UOM</th>
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
                        <div class="col-md-3 three_btns">
                            <div class="savee">
                                <input type="button" name="submit" value="Order" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-3 three_btns">
                            <div class="savee">
                                <input type="submit" name="submit" value="Save" class="btn1" id="submitProductsButton">
                            </div>
                        </div>
                        <div class="col-md-3 three_btns">
                            <div class="savee">
                                <input type="button" name="submit" onclick="clearall()" value="Clear All" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-3 three_btns">
                            <button type="button" class="btn2" onclick="cancelForm()">Cancel</button>
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
                </form>
            </div>
        </div>
    </div>
    <!-- Vendor Modal -->
    <div class="modal fade" id="vendorModal" tabindex="-1" role="dialog" aria-labelledby="vendorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorModalLabel">Select Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach ($vendor as $vendors)
                            <li class="list-group-item" onclick="selectVendor('{{ $vendors->vendor_code }}', '{{ $vendors->vendor_name }}')">
                                {{ $vendors->vendor_name }}
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
    <!-- Purchase Modal -->
    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">Choose a Purchase Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($purchase as $purchases)
                        @if (!$purchases->existsInPurchaseMain())
                            <a href="javascript:void(0);" onclick="selectPONo('{{ $purchases->po_no }}', '{{ $purchases->vendor_code }}')" class="row" style="text-decoration: none; color: inherit;">
                                <div class="col-1" style="border-top: 1px solid gray;"></div>
                                <div class="col-5" style="padding: 10px 0px 10px 0px; border-top: 1px solid gray;">
                                    {{ $purchases->po_no }}
                                </div>
                                <div class="col-5" style="padding: 10px 0px 10px 0px; border-top: 1px solid gray;">
                                    {{ $purchases->vendor->vendor_name }}
                                </div>
                                <div class="col-1" style="border-top: 1px solid gray;"></div>
                            </a>
                        @endif
                    @endforeach
                    @if($purchase->isEmpty())
                        <p>No purchase saved.</p>
                    @endif
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

        function generateVendorCode() {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var middleCodeLength = 2;
            var middleVendorCode = '';

            for (var i = 0; i < middleCodeLength; i++) {
                middleVendorCode += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            var vendorCode = 'RA' + middleVendorCode + 'C' + lastVendorCodeNumber;
            lastVendorCodeNumber++;
            return vendorCode;
        }

        window.onload = function() {
            document.getElementById('po_no').value = generateVendorCode();
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var month = monthNames[today.getMonth()];
            var year = today.getFullYear();
            var formattedDate = day + '/' + month + '/' + year;
            document.getElementById('current_date').value = formattedDate;
        };
        function selectVendor(id, name) {
            document.getElementById('vendor_id').value = id;
            document.getElementById('selected_vendor_name').innerText = name;
            $('#vendorModal').modal('hide');
        }
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
        var productData = {}; // Store product information

        function selectProduct(id, name) {
            var productItem = $('#productList .product-item[data-id="' + id + '"]');
            var unit_of_msrment = productItem.data('unit_of_msrment'); 

            $('#product_id').val(id);
            $('#selected_product_name').text(name);
            $('#hiddenProductId').val(id);
            $('#quantityModal').modal('show');
            $('#productModal').modal('hide');
            

            // Store product details
            productData[id] = {
                product_code: id,
                name: name,
                unit_of_msrment: unit_of_msrment,
                image: productItem.find('img').attr('src')
            };
        }
        function addToTable() {
            var productId = $('#hiddenProductId').val();
            var quantity = $('#quantityInput').val();
            
            if (productId && quantity) {
                var product = productData[productId];
                
                if (product) {
                    var row = `<tr data-product-code="${productId}">
                        <td><img src="${product.image}" style="width: 100px;"></td>
                        <td>${product.name}</td>
                        <td>${quantity}</td>
                        <td>${product.unit_of_msrment || 'N/A'}</td>
                        <td class="table_data">
                            <a href="">
                                <img src="img/edit.png" alt="edit" style="width: 50px; height: 50px;">
                            </a>
                        </td>
                        <td class="table_data">
                            <img src="img/delete.png" onclick="removeRow(this)" alt="delete" style="width: 50px; height: 50px;" class="deleteButton">
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
                    image: row.find('td').eq(0).find('img').attr('src'),
                    name: row.find('td').eq(1).text(),
                    quantity: row.find('td').eq(2).text(),
                    uom: row.find('td').eq(3).text()
                };
                products.push(product);
            });
            console.log("Serialized Products Array:", products);
            $('#products').val(JSON.stringify(products));
        }

        function submitProducts() {
            let po_no = document.getElementById('po_no').value;
            let date = document.getElementById('current_date').value;

            fetch('/products/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    po_no: po_no,
                    date: date,
                    products: JSON.parse($('#products').val())
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
        function removeRow(button) {
            $(button).closest('tr').remove();
        }
        function submitForm(action) {
            document.getElementById('action').value = action;
            serializeTableData();
        }

        function clearall() {
            window.location.href = '/purchase';
        }
        function cancelForm() {
            window.location.href = '/dashboard';
        }
        function selectPONo(poNo) {
            document.getElementById('purchase_order').value = poNo;

            const purchaseTable = document.getElementById('purchaseTable');

            purchaseTable.innerHTML = '';

            const purchaseOrderDetails = getPurchaseOrderDetails(poNo);

            purchaseOrderDetails.forEach(item => {
                const row = purchaseTable.insertRow();
                const cell1 = row.insertCell(0);
                const cell2 = row.insertCell(1);
                const cell3 = row.insertCell(2);

                cell1.innerHTML = item.product_code;
                cell2.innerHTML = item.quantity;
                cell3.innerHTML = item.uom;
            });
            $('#purchaseModal').modal('hide');
        }
        let editingRow = null;

        function selectPONo(po_no, vendor_name) {
            fetch(`/purchase/details/${po_no}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);

                    const tableBody = document.querySelector('.purchaseTable');
                    tableBody.innerHTML = '';

                    data.products.forEach((product, index) => {
                        const row = document.createElement('tr');
                        row.setAttribute('data-index', index); 
                        row.innerHTML = `
                            
                            <td><img src="${product.image}" alt="${product.name}" width="50"></td>
                            <td class="productName">${product.name}</td>
                            <td class="productQuantity">${product.quantity}</td>
                            <td>${product.uom}</td>
                            <td class="table_data">
                                <button onclick="editRow(this)" style="border: none; background: none; padding: 0;">
                                    <img src="img/edit.png" alt="edit" style="width: 50px; height: 50px;">
                                </button>
                            </td>
                            <td class="table_data">
                                <img src="img/delete.png" onclick="removeRow(this)" alt="delete" style="width: 50px; height: 50px;" class="deleteButton">
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });

                    document.getElementById('products').value = JSON.stringify(data.products);
                    document.getElementById('po_no').value = po_no;
                })
                .catch(error => {
                    console.error('Error fetching purchase details:', error);
                });

            $('#purchaseModal').modal('hide');
        }

        function editRow(button) {
            event.preventDefault()
            const row = button.closest('tr');
            editingRow = row; 

            const productName = row.querySelector('.productName').innerText;
            const productQuantity = row.querySelector('.productQuantity').innerText;

            document.getElementById('editProductName').value = productName;
            document.getElementById('editProductQuantity').value = productQuantity;

            document.getElementById('editSection').style.display = 'block'; 
        }

        function saveEdit() {
            if (editingRow) {
                const updatedName = document.getElementById('editProductName').value;
                const updatedQuantity = document.getElementById('editProductQuantity').value;

                editingRow.querySelector('.productName').innerText = updatedName;
                editingRow.querySelector('.productQuantity').innerText = updatedQuantity;

                document.getElementById('editSection').style.display = 'none';

                updateProductsData();
            }
        }

        function updateProductsData() {
            const tableRows = document.querySelectorAll('.purchaseTable tr');
            const updatedProducts = [];

            tableRows.forEach(row => {
                const productCode = row.getAttribute('product-code');
                const name = row.querySelector('.productName').innerText;
                const quantity = row.querySelector('.productQuantity').innerText;
                const uom = row.cells[3].innerText; 

                updatedProducts.push({
                    product_code: productCode,
                    name,
                    quantity,
                    uom
                });
            });

            document.getElementById('products').value = JSON.stringify(updatedProducts);
        }
        $('form').on('submit', function() {
            $('input:invalid').each(function() {
                if (!$(this).is(':visible')) {
                    $(this).prop('disabled', true);
                }
            });
        });

        
    document.querySelector('input[name="submit"][value="Order"]').addEventListener('click', function () {
        let po_no = document.getElementById('po_no').value;
        let vendor_code = document.getElementById('vendor_id').value; 
        let date_field = document.getElementById('current_date').value;

        $.ajax({
            url: '/purchase/main/insert', 
            type: 'POST',
            data: {
                po_no: po_no,
                vendor_code: vendor_code,
                date_field: date_field,
                _token: '{{ csrf_token() }}' 
            },
            success: function(response) {
                    if (response.success) {
                        window.open('/purchase/print/' + response.po_no, '_blank');
                    } else {
                        alert('Failed to save purchase order.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); 
                }
        });
    });

    </script>
</body>
</html>
