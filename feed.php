        <?php
            $co = False;
            if(isset($_SESSION['connecte'])){ 
                if($_SESSION['mode']=='comp'){
                    $username = $_SESSION["username"];
                    $co=True;
                    echo "<button id='add_btn2'   class='material-symbols-outlined'>add</button>";
                }
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
            <script>changecoloracc(<?=$postes1["comp_categ"]?>)</script>
            <div class="post"  >
                <div class="postProfile">
                    <img src="data/comp/<?= $poste["post_comp_id"] ?>/profilimg.png" alt="img-de-profil" />
                </div>

                <div class="postBody">
                    <div class="postHeader">
                        <div class="postUsername">
                            <h3> 
                            <a style="text-decoration:none;" href="profil_comp.php?user=<?=$poste['post_comp_id']?>"><span class="pseudo" ><?= $postes1["comp_name"] ?></span></a>
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
                    <?php if($co){if($poste['post_comp_id']===$username){ ?><form method="post"><input type="hidden" name="idd" value="<?= $poste["id"] ?>"> <button style="background-color:transparent; border:none"  name='deld' type="submit" class="material-symbols-outlined"> delete </button> <?php } } ?>
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
            endforeach;    
            }else{echo 'aucun post';}?>