<?php

require 'functions.php';
$conn=mysqli_connect("localhost","root","","latihan");

//chek apaakah tombol submit sudah ditekan atau belum

if (isset($_POST["submit"])) {
        if (tambah($data)>0) {
            echo"
            <script>
                alert('data berhasil ditambahkan')
                document.location.href='index2.php'
            </script>
            ";
        }else{
            echo"
            
            ";

        }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah kartun</title>
</head>
<body>
    <h3>Tambah Data Mahasiswa</h3>
    <form action="" method="post" enctype="multipart/form-data">

       <label for="nama">Nama : </label> <input type="text" name="nama" id="nama" required><br>
       <label for="nim">Nim   : </label> <input type="text" name="nim" id="nim" required><br>
       <label for="gambar">Gambar :</label><input type="file" name="gambar" id="gambar" > <br>
       <button type="submit" name="submit">Tambah</button>
    
    </form>
</body>
</html>