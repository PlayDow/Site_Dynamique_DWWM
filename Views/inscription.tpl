{extends file="views/modele.tpl"}

{block name="content"}

{if count($arrErrors) > 0}
    <div>
    {foreach from=$arrErrors item=strError}
        <p>{$strError}</p>
    {/foreach}
    </div>
{/if}


        <h2>{$strTitle}</h2>
            <form name ="formInscription" method="post" action ="index.php?ctrl=user&action={$strPage}">
                
                <input type="hidden" name="id" id="id" placeholder="Identifiant" value ='{$objUser->getId()}' /> <!--Permet de garder l'id du compte à modifier-->
            <!--Identifiant-->
                <label for="pseudo">Identifiant</label><br/>
                <input type="text" name="pseudo" id="pseudo" placeholder="Identifiant" value ='{if $objUser->getName() !=''}{$objUser->getPseudo()|unescape}{/if}' required/>
                    <br/>
            <!--Mot de passe-->
                <label for="password">Mot de passe</label><br/>   
                <input type="password" name="password" id="password" placeholder="Mot de passe" value ='{if count($arrErrors) == 0}{$objUser->getPassword()}{/if}' {if $strPage == "create_account"}required{/if}/>
                    <br/>
                <label for="confirmPassword">Confirmer le mot de passe</label><br/>   
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmer le mot de passe" value ='{if count($arrErrors) == 0}{$objUser->getPassword()}{/if}' {if $strPage == "create_account"}required{/if}/>
                    <br/>
            <!--Prénom-->
                <label for="firstName">Prénom</label><br/>   
                <input type="text" name="firstName" id="firstName" placeholder="Prénom" value ='{if $objUser->getName() !=''}{$objUser->getFirstname()|unescape}{/if}' required/>
                    <br/>
            <!--Nom-->
                <label for="nom">Nom</label><br/>   
                <input type="text" name="name" id="name" placeholder="Nom" value ='{if $objUser->getName() !=''}{$objUser->getName()|unescape}{/if}' required/>
                    <br/>
            <!--Téléphone-->
                <label for="phone">Numéro de téléphone</label><br/>   
                <input type="tel" name="phone" id="phone" placeholder="Téléphone" value ='{$objUser->getPhone()}' required/>
                    <br/>
            <!--Adresse mail-->
                <label for="mail">Adresse mail</label><br/>   
                <input type="email" name="mail" id="mail" placeholder="Adresse email" value ='{$objUser->getMail()}' required/>
                    <br/>
            <!--Numéro de rue-->
                <label for="numero">Numéro de rue</label><br/>   
                <input type="number" name="numero" id="numero" placeholder="N°" value ='{$objUser->getNumero()}' />
                    <br/>
            <!--Nom de la rue-->
                <label for="adress">Nom de rue</label><br/>   
                <input type="text" name="adress" id="adress" placeholder="Nom de la rue" value ='{if $objUser->getName() !=''}{$objUser->getAdress()|unescape}{/if}' />
                    <br/>
            <!--Code postal-->
                <label for="postalCode">Code postal</label><br/>   
                <input type="number" name="postalCode" id="postalCode" placeholder="Code postal" value ='{$objUser->getPostalCode()}' />
                    <br/>
            <!--Ville-->
                <label for="city">Ville</label><br/>   
                <input type="text" name="ville" id="city" placeholder="Ville" value ='{$objUser->getCity()}' />
                    <br/><br/>
            {if isset($smarty.session.user.id) && $smarty.session.user.cp_type == 1}
                <!--Type-->
                <label for="type">Type</label><br/>   
                <input type="text" name="type" id="type" placeholder="type" value ='{$objUser->getType()}' />
                    <br/><br/>
            {/if}
            <!--Submit-->
                <input type="submit" name="Inscrire" id="Inscrire" value="{if $strPage == "create_account"}S'inscrire{else}Modifier{/if}" class="btnPrin"/>
            {if isset($smarty.session.user.id)}
            <!--Delete-->
                <a href="index.php?ctrl=user&action=deleteAccount&id={$objUser->getId()}" class="btn cacherBtnBase btnSec">Supprimer</i></a>
            {/if}
            </form>
{/block}