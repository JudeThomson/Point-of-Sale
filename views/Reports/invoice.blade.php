<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invice Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/vendor.css">
</head>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Invoice Report</p>
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
                <button id="searchBtn" class="btn btn-primary">Search</button>
            </div>
            <div class="col-md-2">
                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Customer Name">
            </div>
            <div class="col-md-2">
                <label for="invoice_no">Invoice No:</label>
                <input type="text" id="invoice_no" name="invoice_no" class="form-control" placeholder="Invoice No">
            </div>
        </div>
        {{-- Table Section --}}
        <div class="row table_sec">
            <div class="col-md-12">
                <table>
                    <thead class="table_head">
                        <tr>
                            <th class="head_data" width="220">
                                Customer Id
                            </th>
                            <th class="head_data" width="500">
                                Customer Name
                            </th>
                            <th class="head_data"width="200">
                                Invoice NO
                            </th>
                            <th class="head_data"width="200">
                                CGST
                            </th>
                            <th class="head_data"width="200">
                                SGST
                            </th>
                            <th class="head_data"width="200">
                                IGST
                            </th>
                            <th class="head_data"width="200">
                                Amount
                            </th>
                            <th class="head_data"width="200">
                                Date
                            </th>                            
                            <th class ="table_data"></th>
                            <th class ="table_data"></th>
                            <th class ="table_data"></th>
                        </tr>
                    </thead>
                    <tbody id="invoiceData">

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
        let invoices = []; 

        async function fetchInvoices() {
            try {
                const response = await fetch('/invoices/data');
                invoices = await response.json();
                renderTable(invoices); 
            } catch (error) {
                console.error("Error fetching invoices:", error);
            }
        }

        document.getElementById('searchBtn').addEventListener('click', function() {
            const fromDate = document.getElementById('from_date').value;
            const toDate = document.getElementById('to_date').value;
            const customerName = document.getElementById('customer_name').value.toLowerCase();
            const invoiceNo = document.getElementById('invoice_no').value;

            const filteredInvoices = invoices.filter(invoice => {
            const dateCondition = (!fromDate || !toDate) || (invoice.bill_date >= fromDate && invoice.bill_date <= toDate);
            const nameCondition = !customerName || invoice.customer.customer_name.toLowerCase().includes(customerName);
            const invoiceNoCondition = !invoiceNo || invoice.invoice_no.includes(invoiceNo);

            return dateCondition && nameCondition && invoiceNoCondition;
        });

        renderTable(filteredInvoices);
        });

        function renderTable(data) {
            const tableBody = document.getElementById('invoiceData');
            tableBody.innerHTML = ''; 

            data.forEach(invoice => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${invoice.customer_id}</td>
                    <td>${invoice.customer ? invoice.customer.customer_name : 'N/A'}</td>
                    <td>${invoice.invoice_no}</td>
                    <td>${invoice.cgst}</td>
                    <td>${invoice.sgst ? invoice.sgst : 'N/A'}</td>
                    <td>${invoice.igst}</td>
                    <td>${invoice.amount}</td>
                    <td>${invoice.bill_date}</td>
                    <td>
                        <a href="/invoice/print/${invoice.invoice_no}">
                            <img src="img/print.png" alt="print" style="width: 50px; height: 50px;">
                        </a>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        fetchInvoices();
    </script></body>
</html>
