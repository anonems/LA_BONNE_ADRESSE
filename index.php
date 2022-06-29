<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La bonne adresse</title>
    <link rel="shortcut icon" href="data/lba/logo_app.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="manifest" href="manifest.webmanifest"> -->
    <!-- <script src="index.js" defer></script> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<header class="headbar">
    <button class="ubtn" class="add-button"><span class="material-symbols-outlined">download</span></button>
    <img src="./data/lba/logo.png" width="100px" alt="logo">
    <button class="dnmode" onclick="myFunction()"><span id="dark"
            class="material-symbols-outlined"></span></button>
    <script>
        let element = document.body;
        if (document.cookie.split(';')[0].split("=")[1] == "dark_mode") {
            document.getElementById('dark').innerHTML = 'light_mode';
            element.classList.add('dark-mode');
        } else if (document.cookie.split(';')[0].split("=")[1] == "light_mode") {
            document.getElementById('dark').innerHTML = 'dark_mode';
            element.classList.remove('dark-mode');
        }else{
            document.getElementById('dark').innerHTML = 'light_mode';
            element.classList.remove('dark-mode');

        }

        function myFunction() {
            if (document.getElementById('dark').innerText == 'light_mode') {
                document.cookie = "cmode = dark_mode";
                document.getElementById('dark').innerHTML = 'dark_mode';
                element.classList.add('dark-mode');
            } else if (document.getElementById('dark').innerText == 'dark_mode') {
                document.cookie = "cmode = light_mode";
                document.getElementById('dark').innerHTML = 'light_mode';
                element.classList.remove('dark-mode');
            }
        }
    </script>
</header>

<body>
    <!-- FEED -->
    <section class="today" id="stoday">
        <?php include('feed.php'); ?>
    </section>

    <!-- RECHERCHE -->
    <section class="schedule" id="sschedule">
        <?php include('recherche.php'); ?>
    </section>

    <!-- PROFIL -->
    <section class="setting" id="ssetting">
        <?php
            if(!isset($_SESSION['connecte'])){ 
                include('login.php');
            }elseif($_SESSION['connecte']==True){
                if($_SESSION['mode']=='comp'){
                    include('profil_comp.php');
                }
                elseif($_SESSION['mode']=='user'){
                    include('profil_user.php');
                }
            }
        ?>
        <video src=""></video>
    </section>

</body>

<footer>
    <nav class="navbar">
        <button id="today" class="nbuton"><span class="material-symbols-outlined">home</span> <span
                id="hdt">Feed</span></button>
        <button id="schedule" class="nbuton"><span class="material-symbols-outlined">search</span> <span
                id="hdt">Recherche</span></button>
        <button id="setting" class="nbuton"><span class="material-symbols-outlined">person</span> <span
                id="hdt">Profil</span></button>
    </nav>
    <script>
        let bt1 = document.getElementById("today");
        let bt2 = document.getElementById("schedule");
        let bt3 = document.getElementById("setting");
        let bt4 = document.getElementById("add_btn2");
        let s1 = document.getElementById("stoday");
        let s2 = document.getElementById("sschedule");
        let s3 = document.getElementById("ssetting");
        bt1.style.boxShadow = "0px -5px 0px 0px orange"
        bt1.style.color = "orange"

        bt1.addEventListener("click", () => {
            s1.style.display = "block";
            bt1.style.boxShadow = "0px -5px 0px 0px orange"
            bt1.style.color = "orange"
            bt2.style.color = "white"
            bt3.style.color = "white"
            bt2.style.boxShadow = "0px -5px 0px 0px var(--colortwo)"
            bt3.style.boxShadow = "0px -5px 0px 0px var(--colortwo)"
            s2.style.display = "none";
            s3.style.display = "none";
            s1.style.animation = "moveToRight 0.5s ease-in-out"
        })
        bt2.addEventListener("click", () => {
            s2.style.display = "block";
            bt2.style.boxShadow = "0px -5px 0px 0px orange"
            bt2.style.color = "orange"
            bt3.style.color = "white"
            bt1.style.color = "white"
            bt3.style.boxShadow = "0px -5px 0px 0px var(--colortwo)"
            bt1.style.boxShadow = "0px -5px 0px 0px var(--colortwo)"
            s1.style.display = "none";
            s3.style.display = "none";
            s2.style.animation = "moveToRight 0.5s ease-in-out"

        })
        bt3.addEventListener("click", () => {
            s3.style.display = "block";
            bt3.style.boxShadow = "0px -5px 0px 0px orange"
            bt3.style.color = "orange"
            bt2.style.color = "white"
            bt1.style.color = "white"
            bt2.style.boxShadow = "0px -5px 0px 0px var(--colortwo)"
            bt1.style.boxShadow = "0px -5px 0px 0px var(--colortwo)"
            s2.style.display = "none";
            s1.style.display = "none";
            s3.style.animation = "moveToRight 0.5s ease-in-out"
        })
        bt4.addEventListener("click", () => {
            s3.style.display = "block";
            bt3.style.boxShadow = "0px -5px 0px 0px orange"
            bt3.style.color = "orange"
            bt2.style.color = "white"
            bt1.style.color = "white"
            bt2.style.boxShadow = "0px -5px 0px 0px var(--colortwo)"
            bt1.style.boxShadow = "0px -5px 0px 0px var(--colortwo)"
            s2.style.display = "none";
            s1.style.display = "none";
            s3.style.animation = "moveToRight 0.5s ease-in-out"
        })
    </script>
</footer>
<!-- <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
            .then((registration) => {
                console.log('Service Worker: Registered', registration);
            });
        }
    </script> -->

</html>