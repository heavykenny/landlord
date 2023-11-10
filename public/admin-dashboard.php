<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Estate Elite - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="library/animate.css/animate.min.css" rel="stylesheet" type="text/css">
    <link href="library/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="library/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" type="text/css">
    <link href="library/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php include_once "includes/search.php"; ?>
<?php include_once "includes/header.php"; ?>

<main id="main">
    <section class=" section-t8">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-4">Management Dashboard</h2>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card text-center bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title title-a">Landlords</h5>
                                    <a href="admin-manage-landlords.php" class="btn btn-a btn-sm">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title title-a">Properties</h5>
                                    <a href="admin-manage-properties.php" class="btn btn-a btn-sm">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title title-a">Users</h5>
                                    <a href="admin-manage-users.php" class="btn btn-a btn-sm">Manage</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>

<?php include_once "includes/footer.php"; ?>

<script>

</script>
</body>

</html>