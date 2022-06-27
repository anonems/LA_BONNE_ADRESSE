<?php
$co_comp ;
if(!isset($_SESSION['connecte'])){ 
    $co_comp=false;
}elseif($_SESSION['connecte']==True){
    if ($_SESSION['methode']=="comp"){
        $co_comp=true;

    }
}
?>
<link rel="stylesheet" href="css/style.css">
<div class="cp" >
    <span style="display:flex; align-items:center">
        <img class="profil__img" src="https://cdn.pixabay.com/photo/2019/02/12/07/39/profile-picture-3991604_1280.jpg" alt="image_entreprise">
        <b style=" font-size:20px; margin-left:10px">Leblanc Légumes</b>
    </span>

        <h3 class="profil__subtitle">Description</h3>
    <p class="profil__description">Vente de fruits et légumes en tout 
        genre</p>
    <h3 class="profil__subtitle">Site internet</h3>
    <p class="profil__description">leblanclegumes.fr</p>
    <h3 class="profil__subtitle">Adresse</h3>
    <p class="profil__description">89 Impasse LeDuc, Paris</p>
    <?php if($co_comp==true ){ ?>
        <center><button class="button button--flex">
        AJOUTER UNE<br>NOUVELLE PUBLICATION
    </button></center>
        <?php
    }?>
  

    <hr>

    <h3 class="profil__subtitle">Posts récents</h3>
    <img class="feed__img" src="https://cdn.pixabay.com/photo/2022/06/22/10/47/cheetah-7277665_1280.jpg" alt="image_entreprise__feed">
    </div>
</div>