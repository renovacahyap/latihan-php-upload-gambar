<?php
//koneksi database
$conn=mysqli_connect("localhost","root","","latihan");

function query($query){
    global $conn;

    $result=mysqli_query($conn,$query);
    
    $rows=array();

    while($row = mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    $nama=htmlspecialchars($_POST["nama"]);
    $nim= htmlspecialchars($_POST["nim"]);

    //upload gambar
    $gambar = upload();

    if (!$gambar) {
        return false;
    }
        // insert query 
        $query="INSERT INTO kartun VALUES('','$nama','$nim','$gambar')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
}
function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
       
    //chek gambar sudah diupload atau belum
        if ($error === 4 ) {
            echo"
            <script>
                alert('pilih gambar terlebih dahulu!');
            </script>
            ";
            return false;
        }
        // chek apakah yang diupload gambar?
        $ekstensigambarvalid = array('jpg','png','jpeg');
        $extensigambar=explode('.',$namaFile);
        $extensigambar = strtolower(end($extensigambar));

        if ( !in_array($extensigambar,$ekstensigambarvalid) ) {
            echo"<script>
                alert('yang anda upload bukan gambar!');
                document.location.href='tambah.php'
            </script>";
            return false;
        }

        //cek gambar apakah size nya besar?
        if ($ukuranFile > 1000000) {
            echo"<script>
            alert('data terlalu besar')
            </script>";
        }

        $namaFileBaru=uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $extensigambar; 

        move_uploaded_file($tmpName,'img/' .$namaFileBaru);
        return $namaFileBaru;

}
function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM kartun WHERE id=$id");
    mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id=$_POST["id"];
    $nama=htmlspecialchars($_POST["nama"]);
    $nim= htmlspecialchars($_POST["nim"]);
    $gambarLama= htmlspecialchars($_POST["gambarlama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar=$gambarLama;
    }else{
        $gambar= upload();
    }
    
        // insert query 
        $query="UPDATE kartun SET nama='$nama',nim='$nim',gambar='$gambar' WHERE id=$id";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);

}

function cari($keyword){
    $query="SELECT * FROM kartun WHERE nama = '$keyword' ";
    return query($query);

}
?>