<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="templates.css" type="text/css"> 
        <title>Nouveau Post Artisan</title>
    </head>
    <body>
        <form action="/templates.php">
            <!-- Choix du type d'évènement -->
            <p><strong>Choisissez le type d'évènement :</strong></p>
            <input type="radio" id="degustation" name="type_de_post" value="Dégustation">
            <label for="degustation">Dégustation</label><br>
            <input type="radio" id="nouveau_produit" name="type_de_post" value="Nouveau Produit">
            <label for="nouveau_produit">Nouveau Produit</label><br>
            <input type="radio" id="promotion" name="type_de_post" value="Promotion">
            <label for="promotion">Promotion</label><br><br>

            <!-- Choix de la photo de présentation -->
            <label for="image_type"><strong>Choisissez une image :</label>
            <input list="image_type" name="image_post" id="image_post">
            <datalist id="image_type">
                <option value="Alcool">
                <option value="Fromage">
                <option value="Viande">
                <option value="Fruits">
                <option value="Meuble">
                <option value="Objets">
                <option value="Bonbon">
                <option value="Chocolat">
            </datalist>
            <br><br>

            <label for="photo_presentation">Ou sélectionnez votre propre image :</label>
            <input type="file" id="photo_presentation" name="photo_presentation">
            <br><br>

            <!-- Choix des information de l'évènement -->
            <label for="info_event">Renseignez jour et heure de l'évènement :</label>
            <input type="datetime-local" id="info_event" name="info_event">
            <br><br>

            <!-- Description de l'évènement -->
            <label for="description_type">Choisissez une description :</label>
            <input list="description_type" name="description_post" id="description_post">
            <datalist id="description_type">
                <option value="Venez déguster">
                <option value="Venez savourer">
                <option value="Venez Découvrir">
                <option value="Venez manger">
                <option value="Venez boire">
                <option value="Venez voir">
                <option value="Venez tester">
            </datalist>
            <br><br>

            Ou faîtes votre propre description :<br>
            <textarea name="description" rows="2" cols="30"><?php echo $comment;?></textarea>
            <br><br>
            <input id="submit" type="submit" value="Submit">
        </form>
    </body>
</html>