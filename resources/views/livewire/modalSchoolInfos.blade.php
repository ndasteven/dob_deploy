<div class="modal fade" id="modalSchoolInfos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self> 
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color: #f4f7f7">
          <div class="modal-header shadow-2xl" style="background-color: #fff">
            <h1 class="modal-title fs-5" id="exampleModalLabel">INFORMATIONS SUR L'ECOLE</h1>
            <button  class="btn-close" wire:click='closeSchool' data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          @if ($ecoleInfo)
          @foreach ($ecoleInfo as $ecoleInfo)
                       
          <div class="modal-body">
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="card shadow-xl">
                        <div class="card-body" style="background-color: #5c32f3">
                            <div class="row">
                                <div class="col-md-4 mx-auto">
                                    <img src="asset/img/ecole.png" alt="" width="100%" height="auto" id="image_eleve"/>
                                    <br>
                                </div>
                                <p style="text-align: center; font-size:14px; color:#fff; font-weight:bold ">Nom ecole: {{$ecoleInfo->NOMCOMPLs}} <br> Code dren: {{$ecoleInfo->CODE_DREN}} <br> 
                                    Code etablissement: {{$ecoleInfo->CODSERVs}} <br>
                                    DREN : {{$ecoleInfo["ecole_dren"]->nom_dren}}
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <div>
                      @if (Auth::check() && Auth::user()->role === 'superAdmin' || Auth::user()->role === 'admin')
                      @if ($ecoleInfo)
                      <div class="col-md-4 mx-auto">
                        <a class="btn btn-info col-12 " data-bs-toggle="modal" wire:click="update({{$ecoleInfo->id}})" data-bs-target="#exampleModal" >Modifier</a>
                      </div>   
                      @endif
                      @endif
                     
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="row ">
                        <div class="card shadow-xl col-md-11 mx-auto">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10 mx-auto">
                                        <div class="row">
                                            <div class="col" ><b>Nombre de fiches de décisions</b></div>
                                            <div class="col" style="text-align: right">{{count($ecoleInfo["ecole_fiche"])}}</div>
                                        </div>
                                      <hr class="border border-success border-1 opacity-50">
                                      <div class="row">
                                        <div class="col-md col">
                                          @if (count($ecoleInfo["ecole_fiche"])>0)
                                           <div class="card shadow-xl col-md-11 mx-auto m-3 bg-primary bg-gradient bg-opacity-10 ">
                                              <div class="card-body" style="text-align: center">
                                                @if ($affectation >0)
                                                <div class="row">
                                                  <div class="col" style="text-align: left"><b>Nombre de fiches affectations</b></div>
                                                  <div class="col" style="text-align: right">{{$affectation}}</div>
                                                </div>
                                                <hr class="border border-black border-1 opacity-50">  
                                                @endif

                                                @if ($change_ordre >0)
                                                <div class="row">
                                                  <div class="col" style="text-align: left"><b>Nombre de fiches changements d'ordres</b></div>
                                                  <div class="col" style="text-align: right">{{$change_ordre}}</div>
                                                </div>
                                                <hr class="border border-black border-1 opacity-50">  
                                                @endif

                                                @if ($change_serie >0)
                                                <div class="row">
                                                  <div class="col" style="text-align: left"><b>Nombre de fiches changements de series</b></div>
                                                  <div class="col" style="text-align: right">{{$change_serie}}</div>
                                                </div>
                                                <hr class="border border-black border-1 opacity-50">  
                                                @endif

                                                @if ($omission >0)
                                                <div class="row">
                                                  <div class="col" style="text-align: left"><b>Nombre de fiches d'omissions</b></div>
                                                  <div class="col" style="text-align: right">{{$omission}}</div>
                                                </div>
                                                <hr class="border border-black border-1 opacity-50">  
                                                @endif

                                                @if ($orientation >0)
                                                <div class="row">
                                                  <div class="col" style="text-align: left"><b>Nombre de fiches de orientations</b></div>
                                                  <div class="col" style="text-align: right">{{$orientation}}</div>
                                                </div>
                                                <hr class="border border-black border-1 opacity-50">  
                                                @endif

                                                @if ($permutation >0)
                                                <div class="row">
                                                  <div class="col" style="text-align: left"><b>Nombre de fiches de permutations</b></div>
                                                  <div class="col" style="text-align: right">{{$permutation}}</div>
                                                </div>
                                                <hr class="border border-black border-1 opacity-50">  
                                                @endif

                                                @if ($reaffectation >0)
                                                <div class="row">
                                                  <div class="col" style="text-align: left"><b>Nombre de fiches de reaffectations</b></div>
                                                  <div class="col" style="text-align: right">{{$reaffectation}}</div>
                                                </div>
                                                <hr class="border border-black border-1 opacity-50">  
                                                @endif

                                                @if ($reorientation >0)
                                                <div class="row">
                                                  <div class="col" style="text-align: left"><b>Nombre de fiches de reorientations</b></div>
                                                  <div class="col" style="text-align: right">{{$reorientation}}</div>
                                                </div>
                                                <hr class="border border-black border-1 opacity-50">  
                                                @endif
                                              </div>
                                          </div> 
                                          @endif
                                          
                                        </div>
                                      </div>
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
                                        <div class="col" ><b>Nombre d'élèves</b></div>
                                        <div class="col" style="text-align: right">{{count($ecoleInfo["ecole_eleve_A"])}}</div>
                                      </div>
                                      <hr class="border border-primary border-1 opacity-50">
                                      <div class="row">
                                        <div class="col-md-5">
                                          <div class="card shadow-xl col-md-11 mx-auto m-3 bg-success-subtle">
                                              <div class="card-body" style="text-align: center">
                                                <b>Nombre d'élèves en Sixième</b>
                                                 <br>
                                                 <span style="font-size: 18px; font-weight:bold">{{$nbre6eme}}</span>
                                              </div>
                                          </div>
                                        </div> 
                                        <div class="col-md-7">
                                          <div class="card shadow-xl col-md-11 mx-auto m-3 bg-info-subtle">
                                            <div class="card-body" style="text-align: center">
                                                <b>Nombre d'élèves en Seconde</b>
                                                 <br>
                                                 <span style="font-size: 18px; font-weight:bold">{{$nbre2nde}}</span>
                                                 <div class="row" style="font-size: 11px">
                                                    <div class="col" style="text-align: left"><b>Série A</b></div>
                                                    <div class="col" style="text-align: right">{{$serieA}}</div>
                                                 </div>
                                                <hr class="border border-success border-1 opacity-50">
                                                <div class="row" style="font-size: 11px">
                                                    <div class="col" style="text-align: left"><b>Série C</b></div>
                                                    <div class="col" style="text-align: right">{{$serieC}}</div>
                                                 </div>
                                                <hr class="border border-success border-1 opacity-50">
                                                <div class="row" style="font-size: 11px">
                                                    <div class="col" style="text-align: left"><b>Série F1</b></div>
                                                    <div class="col" style="text-align: right">{{$serieF1}}</div>
                                                 </div>
                                                <hr class="border border-success border-1 opacity-50">
                                                <div class="row" style="font-size: 11px">
                                                    <div class="col" style="text-align: left"><b>Série F2</b></div>
                                                    <div class="col" style="text-align: right">{{$serieF2}}</div>
                                                 </div>
                                                <hr class="border border-success border-1 opacity-50">
                                                <div class="row" style="font-size: 11px">
                                                    <div class="col" style="text-align: left"><b>Série G1</b></div>
                                                    <div class="col" style="text-align: right">{{$serieG1}}</div>
                                                 </div>
                                                <hr class="border border-success border-1 opacity-50">
                                                <div class="row" style="font-size: 11px">
                                                    <div class="col" style="text-align: left"><b>Série G2</b></div>
                                                    <div class="col" style="text-align: right">{{$serieG2}}</div>
                                                 </div>
                                                <hr class="border border-success border-1 opacity-50">
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
            </div>
          </div>
          @endforeach 
          @endif
        </div>
    </div>
    <!--composant de loading permettant de patientez pendant chargement des datas provenant du controller livewire-->
    @include('livewire.loading')
    <!--fin loading -->
</div>