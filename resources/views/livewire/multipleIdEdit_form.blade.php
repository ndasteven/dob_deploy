<div class="modal fade" id="multipleEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet" wire:ignore.self>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js" wire:ignore.self></script>
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
       <a> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </a>
      </div>
      <div class="modal-body">
        <div class="row">        
          <h1 class="modal-title fs-5 col-md-10 mx-auto" id="exampleModalLabel">Vous avez {{$restUpdate}} mise à jour à faire </h1>
          <hr>
            <small style="font-weight: bold">
              @if ($elevemultipleUpdate)
              <div style=" @if($countTableIndex==$longueurTable) display:none; @endif ">
              <div class="alert alert-warning col-md-10 mx-auto">
                <h3>Effectuer la mise à jour pour :</h3>
                @foreach($elevemultipleUpdate as $eleveMultiUp)
                  <ul>
                    <li>Matricule : {{$eleveMultiUp->matricule}} </li>
                  </ul>  
                  <ul>
                    <li>Nom : {{$eleveMultiUp->nom}} </li>
                  </ul>
                  <ul>
                    <li>Prenom : {{$eleveMultiUp->prenom}} </li>
                  </ul>
                </div>
                @endforeach 
              </div>
              @endif
            </small>
          
        </div>
        {{--Formulaire de mise à jour--}}
        <div class="col-md-10 mx-auto col-12">
          <!--Message alert-->

              @if ($errorCount==0)
              <div class="alert alert-success" style=" @if (session()->has('success')) display:block @else display:none @endif " >
                {{ session('success') }}
            </div>
              @endif
             
          
              <div class="alert alert-warning" style=" @if (session()->has('error')) display:block @else display:none @endif ">
                  {{ session('error') }}
              </div>
              @if ($errorCount!=0)
              <div class="alert alert-warning" style=" @if ($countTableIndex == $longueurTable) display:block @endif display:none  ">
                <b style="color: red; margin-right:10px" > {{$errorCount}} Erreurs rencontré sur {{$longueurTable}} pendant la mise à jours</b>
                @foreach ($message_error as $message)
                  <ul>
                    <li>*{{$message}}</li>
                  </ul>
                @endforeach
              </div>
              @endif
             
              
         
          <!--Message alert-->
          <form class="formMupltiple"   wire:submit.prevent='updateMultiple()'    enctype="multipart/form-data" >
            @csrf  
            <div style=" @if($countTableIndex==$longueurTable) display:none; @endif ">
            <div class="row">
              <div class="col">
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
              @if ($classe=='2nde')
              
              <div class="col">
                <div class="row">
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
                <div class="row">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="serieMultiple" wire:change="checkSerieMultiple" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                      <small>Cocher si la Série est identique pour tous les élèves sélectionnés</small>
                    </label>
                  </div>
                </div>
                
              </div>
            
            @endif
              <div class="col">
                <label for="validationServer01" class="form-label">Année d'orientation</label>
                <input  class="form-control @error('annee') is-invalid @enderror  " id="validationServer01" value="" wire:model='annee'  >
                <div class="invalid-feedback">
                  Entrer l'année d'orientation de l'élève
                </div>
              </div>
          </div>
          <div class="row mt-3">
              
               
                
          </div>           
          <style>
            .disabled{
              opacity: 0.8;
            }
          </style>
          
          <div class="row mt-4" wire:loading.class="disabled">
            <div class="col mb-3">
              <label for="formFile" class="form-label " @error('ecole_id') style="color: rgb(192, 79, 79)" @enderror>@if(strlen($ecole_origine)>0) <small>{{$ecole_origine}}</small> @else  Etablissement d'origine  @endif .</label>
              <div wire:ignore>
                <select disabled class="@error('ecole_id') is-invalid @enderror" id="select_ecole_O" wire:model='ecole_id' autocomplete="off">
                </select>
              </div>
              <div class="invalid-feedback">
                @error('ecole_id')Selectionner un établissement d'origine @enderror"
              </div>
            
            </div>
              <div class="col mb-3">
                <label for="formFile" class="form-label"  @error('ecole_A') style="color: rgb(192, 79, 79)" @enderror>Selectionner un etablissement d'accueil</label>
                <div wire:ignore>
                  <select class="@error('ecole_A') is-invalid @enderror" id="select_ecole_A" wire:model='ecole_A' autocomplete="off">
                  </select>
                </div>
                <div class="invalid-feedback">
                  @error('ecole_A')Selectionner un établissement accueil @enderror"
                </div>
              
              </div>
            
          </div>
          <div class="col mb-3" wire:loading.class="disabled">
            <label for="formFile" class="form-label"  @error('fiche_id') style="color: rgb(192, 79, 79)" @enderror>Selectionner la fiche d'orientation de l'élève</label>
            <div wire:ignore>
              <select class="@error('fiche_id') is-invalid @enderror" id="select_fiche" wire:model='fiche_id' autocomplete="off">
              </select>
            </div>
            <div class="invalid-feedback">
              @error('fiche_id')Selectionner la fiche d'orientation @enderror"
            </div>
          </div>
        </div>
          @if($countTableIndex < $longueurTable)
          <div class="row mt-5">
            <div class="col">
              <button class="btn btn-success col-12 " >
               Mettre à jour les informations de l'élève.
               <span class="" wire:loading style="margin: 0;">
                <div class="spinner-border" role="status" style="width: 15px; height: 15px">
                </div>
              </span>
              </button>
            </div>  
          </div>
          @else
          <div class="row mt-5">
            <div class="col">
              <a href="">
              <div class="btn btn-primary col-12 " >
               Retour.
               <span class="" wire:loading style="margin: 0;">
                <div class="spinner-border" role="status" style="width: 15px; height: 15px">
                </div>
              </span>
              </div>
            </a>
            </div>  
          </div>
          @endif
        
          </form>
        </div>
        {{--fi Formulaire de mise à jour--}}
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
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
    var select = searchEcoleSelect('#select_ecole_O')
    var select1 =searchEcoleSelect('#select_ecole_A')
    var select2 =new TomSelect('#select_fiche',{
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

    @this.on('getEcoleOrigin',(data)=>{ //quand la fonction  est activer dans le controlleur studentIndex.php il declache se script de verification de etablissement origine pour mettre a jour dans le selcec ecole O
      select.lock()
      select.addOption(event.detail.data);
      select.addItem(event.detail.id); 
    })
   
        @this.on('getIdArray', () => {
        })
      @this.on('verifyStudentSelect', ()=>{ // 
        
        var checko= setInterval(() => {
         var i=0
          select.addItem(@this.ecole_id);
          if (@this.ecole_id!==null) {
            i++
          }
          if(i>0){
            clearInterval(checko)//arrete la varible check 
          } 
       }, 2);
      })
  })
  </script>
  @endscript
