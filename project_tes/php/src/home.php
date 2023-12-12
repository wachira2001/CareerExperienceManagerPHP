<?php
global $conn;
ob_start();
session_start();
require "config/config_db.php";
$strSQL = "SELECT id,name FROM customer WHERE session = '" . session_id() . "' ";
$query = @mysqli_query($conn, $strSQL);
$resultQuery = @mysqli_fetch_array($query);
print_r($resultQuery);
if ($resultQuery['id'] != "") {
    //print_r("show form");
} else {
    //print_r("go to login.php");
    @mysqli_close($conn);
    header("location: http://127.0.0.1:8090/poject/login.php");
    exit;
}
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
</head>

<body>
<header style="background-color: orange;">
    <h1>Header</h1>
</header>

<div class="row">
    <nav class="column menu" style="background-color: (224, 224, 224);">
        <h2>Menu</h2>
        <ul>
            <li><a href="#">Menu 1</a></li>
            <li><a href="#">Menu 2</a></li>
            <!-- Add more menu items here -->
        </ul>
    </nav>
    <div class="column content" style="background-color: rgb(153, 0, 0);">
        <div id="content"> <!-- แทกครอบคลุมคอนเทน -->


        </div>
    </div>
</div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
    getProductList(); //เรียกใช้ฟังก์ชั่น
    function getProductList() {
        let innerhtml = "";
        let uri = "http://localhost:8090/poject/api/get_product_list.php";
        $.ajax({
            type: "POST",
            url: uri,
            async: false,
            data: null,
            success: function (response) { //มินิฟังก์ชั่น
                // console.log(response);
                if (response.result === 1) {
                    // console.log(response.datalist);
                    // for(let i=0; i<response.datalist.le;i++){
                    //     console.log(response.datalist[i].pname);
                    // }
                    for (let i = 0; i < response.datalist.length; i++) {
                        // console.log(response.datalist[i].pname);

                        // ``เป็นสตริงหลายบรรทัด ใช้สำหรับจาวาสคริป
                        innerhtml = innerhtml + `

                         <div class='col-md-3 mb-3'>
                            <div class='card' style='background-color: #FFF; margin: 5px;'>
                                <img src='./assets/images/product-default.jpg' alt='Alternative text for the image'>
                                <p>Product Name: ${response.datalist[i].pname}</p>
                                <p>SKU: ${response.datalist[i].sku}</p>
                                <p>ID: ${response.datalist[i].id}</p>
                                <p>Price: ${response.datalist[i].price}</p>
                                <p>Number Available: ${response.datalist[i].nums}</p>
                                <p>Image ID: ${response.datalist[i].imgid}</p>
                                <p>Product Type: ${response.datalist[i].tname}</p>
                                <!-- Add other product details as needed -->
                            </div>
                        </div>
                        `;
                    }
                } else {
                    console.log(response.message);
                }
            },
            error: function (error) {
                console.log(error);

            }
        })
        document.getElementById("content").innerHTML = "<div class='row' style='padding:10px'>" + innerhtml + "</div>";
    }
</script>