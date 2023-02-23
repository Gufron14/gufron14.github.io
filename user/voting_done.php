<?php
    session_start();
    include '../config/conn.php';
    if(empty($_SESSION['voter_name']))
    {
        header("Location:index.php", true, 301);
    }
    $voter_id = $_SESSION['voter_id'];
    $fetch_can_id = "SELECT * FROM votes WHERE voter_id='$voter_id'";
    $fetch_can_id_result = mysqli_query($conn, $fetch_can_id);
    if($fetch_can_id_result->num_rows > 0)
    {
        $can_id = mysqli_fetch_array($fetch_can_id_result);
        $real_can_id = $can_id['can_id'];
        $fetch_can_name = "SELECT * FROM candidates WHERE can_id='$real_can_id'";
        $fetch_can_name_result = mysqli_query($conn, $fetch_can_name);
        if($fetch_can_name_result->num_rows > 0)
        {
            $can_name = mysqli_fetch_array($fetch_can_name_result);
            $real_can_name = $can_name['can_name'];
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/kpumlogo.ico">

    <title>Voting Success</title>
    <style>
        #cust_margin{
            margin-top:10%;
        }
        
    </style>
  </head>
  <body>
  <div class="container">
        <div class="text-center" id="cust_margin">
            <img src="../img/check.png" alt="success" width="100" class="mb-3">
            <h1 class="text-success">Terimakasih <font color='#5C125E'> <?php echo $_SESSION ['voter_id'] ?>, </font> <br> Telah Memberikan Hak Suara</h1>
            
            <p>Anda Memilih Nomor Kandidat : <?php echo $real_can_id?>, Yaitu : <?php echo $real_can_name?> </p> <br>
            <!-- <a href="#"> <button class="btn btn-primary text-light font-weight-bold">Lihat Statistik</button></a> -->
            <a href="vlogout.php"> <button class="btn btn-dark text-light font-weight-bold">Logout</button></a>

        </div>
  </div>
        

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>