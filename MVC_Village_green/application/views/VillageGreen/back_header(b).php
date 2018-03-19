
<!-- ouvre container général d'Admin, se ferme dans back_footer -->
<div class="container-fluid" v-if="b">

  <!-- ouvre en-tête d-md-block -->
  <header class="d-none d-md-block">
    <img src="<?= base_url()?>../../assets/img/HEADER/logo.png" class="logo" v-on="{ mouseover: hovcachsousrubriques }">
    <!-- ouvre navbar 1 -->
    <div class="row navtype1" v-on="{ mouseover: hovcachsousrubriques }">
      <div class="col-4"></div>
      <div class="col-2 mx-auto my-0 text-right">
        <button type="button" class="btn btn-sm btn-dark" v-on:click="btnpagevisit">Se déconnecter</button>
      </div>
      <div class="col-4 mx-auto my-0">
        <label><h5>Connecté en tant que <b>Admin</b></h5></label>
      </div>
      <div class="col-1 mx-auto my-0 text-right">
        <label for="Flag"><h6><b>Pe</b></h6></label>
      </div>
      <div class="col-1 mx-auto my-0">
        <img id="Flag" src="<?= base_url()?>../../assets/img/HEADER/pictopays.png"/>
      </div>
    </div>
    <!-- ferme navbar 1 -->


    <!-- ouvre navbar 2 -->
    <div class="row navtype2">
      <div class="col-4"></div>
      <div class="col text-center">
        <a href="#" class="navlinks" v-on="{ mouseover: hovaffsousrubriques }" v-on:click="btnadmrubrique(0)"><h5>Rubriques</h5></a>
      </div>
      <div class="col text-center">
        <a href="#" class="navlinks" v-on="{ mouseover: hovcachsousrubriques }" v-on:click="btnadmproduit(0,0)"><h5>Produits</h5></a>
      </div>
      <div class="col text-center">
        <a href="#" class="navlinks"><h5>Commandes</h5></a>
      </div>
      <div class="col text-center">
        <a href="#" class="navlinks" v-on:click="btnadmclient(0)"><h5>Clients</h5></a>
      </div>
    </div>
    <!-- ferme navbar 2 -->

    <!-- ouvre navbar 3 -->
    <div class="row navtype3" v-on="{ mouseleave: hovcachsousrubriques }">
      <div class="col-4 text-center">VG</div>
      <div class="col text-center" v-if="affsousrubriques">
        <a href="#" class="navlinks" v-on:click="btnadmrubrique(1)"><h6>Guitares</h6></a>
      </div>
      <div class="col text-center" v-if="affsousrubriques">
        <a href="#" class="navlinks" v-on:click="btnadmrubrique(2)"><h6>Batteries</h6></a>
      </div>
      <div class="col text-center" v-if="affsousrubriques">
        <a href="#" class="navlinks" v-on:click="btnadmrubrique(3)"><h6>Claviers</h6></a>
      </div>
      <div class="col text-center" v-if="affsousrubriques">
        <a href="#" class="navlinks" v-on:click="btnadmrubrique(4)"><h6>Studios</h6></a>
      </div>
      <div class="col text-center" v-if="affsousrubriques">
        <a href="#" class="navlinks" v-on:click="btnadmrubrique(5)"><h6>Sonos</h6></a>
      </div>
      <div class="col text-center" v-if="affsousrubriques">
        <a href="#" class="navlinks" v-on:click="btnadmrubrique(6)"><h6>Eclairages</h6></a>
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
        <button type="button" class="btn btn-link btn-sm dropdown-toggle navbutton" data-toggle="dropdown"><b>Admin</b></button>
        <div class="dropdown-menu dropdown-menu-right madmin">
          <a class="dropdown-item" href="#" v-on:click="btnpagevisit">Se déconnecter</a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">Langue : <img src="<?= base_url()?>../../assets/img/HEADER/pictopays.png" class="w-25"/></div>
        </div>
      </div>
    </div>
    <!-- ferme navbar 1 -->

    <!-- ouvre navbar 2 -->
    <div class="row navtype2xs">
      <div class="col-6"></div>
      <div class="col-6 text-center dropdown text-right">
        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"><b>MENU</b></button>
        <div class="dropdown-menu dropdown-menu-right navtype3xs">
          <a class="dropdown-item text-light" href="#" v-on:click="btnadmrubrique(0)"><b>Rubriques</b></a>
          <a class="dropdown-item navlinkxs" href="#" v-on:click="btnadmrubrique(1)">- Guitares</a>
          <a class="dropdown-item navlinkxs" href="#" v-on:click="btnadmrubrique(2)">- Batteries</a>
          <a class="dropdown-item navlinkxs" href="#" v-on:click="btnadmrubrique(3)">- Clavier</a>
          <a class="dropdown-item navlinkxs" href="#" v-on:click="btnadmrubrique(4)">- Studio</a>
          <a class="dropdown-item navlinkxs" href="#" v-on:click="btnadmrubrique(5)">- Sono</a>
          <a class="dropdown-item navlinkxs" href="#" v-on:click="btnadmrubrique(6)">- Eclairage</a>
          <a class="dropdown-item navlinkxs" href="#" v-on:click="btnadmproduit(0,0)"><i>Tous les produits</i></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-light" href="#"><b>Commandes</b></a>
          <a class="dropdown-item text-light" href="#" v-on:click="btnadmclient(0)"><b>Clients</b></a>
        </div>
      </div>
    </div>
    <!-- ferme navbar 2 -->
  </div>
  <!-- ferme en-tête d-md-none -->


  <!-- ouvre div "id=fontacc" -->
  <div id="fontacc">
    <!-- ouvre div "class=contbody" -->
    <div class="contbody">
      