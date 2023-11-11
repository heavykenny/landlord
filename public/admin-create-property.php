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
                            <h3 class="card-title text-center">Property Listing</h3>
                            <form action="http://localhost/landlord/api/property/createProperty" method="post"
                                  role="form" class="php-email-form">
                                <div class="row">

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="name"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Property Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="location"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Location" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="price"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Price" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="address"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="file" name="image_path"
                                                   class="form-control form-control-lg form-control-a" id="imageUpload"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <textarea name="points_of_interest" class="form-control" rows="5"
                                                      placeholder="Points of Interest" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <textarea name="description" class="form-control" rows="5"
                                                      placeholder="Description" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="latitude"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Latitude" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="longitude"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Longitude" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="bedrooms"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Bedrooms" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="bathrooms"
                                                   class="form-control form-control-lg form-control-a"
                                                   placeholder="Bathrooms" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <select name="type_id"
                                                    class="form-control form-control-lg form-control-a form-select">
                                                <option value="">Type (Optional)</option>
                                                <option value="1">Type 1</option>
                                                <option value="2">Type 2</option>
                                                <option value="3">Type 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <select name="property_type_id"
                                                    class="form-control form-control-lg form-control-a form-select">
                                                <option value="">Property Type (Optional)</option>
                                                <option value="1">Apartment</option>
                                                <option value="2">House</option>
                                                <option value="3">Condo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-3">
                                        <div class="mb-3">
                                            <div class="loading">Loading...</div>
                                            <div class="error-message"></div>
                                            <div class="sent-message">Your listing has been submitted. Thank you!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-a">Submit Listing</button>
                                    </div>
                                </div>
                            </form>
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