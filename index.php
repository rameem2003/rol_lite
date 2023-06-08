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
    <?php include './loginPageHeader.php' ?>

    <form action="" method="post">
        <h1>Login</h1>
        <div class="input_box">
            <input type="email" name="login_email" id="" placeholder="Email">
            <i class="fa-solid fa-envelope"></i>
        </div>


        <div class="input_box">
            <input type="password" name="login_pass" id="password" placeholder="Password">
            <i class="fa-solid fa-lock"></i>
            <i class="fa-solid fa-eye tog" id="passtog"></i>
        </div>

        <button type="submit" name="login">Login</button>
    </form>

    <?php include './footer.php' ?>

    <script>
        const password = document.getElementById("password");
        const passtog = document.getElementById("passtog");


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
    </script>
</body>

</html>