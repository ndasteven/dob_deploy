<div>
    <x-slot name="header">
      <div class="row">
        <div class="col-1 " style="width: 50px" >
          <button class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
           <i style="color: #fff" class="bi bi-list"></i> 
          </button>
          
        </div>
        <div class="col-10 mt-1">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrateur') }}
         </h2> 
        </div>
      </div> 
    </x-slot>
    <link rel="stylesheet" href="asset/css/admin/admin.css">
<div class="container">
  <!--menu left offcanvas -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" wire:ignore.self>
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>
        <small>Administaeur du système d'archivage peut effectuer plusieurs configurations avec les bouttons ci-dessous</small>.
      </div>
      <div class="mt-3">
        <div class="btn-group-vertical  col-12" role="group" aria-label="Vertical button group">
          <button type="button " class="btn btn-sm btn-outline-secondary col-12 mt-2 " data-bs-toggle="modal" data-bs-target="#importFile">Importer des élèves</button>
          <button type="button " class="btn btn-sm btn-outline-primary col-12 mt-2 " data-bs-toggle="modal" data-bs-target="#importFileecole">Importer des écoles</button>
          <button type="button " class="btn btn-sm btn-outline-info col-12 mt-2 " data-bs-toggle="modal" data-bs-target="#importFiledren">Importer des dren</button>
          <button type="button " class="btn btn-sm btn-outline-success col-12 mt-2" wire:click="create()"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ajouter des utilisateurs</button>
        </div> 
      </div>
      <div class="d-flex justify-content-center"><small><livewire:file-attente></small> </div>
    </div>
  </div>
  <!--fin menu left offcanvas -->
    <div class="row mt-4" >
        <div class="row">
            <div class="col-md-10 row d-flex justify-content-center  mx-auto" >
              <div class="col-md-4 ">
                  <div class="card cardadmin">
                    <div class="card-content">
                      <p class="card-title">Profil</p>
                      <p>Super Admin: <span style="font-weight: bold; font-size:22px; color:#FFD700">{{$countSuperAdmin}} </span></p>
                      <p class="card-para">Ce profil super admin à tout les droits sur l'application.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                 <div class="card cardadmin cardInfo">
                    <div class="card-content">
                        <p class="card-title">Profil</p>
                        <p>Admin : <span style="font-weight: bold; font-size:22px; color:#FFD700">{{$countAdmin}} </span> </p>
                      <p class="card-para">Ce profil admin peut lire, ajouter et modifier les données sur l'application .</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card cardadmin">
                    <div class="card-content">
                        <p class="card-title">Profil</p>
                        <p>Utilisateur: <span style="font-weight: bold; font-size:22px; color:#FFD700">{{$countUtilisateur}} </span> </p>
                      <p class="card-para">Ce profil ne peut que lire les données sur l'application.</p>
                    </div>
                  </div>
                </div>   
            </div>
            <div class="col-md-10 row mx-auto">
                <div class="row d-flex justify-content-between">
                    <div class="col-12 col-md-5">
                      <div class="row">
                        <div class="col-10 ">
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Rechercher un email</label>
                            <input type="email" class="form-control" wire:model="search" wire:keydown.debounce.900ms="research" id="exampleFormControlInput1" placeholder="email">
                          </div>
                        </div>
                        <div class="col-1 mt-4"">
                          <span wire:loading style="margin: 0; float-end">
                            <div class="spinner-border text-warning mt-2" role="status">
                            </div>
                          </span>
                        </div>
                      </div>
                        
                    </div> 
                  <div class=" col-5 col-md-4">
                         
                  </div> 
                </div>
                
                <div class="overflow-auto">
                    <table class="table mt-3">
                        <thead>
                          <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">email</th>
                            <th scope="col">role</th>
                            <th scope="col" style="text-align:center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($userProfile as $user)
                             <tr>
                                <td>{{$user->name}} </td>
                                <td>{{$user->prenom}} </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="" style="text-align: center">
                                    <button class="btn btn-sm btn-warning col-4" wire:click="update({{$user->id}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Modifier</button>
                                    <button class="btn btn-sm btn-danger col-4" wire:click ="getUserId({{$user->id}})" style="margin-right:8px" data-bs-toggle="modal" data-bs-target="#exampleModal">supprimer</button>
                                </td>
                            </tr>    
                            @endforeach
                           
                        </tbody>
                    </table>
                    
                </div>
                {{$userProfile->links()}}
            </div>
        </div>
        
    </div>    
</div>
 <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

        <h1 class="modal-title fs-5" id="staticBackdropLabel">@if($creer) Ajouter un Utilisateur @endif @if($edit) Modifier l'utilisateur @endif </h1>
        <button type="button" wire:click="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
        {{--form register jetstream--}}
        <form @if($creer) wire:submit.prevent='storeUser' @endif @if($edit) wire:submit.prevent='updateUser()' @endif>
          @csrf
            <div class="row mb-6">
                <div class="col-md col-12">
                    <label for="validationServer01" class="form-label">Nom </label>
                    <input  class="form-control @error('nom') is-invalid @enderror " id="validationServer01" value="" wire:model='name'  >
                    <div class="invalid-feedback">
                        @error('name')Entrer un nom valide @enderror"
                      </div>
                </div>
                
                <div class="col-md col-12">
                  <label for="validationServer01" class="form-label">Prenom</label>
                  <input  class="form-control @error('prenom') is-invalid @enderror " id="validationServer01" value="" wire:model='prenom'  >
                  <div class="invalid-feedback">
                      @error('prenom')Entrer un prenom valide @enderror"
                  </div>
                </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="validationServer01" class="form-label">Email</label>
                  <input type="email"  class="form-control @error('email') is-invalid @enderror " id="validationServer01" value="" wire:model='email'  >
                  <div class="invalid-feedback">
                      @error('email')Entrer un email valide @enderror"
                  </div>
              </div>
            </div>
            <div style="text-align:center">
              <span style="color: red">{{$matchPass}}</span> 
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="validationServer01" class="form-label">Mot de passe </label>
                  <input  type="password"  class="form-control @error('password') is-invalid @enderror " id="validationServer01" value="" placeholder="********" wire:model='password' @if (strlen($matchPass)>3) @dump("hello") @endif  >
                  <div class="invalid-feedback">
                      @error('password')Entrer un nom valide @enderror"
                  </div>
              </div>
            </div>
           
            <div class="row mb-3">
              <div class="col">
                <label for="validationServer01" class="form-label">Repeter le mot de passe </label>
                  <input type="password"  class="form-control @error('repeatPassword') is-invalid @enderror " id="validationServer01" value="" placeholder="********" wire:model='repeatPassword'  >
                  <div class="invalid-feedback">
                      @error('repeatPassword')Repeter le mot de passe svp @enderror"
                  </div>
              </div>
            </div>
            <div class="row">
              <select class="form-select form-control @error('role') is-invalid @enderror" aria-label="Default select example" wire:model="role">
                <option selected>Choisir le role de l'utilisateur</option>
                <option value="utilisateur">Utilisateur</option>
                <option value="admin">Admin</option>
                <option value="superAdmin">Super Admin</option>
              </select>
              <div class="invalid-feedback">
                      @error('role')selectionner le rôle de l'utilisateur svp @enderror"
                  </div>
            </div>
            <div class="row mt-3 ">
              <div class="col">
                <button class="btn btn-success col-12" >
                  @if($creer) Ajouter un Utilisateur @endif @if($edit) Modifier l'utilisateur @endif .
                </button>  
              </div>
              
          </div>
             </form>
        {{--form register jetstream--}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
      <!--composant de loading permettant de patientez pendant chargement des datas provenant du controller livewire-->
      @include('livewire.loading')
      <!--fin loading -->
</div> 
<!--Fin modal form--> 
<!--Modal supression-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation de Suppression</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color: red; font-weight:bold">Voulez vous vraiment supprimer  <span style="color:blue; font-weight:bold">{{$userName}} </span> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closer" data-bs-dismiss="modal">Annuler</button>
        <button wire:click="deleteUser({{$ide}})" type="button" class="btn btn-primary">Confirmer la suppression</button>
      </div>
    </div>
  </div>
</div>
<!--Fin modal suppression-->

<!--Modal d'importation eleve-->

<div class="modal fade " id="importFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
      <div class="modal-header bg-success">
        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Importation d'élèves dans la base</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          @if (session()->has('importOK'))
            <div class="alert alert-success mt-2 mb-2">
              {{ session('importOK') }}
            </div>
          @endif
        <div class="mb-3">
          <div class="row">
            <div class="col-11 col-md-6 mx-auto">
              <button disabled class="btn file-click">
                 <!--progress bar montrannt la progression du fichier selection dans le fichier temporaire de livewire ivewire_temp-->
                @if ($uploadProgress>0)
                <div class="show_progressbar">
                  <p>Téléchargement en cours...</p>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$uploadProgress}}%">@if($uploadProgress>0) {{$uploadProgress}}% @endif  @if($uploadProgress==100) patientez svp @endif</div>
                  </div>
                </div> 
                @else <span style="color:gray">selection fichier excel</span><br> 
                @endif
                @if (Str::length($file) > 2)
                <span  style="color: green"><small>fichier chargé</small> </span><br>
                @else
                <span style="color: red"><small>pas de fichier chargé</small> </span><br>
                @endif
            <!--Fin de progressbar-->
                <img class="shadow-lg" src="asset/img/excel-logo.png" style="max-width: 100%" alt=""> 
                <div style="text-align: center">{{$checkFile}}</div>
              </button>
              
            </div>
          </div>
          <form wire:submit.prevent="importEleve()" enctype="multipart/form-data">
           
            <div class="row">
              <input style="display:none"  type="file" class="form-control @error('file') is-invalid @enderror file" @this.on('uploaded', 'fileUploaded') wire:model="file">
              <div style="text-align: center">
                <small><livewire:file-attente></small> <br>
                @error('file') <small class="error" style="color:red; font-weight:bold">{{ $message }}</small> @enderror
                <br><small>type de fichier <b class="text-danger">*</b>: <b>XLSL, XLS</b> , taille maximale: <b>5mo</b> </small><br>
              </div>
            </div>
            <div class="mt-3">
              @if (Str::length($file) > 2)
              <div class="col-12 col-md-6 mx-auto">
                <button  disabled class="btn col-12 btn-primary submitImport" type="submit">Importation fichier Excel</button>
              </div>
              @endif
            </div>            
          </form>
        </div>
      </div>
      <div class="modal-footer mt-5">
        <span wire:loading style="margin: 0; float-end">
          <div class="spinner-border text-warning mt-2" role="status">
          </div>
        </span>
      </div>
    </div>
  </div>
</div>
<!--Fin modal d'importation eleve-->

<!--Modal d'importation ecole-->

<div class="modal fade " id="importFileecole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Importation des écoles dans la base</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          @if (session()->has('importEcoleOK'))
            <div class="alert alert-warning mt-2 mb-2">
              {{ session('importEcoleOK') }}
            </div>
          @endif
        <div class="mb-3">
          <div class="row">
            <div class="col-11 col-md-6 mx-auto">
              <button disabled class="btn file-click_ecole">
                 <!--progress bar montrannt la progression du fichier selection dans le fichier temporaire de livewire ivewire_temp-->
                @if ($uploadProgress>0)
                <div class="show_progressbar">
                  <p>Téléchargement en cours...</p>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$uploadProgress}}%">@if($uploadProgress>0) {{$uploadProgress}}% @endif  @if($uploadProgress==100) patientez svp @endif</div>
                  </div>
                </div> 
                @else <span style="color:gray">selection fichier excel</span><br> 
                @endif
                @if (Str::length($file) > 2)
                <span  style="color: green"><small>fichier chargé</small> </span><br>
                @else
                <span style="color: red"><small>pas de fichier chargé</small> </span><br>
                @endif
            <!--Fin de progressbar-->
                <img class="shadow-lg" src="asset/img/excel-logo.png" style="max-width: 100%" alt=""> 
                <div style="text-align: center">{{$checkFile}}</div>
              </button>
              
            </div>
          </div>
          <form wire:submit.prevent="importEcole" enctype="multipart/form-data">
           
            <div class="row">
              <input style="display:none"  type="file" class="form-control @error('file') is-invalid @enderror file_ecole" @this.on('uploaded', 'fileUploaded') wire:model="file">
              <div style="text-align: center">
                <small><livewire:file-attente></small> <br>
                @error('file') <small class="error" style="color:red; font-weight:bold">{{ $message }}</small> @enderror
                <br><small>type de fichier <b class="text-danger">*</b>: <b>XLSL, XLS</b> , taille maximale: <b>5mo</b> </small><br>
              </div>
            </div>
            <div class="mt-3">
              @if (Str::length($file) > 2)
              <div class="col-12 col-md-6 mx-auto">
                <button  disabled class="btn col-12 btn-primary submitImport" type="submit">Importation fichier Excel</button>
              </div>
              @endif
            </div>            
          </form>
        </div>
      </div>
      <div class="modal-footer mt-5">
        <span wire:loading style="margin: 0; float-end">
          <div class="spinner-border text-warning mt-2" role="status">
          </div>
        </span>
      </div>
    </div>
  </div>
</div>
<!--Fin modal d'importation ecole-->

<!--Modal d'importation DREN-->

<div class="modal fade " id="importFiledren" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">      
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Importation des DREN dans la base</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          @if (session()->has('importDrenOK'))
            <div class="alert alert-warning mt-2 mb-2">
              {{ session('importDrenOK') }}
            </div>
          @endif
        <div class="mb-3">
          <div class="row">
            <div class="col-11 col-md-6 mx-auto">
              <button disabled class="btn file-click_dren">
                 <!--progress bar montrannt la progression du fichier selection dans le fichier temporaire de livewire ivewire_temp-->
                @if ($uploadProgress>0)
                <div class="show_progressbar">
                  <p>Téléchargement en cours...</p>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$uploadProgress}}%">@if($uploadProgress>0) {{$uploadProgress}}% @endif  @if($uploadProgress==100) patientez svp @endif</div>
                  </div>
                </div> 
                @else <span style="color:gray">selection fichier excel</span><br> 
                @endif
                @if (Str::length($file) > 2)
                <span  style="color: green"><small>fichier chargé</small> </span><br>
                @else
                <span style="color: red"><small>pas de fichier chargé</small> </span><br>
                @endif
            <!--Fin de progressbar-->
                <img class="shadow-lg" src="asset/img/excel-logo.png" style="max-width: 100%" alt=""> 
                <div style="text-align: center">{{$checkFile}}</div>
              </button>
              
            </div>
          </div>
          <form wire:submit.prevent="importDren" enctype="multipart/form-data">
           
            <div class="row">
              <input style="display:none"  type="file" class="form-control @error('file') is-invalid @enderror file_dren" @this.on('uploaded', 'fileUploaded') wire:model="file">
              <div style="text-align: center">
                <small><livewire:file-attente></small> <br>
                @error('file') <small class="error" style="color:red; font-weight:bold">{{ $message }}</small> @enderror
                <br><small>type de fichier <b class="text-danger">*</b>: <b>XLSL, XLS</b> , taille maximale: <b>5mo</b> </small><br>
              </div>
            </div>
            <div class="mt-3">
              @if (Str::length($file) > 2)
              <div class="col-12 col-md-6 mx-auto">
                <button  disabled class="btn col-12 btn-primary submitImport" type="submit">Importation fichier Excel</button>
              </div>
              @endif
            </div>            
          </form>
        </div>
      </div>
      <div class="modal-footer mt-5">
        <span wire:loading style="margin: 0; float-end">
          <div class="spinner-border text-warning mt-2" role="status">
          </div>
        </span>
      </div>
    </div>
  </div>
</div>
<!--Fin modal d'importation DREN-->

</div>

<script>
   var fileName=''
  document.addEventListener('livewire-upload-progress', (event) => {
      // Utiliser Livewire pour mettre à jour la variable de progression
    if ($('.file').val().length>2) {
      var fileName=$('.file').val().split("\\").pop()
    }
    if ($('.file_ecole').val().length>2) {
      var fileName=$('.file_ecole').val().split("\\").pop()
    }
    if ($('.file_dren').val().length>2) {
      var fileName=$('.file_dren').val().split("\\").pop()
    }
      @this.set('uploadProgress', event.detail.progress);
      @this.set('checkFile',fileName)
          
  });

  document.addEventListener('livewire:initialized', () => {
    
    @this.on('deleteUser', (data) => {
      $(".closer").click()
      Swal.fire(
      'suppression effectée',
      'l\'Utilisateur a été supprimé avec succès .',
      'success'
      ) 
    
         
    });
    @this.on('impossibledeleteUser', (data) => {
      $(".closer").click()
      Swal.fire(
      'suppression impossible',
      'Vous ne pouvez pas supprimer votre propre compte .',
      'error'
      ) 
   
         
    });
    
   $('.file-click').on('click',function(){
    $('.file').click()
   })
   $('.file-click_ecole').on('click',function(){
    $('.file_ecole').click()
   })
   $('.file-click_dren').on('click',function(){
    $('.file_dren').click()
   })
  
  })
</script>