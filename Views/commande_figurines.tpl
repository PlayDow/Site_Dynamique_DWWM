{extends file="Views/modele.tpl"}

{block name="content"}
<main class="container">
    <!--Bouton back to top-->
    <a href="#top" id="backToTop">Top</a>

    <div class="row">
    <!--Titre-->
        <h1>Passez ici votre commande de figurines en remplissant le formulaire.</h1>
    </div>
    <!--Formulaire-->
    <div class="row">
        <div class="col-12 col-md-6">
            <p>
                Les fichiers utilisés pour l'impression 3D ont l'extension STL. Ceux-ci sont nécessaires
                pour les figurines. Vous pouvez utiliser des logiciels tel que Blender pour créer les objets
                que vous souhaitez fabriquer ou en trouver sur des sites de partage de contenus libre de droits.
            </p>
            <img src="Assets/Images/figurineElementaire.jpg" alt="" class="img-fluid">
        </div>
        <div class="col-12 col-md-6">

        {if count($arrError) > 0}
            <div class="error">
                {foreach from=$arrError item=strError}
                    <p>{$strError}</p>
                {/foreach}
            </div>
        {/if}
        
            <form name ="formFig" method="post" action ="index.php?ctrl=product&action=Figurines" enctype="multipart/form-data">

            <!--Prénom-->
                <input type="text" name="firstname" id="prenom" placeholder="Prénom" value="{$objFigurine->getFirstname()}" />
            <!--Nom-->
                <input type="text" name="name" id="nom" placeholder="Nom" value="{$objFigurine->getName()}" />
                    <br/>
            <!--Téléphone-->
                <input type="tel" name="phone" id="telephone" placeholder="Téléphone" value="{$objFigurine->getPhone()}" />
            <!--Adresse mail-->
                <input type="email" name="mail" id="adresseEmail" placeholder="Adresse email" value="{$objFigurine->getMail()}" />
                    <br/>
            <!--Numéro de rue-->
                <input type="text" name="numAddress" id="numéro" placeholder="N°" value="{$objFigurine->getNumAddress()}" />

            <!--Nom de la rue-->
                <input type="text" name="street" id="nomRue" placeholder="Nom de la rue" value="{$objFigurine->getStreet()}" />
                    <br/>
            <!--Code postal-->
                <input type="number" name="postCode" id="codePostal" placeholder="Code postal" value="{$objFigurine->getPostCode()}" />
            <!--Ville-->
                <input type="text" name="town" id="ville" placeholder="Ville" value="{$objFigurine->getTown()}" />
                    <br/>
            <!--Fichier-->
                <input type="file" name="file" id="fichier" />
                <label for="fichier">Fichier STL </label>
                    <br/>
            <!--Exemplaires-->
                <input type="number" name="number" id="exemplaire" placeholder="Exemplaires" value="{$objFigurine->getNumber()}" />
                    <br />
            <!--Message-->
                <textarea name ="message" placeholder="Message">{$objFigurine->getMessage()}</textarea>
                    <br />
            <!--Submit-->
                <input type="submit" name="Envoyer" id="Envoyer" value="Envoyer" class="btnPrin"/>
                
            </form>
        </div>
    </div>  
</main>
{/block}