        <!-- ouvre Accueil(b) -->
        <div v-if="admaccueil">

          <!-- ouvre Affiche guitare + pub -->
          <div class="row m-0">
            <div class="col-9 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/pub guitare.png" class="guitar"></div>
            <div class="col-3 m-0 p-0 text-center">
              <img src="<?= base_url()?>../../assets/img/BODY/banniere droite prix.png" usemap="#planetmap" class="banner">
              <map name="planetmap">
                <area shape="rect" coords="18,412,194,508" href="#"/>
              </map>
            </div>
          </div>
          <!-- ferme Affiche guitare + pub -->

          <!-- ouvre Bandeau gris 4pictos -->
          <div class="lvl1">
              <img src="<?= base_url()?>../../assets/img/BODY/banniere centre 4 pictos.png" class="w-100 h-50">
          </div>
          <!-- ouvre Bandeau gris 4pictos -->

          <h3><b>Nos catégories</b></h3>
          <!-- ouvre catégories -->
          <div class="row m-0">
              <div class="col-3 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/CATEGORIES guitare.png"    class="categs m-0 p-0"></div>
              <div class="col-3 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/CATEGORIES batterie.png"   class="categs m-0 p-0"></div>
              <div class="col-3 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/CATEGORIES piano.png"      class="categs m-0 p-0"></div>
              <div class="col-3 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/CATEGORIES micro.png"      class="categs m-0 p-0"></div>
              <div class="col-3 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/CATEGORIES sono.png"       class="categs m-0 p-0"></div>
              <div class="col-3 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/CATEGORIES cases.png"      class="categs m-0 p-0"></div>
              <div class="col-3 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/CATEGORIES cable.png"      class="categs m-0 p-0"></div>
              <div class="col-3 m-0 p-0 text-center"><img src="<?= base_url()?>../../assets/img/BODY/CATEGORIES saxo.png"       class="categs m-0 p-0"></div>
          </div>
          <!-- ferme catégories -->

          <!-- ouvre Meileures ventes / Partenaires -->
          <div class="lvl1">
              <div class="row">
                  <div class="col-6"><h3><b>Nos meilleures ventes</b></h3></div>
                  <div class="col-6"><h3><b>Nos partenaires</b></h3></div>
              </div>
              <div class="row lvl3">
                  <div class="col-2"><img src="<?= base_url()?>../../assets/img/BODY/TOP VENTES guitare.png"   class="imvente"></div>
                  <div class="col-2"><img src="<?= base_url()?>../../assets/img/BODY/TOP VENTES saxo.png"      class="imvente"></div>
                  <div class="col-2"><img src="<?= base_url()?>../../assets/img/BODY/TOP VENTES piano.png"     class="imvente"></div>
                  <div class="col-6"><img src="<?= base_url()?>../../assets/img/BODY/partenaires 4 logos.png"  class="impart"> </div>
              </div>
          </div>
          <!-- ferme Meileures ventes / Partenaires -->
        </div>
        <!-- ferme Accueil (b) -->