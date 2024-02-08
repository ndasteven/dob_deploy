<div class="modal fade" id="modalStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 

  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content" >
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">@if($creer) Enregistrer un élève @endif @if($edit) Modifier l'élève @endif </h1>
          @if ($creer)<a class="btn-close close " data-bs-dismiss="modal" aria-label="Close" wire:click='cancel()'></a>
          @else
          <a  class="btn-close" wire:click="closeUpdate" ></a>
          @endif
          
        </div>
        
        <div class="modal-body">
          <!--Formulaire d'enregistrement-->
          <div class="col-md-10 mx-auto col-12">
            <!--Message alert-->
            
                <div class="alert alert-success" style=" @if (session()->has('success')) display:block @else display:none @endif " >
                    {{ session('success') }}
                </div>
            
                <div class="alert alert-warning" style=" @if (session()->has('error')) display:block @else display:none @endif ">
                    {{ session('error') }}
                </div>
           
            <!--Message alert-->
            <form @if ($creer) wire:submit.prevent='storeStudent()' @endif @if ($edit) wire:submit.prevent='updateStudent()' @endif  enctype="multipart/form-data">
              @csrf  
              <div class="row">
                <div class="col col-md col-6">
                    <label for="validationServer01" class="form-label">Nom</label>
                    <input  class="form-control @error('nom') is-invalid @enderror " id="validationServer01" value="" wire:model='nom'  >
                    <div class="invalid-feedback">
                      Entrer un nom valide
                    </div>
                </div>
                <div class="col col-md col-6">
                    <label for="validationServer01" class="form-label">Prenom</label>
                    <input class="form-control @error('prenom') is-invalid @enderror " id="validationServer01" value="" wire:model='prenom'  >
                    <div class="invalid-feedback">
                      Entrer un nom valide
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <label for="validationCustom04" class="form-label">Niveau</label>
                    <select class="form-select @error('classe') is-invalid @enderror " id="validationCustom04" wire:change='selectclasse' wire:model='classe'  >
                      <option selected value="">choisir la classe de l'élève</option>
                      <option value="6eme">6eme</option>
                      <option value="2nde">2nde</option>
                    </select>
                    <div class="invalid-feedback">
                      veillez selectionner une classe.
                    </div>
                </div>
              
                <div class="col-6 col-md-2">
                  <label for="validationCustom04" class="form-label">Genre</label>
                  <select class="form-select @error('genre') is-invalid @enderror " id="validationCustom04" wire:model='genre'  >
                    <option selected value="">choisir le genre de l'élève</option>
                    <option value="M">Masculin</option>
                    <option value="F">Feminin</option>
                  </select>
                  <div class="invalid-feedback">
                    veillez selectionner le sexe de l'élève.
                  </div>
              </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-md">
                    <label for="validationServer01" class="form-label">Matricule</label>
                    <input  class="form-control @error('matricule') is-invalid @enderror  " id="validationServer01" value="" wire:model='matricule'  >
                    <div class="invalid-feedback">
                      Entrer un matricule valide
                    </div>
                </div>
                  
                
                  <div class="col-6 col-md"  @if ($classe=='2nde') style="display: block" @else style="display: none" @endif>
                    <label for="validationCustom04" class="form-label">Série</label>
                    <select class="form-select @error('serie') is-invalid @enderror " id="validationCustom04"  wire:model='serie'  >
                      <option selected value="">choisir la série</option>
                      <option value="A">A</option>
                      <option value="C">C</option>
                      <option value="G1">G1</option>
                      <option value="G2">G2</option>
                      <option value="F1">F1</option>
                      <option value="F2">F2</option>
                      <option value="AB">AB</option>
                      <option value="T1">T1</option>
                      <option value="T2">T2</option>
                    </select>
                    <div class="invalid-feedback">
                      veillez selectionner une série.
                    </div>
                    </div>
                  

                <div class="col-6 col-md">
                  <label for="validationServer01" class="form-label">Année d'orientation</label>
                  <input  class="form-control @error('annee') is-invalid @enderror  " id="validationServer01" value="" wire:model='annee'  >
                  <div class="invalid-feedback">
                    Entrer l'année d'orientation de l'élève
                  </div>
                </div>
                <div class="col-6 col-md">
                  <label for="validationServer01" class="form-label">Date de naissance</label>
                  <input type="date"  class="form-control @error('dateNaissance') is-invalid @enderror " id="validationServer01" value="" wire:model='dateNaissance'  >
                  <div class="invalid-feedback">
                    Entrer une date valide
                  </div>
                </div>
                
            </div>           
            
            
            <div class="row mt-4" >
              <div class="col-12 col-md mb-3">
                <label for="formFile" class="form-label " @error('ecole_id') style="color: rgb(192, 79, 79)" @enderror>@if($creer) Selectionner un etablissement d'origine @endif @if($edit) <small>{{$ecole_origine}}</small> @endif .</label>
                <div wire:ignore>
                  <select class=" ecole_O @error('ecole_id') is-invalid @enderror" id="select-beast"    wire:model='ecole_id' autocomplete="off">
                  </select>
                </div>
                <div class="invalid-feedback">
                  @error('ecole_id')Selectionner un établissement d'origine @enderror"
                </div>
              </div>

              <div class="col-12 col-md mb-3">
                  <label for="formFile" class="form-label"  @error('ecole_A') style="color: rgb(192, 79, 79)" @enderror>Selectionner un etablissement d'accueil</label>
                  <div wire:ignore>
                    <select class=" @error('ecole_A') is-invalid @enderror" id="select-beast-1" wire:model='ecole_A' autocomplete="off">
                    </select>
                   </div>
                  <div class="invalid-feedback">
                    @error('ecole_A')Selectionner un établissement accueil @enderror"
                  </div>
              </div>
             </div>
            <div class="col mb-3" >
              <label for="formFile" class="form-label"  @error('fiche_id') style="color: rgb(192, 79, 79)" @enderror>Selectionner la fiche d'orientation de l'élève</label>
              <div wire:ignore>
                <select class=" @error('fiche_id') is-invalid @enderror" id="select-beast-2" wire:model='fiche_id' autocomplete="off">
                </select>
              </div>
              <div class="invalid-feedback">
                @error('fiche_id')Selectionner la fiche d'orientation @enderror"
              </div>
            </div>

            <div class="row">
              <div class="col">
                <button class="btn btn-success col-12 " >
                  @if($creer)
                  Valider l'enregistrement de l'eleve
                  @endif
                  @if($edit)
                  Modifier les informations de l'eleve
                  @endif.
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
      
      $wire.getEcole(query).then(results=>{

        callback(results);
      }).catch(()=>{
        callback();
      })
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
    var select1 =searchEcoleSelect('#select-beast-1')
    var select2 =new TomSelect('#select-beast-2',{
      sortField: {
      field: "text",
      direction: "desc"
    },
    valueField:'id',
    labelField:'nom',
    searchField:'nom',

    load: function(query, callback){
      
      $wire.getFiche(query).then(results=>{

        callback(results);
      }).catch(()=>{
        callback();
      })
    },
    render:{
      option:function(item, escape){
        return `<div> ${escape(item.nom)} | ${escape(item.type_fiche)}  </div>`
      }
    },
    item: function(item, escape){
        return `<div> ${escape(item.nom)}</div>`
    }
    });
    
    @this.on('closeUpdate',(data)=>{
      $('#modalStudent').modal('hide')  
      $('#modalStudentInfos').modal('show') 
      select.unlock()
      select.clear()
      select1.clear()
      select2.clear() 
    })
    @this.on('cancel', (data) => {
      select.unlock()
      select.clear()
      select1.clear()
      select2.clear()
    })
    @this.on('save', (data) => {
      select.clear()
      select1.clear()
      select2.clear()
      Swal.fire(
      'Effectué',
      'Enregistrement effectué avec succès',
      'success'
      )
    });
    @this.on('getEcoleOrigin',(data)=>{
      select.lock() // a bloque tres important pour ne pas modifier etablissement origine
      select.addOption(event.detail.data);
      select.addItem(event.detail.id); 
    })
    @this.on('getEcoleAccueil',(data)=>{
      select1.addOption(event.detail.data);
      select1.addItem(event.detail.id); 
    })
    @this.on('getFiche',(data)=>{
      select2.addOption(event.detail.data);
      select2.addItem(event.detail.id); 
    })
});

</script>
@endscript