<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill/Invoice</title>
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
                <p>Bill/Invoice</p>
                <i class="fas fa-file-invoice"></i>
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
                <form method="POST" action="{{ Route('bill.save') }}">             
                    @csrf
                    <input type="hidden" name="customer_id_display" id="customer_id_display" value="">
                    <div class="row">
                        <div class="col-6">
                            <label>Bill No</label>
                            <input type="text" name="bill_no" id="bill_no" class="form-control ins" readonly>
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
                        <div class="col-1">
                            <a href="#" data-toggle="modal" data-target="#orderModal">
                                <img class="logos" src="img/order.png" style="width: 80%;">
                                <h6 class="h6_heading">Order</h6>                                
                            </a>
                        </div>
                    </div>
                    <input type="hidden" id="selected_customer_id" name="customer_id" value="">
                    <div id="customerResults"></div>
                    <div class="row table_sec" style="margin-top: 14px">
                        <div class="col-md-12">
                            <table>
                                <thead class="table_head">
                                    <tr>
                                        <th class="head_data"width='300'>HSN</th>
                                        <th class="head_data" width="300">Product</th>
                                        <th class="head_data" width="300">Rate</th>
                                        <th class="head_data" width="300">CGST</th>
                                        <th class="head_data" width="300">IGST</th>
                                        <th class="head_data" width="300">Discount</th>
                                        <th class="head_data" width="300">Free</th>
                                        <th class="head_data" width="300">Amount</th>
                                        <th class="head_data" width="300">Batch NO.</th>
                                        <th class="table_data"></th>
                                        <th class="table_data"></th>
                                        <th class="table_data"></th>
                                    </tr>
                                </thead>
                                <tbody class="purchaseTable">

                                </tbody>
                            </table>
                            <input type="hidden" name="products" id="products" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 bill_cal">
                            <div class="to_amt">
                                <label for="totalAmount">Total Amount:</label>
                                <input class="ins" name="totalAmount" type="text" id="totalAmount" readonly />
                            </div>
                            <div class="discount">
                                <label>
                                    Bill Discount
                                    <input class="" type="radio" name="discountType" value="percentage" checked>
                                   %
                                </label>
                                <label>
                                    <input class="ins" type="radio" name="discountType" value="amount">
                                    ₹
                                </label>
                                <input class="ins" type="number" id="discountValue" placeholder="Enter discount value">
                            </div> 
                            <div class="sub_total">
                                <p>Sub Total: <span id="finalAmount">0.00</span></p>
                                <input class="ins" type="hidden" name="finalAmount" id="sub" value="finalAmount">
                            </div>
                            <div class="amt_to_received">
                                <label>Total Amount to be received:</label>
                                <input class="ins" type="text" id="roundedAmount" readonly />
                            </div>
                            <div class="paid_amount">
                                <label for="paidAmount">Paid Amount:</label>
                                <input  class="ins" name="paidAmount" type="number" id="paidAmount" placeholder="Enter paid amount" />
                            </div>
                            <div class="remaining_balance">
                                <label for="remainingBalance">Remaining Balance:</label>
                                <input  class="ins" name="remainingBalance" type="text" id="remainingBalance" readonly />
                            </div>
                            <div class="taxable_value">
                                <label for="totalAmount">Taxable Value:</label>
                                <input class="ins" name="totalAmount_one" type="text" id="totalAmount_one" readonly />
                            </div>
                            <div class="tax">
                                <label for="cgstAmountInput">CGST:</label>
                                <input class="ins" type="text" name="cgstAmountInput" id="cgstAmountInput" placeholder="CGST Amount" readonly />
                            </div>
                            <div class="tax_igst">
                                <label for="igstAmountInput">IGST:</label>
                                <input class="ins" type="text" name="igstAmountInput" id="igstAmountInput" placeholder="IGST Amount" readonly />
                            </div>
                            <div class="discount_amt">
                                <label for="discountAmountInput">Discount: </label>
                                <input class="ins" type="text" id="discountAmountInput" placeholder="Discount Amount" readonly />
                            </div>
                            <div class="rounded_amt">
                                <label for="roundedAmount_one">Total:</label>
                                <input class="ins" type="text" id="roundedAmount_one" readonly />
                            </div>
                        </div>
                    </div>         
                    <div class="row btns in_bill">
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
    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="CategoryModel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CategoryModel">Select Category</h5>
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
    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Select Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($orders as $order)
                        <div class="row" onclick="fetchOrderDetails('{{ $order->order_no }}')" style="cursor: pointer;">
                            <div class="col-6" style="padding: 10px 0px 10px 0px; border-top: 1px solid gray; margin-left: 10px;">
                                {{ $order->order_no }}
                            </div>
                            <div class="col-5" style="padding: 10px 0px 10px 0px; border-top: 1px solid gray;">
                                {{ $order->customer ? $order->customer->customer_name : 'Jude' }}
                            </div>
                        </div>
                    @endforeach                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if(session('openPrintWindow'))
    <script>
        window.open('{{ route("invoice.print", ["invoice_no" => $invoiceMain->invoice_no]) }}', '_blank');
    </script>
    @endif

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
            var BillNo = 'RA' + middleVendorCode + 'C' + lastVendorCodeNumber;
            lastVendorCodeNumber++;
            return BillNo;
        }

        window.onload = function() {
            document.getElementById('bill_no').value = generateOrderNO();
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
            $('#productModal').modal('hide');
            
            productData[id] = {
                product_code: id,
                name: name,
            };
        }
        function fetchOrderDetails(orderNo) {
        $('#orderModal').modal('hide');
        
        fetch(`/getOrderDetails/${orderNo}`)

            .then(response => response.json())
            .then(data => {
                document.querySelector('#customer_id_display').value = data[0].customer_id;
                const tableBody = document.querySelector('.purchaseTable');
                tableBody.innerHTML = '';

                let totalAmount = 0; 
                let totalCgst = 0; 
                let totalIgst = 0
                
                data.forEach(item => {
                    const rate = item.selling_rate;
                    const quantity = item.quantity;

                    const baseAmount = rate * quantity;

                    const cgstAmount = (baseAmount * item.cgst) / 100; 
                    const igstAmount = (baseAmount * item.igst) / 100; 

                    const totalItemAmount = baseAmount + cgstAmount + igstAmount;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="hsn-code">${item.hsn_code}</td>
                        <td class="product-name">${item.product_name}</td>
                        <td class="selling-rate">${rate}</td>
                        <td class="cgst">${item.cgst}</td>
                        <td class="igst">${item.igst}</td>
                        <td class="discount">${item.discount || 'N/A'}</td>
                        <td class="free">${item.free || 'N/A'}</td>
                        <td class="total-item-amount">${totalItemAmount.toFixed(2)}</td>
                        <td class="batch-code">${item.batch_code || 'N/A'}</td>
                    `;
                    tableBody.appendChild(row);

                    totalAmount += totalItemAmount;
                    totalCgst += cgstAmount;
                    totalIgst += igstAmount;
                });
                
                document.getElementById('totalAmount').value = totalAmount.toFixed(2);
                document.getElementById('totalAmount_one').value = totalAmount.toFixed(2);

                const cgstAmountInput = document.getElementById('cgstAmountInput');
                const igstAmountInput = document.getElementById('igstAmountInput');
                cgstAmountInput.value = totalCgst.toFixed(2);
                igstAmountInput.value = totalIgst.toFixed(2);
                serializeTableData();
            })
            .catch(error => console.error('Error fetching order details:', error));
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


        function calculateTotalAmount(amounts) {
            const totalAmount = document.getElementById('totalAmount').value;
            const discountType = document.querySelector('input[name="discountType"]:checked').value;
            const discountValue = parseFloat(document.getElementById('discountValue').value) || 0;
    
            let finalAmount = totalAmount;
            if (discountType === 'percentage') {
                finalAmount -= (finalAmount * (discountValue / 100));
            } else {
                finalAmount -= discountValue;
            }

            document.getElementById('finalAmount').innerText = finalAmount.toFixed(2);

            const roundedAmount = Math.round(finalAmount);
            document.getElementById('roundedAmount').value = roundedAmount;
            document.getElementById('roundedAmount_one').value = roundedAmount;
            updateRemainingBalance(roundedAmount);
        }

        function updateRemainingBalance(roundedAmount) {
            const paidAmount = parseFloat(document.getElementById('paidAmount').value) || 0;
            const remainingBalance = roundedAmount - paidAmount;
            document.getElementById('remainingBalance').value = remainingBalance >= 0 ? remainingBalance.toFixed(2) : '0.00'; // Ensure it doesn't show negative values
            document.getElementById('remainingBalance_one').value = remainingBalance >= 0 ? remainingBalance.toFixed(2) : '0.00'; // Ensure it doesn't show negative values

        }
        document.querySelectorAll('input[name="discountType"]').forEach((elem) => {
            elem.addEventListener('change', function() {
                const discountValueInput = document.getElementById('discountValue');
                discountValueInput.placeholder = this.value === 'percentage' ? 'Enter percentage' : 'Enter amount';
                calculateTotalAmount(amounts); 
            });
        });

        document.getElementById('discountValue').addEventListener('input', function() {
            calculateTotalAmount(amounts); 
        });
        document.getElementById('paidAmount').addEventListener('input', function() {
            const roundedAmount = Math.round(parseFloat(document.getElementById('finalAmount').innerText));
            updateRemainingBalance(roundedAmount); 
        });
        let amounts = []; 
        
        function serializeTableData() {
            var products = [];
            document.querySelectorAll('.purchaseTable tr').forEach(row => {
                var product = {
                    hsn_code: row.querySelector('.hsn-code').textContent.trim(),
                    product_name: row.querySelector('.product-name').textContent.trim(),
                    selling_rate: parseFloat(row.querySelector('.selling-rate').textContent.trim()) || 0,
                    cgst: parseFloat(row.querySelector('.cgst').textContent.trim()) || 0,
                    igst: parseFloat(row.querySelector('.igst').textContent.trim()) || 0,
                    discount: parseFloat(row.querySelector('.discount').textContent.trim()) || 0,
                    free: row.querySelector('.free').textContent.trim(),
                    total_item_amount: parseFloat(row.querySelector('.total-item-amount').textContent.trim()) || 0,
                    batch_code: row.querySelector('.batch-code').textContent.trim() || 'N/A',
                };
                products.push(product);
            });

            console.log("Serialized Products Array:", products);
            document.getElementById('products').value = JSON.stringify(products);
        }

    </script>
</body>
</html>
