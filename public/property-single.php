<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Estate Elite - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="library/animate.css/animate.min.css" rel="stylesheet">
    <link href="library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="library/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="library/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<?php include_once "includes/search.php"; ?>

<?php include_once "includes/header.php"; ?>
<main id="main">

    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single" id="propertyName">Property Details</h1>
                        <span class="color-text-a" id="propertyAddress"></span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="property-grid.php">Properties</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                > Property Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <section class="property-single nav-arrow-b">
        <div class="container" id="property">

        </div>
    </section>

</main>

<?php include_once "includes/footer.php"; ?>
<script>
    getProperty();

    function getProperty() {
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "http://localhost/landlord/api/property/viewProperty/<?php echo $_GET['id']; ?>", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                let properties = data.data;
                let {
                    id,
                    image_path,
                    name,
                    address,
                    price,
                    bedrooms,
                    bathrooms,
                    location,
                    property_type,
                    description,
                    landlord_first_name,
                    landlord_last_name,
                    landlord_phone_number,
                    landlord_email,
                    type_name,
                    points_of_interest
                } = properties;

                document.getElementById("property").innerHTML = `<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div id="property-single-carousel" class="swiper">
                <div class="swiper-wrapper">
                    <div class="carousel-item-b swiper-slide">
                        <img src="img/slide-1.jpg" alt="Property Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Details -->
    <div class="row">
        <div class="col-sm-12">
            <div class="row justify-content-between">
                <div class="col-md-5 col-lg-4">
                    <!-- Property Price -->
                    <div class="property-price d-flex justify-content-center foo">
                        <div class="card-header-c d-flex">
                            <div class="card-box-ico">
                                <span class="bi bi-cash">£</span>
                            </div>
                            <div class="card-title-c align-self-center">
                                <h5 class="title-c">${price}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="property-summary">
                    <div class="row">
                    <div class="col-sm-12">
                      <div class="title-box-d section-t4">
                        <h3 class="title-d">Quick Summary</h3>
                      </div>
                    </div>
                  </div>
                        <div class="summary-list">
                            <ul class="list">
                                <li class="d-flex justify-content-between">
                                    <strong>Property ID:</strong>
                                    <span>${id}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Location:</strong>
                                    <span>${location}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Property Type:</strong>
                                    <span>${type_name}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Status:</strong>
                                    <span>${property_type}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Beds:</strong>
                                    <span>${bedrooms}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Baths:</strong>
                                    <span>${bathrooms}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 section-md-t3">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="title-box-d">
                      <h3 class="title-d">Property Description</h3>
                    </div>
                  </div>
                </div>
                <div class="property-description">
                  <p class="description color-text-a">
                    ${description}
                  </p>
                </div>
                <div class="row section-t3">
                  <div class="col-sm-12">
                    <div class="title-box-d">
                      <h3 class="title-d">Point of Intrest</h3>
                    </div>
                  </div>
                </div>
                <div class="amenities-list color-text-a">
                  <ul class="list-a no-margin">
                    ${points_of_interest}
                  </ul>
                </div>
              </div>
            </div>
        </div>
        <!-- Contact Agent Section -->
        <div class="col-md-12">
            <div class="row section-t3">
              <div class="col-sm-12">
                <div class="title-box-d">
                  <h3 class="title-d">Contact Landlord</h3>
                </div>
              </div>
            </div>
            <div class="row">
                <!-- Agent Image -->
                <div class="col-md-6 col-lg-4">
                    <img src="img/agent-4.jpg" alt="Agent Image" class="img-fluid">
                </div>
                <!-- Agent Details -->
                <div class="col-md-6 col-lg-4">
                    <!-- ... other elements ... -->
                    <h4 class="title-agent">${landlord_first_name} ${landlord_last_name}</h4>
                    <!-- Agent Contact Information -->
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between">
                            <strong>Phone:</strong>
                            <span class="color-text-a">${landlord_phone_number}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <strong>Email:</strong>
                            <span class="color-text-a">${landlord_email}</span>
                        </li>
                    </ul>
                    <div class="socials-a">
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="bi bi-facebook" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="bi bi-twitter" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="bi bi-instagram" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#">
                          <i class="bi bi-linkedin" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>`;
                document.getElementById("propertyAddress").innerHTML = address;
                document.getElementById("propertyName").innerHTML = name;
            }
        }
    }
</script>
</body>

</html>