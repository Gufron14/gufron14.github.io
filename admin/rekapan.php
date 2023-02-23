<?php
    session_start();
    include '../config/conn.php';
    if(empty($_SESSION['superadmin_name']))
    {
        header("Location:superadmin.php");
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

    <title>EVoting - Rekap</title>
  </head>
<body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand font-weight-bold text-white" href="#">
        <img src="logo kpum.png" width="30" height="30" class="d-inline-block align-top" alt="">
        &nbsp E - Voting | KPUM IWU &nbsp
        </a>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="control.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-light font-weight-bold" href="rekapan.php">Rekapan <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
  
    <a href="export-xls.php"> <button type="button" class="btn btn-primary mt-3 ml-4">Rekap</button> </a>

      <div class="container-fluid">
        <form class="d-flex c">
          <input class="form-control me-2 mt-1" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    

      <br>
      <br>
    <?php
    $query = "SELECT * FROM votes";
    $result = mysqli_query($conn, $query);
    ?>
    <table border="1" class="table table-sm ml-4 mr-4 ">
      <thead>
      <tr class="thead-dark">
        <th>No</th>
        <th>Nama</th>
        <th>Pilihan</th>
        <th>Waktu Memilih</th>
      </tr>
      </thead>
    <?php
    if ($result->num_rows > 0) {
      $sn=1;
      while($data = $result->fetch_assoc()) {
    ?>
    <tr>
      
      <td><?php echo $data['id']; ?> </td>
      <td><?php echo $data['voter_id']; ?> </td>
      <td><?php echo $data['can_id']; ?> </td>
      <td><?php echo $data['voted_at']; ?> </td>
    <tr>
    <?php
      $sn++;}} else { ?>
        <tr>
        <td colspan="8">No data found</td>
        </tr>
    <?php } ?>
    </table

</body>
</html>
