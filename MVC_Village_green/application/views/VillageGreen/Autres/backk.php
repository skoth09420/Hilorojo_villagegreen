<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-vue@2.0.0-rc.1/dist/bootstrap-vue.css">
  <script src="https://unpkg.com/vue@2.5.13/dist/vue.min.js"></script>
  <script src="https://unpkg.com/axios@0.18.0/dist/axios.min.js"></script>
  <script src="https://unpkg.com/babel-polyfill@6.26.0/dist/polyfill.min.js"></script>
  <script src="https://unpkg.com/bootstrap-vue@2.0.0-rc.1/dist/bootstrap-vue.min.js"></script>
 
  <title>Admin - Village green </title>
  <link rel="stylesheet" href="<?= base_url()?>../../assets/css/villagegreen_back.css">
</head>

<body>
  <div class="container-fluid"  id="global">
  
    <div class="d-block d-md-none">
      <img src="<?= base_url()?>../../assets/img/HEADER/logo.png" class="img-responsive w-50 logo">
      <div class="row navtype1xs">
        <div class="col-7"></div>
        <div class="col-5 dropdown text-right">
          <button type="button" class="btn btn-link btn-sm dropdown-toggle navbutton" data-toggle="dropdown"><b>Admin</b></button>
          <div class="dropdown-menu dropdown-menu-right madmin">
            <a class="dropdown-item navlinks" href="#">Langues :<br> <img src="<?= base_url()?>../../assets/img/HEADER/pictopays.png" class="navmarge" width="30%"/></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item navlinks" href="#">Se déconnecter</a>
          </div>
        </div>
      </div>
      <div class="row navtype2xs">
        <div class="col-7"></div>
        <div class="col-5 dropdown text-right">
          <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown"><b>MENU</b></button>
          <div class="dropdown-menu dropdown-menu-right navtype3xs">
            <a class="dropdown-item navlinkxs" href="#"><b>Rubriques</b></a>
            <a class="dropdown-item navlinkxs" href="#">- Guitares</a>
            <a class="dropdown-item navlinkxs" href="#">- Batteries</a>
            <a class="dropdown-item navlinkxs" href="#">- Clavier</a>
            <a class="dropdown-item navlinkxs" href="#">- Studio</a>
            <a class="dropdown-item navlinkxs" href="#">- Sono</a>
            <a class="dropdown-item navlinkxs" href="#">- Eclairage</a>
            <a class="dropdown-item navlinkxs" href="#">- <i>Tous les produits</i></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item navlinkxs" href="#"><b>Commandes</b></a>
            <a class="dropdown-item navlinkxs" href="#"><b>Clients</b></a>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>
</html>

<!-- <script src="<?= base_url()?>../../assets/script.js"></script> -->