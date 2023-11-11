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

    <section class="section-users section-t8">
        <div class="container mt-5">
            <div class="row mb-4">
                <div class="col-lg-12 d-flex justify-content-end pb-3">
                    <a href="admin-create-users.php" class="btn btn-success">Add New</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            User Management
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="users">
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
    getUsers();

    function getUsers() {
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "http://localhost/landlord/api/admin/getUsers", true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                let users = data.data;
                let html = "";

                for (let i = 0; i < users.length; i++) {
                    html += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${users[i].first_name} ${users[i].last_name}</td>
                            <td>${users[i].email}</td>
                            <td>${users[i].role_name}</td>
                            <td>
                                <button class="btn btn-primary btn-sm">Edit</button>
                                <button class="btn btn-info btn-sm">View</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>`
                }
                document.getElementById("users").innerHTML = html;
            }
        }
    }
</script>
</body>

</html>