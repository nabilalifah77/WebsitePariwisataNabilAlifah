<?php
$server="localhost";
$username="root";
$password="";
$database="db_pariwisata";

$koneksi= new mysqli($server,$username,$password,$database);

if($koneksi) {
    echo "";
}else{
    echo "gagal koneksi";
}



?>