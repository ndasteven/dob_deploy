<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer une DREN</h1>
          <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--Formulaire d'enregistrement-->
          <div class="col-md-10 mx-auto col-12">
            <!--Message alert-->
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif
            <!--Message alert-->
            <form wire:submit.prevent='storeDren()'>
                <div class="row">
                <div class="col">
                    <label for="validationServer01" class="form-label">CODE DREN</label>
                    <input  class="form-control @error('code_dren') is-invalid @enderror " id="validationServer01" value="" wire:model='code_dren'  >
                    <div class="invalid-feedback">
                      Entrer un code DREN valide
                    </div>
                </div>
                <div class="col">
                    <label for="validationServer01" class="form-label">NOM DREN</label>
                    <input class="form-control @error('nom_dren') is-invalid @enderror " id="validationServer01" value="" wire:model='nom_dren'  >
                    <div class="invalid-feedback">
                      Entrer un nom de DREN valide
                    </div>
                </div>
                
            </div>
            
            
            
            <div class="row mt-3">
                <button class="btn btn-success col-12" >
                    Valider l'enregistrement
                </button>
            </div>
            </form>
          </div>
          
          <!--fin Formulaire d'enregistrement-->
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>
