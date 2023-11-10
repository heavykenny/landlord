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
    <section class="section-t8">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Inquiries Management
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Property</th>
                                    <th>Inquirer</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="inquiries">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include_once "includes/footer.php"; ?>

<script>
    getInquiries();

    function getInquiries() {
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "http://localhost/landlord/api/inquiries/getLandlordInquiries/<?=$_GET["propertyId"]?>", true);
        ajax.setRequestHeader("Bearer", "<?=getToken() ?>");
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                let inquiries = data.data;
                let html = "";
                for (let i = 0; i < inquiries.length; i++) {
                    const {
                        id,
                        property_name,
                        tenant_first_name,
                        tenant_last_name,
                        property_id,
                        tenant_id
                    } = inquiries[i];

                    html += `<tr>
                                <td>${i + 1}</td>
                                <td>${property_name}</td>
                                <td>${tenant_first_name + " " + tenant_last_name}</td>
                                <td>
                                    <a href="landlord-view-inquiries.php?propertyId=${property_id}&tenantId=${tenant_id}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>`;
                }

                document.getElementById("inquiries").innerHTML = html;
            }
        }
    }
</script>

</body>

</html>