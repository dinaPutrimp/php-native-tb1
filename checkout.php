<?php
    require 'config.php';

    session_start();
    $grand_total = 0;
    $allItems = '';
    $items = array();

    $sql = "SELECT CONCAT(jenis_tiket, '(' , qty , ')') 
    AS ItemQty, harga_total FROM carts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        $grand_total += $row['harga_total'];
        $items[] = $row['ItemQty'];
    }
    $allItems = implode(",",$items);
?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="author" content="Dina">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
<title>Checkout</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        }
        nav{
            padding: 10px;
            background-color: black;  
        }
        .navbar-brand{
            color: white;
            padding-left: 0;
            padding-right: 20px;
            font-weight: bold;
            opacity: 0.5;
        }
        .navbar ul li .a{
            color: white;
            text-decoration: none;
            padding: 0 60px 20px 0;
            font-size: medium; 
        }
        .list{
            list-style: none;
            display: inline;
        }
        .body{
            width: 100%;
        }
        .container{
            margin: 0 auto;
            text-align: center;
        }
        input{
            width: 30%;
            height: 40px;
        }
        .form-group{
            padding: 5px;
        }
        .kotak{
            background-color: lightgrey;
            width: 30%;
            text-align: center;
            margin: 0 auto;  
        }
        h1{
            color: #0e849e;
        }
        .btn{
            color: white;
            background-color: #008CBA;
        }
    </style>
</head>

<body>
<header>
    <nav class="navbar">
        <div>
            <ul>
                <li class="list"><a class="navbar-brand">Ticket</a></li>
                <li class="list"><a class="a" href="index.php">Home</a></li>
                <li class="list"><a class="a" href="tiket.php">Ticket list</a></li>
                <li class="list"><a class="a" href="checkout.php">Checkout</a></li>
                <li class="list" style="float: right;"><a class="a" href="logout.php">Logout</a></li>
                <li class="list" style="float: right;"><a class="a" href="cart.php"><i class="fa fa-shopping-cart"></i>&nbsp;<span id="cart-item">1</span></a></li>
            </ul>
        </div>        
    </nav>
</header>
<div class="body">
    <div class="container">
        <div class="jumbrotan" id="order">
            <h1>Lengkapi pesananmu!</h1>
            <div class="kotak">
                <h3 class="lead"><b>Ticket(s) : </b><?= $allItems; ?></h3>
                <h2><b>Total yang di bayarkan : </b><?= number_format($grand_total,2); ?></h2>
            </div>
            <form action="" method="post" id="placeOrder">
                <input type="hidden" name="products" value="<?= $allItems; ?>">
                <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                <div class="form-group">
                    <input type="text" name="nama" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
                </div>
                <h4>Pilih Mode Pembayaran</h4>
                <div class="form-group">
                    <select name="mode" class="form-control" style="width: 30%; height: 40px;">
                        <option value="" selected disabled>-Pilih Mode Pembayaran-</option>
                        <option value="internetbanking">Internet Banking</option>
                        <option value="cards">Debit/Credit Card</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Buat Pesanan" class="btn"> 
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#placeOrder").submit(function(e){
            e.preventDefault();
            $.ajax({
                url:'function.php',
                method:'post',
                data: $('form').serialize()+"&action=order",
                success:function(response){
                    $("#order").html(response);
                }
            });
        });
        load_cart_item_number();

        function load_cart_item_number(){
            $.ajax({
                url:'function.php',
                method:'get',
                data:{cartItem:"cart_item"},
                success:function(response){
                    $("#cart-item").html(response);
                }
            });
        }
    });
</script>
</body>
</html>