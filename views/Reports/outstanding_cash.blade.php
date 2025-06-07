<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Outstanding Cash Report</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="CSS/vendor.css">
    </head>
    <body>
        <!--First Container-->
        <div class="container-fluid navigation">
            <div class="row">
                <div class="col-md-8 logo">
                    <img src="img\logo.png">
                    <p>Outstanding Cash Report</p>
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
                                <th class="head_data"width="300">
                                    Outstanding Cash
                                </th>                       
                                <th class ="table_data"></th>
                                <th class ="table_data"></th>
                                <th class ="table_data"></th>
                            </tr>
                        </thead>
                        <tbody id="PurchaseData">

                        </tbody>
                    </table>
                    <div id="balanceModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; border:1px solid #ccc;">
                        <h3>Collect Balance Amount</h3>
                        <form id="collectBalanceForm" onsubmit="event.preventDefault(); submitBalance();">
                            <label>Customer ID:</label>
                            <input type="text" id="modalCustomerId" readonly><br>
                            <label>Outstanding Balance:</label>
                            <input type="text" id="modalBalance" readonly><br>
                            <label>Collected Amount:</label>
                            <input type="number" id="modalCollectedAmount" step="0.01" required><br>
                            <button type="submit">Submit</button>
                            <button type="button" onclick="closeModal()">Cancel</button>
                        </form>
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
            let outstanding = []; 
        
            async function fetchPurchase() {
                try {
                    const response = await fetch('/outstanding/data');
                    outstanding = await response.json();
                    renderTable(outstanding); 
                } catch (error) {
                    console.error("Error fetching invoices:", error);
                }
            }
        
            function renderTable(data) {
                const tableBody = document.getElementById('PurchaseData');
                tableBody.innerHTML = ''; 
        
                data.forEach(cash => {
                    // Skip rows where bal_amt is 0.00
                    if (parseFloat(cash.bal_amt) === 0.00) return;
        
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${cash.customer_id}</td>
                        <td>${cash.customer ? cash.customer.customer_name : 'N/A'}</td>
                        <td>${cash.bal_amt}</td>
                    `;
                    row.addEventListener('click', () => openModal(cash));
                    tableBody.appendChild(row);
                });
            }
            function openModal(cash) {
                const modal = document.getElementById('balanceModal');
                modal.style.display = 'block';
                document.getElementById('modalCustomerId').value = cash.customer_id;
                document.getElementById('modalBalance').value = cash.bal_amt;
            }

            function closeModal() {
                const modal = document.getElementById('balanceModal');
                modal.style.display = 'none';
            }

            async function submitBalance() {
                const customerId = document.getElementById('modalCustomerId').value;
                const collectedAmount = document.getElementById('modalCollectedAmount').value;

                try {
                    const response = await fetch('/cash/collect', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            customer_id: customerId,
                            collected_amt: parseFloat(collectedAmount),
                        }),
                    });

                    if (response.ok) {
                        alert('Balance collected successfully');
                        closeModal();
                        fetchPurchase(); // Refresh table
                    } else {
                        alert('Failed to collect balance');
                    }
                } catch (error) {
                    console.error('Error submitting balance:', error);
                }
            }
            fetchPurchase();
        </script>                     
    </body>
</html>
{{-- <a href="/purchase/print/${purchase.po_no}">
    <img src="img/print.png" alt="print" style="width: 50px; height: 50px;">
</a> --}}