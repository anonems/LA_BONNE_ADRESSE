

<?php
try{
 

require('cobdd.php');
if(($_SERVER["REQUEST_METHOD"] == "POST")){
    if(isset($_POST['content_log'])) {
        $username = filter_input(INPUT_POST, "username");
        $pwd = filter_input(INPUT_POST, "pwd");
        $maRequete = $pdo->prepare("SELECT * FROM user_infos,comp_infos WHERE user_infos.user_email = :id_user OR comp_infos.comp_email = :id_user ");
        $maRequete->execute([
            ":id_user" => $username
        ]);
        $maRequete->setFetchMode(PDO::FETCH_ASSOC);
        $log = $maRequete->fetch();
        if ((($log['user_email'] == $username or $log['user_pseudo'] == $username) && (password_verify($pwd, $log['user_pwd']))  )){
            $_SESSION["connecte"] = true;
            $_SESSION["mode"] = "user";
            $_SESSION["username"] = $log['user_id'];
            http_response_code(302);
            //header("Location : index.php?user_id=".$log['user_id']);
            exit();
        }elseif($log['comp_email'] == $username && (password_verify($pwd, $log['comp_pwd']))){
            $_SESSION["connecte"] = true;
            $_SESSION["mode"] = "comp";
            $_SESSION["username"] = $log['comp_id'];
            http_response_code(302);
            //include("profil_comp.php?comp_id=".$log['user_id']);
            exit();
        }elseif(($log['user_email'] == $username or $log['comp_email'] == $username or $log['user_pseudo'] == $username)){
                echo "<span style='color:red'>mot de passe incorrect ";
        }else{
                echo "<span style='color:red'>identifiant indisponible</span> ";
            }
    }elseif(isset($_POST['content_sig'])){
        $pseudo = filter_input(INPUT_POST, "pseudo");
        $username = filter_input(INPUT_POST, "username");
        $pwd = filter_input(INPUT_POST, "pwd");
        $pwd_hash =  password_hash($pwd, PASSWORD_DEFAULT);
        
        $maRequete2 = $pdo->prepare("SELECT user_email,comp_email FROM user_infos,comp_infos WHERE user_infos.user_email = :id_user OR comp_infos.comp_email = :id_user ");
        $maRequete2->execute(['id_user' => $username]);
        $verifuse = $maRequete2->fetch(); 
        if (!$verifuse){
            $maRequete = $pdo->prepare("INSERT INTO user_infos (user_pseudo,user_email,user_pwd) VALUES (:pseudo,:username,:pwd) ");
            $maRequete->execute(array(
                'pseudo' => $pseudo,
                'username' => $username,
                'pwd' => $pwd_hash        
            ));
            //mkdir('../data/'.$username.'');
        }elseif($verifuse){
            echo "<span style='color:red'>Cette email est déja disponnible veuillez en utiliser un autre.</span>";
        }
    }

}else{
?>
<div id="log_div_class">
    <div class="log_div_class"  >
                <h1 class="Title_connection_Artisan">Connexion</h1>
                <form  method="post">
                <h3 class="Categorie_log">Adresse mail</h3>
                <input type="text" name="username" class="Input_log" placeholder="email@lba.fr" required>
                <h3   class="Categorie_log" >Mots de passe</h3>
                <input type="password" name="pwd" class="Input_log"  placeholder="********" required><br>
                <button type="submit" name="content_log" class="Validation_connexion_Artisan" >Valider</button>
    </form>
    <button id="signin" type="submit" name="content_log" class="Validation_connexion_Artisan2" >signin</button>
    </div>
    </div>

    <div id="sig_div_class">
    <div class="log_div_class"  >
                <h1 class="Title_connection_Artisan">inscription</h1>
                <form  method="post">
                <h3 id="Log_mail" class="Categorie_log">Pseudo</h3>
                <input type="text" name="pseudo" class="Input_log"  placeholder="Pseudo" required>
                <h3 id="Log_mail" class="Categorie_log">Adresse mail</h3>
                <input type="email" name="username" class="Input_log"  placeholder="email@lba.fr" required>
                <h3  id="Log_Pw" class="Categorie_log" >Mots de passe</h3>
                <input type="password" name="pwd" class="Input_log"  placeholder="********" required><br>
                <button type="submit" name="content_sig" class="Validation_connexion_Artisan" >Valider</button>
    </form>
    <button id="login" type="submit" name="content_log" class="Validation_connexion_Artisan2" >login</button>
    </div>
    </div>


<?php } ?>
<script>
        let signin = document.getElementById("signin");
        let login = document.getElementById("login");
        document.getElementById("sig_div_class").style.display = "none";
        signin.addEventListener("click", () => {
            document.getElementById("log_div_class").style.display = "none";
            document.getElementById("sig_div_class").style.display = "block";
        })
        login.addEventListener("click", () => {
            document.getElementById("sig_div_class").style.display = "none";
            document.getElementById("log_div_class").style.display = "block";
        })
</script>
<?php }catch(Exception $e){} ?>