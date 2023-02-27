<?php
    session_start();
    include '../config/conn.php';
    if(empty($_SESSION['superadmin_name']))
    {
        header("Location:../admin/superadmin.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>EVoting - Statistik</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="shortcut icon" href="../img/kpumlogo.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand font-weight-bold text-white" href="#">
        <img src="../img/logo kpum.png" width="30" height="30" class="d-inline-block align-top" alt="">
        &nbsp E - Voting | KPUM IWU &nbsp
        </a>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link " href="control.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rekapan.php">Rekapan</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-light font-weight-bold" href="statistik.php">Statistik <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
      </nav>

      <br>
      <br>
    <p class="text-center">Jumlah Pemilih : 

    <?php 
        $voters_query = "SELECT * FROM voters";
        $result = mysqli_query($conn, $voters_query);
        
        if ($result) {
            $voters_count = mysqli_num_rows($result);
            echo $voters_count;
        } else {
            echo "Error fetching voters count.";
        }       
        ?>
    </p>

    <p class="text-center">Jumlah yang sudah memberikan hak suara : 

    <?php 
        $voters_query = "SELECT * FROM votes";
        $result = mysqli_query($conn, $voters_query);
        
        if ($result) {
            $voters_count = mysqli_num_rows($result);
            echo $voters_count;
        } else {
            echo "Error fetching voters count.";
        }       
        ?>
    </p>

    <p class="text-center">Jumlah Mahasiswa yang memilih Kandidat 1 : 

    <?php 
        $voters_query = "SELECT * FROM votes WHERE can_id='1'";
        $result = mysqli_query($conn, $voters_query);
        
        if ($result) {
            $voters_count = mysqli_num_rows($result);
            echo $voters_count;
        } else {
            echo "Error fetching voters count.";
        }       
        ?>
    </p>

    <p class="text-center">Jumlah Mahasiswa yang memilih Kotak Kosong : 

    <?php 
        $voters_query = "SELECT * FROM votes WHERE can_id='2'";
        $result = mysqli_query($conn, $voters_query);
        
        if ($result) {
            $voters_count = mysqli_num_rows($result);
            echo $voters_count;
        } else {
            echo "Error fetching voters count.";
        }       
        ?>
    </p>

</body>
</html>