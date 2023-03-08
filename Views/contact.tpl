{extends file="Views/modele.tpl"}

{block name="content"}

<main class="container">
            <!--Bouton back to top-->
            <a href="#top" id="backToTop">Top</a>
            
            <h1>Nous contacter</h1>
            
            <div class="row">

                <!--Formulaire de contact-->
                        <div class="col-12 col-md-6">
                            <form name ="formContact" method="post" action ="index.php?ctrl=page&action={$strPage}">
                                <fieldset>

                                    <legend>Formulaire de contact </legend>
                                        <div class="row mb-2">
                                            <label for="firstName" class="col-2 col-form-label"> Prénom </label>  
                                            <input type="text" name="firstName" id="firstName" class="col-5" required/> <br /> 
                                        </div>
                                        
                                        
                                        <div class="row mb-2">
                                            <label for="lastName" class="col-2"> Nom </label> 
                                            <input type="text" name="name" id="name" class="col-5" required/> <br />
                                        </div>
                                        
                                        
                                        <div class="row mb-2">
                                            <label for="phone" class="col-2"> Téléphone </label>
                                            <input type="tel" name="phone" id="phone" class="col-5" required /> <br />
                                        </div>
                                        
        
                                        <div class="row mb-2">
                                            <label for="mail" class="col-2"> Adresse mail </label>
                                            <input type="mail" name="mail" id="mail" class="col-5" required/> <br />
                                        </div>
                                      
        
                                        <div class="row mb-2">
                                            <label for="zoneMultiligne" class="col-2"> Message </label> <br />
                                            <textarea name="zoneMultiligne" id="zoneMultiligne" rows="2" cols="30" class="col-10" required></textarea> <br />
                                        </div>
                                        
        
                                        <input type="submit" name="Envoyer" value="Envoyer" id="submit" class="btnPrin">
        
                                        <input type="reset" name="Effacer" value="Effacer" id="reset" class="btnSec">
                                </fieldset>     
                            </form>  
                        </div>

                <!--Information-->
                        <div class="col-12 col-md-6 infoBlock">
                            <h2> Information de contact </h2>
                            <p><strong>Adresse :</strong> 4 rue du Rhin 68000 Colmar</p>
                            <p><strong>Téléphone :</strong> 03 68 60 20 00</p>
                            <p><strong>Mail :</strong> marcrenoult@ccicampus.fr</p>
                            <p><strong>Horaires :</strong> Du lundi au jeudi de 9h00 à 17h00
                                et le vendredi de 9h00 à 15h00
                            </p>
                        </div>
                </div>
                    
                    
            <div class="row mt-2">

                <!--Localisation-->
                    <h2>Nous trouver</h2>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d85245.76216475348!2d7.3223450814569695!3d48.111584739567164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479165dff670c1cf%3A0xe35d7e3e616ce966!2s68000%20Colmar!5e0!3m2!1sfr!2sfr!4v1670232714949!5m2!1sfr!2sfr" 
                     height="350" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade" title="gmap"></iframe>
            </div>               	
        </main>
{/block}