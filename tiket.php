<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiket</title>
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
        .product{
            border: 1px solid #eaeaec;
            margin: -1px 40px 30px 50px;
            padding: 10px 25px 10px 0;
            text-align: center;
            background-color: #efefef;
            width: 25%;
            float: left;
        }
        div .tab-res .table{
            text-align: center;
            margin: 0 auto;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: darkolivegreen;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: darkolivegreen;
            background-color: #efefef;
            padding: 0.5%;
        }
        table th{
            background-color: #efefef;
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
                <img src="banner.jpg" style="text-align: center;  width: 100%;" />
                    
            </nav>
        </header>

    <div class="container" style="width: 100%">
    <div id="message"></div>
        <div>
            <?php
                include 'config.php';
                $stmt = $conn->prepare("SELECT * FROM tiket");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()):
            ?>
            <div class="product card">
                <h5 style="background-color: grey; margin-left: 25px;" class="text-info"><?= $row["jenis_tiket"]; ?></h5>
                <h5><?= $row["tanggal_tiket"]; ?></h5>
                <h5><?= number_format($row["harga_tiket"],2); ?></h5>
                    <div class="card-footer p-1">
                        <form action="" class="form-submit">
                            <input type="hidden" class="tid" value="<?= $row['id']; ?>">
                            <input type="hidden" class="tjenis" value="<?= $row['jenis_tiket']; ?>">
                            <input type="hidden" class="ttgl" value="<?= $row['tanggal_tiket']; ?>">
                            <input type="hidden" class="tharga" value="<?= $row['harga_tiket']; ?>">
                            <input type="hidden" class="tcode" value="<?= $row['code_tiket']; ?>">
                            <button class="addItemBtn">Add to cart</button>
                        </form>  
                    </div>
            </div>
                <?php endwhile; ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".addItemBtn").click(function(e){
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var tid = $form.find(".tid").val();
            var tjenis = $form.find(".tjenis").val();
            var tharga = $form.find(".tharga").val();
            var tcode = $form.find(".tcode").val();

            $.ajax({
                url:'function.php',
                method:'post',
                data:{tid:tid,tjenis:tjenis,tharga:tharga,tcode:tcode},
                success:function(response) {
                    $("#message").html(response);
                    window.scrollTo(0,0);
                    load_cart_item_number();
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