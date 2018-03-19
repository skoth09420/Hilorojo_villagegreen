
<!-- ouvre container général de Visiteur, se ferme dans VGFontFooter(a) -->
<div class="container-fluid" v-if="a">

  <!-- ouvre en-tête d-md-block -->
  <header class="d-none d-md-block">
    <img src="<?= base_url()?>../../assets/img/HEADER/logo.png" class="logo" v-on="{ mouseover: hovcachsousrubriques }" usemap="#planetmap">
    <map name="planetmap">
        <area shape="rect" coords="14,8,278,150" href="#" v-on:click="btnretouracc"/>
    </map>
    <!-- ouvre navbar 1 -->
    <div class="row navtype1" v-on="{ mouseover: hovcachsousrubriques }">
      <div class="col-4"></div>
      <div class="col-2 mx-auto my-0 text-right">
        <a href="#" v-on:click="btnpageadmin" ><img src="<?= base_url()?>../../assets/img/HEADER/login.png" class="w-25"></a>
      </div><div class="col-4 mx-auto my-0">
        <a href="#" v-on:click="btninfosclient" class="navlinksbl">Bienvenue John !</a>
      </div>
      <div class="col-1 mx-auto my-0">
        <a href="#"><img src="<?= base_url()?>../../assets/img/HEADER/pictopanier.png"></a>
      </div>
      <div class="col-1 mx-auto my-0">
        <img src="<?= base_url()?>../../assets/img/HEADER/pictopays.png">
      </div>
    </div>
    <!-- ferme navbar 1 -->

    <!-- ouvre navbar 2 -->
    <div class="row navtype2">
      <div class="col-4"></div>
      <div class="col text-center">
        <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/2-accueil" class="navlinks" v-on="{ mouseover: hovaffsousrubriques }" ><h5>Produits</h5></a>
      </div>
      <div class="col text-center">
        <a href="#" class="navlinks"><h5>Commandes</h5></a>
      </div>
      <div class="col text-center">
        <a href="#" class="navlinks"><h5>Livraisons</h5></a>
      </div>
    </div>

    <!-- ouvre navbar 3 -->
    <div class="row navtype3" v-on="{ mouseleave: hovcachsousrubriques }">
      <div class="col-4 text-center">VG</div>
      <div class="col text-center dropdown" v-if="affsousrubriques">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-dark btn-sm text-light dropdown-toggle" data-toggle="dropdown"><b>Guitares</b></button>
          <div class="dropdown-menu bg-dark text-light dropdown-menu-left">
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/34-electriques" class="dropdown-item bg-dark text-light">- Electriques</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/35-classiques" class="dropdown-item bg-dark text-light">- Classiques</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/36-acoustiques-et-electro-acoustiques" class="dropdown-item bg-dark text-light">- Acoustiques</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/57-basse-electrique" class="dropdown-item bg-dark text-light">- Basses électriques</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/29-guitares" class="dropdown-item bg-dark text-light"><i>Toutes les guitares</i></a>
          </div>
        </div>
      </div>
      <div class="col text-center dropdown" v-if="affsousrubriques">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-dark btn-sm text-light dropdown-toggle" data-toggle="dropdown"><b>Batteries</b></button>
          <div class="dropdown-menu bg-dark text-light dropdown-menu-left">
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/37-electriques" class="dropdown-item bg-dark text-light">- Electriques</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/38-acoustiques" class="dropdown-item bg-dark text-light">- Acoustiques</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/39-grosses-caisses" class="dropdown-item bg-dark text-light">- Grosses caisses</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/40-caisses-claires" class="dropdown-item bg-dark text-light">- Caisses claires</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/28-batteries" class="dropdown-item bg-dark text-light"><i>Toutes les batteries</i></a>
          </div>
        </div>
      </div>
      <div class="col text-center dropdown" v-if="affsousrubriques">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-dark btn-sm text-light dropdown-toggle" data-toggle="dropdown"><b>Claviers</b></button>
          <div class="dropdown-menu bg-dark text-light dropdown-menu-left">
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/41-synthetiseur" class="dropdown-item bg-dark text-light">- Synthétiseurs</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/42-orgues" class="dropdown-item bg-dark text-light">- Orgues</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/43-orgues-electroniques" class="dropdown-item bg-dark text-light">- Orgues électroniques</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/44-claviers-maitres" class="dropdown-item bg-dark text-light">- Claviers maîtres</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/30-claviers" class="dropdown-item bg-dark text-light"><i>Tous les claviers</i></a>
          </div>
        </div>
      </div>
      <div class="col text-center dropdown" v-if="affsousrubriques">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-dark btn-sm text-light dropdown-toggle" data-toggle="dropdown"><b>Studios</b></button>
          <div class="dropdown-menu bg-dark text-light dropdown-menu-right">
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/45-interface-audio" class="dropdown-item bg-dark text-light">- Interfaces audio</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/46-monitoring" class="dropdown-item bg-dark text-light">- Monitorings</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/47-microphone" class="dropdown-item bg-dark text-light">- Microphones</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/48-logiciel" class="dropdown-item bg-dark text-light">- Logiciels</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/31-studio" class="dropdown-item bg-dark text-light"><i>Tous les studios</i></a>
          </div>
        </div>
      </div>
      <div class="col text-center dropdown" v-if="affsousrubriques">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-dark btn-sm text-light dropdown-toggle" data-toggle="dropdown"><b>Sonos</b></button>
          <div class="dropdown-menu bg-dark text-light dropdown-menu-right">
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/49-set-sono-complet" class="dropdown-item bg-dark text-light">- Sets sono</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/50-enceintes" class="dropdown-item bg-dark text-light">- Enceintes</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/51-table-de-mixage" class="dropdown-item bg-dark text-light">- Tables de mixage</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/52-amplificateur" class="dropdown-item bg-dark text-light">- Amplificateurs</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/32-sono" class="dropdown-item bg-dark text-light"><i>Toutes les sonos</i></a>
          </div>
        </div>
      </div>
      <div class="col text-center dropdown" v-if="affsousrubriques">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-dark btn-sm text-light dropdown-toggle" data-toggle="dropdown"><b>Eclairages</b></button>
          <div class="dropdown-menu bg-dark text-light dropdown-menu-right">
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/53-set-d-eclairages" class="dropdown-item bg-dark text-light">- Sets d'éclairage</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/54-projecteurs" class="dropdown-item bg-dark text-light">- Projecteurs</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/55-projecteur-robotises" class="dropdown-item bg-dark text-light">- Projecteurs robotisés</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/56-technoled" class="dropdown-item bg-dark text-light">- Technoleds</a>
            <a href="http://liens2scott.yo.fr/prestashop_1.7.2.5/33-eclairage" class="dropdown-item bg-dark text-light"><i>Tous les éclairages</i></a>
          </div>
        </div>
      </div>
    </div>
    <!-- ferme navbar 3 -->
  </header>
  <!-- ferme en-tête d-md-block -->

  <!-- ouvre en-tête d-md-none -->
  <div class="d-block d-md-none headerxs">
    <img src="<?= base_url()?>../../assets/img/HEADER/logo.png" class="img-responsive w-50 logo">
    <!-- ouvre navbar 1 -->
    <div class="row navtype1xs">
      <div class="col-7"></div>
      <div class="col-5 dropdown text-right">
        <button type="button" class="btn btn-link btn-sm dropdown-toggle navbutton" data-toggle="dropdown"><b>Plus</b></button>
        <div class="dropdown-menu dropdown-menu-right madmin">
          <a href="#" class="dropdown-item" v-on:click="btnpageadmin"><img src="<?= base_url()?>../../assets/img/HEADER/login.png" class="w-25"/></a>
          <a href="#" class="dropdown-item" v-on:click="btninfosclient">Espace Client</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"><img src="<?= base_url()?>../../assets/img/HEADER/pictopanier.png" class="w-25"/></a>
          <a href="#" class="dropdown-item">Infos</a>
          <div class="dropdown-item">Langue : <img src="<?= base_url()?>../../assets/img/HEADER/pictopays.png" class="navmarge w-25"/></div>
        </div>
      </div>
    </div>
    <!-- ferme navbar 1 -->

    <!-- ouvre navbar 2 -->
    <div class="row navtype2xs">
      <div class="col-7"></div>
      <div class="col-5 dropdown text-right">
        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"><b>MENU</b></button>
        <div class="dropdown-menu dropdown-menu-right navtype3xs">
          <div class="dropdown-item text-light"><b>Rubriques</b></div>
          <a class="dropdown-item navlinkxs" href="http://liens2scott.yo.fr/prestashop_1.7.2.5/29-guitares" >- Guitares</a>
          <a class="dropdown-item navlinkxs" href="http://liens2scott.yo.fr/prestashop_1.7.2.5/28-batteries" >- Batteries</a>
          <a class="dropdown-item navlinkxs" href="http://liens2scott.yo.fr/prestashop_1.7.2.5/30-claviers" >- Clavier</a>
          <a class="dropdown-item navlinkxs" href="http://liens2scott.yo.fr/prestashop_1.7.2.5/31-studio" >- Studio</a>
          <a class="dropdown-item navlinkxs" href="http://liens2scott.yo.fr/prestashop_1.7.2.5/32-sono" >- Sono</a>
          <a class="dropdown-item navlinkxs" href="http://liens2scott.yo.fr/prestashop_1.7.2.5/33-eclairage" >- Eclairage</a>
          <a class="dropdown-item navlinkxs" href="http://liens2scott.yo.fr/prestashop_1.7.2.5/2-accueil" ><i>Tous les produits</i></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-light" href="#"><b>Commandes</b></a>
          <a class="dropdown-item text-light" href="#"><b>Livraisons</b></a>
        </div>
      </div>
    </div>
    <!-- ferme navbar 2 -->
  </div>
  <!-- ferme en-tête d-md-none -->