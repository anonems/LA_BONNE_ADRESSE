<button style="background-color:orange;border:none;border-radius:25px;color:white;width:50px;height:50px;font-size:40px;font-weight:bold;position:fixed;bottom:100px;right:20px"  class="material-symbols-outlined">add</button>
        <?php
        
            $co = False;
            if(isset($_SESSION['connecte'])){ 
                session_start();
                $username = $_SESSION["username"];
                $co=True;
            }

            require('cobdd.php');
            $maRequete = $pdo->prepare("SELECT * FROM post_infos ORDER BY post_date DESC");
            $maRequete->execute();
            $postes = $maRequete->fetchAll(PDO::FETCH_ASSOC);

            if ($postes){
            foreach($postes as $poste): 
                
                    $maRequete1 = $pdo->prepare("SELECT * FROM comp_infos WHERE comp_id=:userp ");
                    $maRequete1->execute(['userp'=> $poste["post_comp_id"]]);
                    $postes1 = $maRequete1->fetch();
                
               
            ?>
            
            <div class="post">
                <div class="postProfile">
                    <img src="../data/<?= $poste["post_comp_id"] ?>/profilimg.png" alt="img-de-profil" />
                </div>
                
                <div class="postBody">
                    <div class="postHeader">
                        <div class="postUsername">
                            <h3> 
                            <?= $postes1["comp_name"] ?>
                            <a href="profil.php?user=<?=$poste['post_comp_id']?>"><span class="pseudo">@<?= $poste["post_comp_id"] ?></span></a>
                            </h3>
                        </div>
                        <div class="postDescription">
                            <p><?= $poste["post_content"] ?></p>
                        </div>
                    </div>

                    <?php if (isset($poste["post_img"])){?>
                    <img src="<?=$poste["post_img"]?>" alt="" > 
                    <?php } ?>

                    <div class="postFooter">
                    <?php if($co){if($poste['post_comp_id']===$username){ ?><form method="post"><input type="hidden" name="idd" value="<?= $poste["id"] ?>"> <button style="background-color:transparent; border:none"  name='deld' type="submit" class="material-symbols-outlined"> delete </button> <?php } } ?>
                    <form method="post"><button type="submit" name="share" style="background-color:transparent; border:none" class="material-symbols-outlined"> share </button>       </form>                   
                    </div>
                </div>
            </div>
            <?php  
            endforeach; 
            
            if(isset($_POST['favd'])){
                $idc = filter_input(INPUT_POST,'idc');
                $maRequete3 = $pdo->prepare("UPDATE post SET fav = fav + 1 WHERE id=:id_post");
                $maRequete3->execute([
                'id_post' => $idc]
            );
            }
            
            }else{echo 'aucun post';}?>


    
