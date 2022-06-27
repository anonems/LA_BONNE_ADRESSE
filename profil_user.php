<?php
$co_user ;
if(!isset($_SESSION['connecte'])){ 
    $co_user=false;
}elseif($_SESSION['connecte']==True){
    if ($_SESSION['methode']=="user" AND $_SESSION['user']==$_GET['user_id']){
        $co_user=true;


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil consommateur</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
    <!-- Logo -->
    
    <div class="profil_consommateur">
        <div class="pdp"></div>
        <text class="name_user">User</text>
    </div>
    <div class="barre">
        <button class="preferences" onclick="colorBarre()">Préférences</button>
        <button class="suggestions" onclick="colorBarre()">Suggestions</button>

    </div>
    <section id="div1">
        <div class="pref_user">
            <button class="pref1" onclick="changeColorPref1()">Préférence 1</button>
            <button class="pref2" onclick="changeColorPref2()">Préférence 2</button>
            <button class="pref3" onclick="changeColorPref3()">Préférence 3</button>
            <button class="pref4" onclick="changeColorPref4()">Préférence 4</button>
            <button class="pref5" onclick="changeColorPref5()">Préférence 5</button>
            <button class="pref6" onclick="changeColorPref6()">Préférence 6</button>
            <button class="pref7" onclick="changeColorPref7()">Préférence 7</button>
            <button class="pref8" onclick="changeColorPref8()">Préférence 8</button>
            <button class="pref9" onclick="changeColorPref9()">Préférence 9</button>
        </div>
    </section>
    <section id="div2" >
        <div class="suggestion_page">
            <div class="suggestions_artisan">
                <div class="pdp1"></div>
                <div class="info_artisan">
                    <div class="name1">Artisan 1</div>
                    <div class="adresse1">123 adresse, Paris</div>
                </div>
            </div>
        </div>
        
        <div class="suggestions_artisan">
            <div class="pdp2"></div>
            <div class="info_artisan">
                <div class="name2">Artisan 2</div>
                <div class="adresse2">456 adresse, Paris</div>
            </div>
        </div>

        <div class="suggestions_artisan">
            <div class="pdp3"></div>
            <div class="info_artisan">
                <div class="name3">Artisan 3</div>
                <div class="adresse3">789 adresse, Paris</div>
            </div>
        </div>
    </div>
    </section>

    <script>
        let btnPref1 = document.querySelector('.pref1');
        let btnPref2 = document.querySelector('.pref2');
        let btnPref3 = document.querySelector('.pref3');
        let btnPref4 = document.querySelector('.pref4');
        let btnPref5 = document.querySelector('.pref5');
        let btnPref6 = document.querySelector('.pref6');
        let btnPref7 = document.querySelector('.pref7');
        let btnPref8 = document.querySelector('.pref8');
        let btnPref9 = document.querySelector('.pref9');
        let btnPref10 = document.querySelector('.pref10');

        let btnPref = document.querySelector('.preferences');
        let btnSuggestions = document.querySelector('.suggestions')
        let btnChangeSect = document.querySelector('#div1');
        let btnChangeSect2 = document.querySelector('#div2');

        btnChangeSect2.style.display = "none";
        btnChangeSect.style.display = "block";
        btnPref.style.color = "white";

        btnSuggestions.onclick = function() {
            btnChangeSect.style.display = "none";
            btnChangeSect2.style.display = "block";
            btnSuggestions.style.color = "white";
            btnPref.style.color = "black";
            btnPref.style.backgroundColor = "#EEEEE4"
            btnSuggestions.style.backgroundColor = "#EC662B"
        }

        btnPref.onclick = function() {
            btnChangeSect2.style.display = "none";
            btnChangeSect.style.display = "block";
            btnSuggestions.style.color = "black";
            btnPref.style.color = "white";
            btnSuggestions.style.backgroundColor = "#EEEEE4"
            btnPref.style.backgroundColor = "#EC662B"
        }

        let compteur = 0;
        function changeColorPref1() {
            if (compteur == 0) {
                btnPref1.style.backgroundColor = "#EC662B";
                btnPref1.style.color = "white";
                compteur = 1;
            } else {
                btnPref1.style.backgroundColor = "#EEEEE4";
                btnPref1.style.color = "black";
                compteur = 0;
            }
        }

        let compteur2 = 0;
        function changeColorPref2() {
            if (compteur2 == 0) {
                btnPref2.style.backgroundColor = "#EC662B";
                btnPref2.style.color = "white";
                compteur2 = 1;
                } else {
                    btnPref2.style.backgroundColor = "#EEEEE4";
                    btnPref2.style.color = "black";
                    compteur2 = 0;
                }
        }

        let compteur3 = 0;
        function changeColorPref3() {
            if (compteur3 == 0) {
                btnPref3.style.backgroundColor = "#EC662B";
                btnPref3.style.color = "white";
                compteur3 = 1;
                } else {
                    btnPref3.style.backgroundColor = "#EEEEE4";
                    btnPref3.style.color = "black";
                    compteur3 = 0;
                }
        }

        let compteur4 = 0;
        function changeColorPref4() {
            if (compteur4 == 0) {
                btnPref4.style.backgroundColor = "#EC662B";
                btnPref4.style.color = "white";
                compteur4 = 1;
                } else {
                    btnPref4.style.backgroundColor = "#EEEEE4";
                    btnPref4.style.color = "black";
                    compteur4 = 0;
                }
        }

        let compteur5 = 0;
        function changeColorPref5() {
            if (compteur5 == 0) {
                btnPref5.style.backgroundColor = "#EC662B";
                btnPref5.style.color = "white";
                compteur5 = 1;
                } else {
                    btnPref5.style.backgroundColor = "#EEEEE4";
                    btnPref5.style.color = "black";
                    compteur5 = 0;
                }
        }

        let compteur6 = 0;
        function changeColorPref6() {
            if (compteur6 == 0) {
                btnPref6.style.backgroundColor = "#EC662B";
                btnPref6.style.color = "white";
                compteur6 = 1;
                } else {
                    btnPref6.style.backgroundColor = "#EEEEE4";
                    btnPref6.style.color = "black";
                    compteur6 = 0;
                }
        }

        let compteur7 = 0;
        function changeColorPref7() {
            if (compteur7 == 0) {
                btnPref7.style.backgroundColor = "#EC662B";
                btnPref7.style.color = "white";
                compteur7 = 1;
                } else {
                    btnPref7.style.backgroundColor = "#EEEEE4";
                    btnPref7.style.color = "black"
                    compteur7 = 0;
                }
        }

        let compteur8 = 0;
        function changeColorPref8() {
            if (compteur8 == 0) {
                btnPref8.style.backgroundColor = "#EC662B";
                btnPref8.style.color = "white";
                compteur8 = 1;
                } else {
                    btnPref8.style.backgroundColor = "#EEEEE4";
                    btnPref8.style.color = "black";
                    compteur8 = 0;
                }
        }

        let compteur9 = 0;
        function changeColorPref9() {
            if (compteur9 == 0) {
                btnPref9.style.backgroundColor = "#EC662B";
                btnPref9.style.color = "white";
                compteur9 = 1;
                } else {
                    btnPref9.style.backgroundColor = "#EEEEE4";
                    btnPref9.style.color = "black";
                    compteur9 = 0;
                }
        }
    </script>

</body>
</html>
<?php
    }
}
?>