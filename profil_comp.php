<?php
$co_comp ;
if(!isset($_SESSION['connecte'])){ 
    $co_comp=false;
}elseif($_SESSION['connecte']==True){
    if ($_SESSION['mode']=="comp"){
        $co_comp=true;

    }

    $maRequete2 = $pdo->prepare("SELECT * FROM comp_infos WHERE comp_id = :id_user ");
    $maRequete2->execute(['id_user' => $_SESSION['username']]);
    $ok = $maRequete2->fetch(); 
?>
<link rel="stylesheet" href="css/style.css">
<div class="cp" >
    <span style="display:flex; align-items:center">
        <img class="profil__img" src="data/comp/<?=$_SESSION['username']?>/profilimg.png" alt="image_entreprise">
        <b style=" font-size:20px; margin-left:10px"><?=$ok['comp_name']?></b>
    </span>
    <a href="logout.php" style="text-decoration:none" class="material-symbols-outlined">logout</a>

        <h3 class="profil__subtitle">Description</h3>
    <p class="profil__description"><?=$ok['comp_desc']?></p>
    <h3 class="profil__subtitle">Site internet</h3>
    <p class="profil__description"><?=$ok['comp_website']?></p>
    <h3 class="profil__subtitle">Adresse</h3>
    <p class="profil__description"><?=$ok['comp_adress_nb']?> <?=$ok['comp_adress_ext']?> <?=$ok['comp_adress_name']?>, <?=$ok['comp_adress_cp']?> <?=$ok['comp_adress_city']?> </p>
    <?php if($co_comp==true ){ ?>
        <center><button style="width:auto;height:auto;padding:15px;margin-bottom:30px" class="Validation_connexion_Artisan">
        AJOUTER UNE<br>NOUVELLE PUBLICATION
    </button></center>
        <?php
    }?>
  

    <hr>

    <h3 class="profil__subtitle">Posts récents</h3>
   
<?php
            require('cobdd.php');
            $maRequete = $pdo->prepare("SELECT * FROM post_infos ORDER BY post_date DESC");
            $maRequete->execute();
            $postes = $maRequete->fetchAll(PDO::FETCH_ASSOC);

            if ($postes){
            foreach($postes as $poste): 
                    $maRequete1 = $pdo->prepare("SELECT * FROM comp_infos WHERE comp_id=:userp ");
                    $maRequete1->execute(['userp'=> $poste["post_comp_id"]]);
                    $postes1 = $maRequete1->fetch();
                    if($_SESSION['username']==$poste['post_comp_id']){
            ?>
            <div class="post"  >
                <div class="postProfile">
                    <img src="data/comp/<?= $poste["post_comp_id"] ?>/profilimg.png" alt="img-de-profil" />
                </div>

                <div class="postBody">
                    <div class="postHeader">
                        <div class="postUsername">
                            <h3> 
                            <a style="text-decoration:none;" href="profil_comp.php?user=<?=$poste['post_comp_id']?>"><span class="pseudo"  ><?= $postes1["comp_name"] ?></span></a>
                            </h3>
                        </div>

                    <?php if (isset($poste["post_img"])){?>
                    <img class="imgfeed" src="<?=$poste["post_img"]?>" alt="" > 
                    <?php } ?>

                        <div class="postDescription">
                        <h2 style="color:orange"><?=$poste["post_tag"]?></h2>

                            <p><?= $poste["post_content"] ?></p>
                        </div>
                    </div>

                    

                    <div class="postFooter">
                    <?php if($co){if($poste['post_comp_id']===$_SESSION['username']){ ?><form method="post"><input type="hidden" name="idd" value="<?= $poste["id"] ?>"> <button style="background-color:transparent; border:none"  name='deld' type="submit" class="material-symbols-outlined"> delete </button> <?php } } ?>
                    <button onclick="fcopy('<?=$poste['post_img']?>')" id="share_btn" class="material-symbols-outlined"> share </button>                  
                    <?= $poste["post_date"] ?>    
                </div>
                </div>
            </div>
            <script>
                function fcopy(copyText) {
                    navigator.clipboard.writeText(copyText);
                    // alert("Copied the text: " + copyText);
                }
            </script>
            <?php  
                    };
            endforeach;    
            }else{echo 'aucun post';}
        }?>    
</div>
</div>