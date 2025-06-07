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
        #amount {
            width: 100%;
        }
        #PoNo {
            margin-left: 20px;
            width: 100%;    
        }
        #remarks {
            margin-left: 20px;
            width: 100%;    
        }
        .logo_search {
            width: 6% !important;
        }
    </style>
</head>
<body>
    <!--First Container-->
    <div class="container-fluid navigation">
        <div class="row">
            <div class="col-md-8 logo">
                <img src="img\logo.png">
                <p>Cancel Purchase Order</p>
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
                <form  method="POST">
                    @csrf
                    <div class="row com_row">                        
                        <div class="col-8 com_in" style="display: flex;">
                            <input type="text" placeholder="Vendor" name="amount" id="amount" class="form-control ins">
                            <input type="text" placeholder="Purchas order No." name="PoNo." id="PoNo" class="form-control ins">
                            <input type="text" placeholder="Remarks" name="remarks" id="remarks" class="form-control ins">
                            <img class="logo_search" src="img/search.png" id="addButton">
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
                                            Purchase Order No.
                                        </th>
                                        <th class="head_data" width="500">
                                            
                                        </th>
                                        <th class="head_data"width="200">
                                            
                                        </th>
                                        <th class="head_data"width="200">
                                            Date
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
                        <div class="col-md-6">
                            <div class="savee">
                                <input type="submit" name="submit" value="Cancel PO" class="btn1">
                            </div>
                        </div>
                        <div class="col-md-6 three_btns">
                            <button type="button" class="btn2" onclick="cancelForm()">Cancel</button>
                        </div>
                    </div>
                </form>
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
        function cancelForm() {
            window.location.href = '/dashboard';
        }
    </script>
</body>
</html>
