<?php
include './configuration/configurations.php';

session_start();
$rol_id = $_SESSION['rol_id'];

if (!isset($rol_id)) {
    header('location:login.php');
}

$show_profile = "SELECT * FROM `members` WHERE rol_id = '$rol_id'";

$run_query = mysqli_query($conn, $show_profile);

if (mysqli_num_rows($run_query) > 0) {
    $row = mysqli_fetch_assoc($run_query);
}

// register new member
if (isset($_POST['update'])) {
    $member_name = $_POST['member_name'];
    $rolid = $_POST['rolid'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $pass = $_POST['pass'];
    $color = $_POST['color'];

    $update_member = "UPDATE `members` SET rol_id = '$rol_id', name = '$member_name', dob = '$dob', gender = '$gender', address = '$address', password = '$pass', phone = '$phone', theme_color = '$color' WHERE rol_id = '$rol_id'";


    if (mysqli_query($conn, $update_member)) {
        $msg[] = "Members Added Successfully";
        header('location:./login.php');
    } else {
        $msg[] = "Something Went Wrong";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROL Login System</title>

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/form.css">
    <link rel="stylesheet" href="./styles/admin.css">
    <link rel="stylesheet" href="./styles/profile.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #members_form{
            position: static;
            transform: translateX(0);
        }
    </style>
</head>

<body>
    <?php include './profileHeader.php' ?>

    <!-- members update form -->
    <form action="" method="post" id="members_form">
        <h1>Update</h1>
        <?php

        if (isset($msg)) {
            foreach ($msg as $msg) {
                echo '<div class="msg_body">' . $msg . '</div>';
            }
        }

        ?>
        <div class="input_box">
            <input type="text" name="member_name" id="" placeholder="Name" value="<?php echo $row['name'] ?>" required>
        </div>

        <div class="input_box">
            <input type="text" name="rolid" id="" placeholder="Roll" value="<?php echo $row['rol_id'] ?>" required>
        </div>

        <div class="input_box">
            <input type="text" name="phone" id="" placeholder="Phone" value="<?php echo $row['phone'] ?>" required>
        </div>

        <div class="input_box">
            <input type="date" name="dob" id="" placeholder="Date of Birth" value="<?php echo $row['dob'] ?>" required>
        </div>

        <div class="input_box">
            <input type="text" name="address" id="" placeholder="Address" value="<?php echo $row['address'] ?>" required>
        </div>

        <div class="input_box">
            <input type="color" name="color" id="" placeholder="Your Color" required>
        </div>

        <div class="input_box">
            <select name="gender" id="" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div class="input_box">
            <input type="password" name="pass" id="" placeholder="Password"  required>
        </div>

        <button type="submit" name="update">Update</button>
    </form>

</body>

</html>