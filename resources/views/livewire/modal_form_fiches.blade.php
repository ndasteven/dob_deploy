<div class="modal fade" id="modal_form_fiche" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>   
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer une fiche d'orientation</h1>
          <button @if($creer) style="display: none" @endif @if($edit) style="display: block" wire:click="close"  @endif  class="closeformUpdateFiche  btn-close"  data-bs-dismiss="modal" aria-label="Close"></button> 
          <button @if($creer) style="display: block" @endif @if($edit) style="display: none" wire:click="close"  @endif  class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>        
        </div>
        <div class="modal-body">
          <!--Formulaire d'enregistrement-->
          <div class="col-md-10 mx-auto col-12">
            <!--Message alert-->
           {{--
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
           --}}
            <!--Message alert-->
            <div class="alert alert-warning" style=" @if (session()->has('error')) display:block @else display:none @endif ">
              {{ session('error') }}
            </div>
            <form @if ($creer) wire:submit.prevent='storeFiche'  @endif @if ($edit) wire:submit.prevent='updateFiche()' @endif' enctype="multipart/form-data">
              @csrf
                <div class="row mb-6">
                    <div class="col-md col-12">
                        <label for="validationServer01" class="form-label">Nom de la fiche</label>
                        <input  class="form-control filecheck @error('nom') is-invalid @enderror " id="validationServer01" value="" wire:model='nom'  >
                        <div class="invalid-feedback">
                            @error('nom')Entrer un nom valide @enderror"
                          </div>
                    </div>
                    
                    
                    <div class="col-md col-12">
                            <label >Selectionner la fiche de décision en PDF</label>
                              <input style="display:none" class="form-control file-select @error('fiche_nom') is-invalid  @enderror" type="file" wire:model='fiche_nom' wire:change='getfilenames' id="fileInput" >
                              <a class="btn btn-primary @error('fiche_nom') btn-danger  @enderror bouton-select-file col-12 mt-2" style="background-color: {{$colorUpload}} " >
                                <span wire:loading wire:target="fiche_nom" class="spinner-border spinner-border-sm spinner-border float-end mt-1" aria-hidden="true"></span>
                                <i class="bi bi-file-earmark-pdf-fill"></i><span class="tele">Selectionner la décision en PDF</span> </a>
                              <div class="invalid-feedback">
                                  @error('fiche_nom') {{$message}} @enderror"
                             </div>
                             @if (strlen($fiche_nom)>10)
                              <div>
                                @if ($creer)
                                <div class="dropdown">
                                  <a href="#" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <small style="color: red"><i class="bi bi-file-earmark-pdf-fill" style="color:red;"> voir la fiche </i></small>
                                  </a>
                                  <ul class="dropdown-menu">
                                     <embed type="application/pdf" src="data:application/pdf;base64,{{ base64_encode(file_get_contents($fiche_nom->getRealPath()))}}" width="600px" height="400px">
                                  </ul>
                                </div>
                                @endif
                                   @if ($edit)
                                      @if (strlen($fiche_nom)>10 && is_string($fiche_nom))
                                      <a href="storage/fiche_orientation/{{$fiche_nom}}" target="_blank">
                                        <small style="color: red">Voir Fiche <i class="bi bi-file-earmark-pdf-fill" style="color:red;"></i></small>
                                      </a>
                                      @endif
                                      @if (!is_string($fiche_nom) && strlen($fiche_nom) > 10)
                                      <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <small style="color: red"><i class="bi bi-file-earmark-pdf-fill" style="color:red;"> voir la fiche </i></small>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <embed type="application/pdf" src="data:application/pdf;base64,{{ base64_encode(file_get_contents($fiche_nom->getRealPath()))}}" width="600px" height="400px">
                                        </ul>
                                      </div>
                                      @endif
                                      
                                    
                                    @endif
                              </div>
                             @endif
                                  
                    </div>
                     
                    
                </div>
                <div class="row mt-3 mb-6">
                  <div class="col">
                    <label for="validationCustom04" class="form-label">Type de fiche</label>
                    <select class="form-select  @error('type_fiche') is-invalid @enderror " id="validationCustom04"  wire:model='type_fiche'>
                        <option selected value="">choisir le type de la fiche</option>
                        <option value="affectation">Affectation</option>
                        <option value="reaffectation">Réaffectation</option>
                        <option value="orientation">Orientation</option>
                        <option value="reorientation">Reorientation</option>
                        <option value="changement_ordre">Changement d'ordre</option>
                        <option value="changement_serie">Changement de serie</option>
                        <option value="permutation">Permutation</option>
                        <option value="omission">Omission</option>
                        <option value="reorientatio-reaffectation">Reorientatio-Reaffectation</option>
                    </select>
                    <div class="invalid-feedback">
                      @error('type_fiche')Selectionner le type de la fiche @enderror"
                    </div>
                </div>
                </div>
                <div class="row mt-3 mb-3 d-flex justify-content-between">
                  <div class="col-md-5 col ">
                      <label for="validationServer01" class="form-label">Année de la fiche</label>
                      <input type="tel" style="padding: 5px"  class="form-control mt-1 p-2 @error('annee') is-invalid @enderror " id="validationServer01" value="" wire:model='annee' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                      <div class="invalid-feedback">
                          @error('annee')Entrer une année valide @enderror"
                      </div>
                  </div>
                  <div class="col-md-5 col">
                    <label for="validationCustom04" class="form-label">Niveau de la fiche</label>
                    <select class="form-select @error('classe') is-invalid @enderror " id="validationCustom04"  wire:model='classe'  >
                        <option selected value="">choisir la classe </option>
                        <option value="6eme">6eme</option>
                        <option value="2nde">2nde</option>
                    </select>
                    <div class="invalid-feedback">
                        @error('classe')Selectionner une classe valide @enderror"
                    </div>
                  </div>
                </div>

                <div class="row mt-3 mb-6">
                  
                    <style>
                      .disabled{
                        opacity: 0.8;
                      }
                    </style>
                    <div class="col-md col-12" >
                        <label for="formFile" class="form-label" >Selectionner la DREN de la fiche</label>
                        <div wire:ignore>
                          <select class="form-select  @error('dren_id') is-invalid @enderror" id="select-dren" wire:model='dren_id' autocomplete="off" >
                              <option value="">selectionner le code DREN</option>
                              @foreach ($codeDren as $item)
                              <option value="{{$item->id}}">{{$item->code_dren}}-{{$item->nom_dren}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="invalid-feedback">
                            @error('dren_id')Selectionner une DREN @enderror
                        </div>
                    </div>
                    <div class="col-md col-12 mb-3" >
                        <label for="formFile" class="form-label">Selectionner l'etablissement de la fiche</label>
                        <div wire:ignore>
                          <select class=" form-select @error('ecole_id') is-invalid @enderror" id="select-beast" wire:model='ecole_id' autocomplete="off" style="z-index: 2;" >
                          </select>
                        </div>
                        <div class="invalid-feedback">
                          @error('ecole_id')Selectionner un établissement @enderror"
                        </div>
                      </div>
                </div>
                
                <div class="row mt-3 mb-3">
                  <div class="form-floating">
                    <textarea class="form-control" wire:model="remarkFiche" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2 " style="margin-left: 10px">Laisser un commentaire sur la fiche de décision</label>
                  </div>
                </div>
            
            <div class="row mt-3 ">
                <div class="col">
                  <button class="btn btn-success col-12" wire:loading.attr="disabled">
                    @if($creer) Ajouter une fiche @endif @if($edit) Modifier la fiche @endif .
                    <span class="" wire:loading style="margin: 0;">
                      <div class="spinner-border" role="status" style="width: 15px; height: 15px">
                      </div>
                    </span>
                </button>  
                </div>
                
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
   
    <!--fin loading -->


  </div>
  @script
  <script>
  document.addEventListener('livewire:initialized', () => {

    //fonction qui permet le select de tom select en ecoutant getEcole() dans studentIndex.php lors de la saisie
    function searchEcoleSelect(id){
      return new TomSelect(id,{
      sortField: {
      field: "text",
      direction: "asc"
    },
    valueField:'id',
    labelField:'NOMCOMPLs',
    searchField:'NOMCOMPLs',

    load: function(query, callback){
      
      if (query === '') {
                $wire.getEcole('').then(results => {
                    callback(results.slice(0, 3));  // Prend les trois premiers résultats
                }).catch(() => {
                    callback();
                });
      } else {
                // Chargez les résultats normalement lors de la saisie
                $wire.getEcole(query).then(results => {
                    callback(results);
                }).catch(() => {
                    callback();
                });
            }
    },
    render:{
      option:function(item, escape){
        return `<div> ${escape(item.NOMCOMPLs)} </div>`
      }
    },
    item: function(item, escape){
        return `<div> ${escape(item.NOMCOMPLs)} </div>`
    }
    });
    }
    
    var select = searchEcoleSelect('#select-beast')

    var select1 = new TomSelect("#select-dren",{
        create: true,
        sortField: {
        field: "text",
        direction: "asc"
    }
    });
    $('.bouton-select-file').on('click', function(e){
      $('.file-select').click()
    })
    @this.on('save', (data) => {
      Swal.fire(
      'Effectué',
      'Enregistrement effectué avec succès',
      'success'
      )
      select.clear()
      select1.clear()
     
    });
    @this.on('error', (data) => {
      Swal.fire(
      'Existe déjà',
      'le nom de la fiche existe déja dans la base de données',
      'error'
      )     
    });
    @this.on('errorFile', (data) => {
      Swal.fire(
      'Erreur de fiche ',
      'Erreur de fichier! selectionner le fichier au format PDF',
      'error'
      )     
    });
    @this.on('check', (data)=>{
      select1.addItem(@this.dren_id);
    })

    @this.on('getEcoleOrigin',(data)=>{
      select.addOption(event.detail.data);
      select.addItem(event.detail.id); 
    })
    
    $('.closeformUpdateFiche').on('click', function(e){
      $('#modal_form_fiche').modal('hide')  
      $('#modalFicheInfos').modal('show') 
    })
})
  
  </script>
  @endscript
