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
    header .right ul li a{
        text-decoration: none;
        font-size: 25px;
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
        <i class="fa-solid fa-bars" id="tog"></i>
    </div>
    <div class="right" id="menu">
        <ul>
            <li><a href="./"><i class="fa-solid fa-power-off"></i> Login</a></li>
            <li><a href="./admin_login.php"><i class="fa-solid fa-shield"></i> Admin Login</a></li>
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