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
                            <div id="inquiries-list" class="list-group">
                                <!-- Inquiries will be dynamically inserted here -->
                            </div>
                            <!-- Response Area -->
                            <div class="response-area mt-4">
                                <textarea class="form-control" id="responseText" rows="3"
                                          placeholder="Type your response..."></textarea>
                                <button class="btn btn-primary btn-sm mt-2" onclick="sendResponse()">Send</button>
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
    fetchInquiries();

    function fetchInquiries() {
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "http://localhost/landlord/api/inquiries/getMessages2/<?=$_GET["propertyId"] ."?tenantId=". $_GET["tenantId"]?>", true);
        ajax.setRequestHeader("Bearer", "<?=getToken() ?>");
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                let inquiries = data.data;
                let html = "";
                for (let inquiry of inquiries) {
                    html += `<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">${inquiry.tenant_first_name + " " + inquiry.tenant_last_name}</h5>
                                    <small>${inquiry.created_at}</small>
                                </div>
                                <p class="mb-1">${inquiry.message}</p>
                            </a>`;
                }
                document.getElementById("inquiries-list").innerHTML = html;
            }
        }
    }

    function sendResponse() {
        let responseText = document.getElementById("responseText").value;
        let propertyId = <?=$_GET["propertyId"]?>;
        let tenantId = <?=$_GET["tenantId"]?>;
        let ajax = new XMLHttpRequest();
        ajax.open("POST", "http://localhost/landlord/api/inquiries/replyInquiry", true);
        ajax.setRequestHeader("Content-Type", "application/json");
        ajax.setRequestHeader("Bearer", "<?=getToken() ?>");
        ajax.send(JSON.stringify({
            property_id: propertyId,
            tenant_id: tenantId,
            message: responseText,
        }));
        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                if (data.status) {
                    fetchInquiries();
                    document.getElementById("responseText").value = "";
                }
            }
        }
    }
</script>

</body>

</html>