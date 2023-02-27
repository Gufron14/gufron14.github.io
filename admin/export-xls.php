<?php 
    session_start();
    include '../config/conn.php';
    if(!isset($_SESSION['superadmin_username'])) {
        // Jika belum, redirect ke halaman login
        header('Location: superadmin.php');
        exit();
    }

 // nama file
 $filename="Jumlah Voting-".date('Ymd').".xlsx";

 //header info for browser
 header("Content-Type: application/vnd-ms-excel"); 
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //menampilkan data sebagai array dari tabel produk
    $out=array();
 $sql=mysqli_query($conn, "SELECT * FROM votes");
 while($data=mysqli_fetch_assoc($sql)) $out[]=$data;

 $show_coloumn = false;
 foreach($out as $record) {
 if(!$show_coloumn) {
 //menampilkan nama kolom di baris pertama
 echo implode("\t", array_keys($record)) . "\n";
 $show_coloumn = true;
 }
 // looping data dari database
 echo implode("\t", array_values($record)) . "\n";
 } 
 exit;
?>