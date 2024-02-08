<div>
    {{--un composant qui surveille les importation de fichier excel dans la DB en file d'attente--}}
    <div wire:poll="checkFileAttente"></div> 
    <div class="">
       @if ($fileAttente)
        <small style="color: red">il y'a {{$countTache}} importation en cours...</small>    
        @else
        <small style="color: green">aucune importation en cours</small>
            
       @endif 
    </div>
    
</div>

<script>
     document.addEventListener('livewire:initialized', () => {
        @this.on('desableForm', (data)=>{// la fonction disableForm declanché par dispatch dans le controlleur livewire fileAttente
            if($('input').hasClass('file')){ //je verifie si dans admin.blade a une classe du nom de file alors je le desactive vu qu'il ya une importation en court
                $('input.file').prop('disabled', true); // Désactivez l'élément
                $('.submitImport').prop('disabled', true); // Désactivez l'élément file-click
                $('.file-click').prop('disabled', true);
                $('.file-click_ecole').prop('disabled', true);
                $('.file-click_dren').prop('disabled', true);
                
            }
    })
        @this.on('ActiveForm', (data)=>{// la fonction ActiveForm declanché par dispatch dans le controlleur livewire fileAttente
                if($('input').hasClass('file')){ //je verifie si dans admin.blade a une classe du nom de file alors je le desactive vu qu'il ya une importation en court
                    $('input.file').prop('disabled', false); // Activez l'élément
                    $('.submitImport').prop('disabled', false); // Activez l'élément
                    $('.file-click').prop('disabled', false); // Activez l'élément
                    $('.file-click_ecole').prop('disabled', false); // Activez l'élément
                    $('.file-click_dren').prop('disabled', false); // Activez l'élément
                    
                }
        })

        @this.on('errorImport', (data)=>{
            Swal.fire(
            'Importation echouée',
            'Merci de bien vouloir verifier le fichier que vous importé',
            'error'
            ) 
            $('.alert-success').delay(5000).fadeOut('slow');
        })
    })
</script>
