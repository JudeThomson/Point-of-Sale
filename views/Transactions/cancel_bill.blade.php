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
                <form method="POST" action="{{ route('cancel.invoice') }}">             
                    @csrf
                    <input type="hidden" name="customer_id_display" id="customer_id_display" value="">
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
                    <div id="customerResults"></div>
                    <div class="row">
                        <div class="col-12">
                            <label for="cancel_invoive">Bill/Invoice No.: </label>
                            <input type="text" name="invoice_no" id="invoice_no" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="remarks">Remarks:</label>
                            <div class="form-check">
                                <input type="radio" name="remarks" id="remark1" value="No cash" class="form-check-input">
                                <label for="remark1" class="form-check-label">No cash</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="remarks" id="remark2" value="No stock available" class="form-check-input">
                                <label for="remark2" class="form-check-label">no stock available</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="remarks" id="remark3" value="Owner not interested" class="form-check-input">
                                <label for="remark3" class="form-check-label">Owner not interested</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="remarks" id="remark4" value="Will Buy Next Week" class="form-check-input">
                                <label for="remark4" class="form-check-label">Will Buy Next Week</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="remarks" id="customer_remark" value="Customer Input" class="form-check-input">
                                <input type="text" name="customer_remark_text" id="customer_remark_input" class="form-control remark-input" placeholder="Others" style="display: inline-block; width: auto; margin-left: 10px;">
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="selected_customer_id" name="customer_id" value="">
                    <div class="row btns">
                        <input type="hidden" name="action" id="action" value="">
                        <div class="col-md-6 three_btns">
                            <div class="savee">
                                <input type="submit" name="submit" value="Cancel Bill/Invoice" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-6s three_btns">
                            <button type="button" class="btn2" onclick="cancelForm()">Cancel</button>
                        </div>  
                    </div>                  
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script>
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
                    url: '{{ route('invoice_main.search') }}',
                    type: 'GET',
                    data: { query: query },
                    success: function(response) {
                        var resultHtml = '';
                        if (response.length > 0) {
                            response.forEach(function(invoice) {
                                resultHtml += `
                                    <div class="customer-item" data-id="${invoice.customer_id}" data-name="${invoice.customer_name}" data-mobile="${invoice.mobile}" data-invoice="${invoice.invoice_no}">
                                        <p>ID: ${invoice.customer_id} | Name: ${invoice.customer_name} | Mobile: ${invoice.mobile} | Invoice No: ${invoice.invoice_no}</p>
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
                var selectedInvoiceNo = $(this).closest('.customer-item').data('invoice');

                $('#inputid_1').val(selectedCustomerId);
                $('#inputid_2').val(selectedCustomerName);
                $('#inputid_3').val(selectedCustomerMobile);
                $('#selected_customer_id').val(selectedCustomerId);
                $('#invoice_no').val(selectedInvoiceNo); 
                $('#customerResults').html('');
            });
        });
        document.getElementById('customer_remark_input').addEventListener('input', function() {
            var customerRemarkInputValue = this.value; 
            var customerRemarkRadio = document.getElementById('customer_remark'); 

            customerRemarkRadio.value = customerRemarkInputValue || 'Customer Input'; 
        });
    </script>
</body>
</html>
