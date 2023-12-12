<?php
    session_start();
    // print_r(session_id());
    // exit();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <div class="row" align="center" style="background-color:rgb(38, 70, 83); ">
        <div class="column content">
            <div class="container" align="center">
                <div class="row justify-content-center">
                    <div class="col-6" style="grid-row: 3 ;background-color:rgb(231, 111, 81)">
                        <div>
                            <img src="https://png.pngtree.com/png-vector/20221215/ourmid/pngtree-school-logo-design-png-image_6524414.png" alt="Girl in a jacket" height="250px">
                        </div>
                        <h2>
                            เข้าสู่ระบบ
                        </h2>
                        <br>
                        <form>
                            <div class="input-group">
                                <span for="username" class="input-group-text" id="addon-wrapping">ชื่อผู้ใช้</span>
                                <input type="text" class="form-control" placeholder="Username" aria-label="Username" id="username">
                            </div>
                            <br>
                            <div class="input-group">
                                <span for="password" class="input-group-text" id="addon-wrapping">รหัสผ่าน</span>
                                <input type="text" class="form-control" placeholder="password" aria-label="password" id="password">
                            </div>
                            <br>
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
                            LOGIN
                            </button> -->

                            <div class="space box" align="center">
                            <button type="button" class="btn btn-primary" style="padding: 10px 20px 10px 20px" onclick="login()">Login</button>
                            </div>



                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <b>ล่าง</b>
    </footer>


</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type=text/javascript>
    var session = "<?php echo session_id(); ?>";
    function login(){
        let username;
        let password;
        username = document.getElementById("username").value;
        password=document.getElementById("password").value;
        let request_data = {
            "email":username,
            "password":password,
            "session":session
        }
        console.log(request_data);
        let uri = "http://localhost:8090/poject/api/get_customer_login.php";
        //url = Uniform Resource Locator
        //uri = Uniform Resource Identifie
        $.ajax({
            type:"POST",
            url:uri,
            async:false,
            data:JSON.stringify(request_data),
            success:function(response){
                console.log("connect success...");
                console.log(response);
                console.log(response.result);
                console.log(response.message);
                if(response.result===1){
                    //console.log("go to home.php");
                    window.location.replace("http://127.0.0.1:8090/poject/home.php");
                }else{
                    //console.log("go to login.php");
                    document.getElementById("username").value ="";
                    document.getElementById("password").value ="";
                    document.getElementById("username").focus();
                    alert("เข้าสู่ระบบไม่สำเร็จ");
                }
            },error:function(error){
                console.log(error);
            }
        });

    }
</script>