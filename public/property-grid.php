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

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Our Amazing Properties</h1>
                        <span class="color-text-a">Properties</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Properties
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <section class="property-grid grid">
        <div class="container">
            <div class="row" id="properties">

            </div>
        </div>
    </section>

</main>


<?php include_once "includes/footer.php"; ?>
<script>
    getProperties();

    function getProperties() {
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "http://localhost/landlord/api/property/viewProperties", true);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                let properties = data.data;
                let html = "";
                for (let i = 0; i < properties.length; i++) {
                    const {
                        id,
                        image_path,
                        name,
                        price,
                        bedrooms,
                        bathrooms,
                        location,
                        property_type,
                        landlord_first_name,
                        landlord_last_name
                    } = properties[i];

                    html += `
        <div class="col-md-4">
    <div class="card-box-a card-shadow">
        <div class="img-box-a">
            <img src="img/property-1.jpg" alt="" class="img-a img-fluid">
        </div>
        <div class="card-overlay">
            <div class="card-overlay-a-content">
                <div class="card-header-a">
                    <h2 class="card-title-a">
                        <a href="property-single.php?id=${id}">${name}
                            <br/> ${location}</a>
                    </h2>
                </div>
                <div class="card-body-a">
                    <div class="price-box d-flex">
                        <span class="price-a">${property_type} | £ ${price}</span>
                    </div>
                    <a href="property-single.php?id=${id}" class="link-a">Click here to view
                        <span class="bi bi-chevron-right"></span>
                    </a>
                </div>
                <div class="card-footer-a">
                    <ul class="card-info d-flex justify-content-around">
                        <li>
                            <h4 class="card-info-title">Beds</h4>
                            <span>${bedrooms}</span>
                        </li>
                        <li>
                            <h4 class="card-info-title">Baths</h4>
                            <span>${bathrooms}</span>
                        </li>
                        <li>
                            <h4 class="card-info-title">Listed By</h4>
                            <span>${landlord_first_name} ${landlord_last_name}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    `;
                }

                document.getElementById("properties").innerHTML = html;
            }
        }
    }
</script>

</body>
</html>