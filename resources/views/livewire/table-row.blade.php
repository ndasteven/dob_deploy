<div>
<tbody>
        @foreach ($eleves as $student)
        <tr wire:key="{{$student->id}}">
           <th scope="row">{{$student->matricule}}</th>
           <td>{{$student->nom}}</td>
           <td>{{$student->prenom}}</td>
           <td class="" >{{$student->genre}}</td>
           <td>{{$student->classe}} @if ($student->classe=='2nde')( {{$student->serie}} )   @endif</td>
           {{----}}
           <td class="">{{$student['eleve_ecole_A']->NOMCOMPLs}}</td>                                
           <td><a href="storage/fiche_orientation/{{$student['eleve_fiche']->fiche_nom}}" target="_blank"><button href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="voir la fiche d'orientation"> <i class="bi bi-filetype-pdf" style="color: red"></i></button></a></td>
           <td class="d-none d-sm-block">
           <button class="btn btn-sm idinfo"  id="{{$student->id}}"    style="background-color: #39b315;color:#fff" >selectionner</button>
          </td>
        </tr> 
    @endforeach
</tbody>
</div>
     


