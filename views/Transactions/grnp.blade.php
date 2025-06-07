<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GRNP</title>
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
    <!--Second Container-->
    <div class="container seccon">
        <div class="row patrow">
            <div class="col-12">
                <form  method="POST" action="{{ route('grnp.save') }}">
                    @csrf
                    <input type="hidden" name="po_no" id="po_no" value="">
                    <div class="row">
                        <div class="col-6">
                            <label>GRNP No</label>
                            <input type="text" name="grnp_no" id="grnp_no" class="form-control ins" readonly>
                        </div>
                        <div class="col-6">
                            <label>Date</label>
                            <input type="text" name="current_date" id="current_date" class="form-control ins" readonly>
                        </div>
                    </div>
                    <div class="row com_row" style="margin-top: 14px;">                        
                        <div class="col-4 com_in">
                            <label>Warehouse</label>
                            <select name="warehouse_code" id="warehouse_code" class="form-control ins">
                                <option value="">Select Warehouse</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->warehouse_code }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 com_in">
                            <button type="button" class="btn mode_of_transpoet" data-toggle="modal" data-target="#transportModal">
                                Mode of Transport
                            </button>
                            
                            <input type="hidden" name="transport_mode" id="transport_mode" class="form-control">
                        </div>
                        <div class="col-4 com_in">
                            <a href="#" data-toggle="modal" data-target="#purchaseModal">
                                <img class="logos" src="img/purchase.png" style="width: 14%; margin-left: 6%;">
                                <h6 class="h6_heading" id="">Purchase Order</h6>
                            </a>
                        </div>
                    </div>
                    <div class="row col-6">
                        {{-- DN or Order NO --}}
                    </div>
                    <div class="row col-6">
                        {{-- old grnp search option --}}
                    </div>
                    {{-- <div class="row">
                        <div class="col-6">
                            @if(isset($vendor))
                                <p><strong>Vendor Code:</strong> {{ $vendor->vendor_code }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>Vendor Name:</strong> {{ $vendor->vendor_name }}</p>
                            @endif
                        </div>
                    </div> --}}
                    <div class="row table_sec" style="margin-top: 14px">
                        <div class="col-md-12">
                            <table>
                                <thead class="table_head">
                                    <tr>
                                        <th class="head_data" width="220">
                                            Image
                                        </th>
                                        <th class="head_data" width="500">
                                            Product
                                        </th>
                                        <th class="head_data"width="200">
                                            Qty
                                        </th>
                                        <th class="head_data"width="200">
                                            UMO
                                        </th>
                                        <th class="head_data"width="200">
                                            Batch No.
                                        </th>
                                        <th class="head_data"width="200">
                                            Mfg Date
                                        </th>
                                        <th class="head_data"width="200">
                                            Exp Date
                                        </th>
                                        <th class="head_data"width="200">
                                            Rate{{-- currency from company details in ()--}}
                                        </th>
                                        <th class="head_data"width="200">
                                            Amount{{-- currency from company details in ()--}}
                                        </th>
                                        <th class ="table_data"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product )                                    
                                    <tr>
                                        <td><img src="{{ $product->photo }}" width="100" /></td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->unit_of_msrment }}</td>  
                                        <td>{{ $product->batch_code }}</td>
                                        <td>{{ $product->mfg_date }}</td>  
                                        <td>{{ $product->expiry_date }}</td>  
                                        <td class="purchase_rate">{{ $product->purchase_rate }}</td>  
                                        <td class="amount"></td>  
                                        <td class="table_data">
                                            <button type="button" class="edit-btn" style="border: none; background-color: white;" data-toggle="modal" data-target="#editModal" data-product="{{ json_encode($product) }}">
                                                <img width="50" src="img/edit.png" alt="">
                                            </button>
                                            <button class="delete-btn" style="border: none; background-color: white;">
                                                <img width="50" src="img/delete.png" alt="">
                                            </button>
                                        </td> 
                                    </tr>  
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>        
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6" style="margin-top: 10%">
                            <label class="grnp_total">GRNP Total:</label>
                            <input class="ins grnp_ins" type="text" name="grnp_total" id="grnp_total" readonly> <br>
                            
                            <label class="grnp_paid_amt">Paid Amount:</label>
                            <input class="ins grnp_ins" type="text" name="paid_amount" id="paid_amount"> <br>
                    
                            <label for="">Balance to be paid to vendor:</label>
                            <input class="ins grnp_ins" type="text" id="balance_amount" readonly>
                        </div>
                    </div>    
                    <div class="row btns">
                        <div class="col-md-4 three_btns">
                            <div class="savee">
                                <input type="submit" name="submit" value="Save" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-4 three_btns">
                            <div class="savee">
                                <input type="reset" name="reset" value="Clear All" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-4 three_btns">
                            <button type="button" class="btn2" onclick="cancelForm()">Cancel</button>
                        </div>
                    </div>
                    {{-- Model for edit --}}
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="po_no" id="po_no" value="{{ $po_no }}">
                                    <input type="hidden" name="product_code" id="product_code" value="{{ optional($product)->product_code }}">
                                    <div class="form-group">
                                        <label for="quantity">Qty</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" />
                                    </div>
                                    <div class="form-group">
                                        <label for="rate">Rate</label>
                                        <input type="number" class="form-control" id="purchase_rate" name="purchase_rate" />
                                    </div>
                                    <div class="form-group">
                                        <label for="batch_code">Batch No.</label>
                                        <input type="text" class="form-control" id="batch_code" name="batch_code" />
                                    </div>
                                    <div class="form-group">
                                        <label for="mfg_date">Mfg Date</label>
                                        <input type="date" class="form-control" id="mfg_date" name="mfg_date" />
                                    </div>
                                    <div class="form-group">
                                        <label for="expiry_date">Exp Date</label>
                                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id="saveChangesBtn">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>   
    {{-- Models --}}
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
                        <form id="poForm" action="{{ route('show.purchase.products') }}" method="GET">
                            @foreach($purchase as $purchases)                            
                                <button type="button" onclick="setPONo('{{ $purchases->po_no }}')" name="po_no" value="{{ $purchases->po_no }}" class="btn btn-link" style="text-decoration: none; color: inherit;">
                                    <div class="row">
                                        <div class="col-1" style="border-top: 1px solid gray;"></div>
                                        <div class="col-5" style="padding: 10px 0px 10px 0px; border-top: 1px solid gray;">
                                            {{ $purchases->po_no }}
                                        </div>
                                        <div class="col-5" style="padding: 10px 0px 10px 0px; border-top: 1px solid gray;">
                                            {{ $purchases->vendor ? $purchases->vendor->vendor_name : 'No Vendor' }}
                                        </div>
                                        <div class="col-1" style="border-top: 1px solid gray;"></div>
                                    </div>
                                </button>
                            @endforeach
                            @if($purchase->isEmpty())
                                <p>No purchase saved.</p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Mode of Transport Model --}}
        <div class="modal fade" id="transportModal" tabindex="-1" role="dialog" aria-labelledby="transportModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transportModalLabel">Select Mode of Transport</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item transport-option" data-transport="None">None</li>
                            <li class="list-group-item transport-option" data-transport="Air">Air</li>
                            <li class="list-group-item transport-option" data-transport="Sea">Ocean Vessel</li>
                            <li class="list-group-item transport-option" data-transport="Land">Road</li>
                            <li class="list-group-item transport-option" data-transport="Courier">Courier</li>
                            <li class="list-group-item transport-option" data-transport="mail">mail</li>
                            <li class="list-group-item transport-option" data-transport="Hand ">Hand Delivery</li>
                        </ul>
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
            document.getElementById('grnp_no').value = generateVendorCode();
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var month = monthNames[today.getMonth()];
            var year = today.getFullYear();
            var formattedDate = day + '/' + month + '/' + year;
            document.getElementById('current_date').value = formattedDate;
            calculateTotalAmount();
        };
    
        function cancelForm() {
            window.location.href = '/dashboard';
        }
    
        $(document).ready(function(){
            $('.transport-option').on('click', function() {
                var selectedTransport = $(this).data('transport');
    
                $('#transport_mode').val(selectedTransport);
    
                $('.mode_of_transpoet').text('Transport: ' + selectedTransport);
    
                $('#transportModal').modal('hide');
            });
        });
    
        let timeout;
        const debounceDelay = 300; 
    
        function calculateTotalAmount() {
            $('tbody tr').each(function() {
                var quantity = parseFloat($(this).find('td').eq(2).text()); // 3rd cell for quantity
                var purchaseRate = parseFloat($(this).find('td').eq(7).text()); // 8th cell for purchase rate
    
                if (!isNaN(quantity) && !isNaN(purchaseRate)) {
                    var totalAmount = quantity * purchaseRate;
    
                    $(this).find('td').eq(8).text(totalAmount.toFixed(2)); // 9th cell for amount
                } else {
                    $(this).find('td').eq(8).text('0.00'); // 9th cell for amount if invalid data
                }
            });
    
            // Update GRNP Total (Sum of all row amounts)
            let grandTotal = 0;
            $('tbody tr').each(function() {
                var amount = parseFloat($(this).find('td').eq(8).text()); // Sum the amount column (9th cell)
                if (!isNaN(amount)) {
                    grandTotal += amount;
                }
            });
            $('#grnp_total').val(grandTotal.toFixed(2));
        }
    
        $('#saveChangesBtn').on('click', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                const productId = $('#product_code').val();
                const quantity = $('#quantity').val();
                const purchaseRate = $('#purchase_rate').val(); 
                const batchNo = $('#batch_code').val();
                const mfgDate = $('#mfg_date').val();
                const expDate = $('#expiry_date').val();
    
                // AJAX request
                $.ajax({
                    url: '/grnp/store',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_code: productId,
                        quantity: quantity,
                        purchase_rate: purchaseRate,
                        batch_code: batchNo,
                        mfg_date: mfgDate,
                        expiry_date: expDate,
                        grnp_no: $('#grnp_no').val()
                    },
                    success: function(response) {
                        // Update total for the current product row after editing
                        calculateTotalAmount();
                        $('#editModal').modal('hide');
                    },
                    error: function(xhr) {
                        let errorMessage = 'Failed to save the product. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message; 
                        }
                        alert(errorMessage);
                    }
                });
            }, debounceDelay);
        });
    
        $('#paid_amount').on('input', function() {
            var grnpTotal = parseFloat($('#grnp_total').val()) || 0;
            var paidAmount = parseFloat($('#paid_amount').val()) || 0;
            var balance = grnpTotal - paidAmount;
    
            // Make sure balance is not negative
            if (balance < 0) {
                balance = 0;
            }
    
            $('#balance_amount').val(balance.toFixed(2));
        });
        function setPONo(poNo) {
            document.getElementById('po_no').value = poNo;
            
            $('#purchaseModal').modal('hide');
            
            // If you need to redirect to the URL with the selected po_no (example: http://127.0.0.1:8000/grnpproducts?po_no=RAWFC0), you can uncomment the following:
            window.location.href = "/grnpproducts?po_no=" + poNo;
        }
    </script>
    </body>
</html>
