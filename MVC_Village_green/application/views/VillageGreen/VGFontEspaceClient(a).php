
<!-- ouvre Informations du client -->
<div id="fontacc" v-if="infosclient">
    <div class="contbody">
        <div class="card my-3">
           <div class="card-header bg-dark">
              <div class="row">
                 <div class="col-md-8">
                    <h3 class="text-light">Vos coordonnées personnelles</h3>
                 </div>
                 <div class="col-md-4 text-right" >
                    <button type="button" class="btn btn-sm btn-primary" v-on:click="btnmodifinfosclient">Modifier vos coordonnées</button>
                 </div>
              </div>
           </div>
           <div class="card-body">
               <div v-for="cli in clilist">
                   <div class="row">
                       <div class="col col-md-5">
                           <label> <b>Nom :</b> {{cli.CliNom}} </label>
                       </div>
                       <div class="col col-md-4">
                           <label> <b>Prénom :</b> {{cli.CliPrenom}} </label>
                       </div>
                       <div class="col col-md-3">
                           <label> <b>Type :</b> {{ (cli.CliType == 1) ? "Particulier" : "Professionnel" }} </label>
                       </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <label> <b>Adresse :</b> {{cli.CliAdresse}} </label>
                        </div>
                        <div class="col col-md-4">
                            <label> <b>Code Postal :</b> {{cli.CliCP}} </label>
                        </div>
                        <div class="col col-md-3">
                            <label> <b>Ville :</b> {{cli.CliVille}} </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-5">
                            <label> <b>Téléphone :</b> {{cli.CliTel}} </label>
                        </div>
                        <div class="col col-md-7">
                             <label> <b>E-mail :</b> {{cli.CliMail}} </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ferme Informations du client -->

<!-- ouvre Modification des Informations du client par le client  -->
<div id="fontacc" v-if="modifinfosclient">
    <div class="contbody">
        <div class="card my-3">
           <div class="card-header bg-dark">
              <div class="row">
                 <div class="col-md-8">
                    <h3 class="text-light">Modification de vos coordonnées</h3>
                 </div>
              </div>
           </div>
           <div class="card-body">
                <div>
                    <div >
                        <label>Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" v-model="cform.CliNom">
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom"  v-model="cform.CliPrenom">
                    </div>
                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse"  v-model="cform.CliAdresse">
                    </div>
                    <div class="form-group">
                        <label>Code Postal</label>
                        <input type="text" class="form-control" id="CP" name="CP"  v-model="cform.CliCP">
                   </div>
                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" class="form-control" id="ville" name="ville"  v-model="cform.CliVille">
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" class="form-control" id="tel" name="tel"  v-model="cform.CliTel">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control" id="mail" name="mail"  v-model="cform.CliMail">
                    </div>
                    <div class="col-sm-10">
                        <label>Vous êtes :</label>
                        <br />
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type" v-model="cform.CliType"  value="1" v-bind:checked="(cform.CliType==0)?false:true" >
                            <label class="form-check-label">
                                Un Particulier
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type" v-model="cform.CliType" value="0" v-bind:checked="(cform.CliType==0)?true:false"  >
                            <label class="form-check-label">
                                Un professionnel
                            </label>
                        </div>
                    </div>
                      <div class="form-inline text-center my-2">
                         <div class="col-md-6"><button type="button" class="btn btn-success" v-on:click="btnloadinfosclient">Enregistrer</button></div>
                         <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btninfosclient">Annuler</button></div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ferme Modification des Informations du client par le client  -->
