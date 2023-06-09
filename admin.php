<?php
include './configuration/configurations.php';

session_start();
$admin_id = $_SESSION['id'];

if (!isset($admin_id)) {
    header('location:./');
}

$show_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$admin_id'");

if (mysqli_num_rows($show_admin) > 0) {
    $admin = mysqli_fetch_assoc($show_admin);
}

if (isset($_GET['logout'])) {
    $id = $_GET['logout'];
    session_destroy();
    unset($id);
    header('location:./');
}


// register new admin
if (isset($_POST['regAdmin'])) {
    $admin_user = $_POST['admin_user'];
    $admin_f_name = $_POST['admin_f_name'];
    $admin_l_name = $_POST['admin_l_name'];
    $admin_pass = $_POST['admin_pass'];

    $register_admin = "INSERT INTO `admin` (username, f_name, l_name, password) VALUES('$admin_user', '$admin_f_name', '$admin_l_name', '$admin_pass')";

    if (mysqli_query($conn, $register_admin)) {
        $msg[] = "Admin Added Successfully";
    } else {
        $msg[] = "Something Went Wrong";
    }
}

// register new member
if (isset($_POST['addMember'])) {
    $member_name = $_POST['member_name'];
    $rolid = $_POST['rolid'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $pass = $_POST['pass'];
    $color = $_POST['color'];

    $add_members = "INSERT INTO `members` (rol_id, name, dob, gender, address, email, password, phone, theme_color) VALUES ('$rolid', '$member_name', '$dob', '$gender', '$address', '$email', '$pass', '$phone', '$color')";


    if (mysqli_query($conn, $add_members)) {
        $msg[] = "Members Added Successfully";
        header('location:./admin.php');
    } else {
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

    <!-- admin registration form -->
    <form action="" method="post" id="admin_form">
        <h1>Add Admin</h1>
        <i class="fa-solid fa-circle-xmark" id="close_admin"></i>
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

    <!-- members registration form -->
    <form action="" method="post" id="members_form">
        <h1>Add Members</h1>
        <i class="fa-solid fa-circle-xmark" id="close_member"></i>
        <?php

        if (isset($msg)) {
            foreach ($msg as $msg) {
                echo '<div class="msg_body">' . $msg . '</div>';
            }
        }

        ?>
        <div class="input_box">
            <input type="text" name="member_name" id="" placeholder="Name">
        </div>

        <div class="input_box">
            <input type="text" name="rolid" id="" placeholder=" Roll">
        </div>

        <div class="input_box">
            <input type="email" name="email" id="" placeholder="Email">
        </div>

        <div class="input_box">
            <input type="text" name="phone" id="" placeholder="Phone">
        </div>

        <div class="input_box">
            <input type="date" name="dob" id="" placeholder="Date of Birth">
        </div>

        <div class="input_box">
            <input type="text" name="address" id="" placeholder="Address">
        </div>

        <div class="input_box">
            <input type="color" name="color" id="" placeholder="Your Color">
        </div>

        <div class="input_box">
            <select name="gender" id="">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div class="input_box">
            <input type="password" name="pass" id="" placeholder="Password">
        </div>

        <button type="submit" name="addMember">Register Members</button>
    </form>

    <!-- <h1 class="admin">Welcome <?php echo $admin['l_name'] ?></h1> -->


    <!-- members -->
    <section class="members">
        <!-- load all members -->
        <?php
        $load_members = "SELECT * FROM `members` ORDER BY rol_id ASC";
        $load_members_query = mysqli_query($conn, $load_members);

        if (mysqli_num_rows($load_members_query) > 0) {
            while ($row = mysqli_fetch_assoc($load_members_query)) {
        ?>
                <a class="member" href="./view_profile_as_admin.php?view=<?php echo $row['rol_id']?>" style="background: <?php echo $row['theme_color']; ?>">
                    <div class="img">
                        <?php
                        if($row['gender'] == "male"){
                            $img = "undraw_male_avatar_g98d.svg";
                        }if($row['gender'] == "female"){
                            $img = "undraw_female_avatar_efig.svg";
                        }
                        ?>

                        <img src="<?php echo "./siteAssets/" . $img; ?>" alt="">
                    </div>

                    <div class="text">
                        <h1><?php echo $row['name'] ?></h1>
                        <h2>ID: <?php echo $row['rol_id'] ?></h2>
                    </div>
                </a>
        <?php
            }
        }else{
            echo "No Data Found";
        }

        ?>


    </section>

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



        // show admin add form
        const addadmin = document.getElementById("admin_form");
        const showAdminFormOption = document.getElementById("add_admin")

        showAdminFormOption.addEventListener("click", () => {
            addadmin.classList.toggle("showform")
        })

        const close_admin = document.getElementById("close_admin");

        close_admin.addEventListener("click", () => {
            addadmin.classList.remove("showform");
        })

        // show members form
        const members_form = document.getElementById("members_form");
        const showMembersFormOption = document.getElementById("add_members");

        showMembersFormOption.addEventListener("click", () => {
            members_form.classList.toggle("showform")
        })

        const close_member = document.getElementById("close_member");

        close_member.addEventListener("click", () => {
            members_form.classList.remove("showform");
        })
    </script>
</body>

</html>