
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
                        {{--flottement droite pour afficher les matricules recupérer--}}
                        <div wire:ignore.self class="offcanvas offcanvas-end" style="width: 69% " tabindex="10" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                            <div class="offcanvas-header">
                              <h5 class="offcanvas-title" id="offcanvasTopLabel"> {{$countFicheMatricule}} matricules récupérés sur la fiche de décisions <div wire:loading style="text-align: center">
                                <div class="spinner-border spinner-border-sm text-primary"  role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                </div>
                              </h5>
                              <button type="button" wire:click="ficheinfo" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                              
                            </div>
                            <div class="offcanvas-body">
                            <div class="card col-12">
                                <div class="card-body">
                                    <header style="background-color:#f0e3e2; padding:10px 15px; color:#fff">
                                        <form wire:submit.prevent="searcheMatricule">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label" style="color: #1a1818">Matricule</label>
                                                <input wire:model='elevematricule' type="text" class="form-control @error('elevematricule') is-invalid @enderror"  id="exampleFormControlInput1" placeholder="12345678A">
                                                <div class="invalid-feedback">
                                                    Entrer un matricule valide
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary col-12" style="color: #fff">Rechercher</button>
                                            </div>
                                        </form>
                                    </header>
                                    <section>
                                        <div class="card">
                                            <div class="card-body">
                                                
                                                @if ($eleveFicheInfo!=null)
                                                  
                                                 <div class="alert alert-warning col-md-10 mx-auto" style="font-size: 13px">
                                                    <div class="alert alert-success" style=" @if (session()->has('success')) display:block @else display:none @endif " >
                                                        {{ session('success') }}
                                                    </div>
                                                
                                                    <div class="alert alert-danger" style=" @if (session()->has('error')) display:block @else display:none @endif ">
                                                        {{ session('error') }}
                                                    </div>
                                                    <h4>Informations sur l'élève N°{{$countFicheEleve}} de la décision </h4>
                                                    @foreach($eleveFicheInfo as $eleveMultiUp)
                                                      <ul>
                                                        <li>Matricule : {{$eleveMultiUp->matricule}} </li>
                                                      </ul>  
                                                      <ul>
                                                        <li>Nom : {{$eleveMultiUp->nom}} </li>
                                                      </ul>
                                                      <ul>
                                                        <li>Prenom : {{$eleveMultiUp->prenom}} </li>
                                                      </ul>
                                                      <ul>
                                                        <li>date de naissance : @if (session()->has('valide_date')) @php echo date('d-m-Y', strtotime($dateNaissance));  @endphp  @else @php
                                                            $date= date('d-m-Y', strtotime($eleveMultiUp->dateNaissance));
                                                            $anneeNaissance = explode('-', $date)[2];
                                                             if ($anneeNaissance >= date('Y') or $anneeNaissance =='2023' or $anneeNaissance=='1970') {
                                                              echo 'Pas de date de naissance';
                                                             } else{
                                                              echo $date;
                                                             }
                                                          @endphp
                                                          @endif  
                                                            <span class="dropdown">
                                                            <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                              Modifier
                                                            </a>
                                                          
                                                            <ul class="dropdown-menu" style="padding: 5px 10px">
                                                             <form wire:submit.prevent='updateDateNaissance({{$eleveMultiUp->id}})'>
                                                                @csrf
                                                                <div>
                                                                    <input style="font-size: 11px"  wire:model="dateNaissance" class="form-control form-control-sm"  type="date" name="" id="">
                                                                </div>
                                                                <div class="mt-2">
                                                                    <small>
                                                                      <button style="font-size: 11px" class="btn btn-sm btn-danger col-12" type="submit">valider</button>  
                                                                    </small>
                                                                    
                                                                </div>
                                                             </form>
                                                            </ul>
                                                           </span>
                                                           @error('dateNaissance') <span style="color: red">Date de naissance    non valide</span> @enderror
                                                           @if (session()->has('valide_date')) <span style="color: green">Modifé</span>  @endif
                                                        </li>
                                                      </ul>
                                                      <ul>
                                                        <li>Niveau : {{$eleveMultiUp->classe}}</li>
                                                      </ul>
                                                      @if ($eleveMultiUp->classe=='2nde')
                                                      <ul>
                                                        <li>Série : @if (session()->has('valide_serie')) {{$serie}} @else {{$eleveMultiUp->serie}} @endif
                                                            <span class="dropdown">
                                                                <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                  Modifier
                                                                </a>
                                                              
                                                                <ul class="dropdown-menu" style="padding: 5px 10px">
                                                                 <form wire:submit.prevent='updateSerie({{$eleveMultiUp->id}})'>
                                                                    @csrf
                                                                    <div>
                                                                        <select wire:model='serie' class="form-select form-select-sm" aria-label="Small select example">
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
                                                                    </div>
                                                                    <div class="mt-2">
                                                                        <small>
                                                                          <button style="font-size: 11px" class="btn btn-sm btn-danger col-12" type="submit">valider</button>  
                                                                        </small>
                                                                        
                                                                    </div>
                                                                 </form>
                                                                </ul>
                                                            </span>
                                                            @error('serie') <span style="color: red">Série non valide</span> @enderror
                                                            @if (session()->has('valide_serie')) <span style="color: green">Modifé</span>  @endif
                                                        </li>
                                                      </ul>  
                                                      @endif
                                                      <ul>
                                                        <li>Etablissement d'origine : {{$eleveMultiUp->ecole_origine}}  </li>
                                                      </ul>
                                                      @if ($eleveMultiUp->fiche_id or $eleveMultiUp->ficheS() )
                                                      @if ($eleveMultiUp['eleve_fiche'])
                                                      <ul>
                                                        <li>
                                                            <p style="color:red">Elève décisions</p>
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                      <th scope="col">information</th>
                                                                      <th scope="col">type</th>
                                                                      <th scope="col">voir</th>
                                                                    </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                    
                                                                     <tr>
                                                                        <td><small>{{$eleveMultiUp['eleve_fiche']->nom}}</small></td>
                                                                        <td>{{$eleveMultiUp['eleve_fiche']->type_fiche}}</td>
                                                                        <td>
                                                                        <div style="text-align:center">
                                                                            <a href="{{ route('pdf.show', ['fileName' =>$eleveMultiUp['eleve_fiche']->fiche_nom]) }}" target="_blank">
                                                                            <i class="bi bi-file-earmark-pdf-fill" style="color:red; font-size:22px"></i>
                                                                            </a>
                                                                        </div>
                                                                        </td>
                                                                    </tr>                                                                     
                                                                    @foreach ($eleveMultiUp->ficheS as $fiche)
                                                                    <tr>
                                                                         <td><small>{{$fiche->nom}}</small></td>
                                                                         <td style="color: rgb(112, 35, 35)">{{$fiche->type_fiche}}</td>
                                                                         <td>
                                                                          <div style="text-align:center">
                                                                            <a href="{{ route('pdf.show', ['fileName' => $fiche->fiche_nom]) }}" target="_blank">
                                                                            <i class="bi bi-file-earmark-pdf-fill" style="color:red; font-size:22px"></i>
                                                                            </a>
                                                                          </div>
                                                                    </tr>
                                                                    @endforeach
                                                                  </tbody>
                                                            </table>
                                                        </li>
                                                      </ul> 
                                                      @endif 
                                                      @endif
                                                      <ul>
                                                        <li><button class="btn btn-success btn-sm col-12" wire:click="attribuerDecision({{$eleveMultiUp->id}})">Attribuer la fiche à l'élève</button></li>
                                                      </ul>
                                                       
                                                      <ul>
                                                        <li></li>
                                                      </ul>
                                                 </div>
                                                    @endforeach 
                                                 @else
                                                 <p style="text-align: center" style="color: red">Pas d'élèves pour ce matricule</p>
                                                                              
                                                @endif
                                                     @if($countMatricule<$countFicheMatricule)
                                                      <div class="d-flex justify-content-center">
                                                      <button class="btn btn-secondary btn-sm  col-10 mx-auto" wire:click="nextMatricule">Suivant <span class="badge bg-primary rounded-pill">{{$resteMatricule}}</span>  </button>
                                                      </div>
                                                     @endif  
                                                                                            
                                                   
                                               
                                                
                                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            </div>
                        </div>
                         {{--fin flottement droite pour afficher informations sur les les matricules recupérer--}}
                        <div class="row ">
                            <div class="card shadow-xl col-md-11 mx-auto">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10 mx-auto">
                                            <div class="row">
                                                <div class="col" ><b>Nombre d'élèves sur la fiche'</b></div>
                                                <div class="col" style="text-align: right">{{count($elevefiche_eleveFichePivot)}}</div>
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
                                            <button wire:click="addStudentOnDecision" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="bi bi-person-plus-fill"></i></button>
                                        </div>
                                        <div class="float-right">
                                            <div wire:loading>
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
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
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="text-align: center"> <button type="button" class="btn btn-outline-success" wire:click='addStudentOnDecision' data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Ajouter elèves de la fiches <i class="bi bi-person-plus-fill"></i></button></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        @endif
                                                        
                                                    </tbody>
                                                </table>
                                                {{ $liste_students_fiches->onEachSide(1)->appends(['page' => request()->page])->links() }}
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
            
          </div>
        <!--fin modal de confirmation de suppression-->
    </div>
    <button style="display: none" class="update" href="" wire:click="mise_a_jour"></button> <!--bouton fictif pour rafraichir la page sans actualise la page en ca de modification des fiche ou detache-->
     <!--composant de loading permettant de patientez pendant chargement des datas provenant du controller livewire-->
     
        @include('livewire.loading')
     
     
     <!--fin loading -->   
     <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('mise_a_jour', function(){
            $('.update').click()
          })
    })
    </script>
</div>

