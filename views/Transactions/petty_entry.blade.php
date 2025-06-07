<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raj Retail POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <p>Petty Entry</p>
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
                <form  method="POST" action="{{ route('petty_entry.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label>Petty No</label>
                            <input type="text" name="petty_code" id="petty_code" class="form-control ins" readonly>
                        </div>
                        <div class="col-6">
                            <label>Date</label>
                            <input type="text" name="current_date" id="current_date" class="form-control ins" readonly>
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-9 com_in">
                            <input type="radio" name="category" value="Income" required> Income
                            <input type="radio" name="category" value="Expense" required> Expense
                            <input type="hidden" name="category_type" id="category_type">
                        </div>
                    </div>
                    <div class="row com_row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#headModal" id="headButton">Head</button>
                        </div>
                        <div class="col-6" style="display: grid">
                            <label>Previous Balance : </label>
                            <label>Current Balance :</label>
                        </div>
                    </div>
                    <div class="row com_row">                        
                        <div class="col-4 com_in">
                            <label>Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control ins">
                        </div>
                        <div class="col-4 com_in">
                            <label>Remarks</label>
                            <input type="text" name="remarks" id="remarks" class="form-control ins">
                            <img class="logo_search" src="img/add.png" id="addButton">
                        </div>
                        <div class="col-4 com_in">
                        </div>
                    </div>
                    <div class="row table_sec" style="margin-top: 14px">
                        <div class="col-md-12">
                            <table>
                                <thead class="table_head">
                                    <tr>
                                        <th class="head_data" width="220">
                                            Head
                                        </th>
                                        <th class="head_data" width="500">
                                            Amount
                                        </th>
                                        <th class="head_data"width="200">
                                            Remarks
                                        </th>
                                        <th class="head_data"width="200">
                                            Transactions
                                        </th>
                                        <th class ="table_data"></th>
                                        <th class ="table_data"></th>
                                        <th class ="table_data"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class ="table_data">
            
                                        </td>
                                        <td class ="table_data">
            
                                        </td>
                                        <td class ="table_data">
            
                                        </td>
                                        <td class ="table_data">
            
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
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
                                <input type="submit" name="submit" value="Clear All" class="btn1">
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
    <!-- Modal Structure -->
    <div class="modal fade" id="headModal" tabindex="-1" role="dialog" aria-labelledby="headModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="headModalLabel">Selected Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="selectedCategories"></ul>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body confirm">
                    Are you sure you want to delete this Petty Account?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn2" id="confirmDeleteBtn">Delete</button>
                    <button type="button" class="btn btn1" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script>
        var lastVendorCodeNumber = 0;
        function generateVendorCode() {
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var middleCodeLength = 2;
            var middleVendorCode = '';

            // Generate the middle part of the vendor code
            for (var i = 0; i < middleCodeLength; i++) {
                middleVendorCode += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            var vendorCode = 'RA' + middleVendorCode + 'C' + lastVendorCodeNumber;

            lastVendorCodeNumber++;

            return vendorCode;
        }

        window.onload = function() {
            document.getElementById('petty_code').value = generateVendorCode();
            var today = new Date();
            var day = today.getDate().toString().padStart(2, '0');
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var month = monthNames[today.getMonth()];
            var year = today.getFullYear();
            var formattedDate = day + '/' + month + '/' + year;
            document.getElementById('current_date').value = formattedDate;
        };

        document.addEventListener('DOMContentLoaded', function() {
            var pettyAccounts = @json($petty);
            var selectedCategories = document.getElementById('selectedCategories');
            var selectedCategoryHeading = document.getElementById('headModalLabel');
            var selectedAccount = null;

            function filterAccounts(category) {
                selectedCategories.innerHTML = '';
                pettyAccounts.forEach(function(account) {
                    if (account.category === category) {
                        var li = document.createElement('li');
                        li.textContent = account.petty_account_name;
                        li.classList.add('list-group-item');
                        li.addEventListener('click', function() {
                            if (selectedAccount) {
                                selectedAccount.classList.remove('selected');
                            }
                            selectedAccount = li;
                            li.classList.add('selected');
                            if (category === 'Expense') {
                                document.getElementById('category_type').value = account.petty_account_name;
                            }
                        });
                        selectedCategories.appendChild(li);
                    }
                });
            }

            document.querySelectorAll('input[name="category"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var selectedCategory = this.value;
                    selectedCategoryHeading.textContent = selectedCategory === 'Income' ? 'Choose the Income Head' : 'Choose the Expense Head';
                    document.getElementById('category_type').value = selectedCategory;
                    filterAccounts(selectedCategory);
                });
            });

            document.getElementById('headButton').addEventListener('click', function() {
                var selectedCategory = document.querySelector('input[name="category"]:checked').value;
                selectedCategoryHeading.textContent = selectedCategory === 'Income' ? 'Choose the Income Head' : 'Choose the Expense Head';
                filterAccounts(selectedCategory);
            });
            
            // Add button click event to add form data to the table
            document.getElementById('addButton').addEventListener('click', function() {
                // Collect form data
                var pettyAccountCode = document.getElementById('petty_code').value;
                var currentDate = document.getElementById('current_date').value;
                var category = document.querySelector('input[name="category"]:checked').value;
                var categoryType = document.getElementById('category_type').value;
                var amount = document.getElementById('amount').value;
                var remarks = document.getElementById('remarks').value;

                // Create a new row and append it to the table
                var table = document.querySelector('table tbody');
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="table_data">${categoryType}</td>
                    <td class="table_data">${amount}</td>
                    <td class="table_data">${remarks}</td>
                    <td class="table_data">${currentDate}</td>
                    <td class="table_data">
                        <a href="#">
                            <img src="img/edit.png" alt="edit" style="width: 50px; height: 50px;">
                        </a>
                    </td>
                    <td class="table_data">
                        <img src="img/delete.png" alt="delete" style="width: 50px; height: 50px;" class="deleteButton">
                    </td>
                `;
                table.appendChild(newRow);

                // Optionally, clear the form inputs after adding the data
                document.getElementById('amount').value = '';
                document.getElementById('remarks').value = '';
                // Reset the selected category
                if (selectedAccount) {
                    selectedAccount.classList.remove('selected');
                }
                selectedAccount = null;
                document.querySelector('input[name="category"]:checked').checked = false;
                document.getElementById('category_type').value = '';
            });
        });
        function cancelForm() {
            window.location.href = '/dashboard';
        }
    </script>
</body>
</html>
