
<!-- ouvre Liste / add / rename / suppr rubriques & Liste / add / suppr sous-rubriques -->
<div class="container" v-show="admrubrique">
   <div class="row">
      <div class="col-md-5">
         <button type="button" class="btn btn-lg btn-link" v-on:click="btnadmaccueil">Retour à l'accueil</button>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-5 text-right">
         <button type="button" class="btn btn-lg btn-primary"  v-on:click="btnadmnewrubrique">Nouvelle rubrique</button>
      </div>
      <!-- ouvre Liste rubriques -->
      <div class="col-md-6" v-for="rub in rublist">
         <div class="card my-3">
            <div class="card-header bg-dark text-light">
               <h3>{{ rub.RubLibelle }}</h3>
               <!-- ouvre Rename rubrique -->
               <div class="row" v-if="rub.RubID == rform.RubID && admrenamerubrique">
                  <div class="col-md-7">
                     <input type="text" class="form-control" v-model="rform.RubLibelle" placeholder="Entrez le nom de la rubrique">
                  </div>
                  <div class="col-6 col-md-2">
                     <button type="button" class="btn btn-success" v-on:click="btnadmrenamerubriqueconfirm">Valider</button>
                  </div>
                  <div class="col-6 col-md-3">
                     <button type="reset" class="btn btn-secondary" v-on:click="btnadmrenamerubriquecancel">Annuler</button>
                  </div>
               </div>
               <!-- ferme Rename rubrique -->
            </div>
            <div class="card-body">
               <!-- ouvre Liste sous-rubriques -->
               <div class="row mb-1" v-for="srub in srublist" v-if="srub.RubID == rub.RubID">
                  <div class="col-md-7">
                     - <a href="#" class="navlinksbl" v-on:click="btnadmproduit(rub.RubLibelle,srub.SRubID,srub.SRubLibelle)">{{ srub.SRubLibelle }}</a>
                  </div>
                  <div class="col-6 col-md-2 text-center">
                     <button type="button" class="btn btn-sm btn-outline-warning" v-on:click="btnadmmodifsousrubrique(srub.SRubID)">Modifier</button>
                  </div>
                  <div class="col-6 col-md-3 text-center">
                     <button type="button" class="btn btn-sm btn-outline-danger" v-on:click="btnadmdeletesousrubrique(srub.SRubID)">Supprimer</button>
                  </div>
               </div>
               <!-- ferme Liste sous-rubriques -->
               <div class="row mb-1" v-if="!admnewsousrubrique">
                  <div class="col-md-7"></div>
                  <div class="col-md-5 text-center">
                     <button type="button" class="btn btn-sm btn-outline-primary" v-on:click="btnadmnewsousrubrique(rub.RubID)">Nouvelle sous-rubrique</button>
                  </div>
               </div>
               <!-- ouvre New sous-rubrique -->
               <form class="row mb-1" v-if="rub.RubID == srform.RubID && admnewsousrubrique">
                  <div class="col-md-7 form-group">
                     <input type="text" class="form-control" id="libelle" name="libelle" pattern="^[-A-Za-z0-9]{1,50}$" placeholder="Entrez le libellé" v-model="srform.SRubLibelle" required>
                     <input type="hidden" id="RubID" name="RubID" v-model="srform.RubID">
                  </div>
                  <div class="col-6 col-md-2 text-center">
                     <button type="button" class="btn btn-success" v-on:click="btnadmnewsousrubriqueconfirm">Valider</button>
                  </div>
                  <div class="col-6 col-md-3 text-center">
                     <button type="reset" class="btn btn-secondary" v-on:click="btnadmnewsousrubriquecancel">Annuler</button>
                  </div>
               </form>
               <!-- ferme New sous-rubrique -->
            </div>
            <div class="card-footer bg-secondary">
               <div class="row">
                  <div class="col-md mb-1 text-center">
                     <button type="button" class="btn btn-sm btn-warning" v-on:click="btnadmrenamerubrique(rub.RubID)">Renommer la rubrique</button>
                  </div>
                  <div class="col-md text-center">
                     <button type="button" class="btn btn-sm btn-danger" v-on:click="btnadmdeleterubrique(rub.RubID)">Supprimer la rubrique</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- ferme Liste rubriques -->
   </div>
</div>
<!-- ferme Liste / add / rename / suppr rubriques & Liste / add / suppr sous-rubriques -->


<!-- ouvre New rubrique -->
<div class="container" v-if="admnewrubrique">
   <div>
      <button type="button" class="btn btn-lg btn-link" v-on:click="btnadmrubrique(0)">Retour aux rubriques</button>
   </div>
   <div class="card my-3">
      <div class="card-header bg-dark text-center"><h3 class="text-light">Nouvelle rubrique</h3></div>
      <div class="card-body">
            <div class="container row mb-1">
               <form class="container mb-3">
                  <div class="form-group">
                     <label>Nom de la rubrique</label>
                     <input type="text" class="form-control" id="libelle" name="libelle" v-model="rform.RubLibelle" placeholder="Entrez le nom de la nouvelle rubrique">
                  </div>
               </form>
           </div>
      </div>
      <div class="card-footer bg-secondary">
         <div class="row">
            <div class="col-md text-center"><button type="button" class="btn btn-success" v-on:click="btnadmnewrubriqueconfirm">Valider</button></div>
            <div class="col-md text-center"><button type="reset" class="btn btn-light" v-on:click="btnadmnewrubriquecancel">Annuler</button></div>
         </div>
      </div>
   </div>
</div>
<!-- ferme New rubrique -->


<!-- ouvre Modif sous-rubrique -->
<div class="container" v-if="admmodifsousrubrique">
   <div>
      <button type="button" class="btn btn-lg btn-link" v-on:click="btnadmrubrique(0)">Retour aux rubriques</button>
   </div>
   <div class="card my-3">
      <div class="card-header bg-dark"><h3 class="text-light">{{ srform.SRubLibelle }}</h3></div>
      <div class="card-body">
         <form class="container mb-3">
            <input type="hidden" id="SRubID" name="SRubID" v-model="srform.SRubID">
            <div class="form-group">
               <label>Libellé de la sous-rubrique</label>
               <input type="text" class="form-control" id="code" name="code" pattern="^[-A-Za-z0-9]{1,50}$" v-model="srform.SRubLibelle" placeholder="Entrez le libellé" required>
            </div>
            <div class="form-group">
               <label>Rubrique de rattachement</label>
               <select class="form-control">
                  <option v-for="rub in rublist" v-model="srform.RubID" v-bind:selected="(srform.RubID == rub.RubID) ? true : false" v-on:click="changerub(rub.RubID)">{{ rub.RubLibelle }}</option>
               </select>
            </div>
            <div class="form-inline text-center my-2">
               <div class="col-md-6"><button type="button" class="btn btn-success" v-on:click="btnadmmodifsousrubriqueconfirm">Valider</button></div>
               <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btnadmmodifsousrubriquecancel">Annuler</button></div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- ferme Modif sous-rubrique -->
