
<!-- ouvre Liste / modif / suppr clients -->
<div class="container" v-if="admclient">
   <div>
      <button type="button" class="btn btn-lg btn-link" v-on:click="btnadmrubrique(0)">Retour aux rubriques</button>
   </div>
   <div class="card my-3">
      <div class="card-header bg-dark">
         <div class="row">
            <div class="col-md-8">
               <h3 class="text-light">Liste des clients</h3>
            </div>
            <div class="col-md-4 text-right" v-show="!admmodifclient">
               <button type="button" class="btn btn-lg btn-primary" v-on:click="btnadmnewclient">Nouveau client</button>
            </div>
         </div>
      </div>

      <!-- ouvre Liste clients -->
      <div class="card-body">
         <div v-for="cli in clilist">
            <div class="row mb-1">
               <div class="col-md-4">- {{ cli.CliNom }}</div>
               <div class="col-md-4 d-none d-md-block">{{ cli.CliPrenom }}</div>
               <div class="col-6 col-md-2 text-right">
                  <button type="button" class="btn btn-xs btn-outline-warning" v-on:click="btnadmmodifclient(cli.CliID)">Modifier</button>
               </div>
               <div class="col-6 col-md-2 text-right">
                  <button type="button" class="btn btn-xs btn-outline-danger">Supprimer</button>
               </div>
            </div>

            <!-- ouvre Modif client -->
            <div class="container row mb-1"  v-if="cli.CliID == g.cform.CliID && admmodifclient">
               <form class="container mb-3">
                  <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" v-model="cform.CliNom" pattern="^[A-Za-z- ]{1,50}$" placeholder="Entrez le nom du client" required>
                  </div>
                  <div class="form-group">
                      <label>Prénom</label>
                      <input type="text" class="form-control" id="prenom" name="prenom" v-model="cform.CliPrenom" pattern="^[A-Za-z- ]{1,50}$" placeholder="Entrez le prenom du client" required>
                  </div>
                  <div class="form-group">
                      <label>Adresse</label>
                      <input type="text" class="form-control" id="adresse" name="adresse" v-model="cform.CliAdresse" pattern="^[0-9]{1,4}.{1,46}$" placeholder="Entrez l'adresse" required>
                  </div>
                  <div class="form-group">
                      <label>Code Postal</label>
                      <input type="text" class="form-control" id="CP" name="CP" pattern="^[0-9]{5}$" v-model="cform.CliCP" placeholder="Entrez le Code Postal du client" required>
                  </div>
                  <div class="form-group">
                      <label>Ville</label>
                      <input type="text" class="form-control" id="ville" name="ville" pattern="^[A-Za-z- ]{1,50}$" v-model="cform.CliVille" placeholder="Entrez la ville du client" required>
                  </div>
                  <div class="form-group">
                      <label>Téléphone</label>
                      <input type="text" class="form-control" id="tel" name="tel" pattern="^[0-9]{10}$" v-model="cform.CliTel" placeholder="Entrez le numéro de téléphone du client" required>
                  </div>
                  <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" class="form-control" id="mail" name="mail" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-_]+\.[a-zA-Z]{2,3}$" v-model="cform.CliMail" placeholder="Entrez l'adresse électronique du client" required>
                  </div>                  
                  <div class="form-check">
                    <label>Le nouveau client est</label>
                    <div class="radio">
                      <label><input type="radio" class="radio-button" name="type" value="1" v-model="g.cform.CliType" v-bind:checked="cform.CliType == 1"> un particulier</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" class="radio-button" name="type" value="0" v-model="g.cform.CliType" v-bind:checked="cform.CliType == 0"> un professionnel</label>
                    </div>
                  </div>
                  <div class="form-group">
                     <label>Commercial</label>
                     <select class="form-control" required>
                        <option disabled>-- <i>Commercial</i> --</option>
                        <option v-for="cmr in cmrlist" :value="cmr.CmrID" v-bind:selected="(g.cform.CmrID == cmr.CmrID) ? true : false" v-on:click="changecmr(cmr.CmrID)">{{ cmr.CmrNom }}</option>
                     </select>
                  </div>
                  <div class="form-inline text-center my-2">
                     <div class="col-md-6"><button type="button" class="btn btn-success" v-on:click="btnadmmodifclientconfirm">Valider</button></div>
                     <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btnadmmodifclientcancel">Annuler</button></div>
                  </div>
               </form>
            </div>
            <!-- ferme Modif client -->

         </div>
      </div>
      <!-- ferme Liste clients -->
   </div>
</div>
<!-- ferme Liste / modif / suppr clients -->

<!-- ouvre Nouveau client -->
<div class="container" v-if="admnewclient">
    <div>
      <button type="button" class="btn btn-lg btn-link" v-on:click="btnadmclient(0)">Retour à la liste des clients</button>
   </div>
   <div class="card my-3">
      <div class="card-header bg-dark">
         <h3 class="text-light">Nouveau Client</h3>
      </div>
      <div class="card-body">
         <div class=" row mb-1">
            <form class="container mb-3">
              <div class="form-group">
                  <label>Nom</label>
                  <input type="text" class="form-control" id="nom" name="nom" v-model="cform.CliNom" pattern="^[A-Za-z- ]{1,50}$" placeholder="Entrez le nom du client" required>
              </div>
              <div class="form-group">
                  <label>Prénom</label>
                  <input type="text" class="form-control" id="prenom" name="prenom" v-model="cform.CliPrenom" pattern="^[A-Za-z- ]{1,50}$" placeholder="Entrez le prenom du client" required>
              </div>
              <div class="form-group">
                  <label>Adresse</label>
                  <input type="text" class="form-control" id="adresse" name="adresse" v-model="cform.CliAdresse" pattern="^[0-9]{1,4}.{1,46}$" placeholder="Entrez l'adresse" required>
              </div>
              <div class="form-group">
                  <label>Code Postal</label>
                  <input type="text" class="form-control" id="CP" name="CP" pattern="^[0-9]{5}$" v-model="cform.CliCP" placeholder="Entrez le Code Postal du client" required>
              </div>
              <div class="form-group">
                  <label>Ville</label>
                  <input type="text" class="form-control" id="ville" name="ville" pattern="^[A-Za-z- ]{1,50}$" v-model="cform.CliVille" placeholder="Entrez la ville du client" required>
              </div>
              <div class="form-group">
                  <label>Téléphone</label>
                  <input type="text" class="form-control" id="tel" name="tel" pattern="^[0-9]{10}$" v-model="cform.CliTel" placeholder="Entrez le numéro de téléphone du client" required>
              </div>
              <div class="form-group">
                  <label>E-mail</label>
                  <input type="email" class="form-control" id="mail" name="mail" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-_]+\.[a-zA-Z]{2,3}$" v-model="cform.CliMail" placeholder="Entrez l'adresse électronique du client" required>
              </div>                  
              <div class="form-check">
                <label>Le nouveau client est</label>
                <div class="radio">
                  <label><input type="radio" class="radio-button" name="type" value="1" v-model="g.cform.CliType" checked> un particulier</label>
                </div>
                <div class="radio">
                  <label><input type="radio" class="radio-button" name="type" value="0" v-model="g.cform.CliType"> un professionnel</label>
                </div>
              </div>
              <div class="form-group">
                 <label>Commercial</label>
                 <select class="form-control" required>
                    <option selected disabled>-- <i>Commercial</i> --</option>
                    <option v-for="cmr in cmrlist" :value="cmr.CmrID" v-on:click="changecmr(cmr.CmrID)">{{ cmr.CmrNom }}</option>
                 </select>
              </div>
              <div class="form-inline text-center my-2">
                <div class="col-md-6"><button type="button" class="btn btn-success" v-on:click="btnadmnewclientconfirm">Valider</button></div>
                <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btnadmnewclientcancel">Annuler</button></div>
              </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- ferme Nouveau client -->
