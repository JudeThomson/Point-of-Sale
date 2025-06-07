<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Vehicle Expense Report</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="CSS/vendor.css">
    </head>
    <body>
        <!--First Container-->
        <div class="container-fluid navigation">
            <div class="row">
                <div class="col-md-8 logo">
                    <img src="img\logo.png">
                    <p>Vehicle Expense Report</p>
                </div>	
                <div class="col-md-4 hrl">
                    <a href="/dashboard">
                        <img class="logo_home" src="img\home.png"	>
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
        <!--Secound Container-->
        <div class="container seccon">
            <!-- Date Filter Row -->
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="from_date">From:</label>
                    <input type="date" id="from_date" name="from_date" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="to_date">To:</label>
                    <input type="date" id="to_date" name="to_date" class="form-control">
                </div>
                <div class="col-md-2 align-self-end">
                    <button id="searchBtn">
                        <img id="searchBtn" src="img\search.png" width="50" alt="">
                    </button>
                </div>
            </div>
            {{-- Table Section --}}
            <div class="row table_sec">
                <div class="col-md-12">
                    <table>
                        <thead class="table_head">
                            <tr>
                                <th class="head_data" width="350">
                                    Report Date
                                </th>
                                <th class="head_data" width="500">
                                    Vehicle Expense Name
                                </th>
                                <th class="head_data"width="200">
                                    Vehicle Expense No.
                                </th>                         
                                <th class ="table_data"></th>
                                <th class ="table_data"></th>
                                <th class ="table_data"></th>
                            </tr>
                        </thead>
                        <tbody id="PurchaseData">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="vehicleDetailsModal" tabindex="-1" role="dialog" aria-labelledby="vehicleDetailsLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="vehicleDetailsLabel">Vehicle Expense Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Expense Head</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="modalTableBody">
                                    <!-- Dynamic rows will be appended here -->
                                </tbody>
                            </table>
                        </div>
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
            let vehicle_report = []; 

            async function fetchPurchase() {
                try {
                    const response = await fetch('/vehicle/data');
                    vehicle_report = await response.json();
                    renderTable(vehicle_report); 
                } catch (error) {
                    console.error("Error fetching invoices:", error);
                }
            }

            document.getElementById('searchBtn').addEventListener('click', function() {
                const fromDate = document.getElementById('from_date').value;
                const toDate = document.getElementById('to_date').value;

                const filteredPurchase = vehicle_report.filter(report => {
                const dateCondition = (!fromDate || !toDate) || (report.date_field >= fromDate && report.date_field <= toDate);

                return dateCondition;
            });

            renderTable(filteredPurchase);
            });

            function renderTable(data) {
                const tableBody = document.getElementById('PurchaseData');
                tableBody.innerHTML = ''; 

                data.forEach(report => {
                    const row = document.createElement('tr');
                    row.style.cursor = 'pointer';
                    row.innerHTML = `
                    
                        <td>${report.date_field}</td>
                        <td>${report.vehicle_no || 'N/A'}</td>
                        <td>${report.vehicle_expense_no}</td>
                    `;

                    row.addEventListener('click', () => {
                        fetchVehicleDetails(report.vehicle_expense_no);
                    });

                    tableBody.appendChild(row);
                });
            }

            async function fetchVehicleDetails(vehicleExpenseNo) {
                try {
                    const response = await fetch('/vehicle/details', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ vehicle_expense_no: vehicleExpenseNo })
                    });

                    const details = await response.json();
                    displayInModal(details);
                } catch (error) {
                    console.error('Error fetching vehicle details:', error);
                }
            }
            function displayInModal(details) {
                const modalTableBody = document.getElementById('modalTableBody');
                const vehicleDetailsLabel = document.getElementById('vehicleDetailsLabel');
                vehicleDetailsLabel.innerHTML = '';
                modalTableBody.innerHTML = '';

                details.forEach(detail => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${detail.vehicle_expense_no}</td>
                        <td>${detail.amount}</td>
                        <td>${detail.remark}</td>
                    `;
                    modalTableBody.appendChild(row);
                });
                details.forEach(detail => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>Vehicle Expense No.: ${detail.vehicle_expense_no}</td>
                    `;
                    vehicleDetailsLabel.appendChild(row);
                });

                $('#vehicleDetailsModal').modal('show');
            }
            fetchPurchase();
        </script>
    </body>
</html>
