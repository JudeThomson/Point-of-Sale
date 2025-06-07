<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Price Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="CSS/vendor.css">
</head>
<body>
    <!--First Container-->
	<div class="container-fluid navigation">
		<div class="row">
			<div class="col-md-8 logo">
				<img src="img\logo.png">
				<p>Product Price Report</p>
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
    <!--Secound Container-->
    <div class="container seccon">
        <!-- Date Filter Row -->
        <div class="row">
            <div class="col-md-12">
                <label for="warehouse">warehouse Name:</label>
                <select id="warehouseDropdown" class="form-control">
                    <option value="">Select Warehouse</option>
                    @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->warehouse_code }}">{{ $warehouse->warehouse_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- Table Section --}}
        <div class="row table_sec">
            <div class="col-md-12">
                <table>
                    <thead class="table_head">
                        <tr>
                            <th class="head_data" width="220">
                                HSN Code
                            </th>
                            <th class="head_data" width="500">
                                Product
                            </th>
                            <th class="head_data"width="200">
                                Batch No.
                            </th>
                            <th class="head_data"width="200">
                                Amount
                            </th> 
                            <th class="head_data"width="200">
                                CGST(%)
                            </th> 
                            <th class="head_data"width="200">
                                SGST(%)
                            </th> 
                            <th class="head_data"width="200">
                                IGST(%)
                            </th> 
                            <th class="head_data"width="200">
                                UMO
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
    $(document).ready(function () {
        $('#warehouseDropdown').change(function () {
            let warehouseId = $(this).val();

            $('#PurchaseData').empty();

            if (warehouseId) {
                $.ajax({
                    url: '/get-products-by-warehouse',
                    method: 'GET',
                    data: { warehouse_code: warehouseId },
                    success: function (response) {
                        if (response.products.length > 0) {
                            response.products.forEach(product => {
                                let row = `
                                    <tr>
                                        <td>${product.hsn_code || 'N/A'}</td>
                                        <td>${product.product?.product_name || 'N/A'}</td>
                                        <td>${product.batch_code || 'N/A'}</td>
                                        <td>${product.selling_rate || '0.00'}</td>
                                        <td>${product.cgst || '0.00'}</td>
                                        <td>${product.sgst || '0.00'}</td>
                                        <td>${product.igst || '0.00'}</td>
                                        <td>${product.unit_of_msrment || 'N/A'}</td>
                                    </tr>
                                `;
                                $('#PurchaseData').append(row);
                            });
                        } else {
                            let emptyRow = `<tr><td colspan="8" class="text-center">No products found for this warehouse</td></tr>`;
                            $('#PurchaseData').append(emptyRow);
                        }
                    },
                    error: function () {
                        alert('Error fetching products. Please try again.');
                    }
                });
            }
        });
    });
</script>

</body>
</html>
