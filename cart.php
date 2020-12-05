<?php
    session_start();
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="author" content="Dina">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
<title>Cart</title>
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
        .container{
            padding-top: 50px;
            margin: 0 auto;
        }
        .cls{
            background-color: #f44336; 
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 8px;
        }
        .ctn{
            background-color: #008CBA;; 
            border: none;
            color: white;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 12px;
        }
        table, th, tr{
            text-align: center;
        }
        h2{
            text-align: center;
            color: #30b8b3;
            padding-top: 10px;

        }
        table{
            width: 70%;
            margin: 0 auto;
            border: 1px solid lightgrey;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        td{
            height: 30px;
        }
        table tr th{
            background-color: #9ebaa8;
            width: 50px;
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

<div class="container">
    <div>
        <div>
        <div style="display: <?php if(isset($_SESSION['showAlert'])){
            echo $_SESSION['showAlert'];
        } else {
            echo 'none';
        } 
        unset($_SESSION['showAlert']);
        ?>" class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>
                <?php if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];} 
                    unset($_SESSION['showAlert']);
                ?>
            </strong>
        </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <td colspan="7">
                                <h2>Tiket anda</h2>
                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Ticket</th>
                            <th>Harga</th>
                            <th>Quantity</th>
                            <th>Total Harga</th>
                            <th>
                                <a href="function.php?clear=all" class="cls"  onclick="return confirm('Yakin ingin menghapus semua?');">Clear cart</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require 'config.php';
                            $stmt = $conn->prepare("SELECT * FROM carts");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            while($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <!-- update quantity saat ditambah -->
                            <input type="hidden" class="tid" value="<?= $row['id']; ?>">
                            <td><?= $row['jenis_tiket']; ?></td>
                            <td><?= number_format($row['harga_tiket'],2); ?></td>
                            <input type="hidden" class="tharga" value="<?= $row['harga_tiket']; ?>">
                            <td><input type="number" class="itemQty" value="<?= $row['qty']; ?>" style="width: 75px;"></td>
                            <td><?= number_format($row['harga_total'],2); ?></td>
                            <td>
                                <a href="function.php?remove=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash" style="color: red; font-size: 20px;"></i></a>
                            </td>
                        </tr>
                        <?php $grand_total += $row['harga_total']; ?>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="2">
                                <a class="ctn" href="tiket.php">Continue shopping</a>
                            </td>
                            <td colspan="2"><b>Grand Total</b></td>
                            <td><b><?= number_format($grand_total,2); ?></b></td>
                            <td>
                                <a class="ctn" href="checkout.php"
                                <?= ($grand_total > 1)?"":"disabled"; ?>>Checkout</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
        //update qty
        $(".itemQty").on('change',function(){
            var $el = $(this).closest('tr');

            var tid = $el.find(".tid").val();
            var tharga = $el.find(".tharga").val();
            var qty = $el.find(".itemQty").val();
            location.reload(true);

            //post to order
            $.ajax({
                url:'function.php',
                method:'post',
                cache:false,
                data:{qty:qty,tid:tid,tharga:tharga},
                success:function(response){
                    console.log(response);
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