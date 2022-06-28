
<?php
require('cobdd.php');
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['content_log']))) {
    $username = filter_input(INPUT_POST, "username");
    $pwd = filter_input(INPUT_POST, "pwd");
    $maRequete = $pdo->prepare("SELECT * FROM user_infos,comp_infos WHERE user_infos.user_email = :id_user OR comp_infos.comp_email = :id_user ");
    $maRequete->execute([
        ":id_user" => $username
    ]);
    $maRequete->setFetchMode(PDO::FETCH_ASSOC);
    $log = $maRequete->fetch();
    if (($log['user_email'] == $username && (password_verify($pwd, $log['user_pwd'])) )){
        $_SESSION["connecte"] = true;
        $_SESSION["methode"] = "user";
        $_SESSION["username"] = $log['user_id'];
        http_response_code(302);
        include("profil_user.php");
        exit();
    }elseif($log['comp_email'] == $username && (password_verify($pwd, $log['comp_pwd']))){
        $_SESSION["connecte"] = true;
        $_SESSION["methode"] = "comp";
        $_SESSION["username"] = $log['comp_id'];
        http_response_code(302);
        include("profil_comp.php");
        exit();
    }elseif(($log['user_email'] == $username or $log['comp_email'] == $username)){
            echo "<span style='color:red'>mot de passe incorrect ";
    }else{
            echo "<span style='color:red'>identifiant indisponible</span> ";
        }
    }
else{
?>
    <div class="log_div_class" >
            <div class="Conteneur_log">
                <h1 class="Title_connection_Artisan">Connexion</h1>
            <div>
                <form  method="post">
                <h3 id="Log_mail" class="Categorie_log">Adresse mail</h3>
                <input type="email" name="username" class="Input_log" id="Input_mail" placeholder="email@lba.fr" required>
                <h3  id="Log_Pw" class="Categorie_log" >Mots de passe</h3>
                <input type="password" name="pwd" class="Input_log" id="Input_pw" placeholder="********" required>
                <button type="submit" name="content_log" class="Validation_connexion_Artisan" >Valider</button>
            </form>
            
    </div>
<?php } ?>