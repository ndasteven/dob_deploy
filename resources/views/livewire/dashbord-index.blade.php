<div>
      <div>
        <div class="col-md-2 col-11">
          <select wire:change="changeYear" wire:model="yearsearch" class="form-select mt-4 ml-4" aria-label="Default select example">
            <option selected value="">Toutes les années </option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
          </select>
        </div>
      </div>
      
      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                  <div class="row">
                      <div class="col-md-12 d-flex justify-content-center">
                      <div class="row" style="text-align: center">
                        <div class="col-md-4 col-12 mb-3">
                        {{--card test 6eme--}}
                        <button  wire:click="goStudent('6eme')" wire:model="niveau" value="6eme">
                        <div class="clash-card  barbarian" style="border-radius:10px">
                          <div class="clash-card__image clash-card__image--barbarian" >
                            <img src="asset/img/eleve.jpg" alt="barbarian" />
                          </div>
                          <div class="clash-card__level clash-card__level--barbarian" style="color: orangered">Nombre d'éleves en Sixieme</div>
                          <div class="clash-card__unit-name"><span id="count_eleve6eme">{{$nombre_eleve6eme}} </span></div>
                          <div class="clash-card__unit-description">
                            @if ($yearsearch=='')
                                Toutes les années
                            @else
                                {{$yearsearch}}
                            @endif
                          </div>
                    
                          <div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
                            <div class="one-third">
                              <div class="stat" id="count_rea6eme">{{$nombre_rea6eme}} </div>
                              <div class="stat-value">Reaffectés</div>
                            </div>
                    
                            <div class="one-third">
                              <div class="stat" id="count_Omi6eme">{{$nombre_Omi6eme}}</div>
                              <div class="stat-value">Omis</div>
                            </div>
                    
                            <div class="one-third no-border" style="padding-left: 2px">
                              <div class="stat" id="count_Permu6eme">{{$nombre_Permu6eme}}</div>
                              <div class="stat-value">Permutés</div>
                            </div>
                    
                          </div>
                    
                        </div>
                      </button>
                      {{--card test--}}
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                      {{--card test--}}
                      <button  wire:click="goStudent('2nde')" >
                              <div class="clash-card barbarian" style="border-radius:10px">
                                  <div class="clash-card__image clash-card__image--barbarian" >
                                    <img src="asset/img/bg1.jpeg" alt="barbarian" />
                                  </div>
                                  <div class="clash-card__level clash-card__level--barbarian" style="color: orangered">Nombre d'éleves en Seconde</div>
                                  <div class="clash-card__unit-name"><span id="count_eleve2nde">{{$nombre_eleve2nde}}</span></div>
                                  <div class="clash-card__unit-description">
                                    @if ($yearsearch=='')
                                    Toutes les années
                                    @else
                                        {{$yearsearch}}
                                    @endif
                                  </div>
                            
                                  <div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
                                    <div class="one-third">
                                      <div class="stat" id="count_rea2nde">{{$nombre_rea2nde}}</div>
                                      <div class="stat-value">Reaffectés</div>
                                    </div>
                            
                                    <div class="one-third">
                                      <div class="stat" id="count_Omi2nde">{{$nombre_Omi2nde}}</div>
                                      <div class="stat-value">Omis</div>
                                    </div>
                            
                                    <div class="one-third no-border" >
                                      <div class="stat" id="count_Reo2nde">{{$nombre_Reo2nde}}</div>
                                      <div class="stat-value">Reorientatés</div>
                                    </div>
                            
                                  </div>
                            
                                </div>
                      </button>
                      {{--card test--}}
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                          {{--card test--}}
                        <button href="/fiche" wire:click="goFiche">
                          <div class="clash-card barbarian" style="border-radius:10px">
                          <div class="clash-card__image clash-card__image--barbarian" >
                            <img src="asset/img/fiche.jpg" alt="barbarian" />
                          </div>
                          <div class="clash-card__level clash-card__level--barbarian" style="color: orangered">Nombre de fiches de décisions</div>
                          <div class="clash-card__unit-name"><span id="count_fiche">{{$nombre_fiche}}</span></div>
                          <div class="clash-card__unit-description">
                            @if ($yearsearch=='')
                            Toutes les années
                            @else
                                {{$yearsearch}}
                            @endif
                          </div>
                    
                          <div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
                            <div class="one-third border-none" style="padding-left: 2px">
                              <div class="stat" id="count_ficheRea">{{$nombre_ficheRea}}</div>
                              <div class="stat-value">Reaffectations</div>
                            </div>
                    
                            <div class="one-third">
                              <div class="stat" id="count_ficheOmi">{{$nombre_ficheOmi}}</div>
                              <div class="stat-value">Omissions</div>
                            </div>
                    
                            <div class="one-third border-none no-border" style="padding-left: 5px">
                              <div class="stat" id="count_fichePermu">{{$nombre_fichePermu}}</div>
                              <div class="stat-value">Permutations</div>
                            </div>
                    
                          </div>
                    
                        </div>
                      </button>
                      {{--card test--}}
                        </div>
                      </div>
  
                      </div>
                  
                  </div>
   
              </div>
          </div>
      </div>
      <script>
      document.addEventListener("DOMContentLoaded", function() {
      
      function counter($nombre, $idselect, $timer, $pas) {
          let count = 0; // Valeur initiale
          let iteration = 0
          const targetValue = $nombre; // La valeur cible que vous avez obtenue de votre route Laravel
  
          const countElement = document.getElementById($idselect);
  
          const intervalId = setInterval(function() {
              count+=$pas;
              iteration+=1
              countElement.innerText = count;

              if (iteration >= 10) {
                  clearInterval(intervalId);
                  countElement.innerText = $nombre
              }
              if (targetValue==0) {
                countElement.innerText = 0
              }
          }, $timer); // Augmentation toutes les 100 millisecondes (ajustez selon vos préférences) 
      }
      //counter automatique du nombre des element de la base de donnée
    counter({{$nombre_eleve6eme}}, "count_eleve6eme", 100,1003)
    counter({{$nombre_eleve2nde}}, "count_eleve2nde", 100, 1005)
    counter({{$nombre_rea6eme}}, "count_rea6eme", 100, 1)
    counter({{$nombre_rea2nde}}, "count_rea2nde", 100, 1)
    counter({{$nombre_fiche}}, "count_fiche", 100, 3)
    counter({{$nombre_ficheRea}}, "count_ficheRea", 100, 1)
    counter({{$nombre_ficheOmi}}, "count_ficheOmi", 100, 1)
    counter({{$nombre_fichePermu}}, "count_fichePermu", 100, 1)
    counter({{$nombre_Omi2nde}}, "count_Omi2nde", 100, 1)
    counter({{$nombre_Omi6eme}}, "count_Omi6eme", 100, 1)
    counter({{$nombre_Reo2nde}}, "count_Reo2nde", 100, 1)
    counter({{$nombre_Permu6eme}}, "count_Permu6eme", 100, 1)
      });
      </script> {{-- The best athlete wants his opponent at his best. --}}
</div>
