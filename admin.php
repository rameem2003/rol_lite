<?php 
include './configuration/configurations.php';

session_start();
$admin_id = $_SESSION['id'];

if(!isset($admin_id)){
    header('location:./');
}

$show_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$admin_id'");

if(mysqli_num_rows($show_admin) > 0){
    $admin = mysqli_fetch_assoc($show_admin);
}

if(isset($_GET['logout'])){
    $id = $_GET['logout'];
    session_destroy();
    unset($id);
    header('location:./');
}


// register new admin
if(isset($_POST['regAdmin'])){
    $admin_user = $_POST['admin_user'];
    $admin_f_name = $_POST['admin_f_name'];
    $admin_l_name = $_POST['admin_l_name'];
    $admin_pass = $_POST['admin_pass'];

    $register_admin = "INSERT INTO `admin` (username, f_name, l_name, password) VALUES('$admin_user', '$admin_f_name', '$admin_l_name', '$admin_pass')";

    if(mysqli_query($conn, $register_admin)){
        $msg[] = "Admin Added Successfully";
    }else{
        $msg[] = "Something Went Wrong";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROL Login System</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/form.css">
    <link rel="stylesheet" href="./styles/admin.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include './adminheader.php' ?>

    <button type="button" class="admin_menu"><i class="fa-sharp fa-solid fa-bars"></i></button>

    <ul class="admin_option">
        <li id="add_members">Add Members</li>
        <li id="add_admin">Add Admin</li>
    </ul>

    <form action="" method="post" id="admin_form">
        <h1>Add Admin</h1>
        <?php

        if (isset($msg)) {
            foreach ($msg as $msg) {
                echo '<div class="msg_body">' . $msg . '</div>';
            }
        }
        
        ?>
        <div class="input_box">
            <input type="text" name="admin_f_name" id="" placeholder="First Name">
        </div>

        <div class="input_box">
            <input type="text" name="admin_l_name" id="" placeholder="Last Name">
        </div>

        <div class="input_box">
            <input type="text" name="admin_user" id="" placeholder="Username">
            <i class="fa-solid fa-user"></i>
        </div>


        <div class="input_box">
            <input type="password" name="admin_pass" id="password" placeholder="Password">
            <i class="fa-solid fa-lock"></i>
            <i class="fa-solid fa-eye tog" id="passtog"></i>
        </div>

        <button type="submit" name="regAdmin">Register Admin</button>
    </form>

    <?php include './footer.php' ?>











    <script>
        const password = document.getElementById("password");
        const passtog = document.getElementById("passtog");

        const admin_menu = document.querySelector(".admin_menu");
        const admin_option = document.querySelector(".admin_option")


        // password show/hide
        passtog.addEventListener("click", () => {
            if (password.type === "password") {
                password.type = "text";
                passtog.classList.replace("fa-eye", "fa-eye-slash")
            } else {
                password.type = "password";
                passtog.classList.replace("fa-eye-slash", "fa-eye")
            }
        })

        // show admin menu
        admin_menu.addEventListener("click", () => {
            admin_option.classList.toggle("show_admin_menu");
        })


        // show admin add form
        const addadmin = document.getElementById("admin_form");
        const showAdminFormOption = document.getElementById("add_admin")

        showAdminFormOption.addEventListener("click" ,() => {
            addadmin.classList.toggle("showform")
        })
    </script>
</body>

</html>