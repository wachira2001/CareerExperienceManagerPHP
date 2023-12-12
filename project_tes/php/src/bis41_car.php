<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
    <title>แสดงยี่ห้อรถ</title>
</head>
<body>
<h1>เรียกข้อมูลจาก API bis41_get_car</h1>
<h3>รหัสประจำตัว 65342310016-1</h3>
<h3>ชื่อ วชิระ  บุญปก</h3>
<h3>กลุ่มเรียน BIS4R1</h3>
<select id="series">
    <option value="HONDA">HONDA</option>
    <option value="TOYOTA">TOYOTA</option>
<!--    <option value="NISSAN">NISSAN</option>-->
</select>
<button type="button" onclick="SHOW_car()">แสดงข้อมูล</button>
</body>
</html>
<script type=text/javascript>
    function SHOW_car() {
        let series;
        series = document.getElementById("series").value;
        let data={
            "band": series
        }
        let uri = "http://localhost:8090/poject/api/bis41_get_car.php";
        $.ajax({
            type: "POST",
            url: uri,
            async: false,
            data:JSON.stringify(data),
            success: function(response) {
                if(response.result === 1){
                    console.log(response.datalist);
                }else{
                    console.log(response.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        })
    }
</script>