<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nouveau Post</title>
    </head>
    <body>
        <p>Choisissez le type d'évènement :</p>
        <form action="/templates.php">
            <input type="radio" id="degustation" name="fav_language" value="Dégustation">
            <label for="degustation">Dégustation</label><br>
            <input type="radio" id="nouveau_produit" name="fav_language" value="Nouveau Produit">
            <label for="nouveau_produit">Nouveau Produit</label><br>
            <input type="radio" id="promotion" name="fav_language" value="Promotion">
            <label for="promotion">Promotion</label><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>