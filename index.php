<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROL Login System</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/form.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include './header.php' ?>

    <!-- members -->
    <section class="members">
        <!-- load all members -->
        <?php
        include './configuration/configurations.php';
        $load_members = "SELECT * FROM `members` ORDER BY rol_id ASC";
        $load_members_query = mysqli_query($conn, $load_members);

        if (mysqli_num_rows($load_members_query) > 0) {
            while ($row = mysqli_fetch_assoc($load_members_query)) {
        ?>
                <a class="member" href="./view_profile.php?view=<?php echo $row['rol_id'] ?>" style="background: <?php echo $row['theme_color']; ?>">
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

                    <div class="text">
                        <h1><?php echo $row['name'] ?></h1>
                        <h2>ID: <?php echo $row['rol_id'] ?></h2>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "No Data Found";
        }

        ?>


    </section>

    <?php include './footer.php' ?>
</body>

</html>