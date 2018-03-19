
<!-- ouvre footer(a) -->
<footer>
  <div>
    <img src="<?= base_url()?>../../assets/img/FOOTER/footer.png" class="imagefooter d-none d-md-block">
  </div>

  <!-- ouvre composants footer -->
  <div class="textesurimagge">
    <div class="row">
      <div class="col-md-5">
        <b>Recevez <orange> nos offres exclusives : </orange></b>
        <div class="row">
          <div class="col-md-7">
            <input class="form-control w-100 d-none d-md-block" type="mail" v-model="mailnewsletter" placeholder="Votre adresse e-mail">
            <input class="form-control w-75 d-block d-md-none" type="mail" v-model="mailnewsletter" placeholder="Votre adresse e-mail">
          </div>
          <div class="col-md-5">
            <button type="button" class="btn btn-warning d-none d-md-block" v-on:click="btnnewsletter">Valider</button>
            <button type="button" class="btn btn-warning btn-sm d-block d-md-none mt-1" v-on:click="btnnewsletter">Valider</button>
          </div>
        </div>
      </div>
      <div class="col-md-7 d-none d-md-block">
        <div class="row">
          Suivez nous :
        </div>
        <div class="row">
          <a href="#"><img src="<?= base_url()?>../../assets/img/FOOTER/picto_facebook.png"></a>
          <a href="#" class="pl-2"><img src="<?= base_url()?>../../assets/img/FOOTER/picto_twitter.png"></a>
        </div>
      </div>
      <div class="col d-block d-md-none py-2">
        <div class="row">
          <div class="col-3"></div>
          <div class="col-6 text-center"><h3><b>Suivez nous :</b></h3></div>          
          <div class="col-3"></div>
        </div>
        <div class="row">
          <div class="col-4"></div>
          <div class="col-2"><a href="#"><img src="<?= base_url()?>../../assets/img/FOOTER/picto_facebook.png"></a></div>
          <div class="col-2"><a href="#"><img src="<?= base_url()?>../../assets/img/FOOTER/picto_twitter.png"></a></div>
          <div class="col-4"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- ferme composants footer -->

</footer>
<!-- ferme footer(a) -->


</div>
<!-- ferme container général de Visiteur ouvert dans VGFontHeader(a) -->


