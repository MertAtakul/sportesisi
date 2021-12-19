<?php
   include('session.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gösterge Paneli · Spor Tesisi</title>

    <!-- Bootstrap core CSS -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            <?php echo $login_session; ?>
            <?php echo $login_id; ?>

        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout.php">Çıkış Yap</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="dashboard.php">
                                <i class="bi bi-house-door"></i>
                                Gösterge Paneli
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointment.php">
                                <i class="bi bi-file-earmark"></i>
                                Randevularım
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="row">
                    <div class="col-6">
                        <h2 class="mt-3 d-inline-block">Randevularım</h2>
                    </div>
                    <div class="col-6 mt-auto p-2 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm add"
                            data-bs-toggle="modal" data-bs-target="#record-add">Randevu Oluştur</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Branş</th>
                                        <th scope="col">Antrenör</th>
                                        <th scope="col">Tarih</th>
                                        <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $result = mysqli_query($db,"SELECT a.id, b.branch_name, t.trainer_name, t.trainer_surname, a.date FROM appointment a LEFT JOIN trainer t	ON a.trainer_id = t.id LEFT JOIN branch b ON a.branch_id = b.id;");
                                        $i=1;
                                        while($row = mysqli_fetch_array($result)) { ?>

                                    <tr id="<?php echo $row["id"]; ?>">
                                        <td>
                                            <?php echo $row["id"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["branch_name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["trainer_name"]; ?>
                                            <?php echo $row["trainer_surname"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["date"]; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-secondary btn-sm edit"
                                                data-bs-toggle="modal" data-bs-target="#record-edit">Düzenle</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete"
                                                data-bs-toggle="modal" data-bs-target="#confirm-delete">Sil</button>
                                        </td>
                                    </tr>

                                    <?php $i++; } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="record-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Randevu Oluştur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <input type="hidden" value="1" name="type">
                    <div class="mb-3">
                    <select class="form-select" name="branch_id">
                        <option selected>Branş Seçiniz...</option>
                        <option value="1">FITNESS</option>
                        <option value="2">Tenis/SQUASH</option>
                        <option value="3">HAVUZ</option>
                        
                    </select>

                    </div>
                    <div class="mb-3">
                    <select class="form-select" name="trainer_id">
                        <option selected>Antrenör Seçiniz...</option>
                        <option value="1">Mert Atakul</option>
                        <option value="2">Talha Kaan Özkan</option>
                        <option value="3">Sefa Dudu</option>
                        
                    </select>
                    </div>


                <div class="mb-3">
                                <label class="form-label">Tarih</label>
                                <input type="datetime-local" class="form-control" placeholder="" name="date">
                </div>
 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" id="add">Oluştur</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="record-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Randevu Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                        <input type="hidden" value="2" name="type">
                        <input type="hidden" id="id_u" name="id" class="form-control" required>
                        <div class="mb-3">
                    <select class="form-select" name="branch_id">
                        <option selected>Branş Seçiniz...</option>
                        <option value="1">FITNESS</option>
                        <option value="2">Tenis/SQUASH</option>
                        <option value="3">HAVUZ</option>
                        
                    </select>

                    </div>
                    <div class="mb-3">
                    <select class="form-select" name="trainer_id">
                        <option selected>Antrenör Seçiniz...</option>
                        <option value="1">Mert Atakul</option>
                        <option value="2">Talha Kaan Özkan</option>
                        <option value="3">Sefa Dudu</option>
                        
                    </select>
                    </div>


                <div class="mb-3">
                                <label class="form-label">Tarih</label>
                                <input type="datetime-local" class="form-control" placeholder="" name="date">
                </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" id="edit">Güncelle</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Silmeyi Onayla</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bu Kayıtları silmek istediğinizden emin misiniz?</p>
                    <p class="text-danger"><small>Bu işlem geri alınamaz.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" id="delete">Sil</button>
                </div>
            </div>
        </div>
    </div>




    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
        crossorigin="anonymous"></script>

    <script src="js/appointment.js"></script>
</body>

</html>