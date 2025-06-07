<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vehicle Expense</title>
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
                <p>Vehicle Expense</p>
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
                <form method="POST" action="{{ Route('vehicle.store') }}">                    
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label>Vehicle Expense No. :</label>
                            <input type="text" name="expense_no" id="expense_no" class="form-control ins" readonly>
                        </div>
                        <div class="col-6">
                            <label>Date</label>
                            <input type="text" name="current_date" id="current_date" class="form-control ins" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 16px">
                            <input type="text" name="vehicle_no" id="vehicle_no" class="form-control pat inputs" placeholder="Vehicle Name">                            
                            <button type="button" id="expense_name" class="mode_of_transpoet" data-toggle="modal" data-target="#expenseHeadModal">
                                Expense Head
                            </button>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 16px">
                        <input type="text" name="patid" id="input_amount" class="form-control pat inputs" placeholder="Amount">  
                        <input type="text" name="patid" id="input_remarks" class="form-control pat inputs" placeholder="Remarks">
                        <a href="#" id="addExpenseBtn">
                            <img style="width: 65%" src="img/add.png" alt="add">
                        </a>
                    </div>
                    <div class="row table_sec" style="margin-top: 14px">
                        <div class="col-md-12">
                            <table>
                                <thead class="table_head">
                                    <tr>
                                        <th class="head_data" width="500">Expense Head</th>
                                        <th class="head_data" width="300">Amount</th>
                                        <th class="head_data" width="300">Remarks</th>
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
                    <div class="row btns">
                        <input type="hidden" name="action" id="action" value="">
                        <div class="col-md-4 three_btns">
                            <div class="savee">
                                <input type="submit" name="submit" value="Save" class="btn1" id="submitProductsButton">
                            </div>
                        </div>
                        <div class="col-md-4 three_btns">
                            <div class="savee">
                                <input type="button" name="button" onclick="clearall()" value="Clear All" class="btn1">
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
    {{-- Expense Model --}}
    <div class="modal fade" id="expenseHeadModal" tabindex="-1" aria-labelledby="expenseHeadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="expenseHeadModalLabel">Select Expense Head</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Expense Code</th>
                                <th>Expense Name</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody id="expenseHeadTableBody">
                        </tbody>
                    </table>
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
            document.getElementById('expense_no').value = generateOrderNO();
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var month = monthNames[today.getMonth()];
            var year = today.getFullYear();
            var formattedDate = day + '/' + month + '/' + year;
            document.getElementById('current_date').value = formattedDate;
        };
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
            $('#expenseHeadModal').on('show.bs.modal', function() {
                $.ajax({
                    url: '/getVehicleExpenses', 
                    type: 'GET',
                    success: function(data) {
                        var tableBody = $('#expenseHeadTableBody');
                        tableBody.empty(); 
                        
                        data.forEach(function(expense) {
                            var row = `
                                <tr>
                                    <td>${expense.vehicle_expense_code}</td>
                                    <td>${expense.vehicle_expense_name}</td>
                                    <td>
                                        <button type="button" class="mode_of_transpoet select-expense" 
                                            data-expense-code="${expense.vehicle_expense_code}" 
                                            data-expense-name="${expense.vehicle_expense_name}">
                                            Select
                                        </button>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });

                        $('.select-expense').on('click', function() {
                            var expenseCode = $(this).data('expense-code');
                            var expenseName = $(this).data('expense-name');
                            
                            $('#expense_name').val(expenseCode); 
                            $('#expense_name').text(expenseName); 
                            $('#expenseHeadModal').modal('hide');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching expense heads:', error);
                    }
                });

            });
        });
        let editRowIndex = -1; 

        function addOrUpdateRow() {
            const expenseHead = $('#expense_name').val();
            const amount = $('#input_amount').val();
            const remarks = $('#input_remarks').val();
    
            if (!expenseHead || !amount || !remarks) {
                alert("Please fill all fields.");
                return;
            }
    
            if (editRowIndex === -1) {
                const newRow = `<tr>
                    <td class="table_data expense_head">${expenseHead}</td>
                    <td class="table_data amount">${amount}</td>
                    <td class="table_data remarks">${remarks}</td>
                    <td class="table_data">
                        <a href="#" onclick="editRow(this)" class="edit-icon">
                            <img src="img/edit.png" alt="edit" style="width: 50px; height: 50px;">
                        </a>
                    </td>
                    <td class="table_data">
                        <a href="#" onclick="removeRow(this)" class="delete-icon">
                            <img src="img/delete.png" alt="delete" style="width: 50px; height: 50px;">
                        </a>
                    </td>
                </tr>`;
                $('table tbody').append(newRow);
            } else {
                const row = $('table tbody tr').eq(editRowIndex);
                row.find('td').eq(0).text(expenseHead);
                row.find('td').eq(1).text(amount);
                row.find('td').eq(2).text(remarks);
    
                editRowIndex = -1;
            }
    
            $('#expense_name').text("Expense Head");
            $('#input_amount').val('');
            $('#input_remarks').val('');
            serializeTableData();
        }
    
        function editRow(button) {
            const row = $(button).closest('tr');
            editRowIndex = row.index();
    
            $('#expense_name').text(row.find('td').eq(0).text());
            $('#input_amount').val(row.find('td').eq(1).text());
            $('#input_remarks').val(row.find('td').eq(2).text());
        }
    
        function removeRow(button) {
            $(button).closest('tr').remove();
            if (editRowIndex >= 0) editRowIndex = -1; 
        }
    
        $(document).on("click", "img[alt='add']", function(e) {
            e.preventDefault();
            addOrUpdateRow();
        });
        function serializeTableData() {
            var products = [];
            document.querySelectorAll('.purchaseTable tr').forEach(row => {
                var product = {
                    vehicle_expense_code: row.querySelector('.expense_head').textContent.trim(),
                    amount: parseFloat(row.querySelector('.amount').textContent.trim()) || 0,
                    remarks: row.querySelector('.remarks').textContent.trim(),
                };
                products.push(product);
            });

            console.log("Serialized Products Array:", products);
            document.getElementById('products').value = JSON.stringify(products);
        }
    </script>
    
</body>
</html>
