
<div class="modal fade" id="modalFicheInfos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color: #f4f7f7">
          <div class="modal-header shadow-2xl" style="background-color: #fff">
            <h1 class="modal-title titre fs-5" id="exampleModalLabel">INFORMATIONS SUR LA FICHE</h1>
            <button  class="btn-close" wire:click='closefiche' data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          @if ($ficheInfo)
          @foreach ($ficheInfo as $ficheInfo)
           <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3">
                        <div class="card shadow-xl">
                            <div class="card-body" style="background-color: #f0342d">
                                <div class="row">
                                    <div class="col-md-4 mx-auto">
                                        <img src="asset/img/imageFiche.jpg" alt="" width="100%" height="auto" />
                                        <br>
                                    </div>
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="text-align: left"><span style="color: black; font-weight:bold">Nom fiche </span>: </td>
                                            <td style=""><span style="color: ; font-weight:bold">{{$ficheInfo->nom}} </span></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"><span style="color: black; font-weight:bold">Type de fiche </span>: </td>
                                            <td style=""><span style="color: ; font-weight:bold">{{$ficheInfo->type_fiche}} </span></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"><span style="color: black; font-weight:bold">Annee de la fiche </span>: </td>
                                            <td style=""><span style="color: ; font-weight:bold">{{$ficheInfo->annee}} </span></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"><span style="color: black; font-weight:bold">Classe de la fiche </span>: </td>
                                            <td style=""><span style="color: ; font-weight:bold">{{$ficheInfo->classe}} </span></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"><span style="color: black; font-weight:bold">Ecole de la fiche </span>: </td>
                                            <td style=""><span style="color: ; font-weight:bold">{{$ficheInfo['fiche_ecole']->NOMCOMPLs}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left"><span style="color: black; font-weight:bold">Voir la fiche</span>: </td>
                                            <td style=""><span style="color: ; font-weight:bold"><a href="{{ route('pdf.show', ['fileName' => $ficheInfo->fiche_nom]) }}" target="_blank">
                                                <button class="btn btn-sm btn-outline-primary test_click">Voir Fiche <i class="bi bi-file-earmark-pdf-fill" style="color:red;"></i></button>
                                              </a></span></td>
                                        </tr>
                                        @if (Auth::check() && Auth::user()->role === 'superAdmin' || Auth::user()->role === 'admin')
                                        <tr>
                                            <td style="text-align: left"><span style="color: black; font-weight:bold">Modifier la fiche</span>: </td>
                                            <td style="">
                                                <span style="color: ; font-weight:bold">
                                                 <button class="btn btn-warning btn-sm test_click" data-bs-toggle="modal" data-bs-target="#modal_form_fiche" wire:click="update({{$ficheInfo->id}})">Modifier Fiche <i class="bi bi-file-earmark-pdf-fill" style="color:red;"></i></button>
                                                </span></td>
                                        </tr>
                                        @endif
                                    </table>
                                    
                                    <div class="card">
                                        <div class="card-body shadow-md">
                                            <h6>Remarque sur la fiche:</h6>
                                            <p>{{$ficheInfo->remarkFiche}}</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 mx-auto">
                        <div class="row ">
                            <div class="card shadow-xl col-md-11 mx-auto">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10 mx-auto">
                                            <div class="row">
                                                <div class="col" ><b>Nombre d'élèves sur la fiche'</b></div>
                                                <div class="col" style="text-align: right">{{count($ficheInfo["fiche_eleve"])}}</div>

                                            </div>
                                          <hr class="border border-success border-1 opacity-50">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="card shadow-xl col-md-11 mx-auto">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10 mx-auto">
                                          <div class="row">
                                            <div class="col" ><b>Liste des élèves sur la fiche</b></div>
                                            <div class="col" style="text-align: right">
                                                <label for="exampleFormControlInput1" class="form-label">Rechercher un matricule</label>
                                                <input type="text" wire:model="search" wire:keydown.debounce.900ms="research" class="form-control-sm col-md-5 col-12" id="exampleFormControlInput1" placeholder="12345678A">
                                            </div>
                                          </div>
                                          <hr class="border border-primary border-1 opacity-50">
                                          <div class="row">
                                            <div class="col overflow-x-auto" >
                                                
                                                <table class="table tableFiche  display" id="example"  style="width:100%">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col">Matricule</th>
                                                        <th scope="col">Nom</th>
                                                        <th scope="col">Prenom</th>
                                                        <th scope="col">Genre</th>
                                                        <th scope="col">Date de naissance</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @if (count($liste_students_fiches)>0)
                                                         @foreach ($liste_students_fiches as $item)
                                                        
                                                        <tr>
                                                            <td>{{$item->matricule}}</td>
                                                            <td>{{$item->nom}}</td>
                                                            <td>{{$item->prenom}}</td>
                                                            <td>{{$item->genre}}</td>
                                                            <td>
                                                                @if ($item->dateNaissance=='0000-01-01')
                                                                    Pas de date de naissance
                                                                @else
                                                                    @php
                                                                    $date= date('d-m-Y', strtotime($item->dateNaissance));
                                                                    $anneeNaissance = explode('-', $date)[2];
                                                                    if ($anneeNaissance >= date('Y') or $anneeNaissance =='2023') {
                                                                        echo 'Pas de date ';
                                                                    } else{
                                                                        echo $date;
                                                                    }
                                                                    @endphp
                                                                    
                                                                @endif
                                                            </td>
                                                        </tr>  
                                                        @endforeach 
                                                        @else
                                                        
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="text-align: center; color:red">PAS D'ELEVES</td>
                                                            <td></td>
                                                            <td></td>
                                                            
                                                        </tr>
                                                        @endif
                                                        
                                                    </tbody>
                                                </table>
                                                {{ $liste_students_fiches->links() }}
                                            </div>
                                           
                                            
                                          </div>
                                        </div>
                                    </div> 
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          @endforeach
           @endif            
          <div class="modal-body">
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
                    <button class="btn btn-sm btn-danger col-5 deletes">confirmer la suppression</button>
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
     <!--composant de loading permettant de patientez pendant chargement des datas provenant du controller livewire-->
     @include('livewire.loading')
     <!--fin loading -->   
</div>
