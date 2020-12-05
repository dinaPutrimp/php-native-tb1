<?php
session_start();
require 'config.php';

//post to cart
if(isset($_POST['tid'])){
    $tid = $_POST['tid'];
    $tjenis = $_POST['tjenis'];
    $tharga = $_POST['tharga'];
    $tcode = $_POST['tcode'];
    $tqty = 1;

    $stmt = $conn->prepare("SELECT code_tiket FROM carts WHERE code_tiket=?");
    $stmt->bind_param("s",$tcode);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['code_tiket'];

    if(!$code){
        $query = $conn->prepare("INSERT INTO carts (jenis_tiket,harga_tiket,qty,harga_total,code_tiket) VALUES 
        (?,?,?,?,?)");
        $query->bind_param("ssiss",$tjenis,$tharga,$tqty,$tharga,$tcode);
        $query->execute();
        echo '<div class="alert alert-success alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Ditambahkan ke keranjang!</strong>
            </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Tiket sudah ada dikeranjang!</strong>
            </div>';
    }
}

//tambah angka ke icon cart
if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cartitem'){
    $stmt = $conn->prepare("SELECT * FROM carts");
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}

//remove product
if(isset($_GET['remove'])){
    $id = $_GET['remove'];

    $stmt = $conn->prepare("DELETE FROM carts WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Tiket dihapus!';
    header('location:cart.php');
}

//clear all cart
if(isset($_GET['clear'])){
    $stmt = $conn->prepare("DELETE FROM carts");
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Semua tiket dihapus dari cart!';
    header('location:cart.php');
}

//update qty
if(isset($_POST['qty'])){
    $qty = $_POST['qty'];
    $tid = $_POST['tid'];
    $tharga = $_POST['tharga'];

    $tprice = $qty*$tharga;

    $stmt = $conn->prepare("UPDATE carts SET qty=? , harga_total=? WHERE id=?");
    $stmt->bind_param("isi",$qty,$tprice,$tid);
    $stmt->execute();
}

//post checkout
if(isset($_POST['action']) && isset($_POST['action']) == 'order'){
    $name = $_POST['nama'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $mode = $_POST['mode'];

    $data = '';

    $stmt = $conn->prepare("INSERT INTO orders (nama,email,phone,mode,tiket,total) 
    VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$name,$email,$phone,$mode,$products,$grand_total);
    $stmt->execute();
    $data .= '<div> 
                <h1>Terima kasih!</h1>
                <h2>Pesanan berhasil dibuat!</h2>
                <h4>Pembayaran : '.$products.' </h4>
                <h4>Nama Pemesan : '.$name.'</h4>
                <h4>Email : '.$email.'</h4>
                <h4>Phone : '.$phone.'</h4>
                <h4>Total Pembayaran : '.number_format($grand_total,2).'</h4>
                <h4>Mode Pembayaran : '.$mode.'</h4>
            </div>';
    echo $data;
}
?>