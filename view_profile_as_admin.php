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
    echo "<div id='perloader'></div>";
    $id = $_GET['logout'];
    session_destroy();
    unset($id);
    header('location:./');
}


if (isset($_GET['view'])) {
    $profile_id = $_GET['view'];
    $show_profile = "SELECT * FROM `members` WHERE rol_id = '$profile_id'";

    $run_query = mysqli_query($conn, $show_profile);

    if (mysqli_num_rows($run_query) > 0) {
        $row = mysqli_fetch_assoc($run_query);
    }
}

if(isset($_GET['dl'])){
    $dlid = $_GET['dl'];
    mysqli_query($conn, "DELETE FROM `members` WHERE rol_id = '$dlid'");
    header('location:./admin.php');
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
    <link rel="stylesheet" href="./styles/profile.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <?php include './adminheader.php' ?>

    <main style="background: <?php echo $row['theme_color'] ?>;">
        <div class="img">
            <?php
            if ($row['gender'] == "male") {
                $img = "undraw_male_avatar_g98d.svg";
            }
            if ($row['gender'] == "female") {
                $img = "undraw_female_avatar_efig.svg";
            }
            ?>

            <img src="<?php echo "./siteAssets/" . $img; ?>" alt="">
        </div>

        <h1 class="name"><?php echo $row['name'] ?></h1>
        <h2>ID: <?php echo $row['rol_id'] ?></h2>
        <div class="action">
            <a class="dl" href="./view_profile_as_admin.php?dl=<?php echo $row['rol_id'] ?>"><i class="fa-solid fa-trash"></i></a>
        </div>
    </main>

    <main class="details">
        <h1>Phone: <?php echo $row['phone'] ?></h1>
        <h1>Date of Birth: <?php echo $row['dob'] ?></h1>
        <h1>Gender: <?php echo $row['gender'] ?></h1>
        <h1>Address: <?php echo $row['address'] ?></h1>
        <h1>Email: <?php echo $row['email'] ?></h1>
    </main>

    <?php include './footer.php' ?>
</body>

</html>