<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
    <title>Webservice data pesanan</title>
    <!-- Csrf Token -->
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?>">
     <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <nav class="navbar navbar-dark" style="background-color: #5ab337">
      <a class="navbar-brand" href="http://andikateknik.xyz" style="color: #fff;">
       Web Service Andika Teknik
      </a>
    </nav>

    <div class="container">
        <h2 align="center" style="margin: 30px;">Insert data pesanan</h2>

        <form method="post" class="form-data" id="form-data">  
        </div>
        </form>
        <hr>

        <div class="data"></div>
        
    </div>
    <!-- Untuk Keperluan Demo Saya Menggunakan JQuery Online, Jika sobat menggunakan untuk keperluan developmen/production maka download JQuery pada situs resminya -->
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        //Mengirimkan Token Keamanan
        $.ajaxSetup({
            headers : {
                'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.data').load("data.php");
        $("#simpan").click(function(){
            var data = $('.form-data').serialize();
            var nama = document.getElementById("nama").value;
            var tgl_pengerjaan = document.getElementById("tgl_pengerjaan").value;
            var alamat = document.getElementById("alamat").value;
             var no_hp = document.getElementById("no_hp").value;
              var pesanan = document.getElementById("pesanan").value;
             var total_biaya = document.getElementById("total_biaya").value;

            if (nama=="") {
                document.getElementById("err_nama").innerHTML = "Nama Pelanggan Harus Diisi";
            } else {
                document.getElementById("err_nama").innerHTML = "";
            }
            if (alamat=="") {
                document.getElementById("err_alamat").innerHTML = "Alamat pelanggan Harus Diisi";
            } else {
                document.getElementById("err_alamat").innerHTML = "";
            }
            if (pesanan=="") {
                document.getElementById("err_pesanan").innerHTML = "jenis pesanan Harus Diisi";
            } else {
                document.getElementById("err_pesanan").innerHTML = "";
            }
            if (tgl_pengerjaan=="") {
                document.getElementById("err_tgl_pengerjaan").innerHTML = "Tanggal pengerjaan Harus Diisi";
            } else {
                document.getElementById("err_tgl_pengerjaan").innerHTML = "";
            }
            if (no_hp=="") {
                document.getElementById("err_no_hp").innerHTML = "nomor hp Harus Diisi";
            } else {
                document.getElementById("err_no_hp").innerHTML = "";
            } if (total_biaya=="") {
                document.getElementById("err_total_biaya").innerHTML = "nomor hp Harus Diisi";
            } else {
                document.getElementById("err_total_biaya").innerHTML = "";
            }

            if (nama!="" && tgl_pengerjaan!=""  && alamat!=""  && no_hp!=""  && pesanan!="" && total_biaya!= "") {
                $.ajax({
                    type: 'POST',
                    url: "form_action.php",
                    data: data,
                    success: function() {
                        $('.data').load("data.php");
                        document.getElementById("id").value = "";
                        document.getElementById("form-data").reset();
                    }, error: function(response){
                        console.log(response.responseText);
                    }
                });
            }
            
        });
    });
    </script>
</body>
</html>