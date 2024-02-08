<div class="modal fade modalSchool" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" wire:ignore.self>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js" wire:ignore.self></script>
  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"> @if($creer) Enregistrer un établissement @endif @if($edit) Modifier un établissement @endif </h1>
         
          <button @if($creer) style="display: none" @endif @if($edit) style="display: block"   @endif  class="closeformUpdateSchool btn-close"  data-bs-dismiss="modal" aria-label="Close"></button> 
          <button @if($creer) style="display: block" @endif @if($edit) style="display: none" wire:click="close"  @endif  class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button> 
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
            <form @if($creer) wire:submit.prevent='storeEtablissement()' @endif @if($edit)wire:submit.prevent='updateEtablissement()' @endif enctype="multipart/form-data">
                <div class="row">
                <div class="col">
                    <label for="validationServer01" class="form-label">Code établissement</label>
                    <input  class="form-control @error('CODSERVs') is-invalid @enderror " id="validationServer01" value="" wire:model='CODSERVs'  >
                    <div class="invalid-feedback">
                      Entrer un code valide
                    </div>
                </div>
                <div class="col">
                    <label for="validationServer01" class="form-label">Nom établissement</label>
                    <input class="form-control @error('NOMCOMPLs') is-invalid @enderror " id="validationServer01" value="" wire:model='NOMCOMPLs'  >
                    <div class="invalid-feedback">
                      Entrer un nom valide
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Type</label>
                    <select class="form-select @error('GENREs') is-invalid @enderror " id="validationCustom04" wire:model='GENREs'  >
                      <option selected value="">choisir le type d'établissement</option>
                      <option value="PRIVE">privé</option>
                      <option value="PUBLIC">public</option>
                      <option value="MIXTE">MIX</option>
                    </select>
                    <div class="invalid-feedback">
                      veillez selectionner le type d'etablissement.
                    </div>
                  </div>
            </div>
            <div wire:ignore class="col mb-3">
              <label for="formFile" class="form-label">Selectionner une DREN</label>
              <select class="form-select  @error('CODE_DREN') is-invalid @enderror" id="select-beast" wire:model='CODE_DREN' autocomplete="off" >
                <option >selectionner le code DREN</option>
                @foreach ($codeDren as $item)
                 <option value="{{$item->code_dren}}">{{$item->code_dren}}-{{$item->nom_dren}}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                @error('CODE_DREN')Selectionner une DREN @enderror"
              </div>
            </div>
           
 
            <div class="row mt-10">
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
    <!--composant de loading permettant de patientez pendant chargement des datas provenant du controller livewire-->
    @include('livewire.loading')
    <!--fin loading -->
  </div>
  <script>
    document.addEventListener('livewire:initialized', () => {
      $('.closeformUpdateSchool').on('click', function(e){
      $('.modalSchool').modal('hide')  
      $('#modalSchoolInfos').modal('show') 
    })
    var select = new TomSelect("#select-beast",{
    create: true,
    sortField: {
    field: "text",
    direction: "asc"
    }
    });
    @this.on('check', (data)=>{
      select.addItem(@this.CODE_DREN);
    })
    @this.on('save', (data) => {
      Swal.fire(
      'Effectué',
      'Enregistrement effectué avec succès',
      'success'
      )     
    });
  })
</script>
