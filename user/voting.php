<?php
    session_start();
    include '../config/conn.php';
    if(empty($_SESSION['voter_name']))
    {
        header("Location:index.php");
    }
    $voter_id = $_SESSION['voter_id'];
    $check_vote = "SELECT * FROM votes WHERE voter_id='$voter_id'";
    $check_vote_result = mysqli_query($conn,$check_vote);
    if($check_vote_result->num_rows > 0)
    {
        header("Location:voting_done.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/kpumlogo.ico">
    <title>EVoting</title>
    <style>
        fieldset {
        background-color: #eeeeee;
        }

        legend {
        background-color: gray;
        color: white;
        padding: 5px 10px;
        }

        input {
        margin: 5px;
        }

        nav {
            background-color: #5C125E;
        }
        .btn {
            background-color: #5C125E;
        }
        
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand text-white font-weight-bold" href="#">
    <img src="../img/logo kpum.png" width="30" height="30" class="d-inline-block align-top" alt="">
        &nbsp E - Voting | KPUM IWU &nbsp
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-muted" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?php echo $base_url?>vlogout.php">Logout</a>
            </li>
        </ul>
    </div>
    </nav>
    
    <h3 class="text-center font-weight-bold mt-3">Selamat Datang <?php echo $_SESSION['voter_id'] ?>, <br> di E - Voting KPUM IWU </h3>
    <p class="text-center">Sebelum melakukan Pemilihan, silakan pahami terlebih dahulu Tata Cara Pemungutan Suara</p>
    <div class="container mt-3 border rounded">
        <h4><b>TATA CARA PEMUNGUTAN SUARA</b></h4>
        <p>
            <ol>
                <li>Pelaksanaan pemungutan suara dilakukan secara online melalui link yang diberikan  KPUM.</li>
                <li>Pemberian hak pilih tidak boleh diwakilkan kepada orang lain</li>
                <li>Calon pemilih wajib melampirkan Kartu Tanda Mahasiswa (KTM) sesuai arahan yang tercantum di Buku Panduan.</li>
                <li>Bagi calon pemilih semester 1 (MABA) wajib menyerahkan identitas lainnya apabila belum mempunyai KTM.</li>
                <li>Pemilih wajib mengisi setiap kolom yang terpampang pada formulir Pemilihan.</li>
                <li>Pemilih hanya di perbolehkan memilih satu kali.</li>
                <li>Selama pemilihan berlangsung pemilih dan calon DILARANG :</li>
                    <ul>
                        <li>Melakukan Kampanye</li>
                        <li>Melakukan pemilihan dua kali</li>
                        <li>Melakukan kecurangan politik seperti money politik</li>
                        <li>Melakukan pemaksaan kepada calon pemilih</li>
                    </ul>
                <li>Jika diketahui ada calon pemilih yang melakukan pengisian dua kali, akan dikenakan  sanksi.</li>
                <li>Pemilih menentukan pilihan dengan cara mengklik foto/poster kandidat yang sudah tertera  pada form pemilihan.</li>
                <li>Pihak yang boleh mengubah susunan pada Formulir hanyalah KPUM UWI.</li>
            </ol>
        </p>
        <input type="checkbox" name="checkbox" id="checkbox">Saya sudah membaca Tata Cara Pemungutan Suara dan Apabila saya melanggar peraturan, saya siap menerima sanksi</input>
        <div class="text-center mt-3">
            <a href="voting_page.php"><button class="btn btn-primary mb-3 font-weight-bold " id="agree">Lanjutkan</button></a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#agree').attr('disabled', true);
            $('#checkbox').click(function(){
            if($(this).prop("checked") == true){
                $('#agree').attr('disabled', false);
            }
            else if($(this).prop("checked") == false){
                $('#agree').attr('disabled', true);
            }
            });
        });
            
    </script>
</body>
</html>