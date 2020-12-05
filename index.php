<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
?>


<html>

  <head>
    <title>Home</title>
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
        p{
            text-align: justify;
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
                        <li class="list"><a class="a" href="ticket.php">Ticket list</a></li>
                        <li class="list"><a class="a" href="checkout.php">Checkout</a></li>
                        <li class="list" style="float: right;"><a class="a" href="logout.php">Logout</a></li>
                        <li class="list" style="float: right;"><a class="a" href="cart.php"><i class="fa fa-shopping-cart"></i>&nbsp;<span id="cart-item">1</span></a></li>
                    </ul>
                </div>
                <img src="banner.jpg" style="text-align: center;  width: 100%;" />
            </nav>
        </header> 
        <article>
            <p>Raisa Live In Concert</p>
            <p>Raisa bersama JUNI Concert akan menggelar konser tunggal di Stadion Utama Gelora Bung Karno pada 
            28 November 2020 yang bertajuk Raisa Live in Concert Stadion Utama Gelora Bung Karno. Konser ini akan 
            menjadi saksi nyata tentang cerita perjalanan, perjuangan, dan harapannya di industri musik, serta 
            memberikan pesan kuat bahwa setiap orang, terutama generasi muda khususnya perempuan, bisa bermimpi 
            dan menggapai impiannya dan bahkan menciptakan sejarah. Dalam rangka menyambut 5 tahun ada di industri 
            musik, Raisa membuat konser tunggalnya, "Raisa Live in Concert at Istora Senayan", Jakarta. Kesuksesan 
            konser yang diselenggarakan di tahun 2015 ini merupakan langkah awal Raisa untuk memasuki konser skala 
            stadium. Pada tahun 2018, Raisa menggadakan intimate concert "Fermata" yang merupakan konser Raisa 
            sebelum mengambil cuti selama 7 bulan. Perjalan baru Raisa kali ini dimulai dengan sebuah mega proyek 
            untuk merayakan 10 tahun perjalanannya, "Raisa Live in Concert Stadion Utama Gelora Bung Karno".</p>
            <p>JUNI Concert merupakan bagian dari PT JUNI Suara Kreasi yang berfokus pada live entertainment. 
            Berdedikasi dalam membuat rancangan sampai dengan menjalankan berbagai acara musik seperti showcase, 
            konser tunggal, festival, konferensi, sampai dengan tur keliling kota. JUNI Concert siap untuk 
            membantu mewujudkan dan menyampaikan visi dari para artis dan juga kliennya pada setiap acara 
            yang ingin digelar. Tugas utama JUNI Concert sendiri adalah untuk memastikan para fans dan 
            penonton mendapatkan sebuah pengalaman yang berkesan, dari mulai penjualan tiket, sampai 
            dengan hari H acara pertunjukkan dengan membuat sesuatu aktivasi yang inovatif yang mengelilingi 
            acaranya sendiri.</p>
        </article>
        <footer  style="text-align: center;">
            <a href="tiket.php"><button>Ticket</button></a>
        </footer>
        </body>
</html>