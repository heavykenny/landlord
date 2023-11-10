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
            <div class="row mb-4">
                <div class="col-lg-12 d-flex justify-content-end pb-3">
                    <a href="admin-create-users.php" class="btn btn-success">Add New</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Landlords Management
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Properties</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="landlords">
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>johndoe@example.com</td>
                                    <td>5</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-info btn-sm">View</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
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
    getLandlords();
    function getLandlords() {
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "http://localhost/landlord/api/admin/getLandlords", true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                let landlords = data.data;
                let html = "";

                for (let i = 0; i < landlords.length; i++) {
                    html += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${landlords[i].first_name} ${landlords[i].last_name}</td>
                            <td>${landlords[i].email}</td>
                            <td>${landlords[i].properties}</td>
                            <td>
                                <button class="btn btn-primary btn-sm">Edit</button>
                                <button class="btn btn-info btn-sm">View</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>`
                }
                document.getElementById("landlords").innerHTML = html;
            }
        }
    }
</script>
</body>

</html>