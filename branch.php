<?php
   include("config.php");

   $branchid = htmlspecialchars($_GET["branchid"]);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="libs/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="libs/dist/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/style.css">
    <title>Just Sports</title>
</head>

<body>

    <header class="fixed-top bg-dark bg-opacity-75">
        <div class="container ">
            <nav class="navbar navbar-expand-sm navbar-light ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img src="images/logo.png " class="img-responsive" height="50px"
                            alt="logo"></a>
                    <button class="navbar-toggler bg-yellow" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon "></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav ms-auto jsports-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Anasayfa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#branch">Branşlar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#events">Etkinlikler</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">İletişim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="signup.php">Üye Ol</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php"><img src="images/user.png" class="img-responsive"
                                        height="25px" alt="user img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="jsport-main">
        <div class="container-fluid position-relative p-0">
            <img src="images/icerik_sayfa_banner_03.jpg" class="img-fluid" alt="içerik banner">
        </div>

        <div class="container">

            <div class="row mt-4">
                <div class="col-9">

                    <div class="row">

                        <?php 
                        
                        if($branchid == ""){ $result = mysqli_query($db,"SELECT * FROM trainer"); }
                        else{ $result = mysqli_query($db,"SELECT * FROM trainer WHERE branch_id = $branchid"); }

                        $i=1;
                        while($row = mysqli_fetch_array($result)) { ?>

                        <div class="col-md-3 col-sm-12 pt-3 text-white text-center">
                            <div class="mb-2 h-100 bg-gray">
                                <img src="https://www.clubsporium.com.tr/upload/data/_thumbs/images/egitmen/bostanci/serhat_akkaya745.jpg"
                                    alt="" class="img-fluid">
                                <p class="p-3">
                                    <b>
                                        <?php echo $row["trainer_name"]; ?>
                                        <?php echo $row["trainer_surname"]; ?>
                                    </b> <br />
                                    Fitness Eğitmeni <br />
                                </p>
                            </div>
                        </div>

                        <?php $i++; } ?>

                    </div>
                </div>
                <div class="col-3">
                    <div class="row pt-3">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item bg-transparent border-0">
                                <?php if($branchid == ""){ ?>
                                    <a href="branch.php" class="text-decoration-none text-warning">Tümü</a>
                                <?php }else{ ?>
                                    <a href="branch.php" class="text-decoration-none text-white">Tümü</a>
                                <?php } ?>
                            </li>

                            <?php
                                $result = mysqli_query($db,"SELECT * FROM branch");
                                $i=1;
                                while($row = mysqli_fetch_array($result)) { ?>

                            <li class="list-group-item bg-transparent border-0">
                                <?php if($branchid == $row["id"]){ ?>
                                <a href="branch.php?branchid=<?php echo $row["id"]; ?>" class="text-decoration-none
                                    text-warning">
                                    <?php echo $row["branch_name"]; ?>
                                </a>
                                <?php }else{ ?>
                                <a href="branch.php?branchid=<?php echo $row["id"]; ?>" class="text-decoration-none
                                    text-white">
                                    <?php echo $row["branch_name"]; ?>
                                </a>
                                <?php } ?>

                            </li>

                            <?php $i++; } ?>

                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </main>



    <div style="height: 1000px;">asdasd</div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>

</html>