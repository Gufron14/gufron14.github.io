<?php
    session_start();
    include '../config/conn.php';
    if(empty($_SESSION['voter_name']))
    {
        header("Location:index.php", true, 301);
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

    <title>EVoting - Voting</title>
    <style>
        nav{
            background-color: #5C125E;
        }
    </style>
  </head>
<body>
    <nav class="navbar navbar-expand-lg">
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
                <li class="nav-item active">
                    <a class="nav-link text-light font-weight-bold" href="voting.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="vlogout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    

    <!--Submit Vote Modal -->
    <div class="modal fade" id="submitvotemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kirim Pilihan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post">
        <div class="modal-body">
            <p>Apakah Anda yakin ingin memberikan suara kepada kandidat ini?</p>
            <p>Tindakan ini tidak dapat diubah.</p>
            <p>Setelah Anda mengklik <b>'Ya, Saya Yakin'</b>, Anda tidak dapat mengubah suara Anda.</p>
            
                        <input type="hidden" name="candidate_id" id="candidate_id">
                        <input type="hidden" name="voter_id" id="voter_id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" name="submit_vote" class="btn btn-primary">Ya, Saya Yakin</button>
        </div>
        </form>
        </div>
    </div>
    </div>

    <?php
        if(isset($_POST['submit_vote']))
        {
            $candidate_id = $_POST['candidate_id'];
            $voter_id = $_POST['voter_id'];
            
            $insert_vote = "INSERT INTO votes (voter_id, can_id) VALUES ('$voter_id','$candidate_id')";
            $insert_vote_result = mysqli_query($conn, $insert_vote);
            if($insert_vote_result == '1')
            {
                echo '<script>alert("Voted Successfully")</script>';
                // echo '<script>';
                // echo 'window.location="'.$base_url.'vlogout.php"';
                // echo '</script>';
                header("Location:voting_done.php");
            }
            else
            {
                echo '<script>alert("Failed to Vote")</script>';
            }
        }
    ?>

    <h1 class="text-center mt-2">Daftar Kandidat</h1>
    <hr>
    <div class="container mt-3">
        <table class="table table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>Nomor Kandidat</th>
                        <th>Nama Kandidat</th>
                        <th>CAPRESMA</th>
                        <th>CAWAPRESMA</th>
                        <th>Vote</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fetch_candidate_data = "SELECT * FROM candidates";
                    $result_candidate_data = mysqli_query($conn, $fetch_candidate_data);
                    if(mysqli_num_rows($result_candidate_data) > 0)
                    {
                        while($res = mysqli_fetch_array($result_candidate_data))
                        {
                    ?>
                        <tr>
                            <td class="pt-4"><h6><?php echo $res['can_id']?></h6></td>
                            <td><h6 class="pt-4"><?php echo $res['can_name']?></h6></td>
                            <td><img src="../profile/<?php echo $res['can_party_symbol'] ?>" alt="image" width="100"></td>
                            <td><img src="/profile/<?php echo $res['can_image'] ?>" alt="party" width="100"></td>
                            <td><a href="" data-toggle="modal" data-target="#submitvotemodal" data-candidate_id="<?php echo $res['can_id']?>" data-voter_id="<?php echo $_SESSION['voter_id']?>"><img src="http://icons.iconarchive.com/icons/iconarchive/blue-election/256/Election-Vote-2-icon.png" alt="vote" width="100"></a></td>
                        </tr>
                        <?php
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="5">No Data Available</td>
                        </tr>
                        <?php
                    }
                        ?>
                </tbody>
        </table>
    </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#submitvotemodal').on('show.bs.modal', function (event) {
                // console.log("modal open");
                var button = $(event.relatedTarget) // Button that triggered the modal
                var candidate_id = button.data('candidate_id')
                var voter_id = button.data('voter_id')
            
                var modal = $(this)
                modal.find('.modal-body #candidate_id').val(candidate_id)
                modal.find('.modal-body #voter_id').val(voter_id)
                })
            });
        </script>
</body>
</html>