<?php
$co_comp ;
if(!isset($_SESSION['connecte'])){ 
    $co_comp=false;
}elseif($_SESSION['connecte']==True){
    if ($_SESSION['mode']=="comp"){
        $co_comp=true;

    }
 }
    $maRequete2 = $pdo->prepare("SELECT * FROM comp_infos WHERE comp_id = :id_user ");
    $maRequete2->execute(['id_user' => $_SESSION['username']]);
    $ok = $maRequete2->fetch(); 
    if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['content_npa']))) {
        $post_desc = filter_input(INPUT_POST, "post_desc");
        $post_img = filter_input(INPUT_POST, "post_img");
        $post_categ = filter_input(INPUT_POST, "post_categ");
        $maRequete = $pdo->prepare("INSERT INTO post_infos (post_content,post_tag,post_img,post_comp_id) VALUES (:post_desc,:post_categ,:post_img,:post_comp_id) ");
        $maRequete->execute(array(
            'post_desc'=>$post_desc,
            'post_categ'=>$post_categ,
            'post_img'=>$post_img,
            'post_comp_id'=>$_SESSION['username']
        ));
    }
    else if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['content_edit_p']))) {
        $title = filter_input(INPUT_POST, "title");
        $username = filter_input(INPUT_POST, "username");
        $phone = filter_input(INPUT_POST, "phone");
        $website = filter_input(INPUT_POST, "website");
        $desc = filter_input(INPUT_POST, "desc");
        $ad_nb = filter_input(INPUT_POST, "ad_nb");
        $ad_ext = filter_input(INPUT_POST, "ad_ext");
        $ad_lb = filter_input(INPUT_POST, "ad_lb");
        $ad_cp = filter_input(INPUT_POST, "ad_cp");
        $ad_city = filter_input(INPUT_POST, "ad_city");
        $comp_categ = filter_input(INPUT_POST, "comp_categ");
        $pwd = filter_input(INPUT_POST, "pwd");
        $pwd_hash =  password_hash($pwd, PASSWORD_DEFAULT);
        
        $maRequete2 = $pdo->prepare("SELECT user_email,comp_email FROM user_infos,comp_infos WHERE user_infos.user_email = :id_user OR comp_infos.comp_email = :id_user ");
        $maRequete2->execute(['id_user' => $username]);
        $verifuse = $maRequete2->fetch(); 
        if (!$verifuse){
            $nb_id = $pdo->prepare("SELECT COUNT(comp_id) FROM comp_infos");
            $nb_id->execute();
            $nb_idd = $nb_id->fetch(); 
            $maRequete = $pdo->prepare("UPDATE comp_infos SET comp_name =:title,comp_email=:username,comp_phone=:phone,comp_website=:website,comp_desc=:descr,comp_adress_nb=:ad_nb,comp_adress_ext=:ad_ext,comp_adress_name=:ad_lb,comp_adress_cp=:ad_cp,comp_adress_city=:ad_city,comp_pwd=:pwd,comp_categ=:comp_categ");
            $maRequete->execute(array(
                'title' => $title,
                'phone'=> $phone,
                'website'=>$website,
                'descr'=>$desc,
                'ad_nb'=>$ad_nb,
                'ad_ext'=>$ad_ext,
                'ad_lb'=>$ad_lb,
                'ad_cp'=>$ad_cp,
                'ad_city'=>$ad_city,
                'comp_categ'=>$comp_categ,
                'username' => $username,
                'pwd' => $pwd_hash        
            ));
        }
    }
?>
<section id="profcomp" >
<link rel="stylesheet" href="css/style.css">
<div class="cp" >
    <span style="display:flex; align-items:center">
        <img class="profil__img" src="data/comp/<?=$_SESSION['username']?>/profilimg.png" alt="image_entreprise">
        <b style=" font-size:20px; margin-left:10px"><?=$ok['comp_name']?></b>
    </span>
    <?php if($co_comp==true ){ ?>
    <a href="logout.php" style="text-decoration:none" class="material-symbols-outlined">logout</a>
    <span id="modifprofcomp" class="material-symbols-outlined">drive_file_rename_outline</span>
    <?php } ?>
        <h3 class="profil__subtitle">Description</h3>
    <p class="profil__description"><?=$ok['comp_desc']?></p>
    <h3 class="profil__subtitle">Site internet</h3>
    <p class="profil__description"><?=$ok['comp_website']?></p>
    <h3 class="profil__subtitle">Adresse</h3>
    <p class="profil__description"><?=$ok['comp_adress_nb']?> <?=$ok['comp_adress_ext']?> <?=$ok['comp_adress_name']?>, <?=$ok['comp_adress_cp']?> <?=$ok['comp_adress_city']?> </p>
    <?php if($co_comp==true ){ ?>
        <center><button id="np" style="width:auto;height:auto;padding:15px;margin-bottom:30px" class="Validation_connexion_Artisan">
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
        ?>    
</div>
</div>
</section>

<section id="pubcomp">
    <div class="log_div_class"  >
                <h1 class="Title_connection_Artisan">Nouveau Post</h1>
                <form  method="post">
                <h3 id="Log_mail" class="Categorie_log">Description</h3>
                <input type="text" name="post_desc" class="Input_log" id="Input_mail" placeholder="Ceci est un poste" required>
                <h3 id="Log_mail" class="Categorie_log">Image</h3>
                <input type="url" name="post_img" class="Input_log" id="Input_mail" placeholder="image.png" required>
                <h3  id="Log_Pw" class="Categorie_log" >Thème</h3>
                <select class="Input_log" name="post_categ" required>
                    <option value="">faire un choix</option>
                    <option value="promotion">Promotion</option>
                    <option value="event">Evenement</option>
                    <option value="new_article">New article</option>
                </select><br>
                <button type="submit" name="content_npa" class="Validation_connexion_Artisan" >Valider</button>
    </form>
    <button id="npa" type="submit" name="content_log" class="Validation_connexion_Artisan2" >annuler</button>
    </div>
</section>
<section id="mpfs">
<div class="log_div_class"  >
                <h1 class="Title_connection_Artisan">Edit profil</h1>
                <form  method="post">
                <h3 id="Log_mail" class="Categorie_log">Nom</h3>
                <input type="text" name="title" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_name']?>" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse mail</h3>
                <input type="email" name="username" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_email']?>" required>
                <h3 id="Log_mail" class="Categorie_log">Telephone</h3>
                <input type="number" name="phone" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_phone']?>" >
                <h3 id="Log_mail" class="Categorie_log">Site web</h3>
                <input type="url" name="website" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_website']?>">
                <h3 id="Log_mail" class="Categorie_log">description</h3>
                <input type="text" name="desc" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_desc']?>" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : Num</h3>
                <input type="number" name="ad_nb" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_adress_nb']?>" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : Ext</h3>
                <input type="text" name="ad_ext" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_adress_ext']?>" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : libélé</h3>
                <input type="text" name="ad_lb" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_adress_name']?>" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : CP</h3>
                <input type="number" name="ad_cp" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_adress_cp']?>" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse : Ville</h3>
                <input type="text" name="ad_city" class="Input_log" id="Input_mail" placeholder="<?=$ok['comp_adress_city']?>" required>
                <h3 id="Log_mail" class="Categorie_log">Category</h3>
                <select class="Input_log" name="comp_categ">
                    <option value=""><?=$ok['comp_categ']?></option>
                    <option value="epicerie">épicerie</option>
                    <option value="charcuterie">Charcuterie</option>
                    <option value="brasserie">brasserie</option>
                    <option value="restoration">restoration</option>
                    <option value="boulangerie">boulangerie</option>
                </select>
                <h3  id="Log_Pw" class="Categorie_log" >Mots de passe</h3>
                <input type="password" name="pwd" class="Input_log" id="Input_pw" placeholder="********" required><br>
                <button type="submit" name="content_ad" class="Validation_connexion_Artisan" >Valider</button>
    </form>
    <button id="edit_e_a" type="submit" name="content_edit_p" class="Validation_connexion_Artisan2" >Annuler</button>
    </div>
</section>

<script>
let np = document.getElementById("np");
let npa = document.getElementById("npa");
let profcomp = document.getElementById("profcomp");
let mpf = document.getElementById("modifprofcomp");
let mpfs = document.getElementById("mpfs");
let edit_e_a = document.getElementById("edit_e_a");
pubcomp.style.display = "none";
mpfs.style.display = "none";
np.addEventListener("click", () => {
    profcomp.style.display = "none"
    pubcomp.style.display = "block"
})
npa.addEventListener("click", () => {
    profcomp.style.display = "block"
    pubcomp.style.display = "none"
})
mpf.addEventListener("click", () => {
    profcomp.style.display = "none"
    mpfs.style.display = "block"
})
edit_e_a.addEventListener("click", () => {
    profcomp.style.display = "block"
    mpfs.style.display = "none"
})
</script>
