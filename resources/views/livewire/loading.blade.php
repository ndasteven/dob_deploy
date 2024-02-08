     {{--Script de chargement des donnees venant du controller livewire studentIndex.php--}}
     <div wire:loading style="z-index: 10;">
        <div class="d-flex justify-content-between" style="background-color: rgba(0, 0, 0, 0.4);width:100%; height:100%; left:0; top:0;position:fixed;">
          <div class="col-8 col-md-2 mx-auto" style="display: block; z-index: 2; margin-top:15% ">
            <!--card pour alert-->
            <div class="card" style="padding: 0px; border-radius: 15px;">
                <div style="border: solid 1px #049724; background-color: #049724; color: #fff; border-bottom-left-radius: 50%; border-bottom-right-radius: 50%; padding: 38px ;
                position: relative; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <div style="text-align: center;position: absolute;top: 50px; left: 42%; "><img src="asset/img/amoi.png" height="51" width="58"></div>
                </div>
                <div class="card-body " style="text-align: center; margin-top: 10px;">
                    <div>
                        <small style="font-weight: bold; font-weight: bold;text-align: center">Veillez patientez svp!</small>
                    </div>
                    <div class="col-2 mx-auto" style="display:block; text-align:center">
                        <img src="asset/img/load.gif" alt="" height="32" width="40">
                    </div>
                </div>
            </div>
            <!--fin de card pour alert-->
        </div>
        </div>
      </div> 
      {{--Fin de Script de chargement des donnees venant du controller livewire studentIndex.php--}}