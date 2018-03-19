
<!-- ouvre Liste / modif / suppr produits -->
<div class="container" v-if="admproduit">
   <div>
      <button type="button" class="btn btn-lg btn-link" v-on:click="btnadmrubrique(0)">Retour aux rubriques</button>
   </div>
   <div class="card my-3">
      <div class="card-header bg-dark">
         <div class="row">
            <div class="col-md-8">
               <a href="#" v-on:click="btnadmproduit('null',0,0)"><h3 class="text-light">{{ titrelistepro }}</h3></a>
            </div>
                <div class="col-md-4 text-right">
               <button type="button" class="btn btn-lg btn-primary" v-on:click="btnadmnewproduit">Nouveau produit</button>
            </div>
         </div>
         <div align="center">
             <b-label class="text-light" >Rechercher un produit : </b-label><br /><br />
             <input class="form-control w-100 d-none d-md-block" type="text" placeholder="Entrez le nom du produit recherché" v-model="lfproduit"></input><br />
             <button type="button" class="btn btn-md btn-secondary d-none d-md-block" v-on:click="search">Rechercher</button>
         </div>
      </div>
      <div class="card-body">
         <!-- ouvre Liste produits -->
         <div v-for="pro in prolist">
            <div class="row mb-1">
               <div class="col-md-6">- {{ pro.ProLibelle }}</div>
               <div class="col-md-2 d-none d-md-block">{{ pro.ProPrixAchat }} €</div>
               <div class="col-6 col-md-2 text-right">
                  <button type="button" class="btn btn-xs btn-outline-warning" v-on:click="btnadmmodifproduit(pro.ProCode)">Modifier</button>
               </div>
               <div class="col-6 col-md-2 text-right">
                  <button type="button" class="btn btn-xs btn-outline-danger" v-on:click="btnadmdeleteproduit(pro.ProCode)">Supprimer</button> <!-- Ajouter Click supprimer produit -->
               </div>
            </div>
            <!-- ouvre Modif produit -->
            <div class="container row mb-1"  v-if="pro.ProCode == detpro && admmodifproduit">
               <form class="container mb-3">
                  <div class="form-group">
                     <label >Code Produit</label>
                     <input type="text" class="form-control" id="code" name="code" pattern="^[A-Za-z]{2}[0-9]{4}$" v-model="pform.ProCode" placeholder="Entrez le code produit (format AB1234)" required>
                  </div>
                  <div class="form-group">
                     <label>Nom du produit</label>
                     <input type="text" class="form-control" id="nom" name="nom" pattern="^.{1,50}$" v-model="pform.ProLibelle" placeholder="Entrez le nom du produit" required>
                  </div>
                  <div class="form-group">
                     <label for="textarea">Description du produit</label>
                     <textarea id="textarea" class="form-control" rows="4" placeholder="Entrez la description du produit">{{ pform.ProDescription }}</textarea>
                  </div>
                  <div class="form-group">
                     <label>URL de la photo du produit</label>
                     <input type="URL" class="form-control" v-model="pform.ProPhoto" placeholder="Entrez l'URL de la photo du produit">
                  </div>
                  <div class="form-group">
                     <label>Affichage sur le site</label>
                     <div class="radio">
                        <label><input type="radio" class="radio-button" name="aff" value="1" v-model="g.pform.ProAffichage"> oui</label>
                     </div>
                     <div class="radio">
                        <label><input type="radio" class="radio-button" name="aff" value="0" v-model="g.pform.ProAffichage"> non</label>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Prix du produit (en €)</label>
                     <input type="number" min="0" class="form-control" id="prix" name="prix" v-model="pform.ProPrixAchat" placeholder="Entrez le prix d'achat du produit" required>
                  </div>
                  <div class="form-group">
                     <label>Stock physique du produit</label>
                     <input type="number" min="0" class="form-control" id="stkphy" name="stkphy" v-model="pform.ProStockPhysique" placeholder="Entrez le stock physique du produit" required>
                  </div>
                  <div class="form-group">
                     <label>Stock d'alerte du produit</label>
                     <input type="number" min="0" class="form-control" id="stkale" name="stkale" v-model="pform.ProStockAlerte" placeholder="Entrez le stock d'alerte renouvellement du produit" required>
                  </div>
                  <div class="form-group">
                     <label>Quantité d'approvisionnement</label>
                     <input type="number" min="0" class="form-control" id="appro" name="appro" v-model="pform.apprQuantite" placeholder="Entrez la quantité d'approvisionnement du produit" required>
                  </div>
                  <div class="form-group">
                     <label>Fournisseur</label>
                     <select class="form-control" required>
                        <option selected disabled>-- <i>Fournisseur</i> --</option>
                        <option v-for="fou in foulist" :value="fou.FouID" v-bind:selected="(g.pform.FouID == fou.FouID) ? true : false" v-on:click="changefou(fou.FouID)">{{ fou.FouNom }}</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Rubrique de rattachement</label>
                     <select class="form-control" required>
                        <option disabled>-- <i>Rubrique</i> --</option>
                        <option v-for="rub in rublist" :value="rub.RubID" v-bind:selected="(detrub == rub.RubID) ? true : false" v-on:click="changerub(rub.RubID)">{{ rub.RubLibelle }}</option>
                     </select>
                     <br>
                     <select class="form-control" required>
                        <option value="0" v-bind:selected="(srform.RubID != temp) ? true : false"  disabled>-- <i>Sous-rubrique</i> --</option>
                        <option v-for="srub in srublist" v-bind:selected="srub.SRubID == g.srform.SRubID" :value="srub.SRubID" v-if="detrub == srub.RubID" v-on:click="changesrub(srub.SRubID)">{{ srub.SRubLibelle }}</option>
                     </select>
                  </div>
                  <div class="form-inline text-center my-2">
                     <div class="col-md-6"><button type="button" class="btn btn-success" v-on:click="btnadmmodifproduitconfirm">Valider</button></div>
                     <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btnadmmodifproduitcancel">Annuler</button></div>
                  </div>
               </form>
            </div>
            <!-- ferme Modif produit -->
         </div>
      </div>
      <!-- ferme Liste produits -->
   </div>
</div>
<!-- ferme Liste / modif / suppr produits -->

<!-- ouvre Nouveau produit -->
<div class="container" v-if="admnewproduit">
   <div class="card my-3">
      <div class="card-header bg-dark">
         <h3 class="text-light">Nouveau produit</h3>
      </div>
      <div class="card-body">
         <div class=" row mb-1"  >
            <form class="container mb-3">
               <div class="form-group">
                  <label>Code Produit</label>
                  <input type="text" class="form-control" id="code" name="code" v-model="pform.ProCode" pattern="^[A-Za-z]{2}[0-9]{4}$" placeholder="Entrez le code produit" required>
               </div>
               <div class="form-group">
                  <label>Nom du produit</label>
                  <input type="text" class="form-control" id="nom" name="nom" v-model="pform.ProLibelle" pattern="^[A-Za-z0-9- ._]{1,50}$" placeholder="Entrez le nom du produit" required>
               </div>
                  <div class="form-group">
                  <label for="textarea">Description du produit</label>
                  <textarea id="textarea" class="form-control" rows="4" placeholder="Entrez la description du produit">{{ pform.ProDescription }}</textarea>
               </div>
               <div class="form-group">
                  <label>URL de la photo du produit</label>
                  <input type="URL" class="form-control" v-model="pform.ProPhoto" placeholder="Entrez l'URL de la photo du produit">
               </div>
               <div class="form-group">
                  <label>Affichage sur le site</label>
                  <div class="radio">
                     <label><input type="radio" class="radio-button" name="aff" value="1" v-model="g.pform.ProAffichage" v-bind:checked="g.pform.ProAffichage == 1"> oui</label>
                  </div>
                  <div class="radio">
                     <label><input type="radio" class="radio-button" name="aff" value="0" v-model="g.pform.ProAffichage" v-bind:checked="g.pform.ProAffichage == 0"> non</label>
                  </div>
               </div>
               <div class="form-group">
                  <label>Prix d'achat du produit (en €)</label>
                  <input type="number" min="0" class="form-control" id="prix" name="prix" v-model="pform.ProPrixAchat" placeholder="Entrez le prix d'achat du produit" required>
               </div>
               <div class="form-group">
                  <label>Stock physique du produit</label>
                  <input type="number" min="0" class="form-control" id="stkphy" name="stkphy" v-model="pform.ProStockPhysique" placeholder="Entrez le stock physique du produit" required>
               </div>
               <div class="form-group">
                  <label>Stock d'alerte du produit</label>
                  <input type="number" min="0" class="form-control" id="stkale" name="stkale" v-model="pform.ProStockAlerte" placeholder="Entrez le stock d'alerte renouvellement du produit" required>
               </div>
               <div class="form-group">
                  <label>Quantité d'approvisionnement</label>
                  <input type="number" min="0" class="form-control" id="appro" name="appro" v-model="pform.apprQuantite" placeholder="Entrez la quantité d'approvisionnement du produit" required>
               </div>
               <div class="form-group">
                  <label>Fournisseur</label>
                  <select class="form-control" required>
                     <option selected disabled>-- <i>Fournisseur</i> --</option>
                     <option v-for="fou in foulist" :value="fou.FouID" v-on:click="changefou(fou.FouID)">{{ fou.FouNom }}</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Rubrique de rattachement</label>
                  <select class="form-control" required>
                     <option  selected disabled>-- <i>Rubrique</i> --</option>
                     <option v-for="rub in rublist" :value="rub.RubID" v-on:click="changerub(rub.RubID)">{{ rub.RubLibelle }}</option>
                  </select>
                  <br>
                  <select class="form-control" v-model="temp" v-if="detrub != 0" required>
                     <option value="0" selected disabled>-- <i>Sous-rubrique</i> --</option>
                     <option v-for="srub in srublist" :value="srub.SRubID" v-if="detrub == srub.RubID" v-on:click="changesrub(srub.SRubID)">{{ srub.SRubLibelle }}</option>
                  </select>
               </div>

               <div class="form-inline text-center my-2">
                  <div class="col-md-6"><button type="button" class="btn btn-success" v-on:click="btnadmnewproduitconfirm">Valider</button></div>
                  <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btnadmnewproduitcancel">Annuler</button></div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- ferme Nouveau produit -->
