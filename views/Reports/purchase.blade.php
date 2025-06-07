<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/vendor.css">
</head>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Purchase Report</p>
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
                    <img src="img\search.png" width="50" alt="">
                </button>
            </div>
        </div>
        {{-- Table Section --}}
        <div class="row table_sec">
            <div class="col-md-12">
                <table>
                    <thead class="table_head">
                        <tr>
                            <th class="head_data" width="220">
                                PO No.
                            </th>
                            <th class="head_data" width="500">
                                Vendor Code
                            </th>
                            <th class="head_data"width="200">
                                Vendor Name
                            </th>
                            <th class="head_data"width="200">
                                Date
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
    </div>
    

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
        let purchases = []; 

        async function fetchPurchase() {
            try {
                const response = await fetch('/purchase/data');
                purchases = await response.json();
                renderTable(purchases); 
            } catch (error) {
                console.error("Error fetching invoices:", error);
            }
        }

        document.getElementById('searchBtn').addEventListener('click', function() {
            const fromDate = document.getElementById('from_date').value;
            const toDate = document.getElementById('to_date').value;

            const filteredPurchase = purchases.filter(purchase => {
            const dateCondition = (!fromDate || !toDate) || (purchase.date_field >= fromDate && purchase.date_field <= toDate);

            return dateCondition;
        });

        renderTable(filteredPurchase);
        });

        function renderTable(data) {
            const tableBody = document.getElementById('PurchaseData');
            tableBody.innerHTML = ''; 

            data.forEach(purchase => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${purchase.po_no}</td>
                    <td>${purchase.vendor_code}</td>
                    <td>${purchase.vendor ? purchase.vendor.vendor_name : 'N/A'}</td>
                    <td>${purchase.date_field}</td>
                    <td>
                    <a href="/purchase/print/${purchase.po_no}">
                        <img src="img/print.png" alt="print" style="width: 50px; height: 50px;">
                    </a>
                </td>
                `;
                tableBody.appendChild(row);
            });
        }

        fetchPurchase();
    </script></body>
</html>
