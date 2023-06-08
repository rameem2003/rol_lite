<style>
    header{
        background-color: #10264B;
        padding: 20px;
    }

    header .left{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }

    header .left img{
        width: 20%;
    }

    header .left i{
        color: white;
        font-size: 30px;
    }

    header .left h1{
        color: white;
        font-family: cursive;
    }

    header .right {
        position: absolute;
        width: 70%;
        background-color: white;
        height: 100vh;
        top: 0;
        left: -100%;
        padding: 20px;
        transition: 0.5s linear;
        z-index: 10000000000;
    }

    header .right.show{
        left: 0;
    }

    header .right ul{
        list-style-type: none;
    }

    header .right li{
        margin-bottom: 10px;
    }
    header .right ul li a{
        text-decoration: none;
        font-size: 20px;
        color: black;
        margin-bottom: 20px;
        display: block;
        font-weight: bold;
    }
</style>
<header>
    <div class="left">
        <img src="./siteAssets/ROL1.png" alt="">
        <h1>ROL Lite</h1>
        <i class="fa-solid fa-user" id="tog"></i>
    </div>
    <div class="right" id="menu">
        <ul>
            <li>Hello</li>
            <li><h1><?php echo $admin['l_name'] ?></h1></li>
            <li><a href="./admin.php?logout=<?php $admin['id'] ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout Admin</a></li>
        </ul>
    </div>
</header>


<script>
    const tog = document.getElementById("tog");
    const menu = document.getElementById("menu");


    tog.addEventListener("click", () => {
        menu.classList.toggle("show");
    })
</script>