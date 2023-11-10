<?php include_once "function.php"; ?>
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault"
                aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand text-brand" href="index.php">Estate<span class="color-b">Elite</span></a>

        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="property-grid.php">Property</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="contact.php">Contact</a>
                </li>
                <?php if (isAdmin()) { ?>
                    <li class="nav-item">
                        <a class="nav-link " href="admin-dashboard.php">Admin Dashboard</a>
                    </li>
                <?php } ?>
                <?php if (isLandlord()) { ?>
                    <li class="nav-item">
                        <a class="nav-link " href="landlord-dashboard.php">Landlord Dashboard</a>
                    </li>
                <?php } ?>

                <?php if (isLogin()) { ?>
                    <li class="nav-item">
                        <a class="nav-link " href="logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link " href="login.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01">
            <i class="bi bi-search"></i>
        </button>

    </div>

</nav>