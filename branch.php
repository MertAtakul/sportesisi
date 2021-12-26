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
                                <a class="nav-link" href="index.html">Anasayfa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.html#branch">Branşlar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.html#events">Etkinlikler</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.html#contact">İletişim</a>
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
                        
                        if($branchid == ""){ $result = mysqli_query($db,"SELECT  t.trainer_name, t.trainer_surname, t.image, b.branch_name	FROM trainer t LEFT JOIN branch b ON t.branch_id = b.id;"); }
                        else{ $result = mysqli_query($db,"SELECT  t.trainer_name, t.trainer_surname, t.image, b.branch_name	FROM trainer t LEFT JOIN branch b ON t.branch_id = b.id WHERE branch_id = $branchid;"); }

                        while($row = mysqli_fetch_array($result)) { ?>

                        <div class="col-md-3 col-sm-12 pt-3 text-white text-center">
                            <div class="mb-2 h-100 bg-gray">
                                <img src="<?php echo $row["image"]; ?>"
                                    alt="" class="img-fluid">
                                <p class="p-3">
                                    <b>
                                        <?php echo $row["trainer_name"]; ?>
                                        <?php echo $row["trainer_surname"]; ?>
                                    </b> <br />
                                    <?php echo $row["branch_name"]; ?> <br />
                                </p>
                            </div>
                        </div>

                        <?php } ?>

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

    <footer>

    <div class="container-fluid p-0 mt-4">

    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12052.131281648897!2d29.11198848150635!3d40.95885984320636!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa65cc0e193d07d07!2sClubsporium!5e0!3m2!1str!2s!4v1434631285445" width="100%" height="350"
                frameborder="0" style="border:0" class="map"></iframe>

        </div>

        <div class="container">
            <div class="row mt-4">
                <div class="col-md-3 col-sm-12">

                    <p class="h3 text-warning">BRANŞLAR</p>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">FITNESS</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">TENİS/SQUASH</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">HAVUZ</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">SPOR OKULLARI</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">SPA</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">SPOR OKULLARI</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">AKTİF SPORLAR</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">SAVUNMA SPORLARI</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">KIDS CLUB</a>
                        </li>
                    </ul>

                </div>

                <div class="col-md-3 col-sm-12">

                    <p class="h3 text-warning">DİĞER</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="branch.php">EĞİTMENLER</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">İLETİŞİM</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">İLETİŞİM FORMU</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">KAMPANYALAR</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">ÜYELİK</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">BLOG</a>
                        </li>
                    </ul>

                </div>

                <div class="col-md-3 col-sm-12">

                    <p class="h3 text-warning">JUST SPORTS BLOG</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">Gençlik ve Spor</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">Yağ Yakımına Yardımcı Olan Besinler</a>
                        </li>
                    </ul>

                </div>

                <div class="col-md-3 col-sm-12">

                    <p class="h3 text-warning">SOSYAL MEDYA</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">Facebook</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">Twitter</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">Instagram</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">Google+</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">Youtube</a>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a class="link-warning text-light text-decoration-none" href="#">FourSquare</a>
                        </li>
                    </ul>

                </div>


            </div>


            <div class="row mt-5">
                <div class="col-12 text-center">
                    <h4 class="text-warning">DANIŞMA HATTI</h4>
                    <h1 class="text-white">444 77 67</h1>
                    <h6 class="text-white h4">bostanci@justsports.com.tr</h6>
                </div>

            </div>

        </div>


    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>

</html>