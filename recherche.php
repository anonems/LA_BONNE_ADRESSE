<?php
$bdd = new PDO('mysql:host=localhost; dbname=lba;','root','');
$allmembers = $bdd->prepare('SELECT * FROM comp_infos ORDER BY comp_id DESC');
if(isset($_GET['research']) AND !empty($_GET['research'])){
    $search = htmlspecialchars($_GET['research']);    
    $allmembers = $bdd->query('SELECT * FROM comp_infos WHERE comp_categ Like "%' .$search.'%" or comp_name LIKE "%' .$search.'%" ORDER BY comp_id DESC');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <!-- Logo -->
    <form method="GET">
    <input type="search" id="searchbar" placeholder="Recherche"><br>
    <div id="trait_dessus"></div>
    <ul id="menu">
        <li id="distance"><a>Distance</a>
            <ul>
                <li>
                    <a href="recherche?=e.php">
                       <div>
                           <button type="button" class="boutton_recherche">0-100m</button>
                        </div>
                    </a>
                </li>
                <li>
                    <a value="100-300m">
                        <div>
                           <button type="button" class="boutton_recherche">100-300m</button>
                        </div>
                    </a>
                </li>
                <li><a value ="300-500m">
                        <div>
                           <button type="button" class="boutton_recherche">300-500m</button>
                        </div>
                    </a>
                </li>
            </ul>
        </li>  
        <li id="theme"><a>Theme</a>
            <ul>
                <li><a value="degustation">
                        <div>
                           <button type="button" class="boutton_recherche">Degustation</button>
                        </div>
                    </a>
                </li>
                <li><a value="promotion">
                        <div>
                           <button type="button" class="boutton_recherche">Promotion</button>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div id="trait_bas"></div>

    <!-- <form method="GET">
        <input type="search" name="research" placeholder="Rechercher un membre">
        <input type="submit" value="recherche">-->
    </form> 


    <section class="afficher_membres">
        <?php
            if($allmembers->rowCount() > 0){
                while($member = $allmembers->fetch()){
                    ?>
                    <p><?= $member['comp_name'];?></p>
                    <p><?= $member['comp_adress_nb'];?></p>
                    <p><?= $member['comp_adress_ext'];?></p>
                    <p><?= $member['comp_adress_name'];?></p>


                    <?php
                }
            }
            ?>
    </section>

    
</body>
</html>