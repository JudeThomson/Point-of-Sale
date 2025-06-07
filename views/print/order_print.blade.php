<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Print Purchase Order</title>
</head>
<style>
    body{
        margin-top: 12px;
    }
    p{
        margin-bottom: 0px;
    }
</style>
<body>
    <div class="container-fluid" style="border: 1px solid black">
        <div class="row">
            <div class="col-2">
                <img src="img\logo.png" alt="">
            </div>
            <div class="col-10" style="text-align: center">
                <h6>{{ $company->company_name }}</h6>
                <p>{{ $company->address1 }}</p>
                <p>{{ $company->address2 }}</p>
                <p>{{ $company->address3 }}</p>
                <p>{{ $company->mobile }}</p>
                <p>{{ $company->email }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="border-top: 2px solid black; border-bottom: 2px solid black; text-align:center;">
                <h4>Purchase Order</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <h6>
                    Vendor Name :   {{ $purchase->vendor_name}}
                </h6>
                <h6>
                    PO No. : {{ $purchase->po_no}} 
                </h6>
            </div>
            <div class="col-3">
                <h6>Mobile : {{ $purchase->mobile }}</h6>
                <h6>Date : {{ $purchase->date_field }}</h6>
            </div>
        </div>
        <!-- Add Table for Purchase Order Items -->
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead class="thead">
                            <tr>
                                <th>Sl. No.</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>UOM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseItems as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit_of_msrment }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <h1>Purchase Order #{{ $company->company_name }}</h1>
    <p>Vendor Code: {{ $purchase->vendor_code }}</p> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
