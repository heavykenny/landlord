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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card my-5">
                        <div class="card-body">
                            <h3 class="card-title text-center">Login</h3>
                            <form action="http://localhost/landlord/api/user/loginUser" method="post" role="form" class="php-email-form">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="email" name="email"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Your Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <div class="mb-3">
                                            <div class="loading">Loading...</div>
                                            <div class="error-message"></div>
                                            <div class="sent-message">User logged in successfully</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-a">Login</button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center pt-4">
                                <p>Don't have an account? <a href="register.php">Register</a></p>
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