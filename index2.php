<?php
require'functions.php';
global $row;
$kartun= query("SELECT * FROM kartun");


if ( isset($_POST["cari"]) ) {
    $kartun= cari($_POST["keyword"]);
}
//ambil data dari tabel kartun / query data kartun

//$row=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h3>Selamat Datang! </h3>
    <form action="" method="POST">
    
    <input type="text" name="keyword"  size="40" autofocus placeholder="cari" autocomplete="off">
    <button type="submit" name="cari">cari</button>
    
    </form>
    <table border=1 cellspacing="0" cellpadding="10" >
          <a href="tambah.php">tambah data kartun</a>
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Gambar</th>
            <th>Actions</th>
        </tr>
        <?php $i=1;?>
        <?php foreach ($kartun as $krt) {?>
        <tr>
            <td>
                <?php echo $i;?>
            </td>
            <td>
                <a href="ubah.php?id=<?php echo $krt["id"]?>">ubah</a>
                <a href="hapus.php?id=<?php echo $krt["id"]?>" onclick="return confirm('yakin?')">hapus</a>
            </td>
            <td><?php echo $krt["nama"]?></td>
            <td><?php echo $krt["nim"]?></td>
            <td><img src="img/<?php echo $krt["gambar"]?>" alt="<?php echo $krt["gambar"]?>" width="50"></td>

            
        </tr>
        <?php $i++?>
        <?php } ?>
    
    </table>
</body>
</html>