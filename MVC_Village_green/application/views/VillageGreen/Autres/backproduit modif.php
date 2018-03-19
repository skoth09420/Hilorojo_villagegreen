<div id="contenu" v-if="admaccueil">
   Bienvenue admin vous pouvez modifier bouton gniiiiiiin
   <br>Oui
</div>

<div id="contenu">

   <div class="container" v-if="admlisteproduits">
      <div>
         <button type="button" class="btn btn-lg btn-link">Retour aux rubriques</button>
      </div>
      <div class="card my-3">
         <div class="card-header bg-dark">
            <div class="row">
               <div class="col-md-8">
                  <h3 style="color: white;">{{ titrelistepro }}</h3>
               </div>
               <div class="col-md-4 text-right">
                  <button type="button" class="btn btn-lg btn-primary">Nouveau produit</button>
               </div>
            </div>
         </div>
         <div class="card-body">
            <?php foreach ($prodiks as $prd):
            // if ($srub->RubID == $rub->RubID) {   ?>
            <div class="row mb-1">
               <div class="col-md-6">- <a href="#" class="navlinksbl"><?= $prd->ProLibelle; ?></a></div>
               <div class="col-md-2 d-none d-md-block"><?= $prd->ProPrixAchat; ?> €</div>
               <div class="col-6 col-md-2 text-right"><button type="button" class="btn btn-xs btn-outline-warning" v-on:click="btnadmmodifproduits('<?= $prd->ProCode; ?>')">Modifier</button></div>
               <div class="col-6 col-md-2 text-right"><button type="button" class="btn btn-xs btn-outline-danger">Supprimer</button></div>
            </div>
            <!-- <div class="card-body"> -->
            <div class="container row mb-1"  v-if="'<?= $prd->ProCode; ?>' == detpro" v-show="admmodifproduits">
               <form class="container mb-3">
               <div class="form-group">
                  <label >Code du Produit</label>
                  <input type="text" class="form-control" id="code" name="code" pattern="^[A-Za-z]{2}[0-9]{4}$" value="<?= $prd->ProCode; ?>" placeholder="Entrez le code produit" required>
               </div>
               <div class="form-group">
                  <label>Nom du Produit</label>
                  <input type="text" class="form-control" id="nom" name="nom" pattern="^[A-Za-z0-9-._]{1,50}$" value="<?= $prd->ProLibelle; ?>" placeholder="Entrez le nom du produit" required>
               </div>
                  <div class="form-group">
                  <label for="textarea">Description du produit</label>
                  <textarea id="textarea" class="form-control" rows="4" value="<?= $prd->ProDescription; ?>" placeholder="Entrez la description du produit"></textarea>
               </div>
               <!-- la pohoto -->
               <div class="form-group">
                  <label>Prix du produit (en €)</label>
                  <input type="number" class="form-control" id="prix" name="prix" pattern="^[0-9]{1,6}$" value="<?= $prd->ProPrixAchat; ?>" placeholder="Entrez le prix d'achat du produit" required>
                  <!-- <i class="glyphicon glyphicon-euro"></i> -->
               </div>
               <div class="form-group">
                  <label>Stock physique du produit</label>
                  <input type="number" class="form-control" id="stkphy" name="stkphy" pattern="^[0-9]{1,6}$" value="<?= $prd->ProStockPhysique; ?>" placeholder="Entrez le stock physique du produit" required>
               </div>
               <div class="form-group">
                  <label>Stock d'alerte du produit</label>
                  <input type="number" class="form-control" id="stkale" name="stkale" pattern="^[0-9]{1,6}$" value="<?= $prd->ProStockAlerte; ?>" placeholder="Entrez le stock d'alerte renouvellement du produit" required>
               </div>
               <div class="form-group">
                  <label>Quantité d'approvisionnement</label>
                  <input type="number" class="form-control" id="appro" name="appro" pattern="^[0-9]{1,6}$" value="<?= $prd->apprQuantite; ?>" placeholder="Entrez la quantité d'approvisionnement du produit" required>
               </div>
               <div class="form-inline text-center my-2">
                  <div class="col-md-6"><button type="submit" class="btn btn-success" v-on:click="btnadmmodifproduitsconfirm">Valider</button></div>
                  <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btnadmmodifproduitscancel">Annuler</button></div>
               </div>
            </form>
            </div>
            <?php // }
            endforeach; ?>
         </div>
      </div>
   </div>

   <div class="container-fluid" v-if="admrubriques">
      <div class="container-fluid row" v-show="admdetailrubriques">
         <div class="col-md-5"><button type="button" class="btn btn-lg btn-link">Retour à l'accueil</button></div>
         <div class="col-md-2"></div>
         <div class="col-md-5 text-right"><button type="button" class="btn btn-lg btn-primary">Nouvelle rubrique</button></div>
         <?php foreach ($rubriks as $rub): ?>
         <div class="col-md-6">
            <div class="card my-3">
               <div class="card-header bg-dark"><a href="#" class="navlinks"><h3><?= $rub->RubLibelle; ?></h3></a></div>
               <div class="card-body">
                  <?php foreach ($sous_rubriks as $srub):
                  if ($srub->RubID == $rub->RubID) {  ?>
                  <div class="row mb-1">
                     <div class="col-md-7">- <a href="#" class="navlinksbl"><?= $srub->SRubLibelle; ?></a></div>
                     <div class="col-6 col-md-2 text-center">
                        <button type="button" class="btn btn-xs btn-outline-warning" v-on:click="btnadmmodifsousrubrique(<?= $srub->SRubID; ?>)">Modifier</button>
                     </div>
                     <div class="col-6 col-md-3 text-center">
                        <button type="button" class="btn btn-xs btn-outline-danger">Supprimer</button>
                     </div>
                  </div>
                  <?php } endforeach; ?>
                  <div class="row mb-1">
                     <div class="col-md-7"></div>
                     <div class="col-md-5 text-center">
                        <button type="button" class="btn btn-xs btn-outline-primary">Nouvelle sous-rubrique</button>
                     </div>
                  </div>
               </div>
               <div class="card-footer bg-secondary">
                  <div class="row">
                     <div class="col-md mb-1 text-center">
                        <button type="button" class="btn btn-warning">Modifier la rubrique</button>
                     </div>
                     <div class="col-md text-center">
                        <button type="button" class="btn btn-danger">Supprimer la rubrique</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php endforeach; ?>
      </div>

      <div class="container" v-if="admlisteclients">
         <div>
            <button type="button" class="btn btn-lg btn-link">Retour aux rubriques</button>
         </div>
         <div class="card my-3">
            <div class="card-header bg-dark">
               <div class="row">
                  <div class="col-md-8">
                     <h3 style="color: white;">Liste des clients</h3>
                  </div>
                  <div class="col-md-4 text-right">
                     <button type="button" class="btn btn-lg btn-primary">Nouveau client</button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <?php foreach ($prodiks as $prd):
               // if ($srub->RubID == $rub->RubID) {   ?>
               <div class="row mb-1">
                  <div class="col-md-6">- <a href="#" class="navlinksbl"><?= $prd->ProLibelle; ?></a></div>
                  <div class="col-md-2 d-none d-md-block"><?= $prd->ProPrixAchat; ?> €</div>
                  <div class="col-6 col-md-2 text-right"><button type="button" class="btn btn-xs btn-outline-warning" v-on:click="btnadmmodifproduits('<?= $prd->ProCode; ?>')">Modifier</button></div>
                  <div class="col-6 col-md-2 text-right"><button type="button" class="btn btn-xs btn-outline-danger">Supprimer</button></div>
               </div>
               <!-- <div class="card-body"> -->
               <div class="container row mb-1"  v-if="'<?= $prd->ProCode; ?>' == detpro" v-show="admmodifproduits">
                  <form class="container mb-3">
                  <div class="form-group">
                     <label >Code du Produit</label>
                     <input type="text" class="form-control" id="code" name="code" pattern="^[A-Za-z]{2}[0-9]{4}$" value="<?= $prd->ProCode; ?>" placeholder="Entrez le code produit" required>
                  </div>
                  <div class="form-group">
                     <label>Nom du Produit</label>
                     <input type="text" class="form-control" id="nom" name="nom" pattern="^[A-Za-z0-9-._]{1,50}$" value="<?= $prd->ProLibelle; ?>" placeholder="Entrez le nom du produit" required>
                  </div>
                     <div class="form-group">
                     <label for="textarea">Description du produit</label>
                     <textarea id="textarea" class="form-control" rows="4" value="<?= $prd->ProDescription; ?>" placeholder="Entrez la description du produit"></textarea>
                  </div>
                  <!-- la pohoto -->
                  <div class="form-group">
                     <label>Prix du produit (en €)</label>
                     <input type="number" class="form-control" id="prix" name="prix" pattern="^[0-9]{1,6}$" value="<?= $prd->ProPrixAchat; ?>" placeholder="Entrez le prix d'achat du produit" required>
                     <!-- <i class="glyphicon glyphicon-euro"></i> -->
                  </div>
                  <div class="form-group">
                     <label>Stock physique du produit</label>
                     <input type="number" class="form-control" id="stkphy" name="stkphy" pattern="^[0-9]{1,6}$" value="<?= $prd->ProStockPhysique; ?>" placeholder="Entrez le stock physique du produit" required>
                  </div>
                  <div class="form-group">
                     <label>Stock d'alerte du produit</label>
                     <input type="number" class="form-control" id="stkale" name="stkale" pattern="^[0-9]{1,6}$" value="<?= $prd->ProStockAlerte; ?>" placeholder="Entrez le stock d'alerte renouvellement du produit" required>
                  </div>
                  <div class="form-group">
                     <label>Quantité d'approvisionnement</label>
                     <input type="number" class="form-control" id="appro" name="appro" pattern="^[0-9]{1,6}$" value="<?= $prd->apprQuantite; ?>" placeholder="Entrez la quantité d'approvisionnement du produit" required>
                  </div>
                  <div class="form-inline text-center my-2">
                     <div class="col-md-6"><button type="submit" class="btn btn-success" v-on:click="btnadmmodifproduitsconfirm">Valider</button></div>
                     <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btnadmmodifproduitscancel">Annuler</button></div>
                  </div>
               </form>
               </div>
               <?php // }
               endforeach; ?>
            </div>
         </div>
      </div>


      <?php foreach ($sous_rubriks as $srub): ?>
      <div class="card my-3" v-show="<?= $srub->SRubID; ?> == detssrub" v-if="admmodifsousrubrique">
               <div class="card-header bg-dark"><h3>{{ titressrub }}</h3></div>
               <div class="card-body">
                  <form class="container mb-3">
                     <div class="form-group">
                        <label>Libellé de la sous-rubrique</label>
                        <input type="text" class="form-control" id="code" name="code" pattern="^[-A-Za-z0-9]{1,50}$" value="<?= $srub->SRubLibelle; ?>" placeholder="Entrez le libellé" required>
                     </div>
                     <div class="form-group">
                        <label>Rubrique de rattachement</label>
                        <select>
                           <?php foreach ($rubriks as $rub): ?>
                           <option><?= $rub->RubLibelle; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="form-inline text-center my-2">
                        <div class="col-md-6"><button type="submit" class="btn btn-success" v-on:click="btnadmmodifsousrubriqueconfirm">Valider</button></div>
                        <div class="col-md-6"><button type="reset" class="btn btn-secondary" v-on:click="btnadmmodifsousrubriquecancel">Annuler</button></div>
                     </div>
                  </form>
               </div>
      </div>
      <?php endforeach; ?>

</div>
