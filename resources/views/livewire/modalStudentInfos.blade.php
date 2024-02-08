<div class="modal fade" id="modalStudentInfos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
   
  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content" style="background-color: #f4f7f7">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">INFORMATIONS SUR L'ELEVE</h1>
          <button  class="btn-close" wire:click='closeStudent' data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--info students-->
          
          <div class="col-md-10 mx-auto col-12" >
              <div class="container">
                  <div class="main-body">
                                      
                        <div class="row gutters-sm">
                          <div class="col-md-4 mb-3">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                  @if($eleveInfo)
                                  @foreach ($eleveInfo as $eleveInfo)
                                    
                                  @endforeach
                                  
                                  @if ($eleveInfo->genre=='M')
                                  <img class="" src="asset/img/m.jpg" width="150">
                                   @else 
                                   <img class="" src="asset/img/f.jpg" alt="Admin" class="rounded-circle" width="150">
                                  @endif
                                  
                                  <div class="mt-3">                                    
                                    <p class="text-secondary mb-1">{{$eleveInfo->nom}} {{$eleveInfo->prenom}}</p>
                                    <p class="text-muted font-size-sm">{{$eleveInfo->classe}}</p>
                                    <p class="text-muted font-size-sm">{{$eleveInfo->matricule}}</p>                                
                                  </div>
                                  
                                  @else
                                  <img src="https://cdn3.iconfinder.com/data/icons/ui-solid-2/32/people_profil_avatar_user_person_team_ui-512.png" alt="Admin" class="rounded-circle" width="150">
                                  <div class="mt-3">
                                      <h4 class="placeholder-glow col-6"></h4>
                                      <p class="card-text placeholder-glow">
                                          <span class="placeholder col-8 "></span>
                                          <span class="placeholder col-12"></span>
                                          <span class="placeholder col-10"></span>
                                        </p>
                                      
                                      <button class="btn btn-outline-primary">Voir fiche</button>
                                    </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="mt-2" style="text-align: center;">
                              @if (Auth::check() && Auth::user()->role === 'superAdmin' )
                                <button class="btn btn-danger btn-sm col-7 mx-auto" id="openModal"><i class="bi bi-trash3"></i> supprimer l'élève</button> 
                              @endif
                              
                            </div>

                            <div class="card mt-2">
                              <div class="card-body">
                                <small>
                                  <h6 style="text-align: center; color:blue">Décisions élèves</h6>
                                  <hr>
                                  @if ($eleveInfo)
                                  <table class="table table-striped"">
                                    <thead>
                                      <tr>
                                        <th scope="col">information</th>
                                        <th scope="col">type</th>
                                        <th scope="col">voir</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if($eleveInfo['eleve_fiche'])
                                      <tr>
                                        <td><small>{{$eleveInfo['eleve_fiche']->nom}}</small></td>
                                        <td>{{$eleveInfo['eleve_fiche']->type_fiche}}</td>
                                        <td>
                                          <div style="text-align:center">
                                            <a href="{{ route('pdf.show', ['fileName' => $eleveInfo['eleve_fiche']->fiche_nom]) }}" target="_blank">
                                              <i class="bi bi-file-earmark-pdf-fill" style="color:red; font-size:22px"></i>
                                            </a>
                                          </div>
                                          <br>
                                          @if (Auth::check() && Auth::user()->role === 'superAdmin' )
                                          <div style="text-align:center">
                                            <a href="#" wire:click="detachFichePrimaire({{$eleveInfo->id}})">
                                              <i class="bi bi-trash" style="color:red; font-size:15px"></i>
                                            </a>
                                          </div>
                                          @endif
                                        </td>
                                      </tr>
                                      @endif
                                  @forelse ($eleveInfo->ficheS as $fiche)
                                  
                                      <tr>
                                        <td><small>{{$fiche->nom}}</small></td>
                                        <td style="color: rgb(112, 35, 35)">{{$fiche->type_fiche}}</td>
                                        <td>
                                          <div style="text-align:center">
                                            <a href="{{ route('pdf.show', ['fileName' => $fiche->fiche_nom]) }}" target="_blank">
                                              <i class="bi bi-file-earmark-pdf-fill" style="color:red; font-size:22px"></i>
                                            </a>
                                          </div>
                                          <br>
                                          @if (Auth::check() && Auth::user()->role === 'superAdmin' )
                                            <div style="text-align:center">
                                              <a href="#" wire:click="detachFicheAnnexe({{$eleveInfo->id}}, {{$fiche->id}})">
                                                <i class="bi bi-trash" style="color:red; font-size:15px"></i>
                                              </a>
                                            </div>
                                          @endif 
                                        </td>
                                      </tr>
                                    
                                  @empty
                                    <center></center>
                                  @endforelse 
                                  </tbody>
                                </table>
                                  @endif
                                </small>
                              </div>
                            </div>
                            
                          </div>
                          <div class="col-md-8">
                            <div class="card mb-3">
                              <div class="card-body">
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                   @if ($eleveInfo)
                                   {{$eleveInfo->nom}}
                                   @else
                                   <p class="placeholder-glow">
                                      <span class="placeholder col-6"></span>
                                   </p>
                                   @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Prenom</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      {{$eleveInfo->prenom}}
                                      @else
                                      <p class="placeholder-glow">
                                          <span class="placeholder col-5 "></span>
                                       </p>
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Date de naissance</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      @if ($eleveInfo->dateNaissance=='0000-01-01')
                                        Pas de date de naissance
                                      @else
                                        @php
                                          $date= date('d-m-Y', strtotime($eleveInfo->dateNaissance));
                                          $anneeNaissance = explode('-', $date)[2];
                                           if ($anneeNaissance >= date('Y') or $anneeNaissance =='2023' or $anneeNaissance=='1970') {
                                            echo 'Pas de date de naissance';
                                           } else{
                                            echo $date;
                                           }
                                        @endphp
                                        
                                      @endif
                                      
                                      @else
                                      <p class="placeholder-glow col-5">
                                          <span class="placeholder col-1 "></span>/<span class="placeholder col-1 "></span>/<span class="placeholder col-4 "></span>
                                       </p>
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Contact parent</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      @if (strlen($eleveInfo->contactParent)>=8 )
                                          {{$eleveInfo->contactParent}}
                                      @else
                                          Pas de contact
                                      @endif
                                      {{$eleveInfo->contactParent}}
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Année d'orientation</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                        {{$eleveInfo->annee}}
                                      @else
                                      <span class="placeholder col-3 "></span>
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Matricule</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      {{$eleveInfo->matricule}}
                                      @else
                                      <span class="placeholder col-5 "></span>
                                      @endif
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">classe</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      @if ($eleveInfo)
                                      {{$eleveInfo->classe}}
                                      @else
                                      <span class="placeholder col-3 "></span>
                                      @endif
                                  </div>
                                </div>
                                @if ($eleveInfo)
                                  @if ($eleveInfo->classe=='2nde')
                                  <hr>
                                  <div class="row mb-3 mt-2">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Série</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      {{$eleveInfo->serie}}
                                    </div>
                                  </div>
                                  @endif
                                @endif
                                <hr>
                                @if (Auth::check() && Auth::user()->role === 'superAdmin' || Auth::user()->role === 'admin')
                                <div class="row mb-3 mt-2">
                                  <div class="col-sm-12 d-flex justify-content-between" >
                                    @if ($eleveInfo)
                                    <a class="btn btn-info " data-bs-toggle="modal" data-bs-target="#modalStudent" wire:click='update({{$eleveInfo->id}})'>Modifier</a>
                                    @endif
                                  </div>
                                </div>
                                @endif
                              </div>
                            </div>
                            
                            
                            @if ($eleveInfo)
                            
                            <div class="row gutters-sm">
                              @if ($eleveInfo['eleve_ecole_O'])
                              <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Etablissement d'origine:</i> <span style="font-size: 12px">{{$eleveInfo['eleve_ecole_O']->NOMCOMPLs}}</span>  </h6>
                                    <small style="font-weight: bold">CODE établissement</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$eleveInfo['eleve_ecole_O']->CODSERVs}}</span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">CODE DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$eleveInfo['eleve_ecole_O']->CODE_DREN}}</span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">Nom DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$drenOrigine}}</span>
                                    </div>
                                    <hr>
                                  </div>
                                </div>
                              </div>
                              
                              @endif
                              @if ($eleveInfo['eleve_ecole_A'])
                              <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Etablissement d'accueil:</i> <span style="font-size: 12px">{{$eleveInfo['eleve_ecole_A']->NOMCOMPLs}}</span>  </h6>
                                    <small style="font-weight: bold">CODE établissement</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$eleveInfo['eleve_ecole_A']->CODSERVs}}</span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">CODE DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$eleveInfo['eleve_ecole_A']->CODE_DREN}}</span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">Nom DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span >{{$drenAccueil}}</span>
                                    </div>
                                    <hr>
                                  </div>
                                </div>
                              </div>
                              @endif
                            </div>
                            @else
                            <div class="row gutters-sm placeholder-glow">
                              <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Etablissement d'origine:</i> <span class="placeholder col-5" style="font-size: 12px"></span>  </h6>
                                    <small style="font-weight: bold">CODE établissement</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">CODE DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">Nom DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                  <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Etablissement d'origine:</i> <span class="placeholder col-5" style="font-size: 12px"></span>  </h6>
                                    <small style="font-weight: bold">CODE établissement</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">CODE DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                    <small style="font-weight: bold">Nom DREN</small>
                                    <div style="margin-bottom: 10px">
                                      <span class="col-4 placeholder"></span>
                                    </div>
                                    <hr>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif
              
              
                          </div>
                        </div>
              
                      </div>
                  </div>
          <!--fin info students-->
        </div>
        
        <div class="modal-footer">
        </div>
      </div>
          <!--modal de confirmation de suppression-->
          
          <div id="myModals" class="modalDel" style="text-align: center">
            <div class="modal-contents">
              <span id="closeModal" class="closes">&times;</span>
              <div style="" class="p-3">
                <h2 style="color: #1a1818; font-weight: bold"  > Suppression de l'élève</h2>
              </div>
              
              <div class="col-md-8  col-12 mx-auto">
                <div class="card shadow-xl mt-3 mb-4">
                  <div class="card-body">
                   <p style="font-weight: bold; color:red; text-align:center">Voulez vous supprimer l'élève ?</p> 
                   <div class="mt-2" style="text-align: center">
                    <i class="bi bi-exclamation-circle" style="font-size: 70px; color: red" ></i>
                   </div>
                   <div class="col-12 mx-auto d-flex justify-content-between mt-4 mb-2">
                    <button class="btn btn-sm btn-danger col-5 deletes" wire:model="ide" wire:click='deleteStudent({{$ide}})' >confirmer la suppression</button>
                    <button class="btn btn-sm btn-info col-5 clo">Annuler</button>
                    
                   </div>
                  </div>
                </div>
              </div>
            </div>
            @include('livewire.loading')
          </div>
        <!--fin modal de confirmation de suppression-->
    </div>
    <button style="display: none" class="update" href="" wire:click="mise_a_jour"></button> <!--bouton fictif pour rafraichir la page sans actualise la page en ca de modification des fiche ou detache-->
    <!--composant de loading permettant de patientez pendant chargement des datas provenant du controller livewire-->
    @include('livewire.loading')
    <!--fin loading -->
</div>

<script>
  document.addEventListener('livewire:initialized', () => {
    $('.deletes').on('click', function(){
      $("#modalStudentInfos").modal('hide');
      Swal.fire(
      'supprimer',
      'L\'élève a été supprimé avec success',
      'success'
      )
     
    })
    @this.on('detachPrimary', function(){
            $('.update').click()
          })
    })
</script>

</div>


