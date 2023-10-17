<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Consumer</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<button id="fetchDataBtn">Fetch Data</button>
<div id="responseMessage"></div>
<pre id="responseData"></pre>

<!--<script>-->
<!--    $('#fetchDataBtn').click(function() {-->
<!--        $.ajax({-->
<!--            url: '/path/to/your/api/endpoint',-->
<!--            method: 'GET',-->
<!--            dataType: 'json',-->
<!--            success: function(response) {-->
<!--                $('#responseMessage').text(response.message);-->
<!--                $('#responseData').text(JSON.stringify(response.data, null, 4));-->
<!--            },-->
<!--            error: function() {-->
<!--                $('#responseMessage').text("Error fetching data.");-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->
</body>
</html>
