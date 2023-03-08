{extends file="views/modele.tpl"}

{block name="content"}
    <h2>Se connecter</h2>
{if isset($strError)}
	{$strError}
{/if}
<!-- Zone de connexion-->
    <div> 
            <form action="index.php?ctrl=user&action=login" name="formConnect" method="post">
            <label for="pseudo">Identifiant</label>
            <input type="text" name="identifiant" id="identifiant" placeholder="Identifiant" required >

            <br/>   

            <label for="password">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required >
                
            <input type="submit" value="Se connecter" name="connexion" id="connexion" class="d-block btnPrin col-2 me-1 ps-1">  
            </form>
    </div>

{/block}