<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elèves') }}
        </h2>
    </x-slot>
    <style>

.btn-spacing {
    margin-right: 10px; /* Ajoutez la marge à droite pour espacer les boutons */
    background-color: #fff;
    border-radius: 10px;

}
.checkinfo{
    background-color: #39b315;color:#fff;
}
table{
    font-size: 13px;
}
.form-control{
    height:33px;
}

    </style>
    <div class="container" >
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-sm col-md-2 col-4 addStudent" data-bs-toggle="modal" data-bs-target="#modalStudent" wire:click='create()' style="display:none"></button>
        </div>
        <!--liste des élèves -->
        <div class="row">
                      
            <div class="container">
               
                <div class="row">
                    
                    @if (!empty($shareAnnee) || !empty($shareNiveau))
                     @if (!empty($shareNiveau))
                         <small style="color: blue"> Filter par niveau : <b style="color: red">{{$shareNiveau}}</b></small>
                     @endif 
                     @if (!empty($shareAnnee))
                         <small style="color: blue"> Filter par année : <b style="color: red">{{$shareAnnee}}</b> </small>
                     @endif 
                    @endif
                    <div class="col-md-12 col-12 mt-5">
                        <livewire:student-table :shareAnnee="$shareAnnee" :shareNiveau="$shareNiveau" /><button class="studentclick" wire:model='ide'   data-bs-toggle="modal" data-bs-target="#modalStudentInfos" wire:click="studentInfo()"   style="display:none" ></button>
                                                <button class="multipleCheck" wire:model='idsSelects' wire:click="getIdArray" data-bs-toggle="modal" data-bs-target="#multipleEdit"></button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--fin liste des élèves -->
        <!-- modal formulaire inscription-->
        @include('livewire.modal_form_students')
        <!--fin modal -->
        <!-- modal info student-->
        @include('livewire.modalStudentInfos')
        <!--fin modal -->
        <!-- modal editMultiple-->
        @include('livewire.multipleIdEdit_form')
        <!--fin modal -->

    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('edit', (data) => {
            @this.ide = data.rowId //ce id ce trouve dans le bouton sectionner dans le controlleur de mon powergrid "studentTable"
            
            $('.studentclick').click()
           });

          @this.on('editting',(data)=>{
            @this.idsSelects = data[0].myId; // on fait passer les id selectionner de la propriete $this->showCheckBox()->checkedValues() de la table powergrid studenTable dans le controlleur livewire StudentIndex.php
            $('.multipleCheck').click()
          })

          @this.on('addStudent', function(){
            $('.addStudent').click()
            
          })    
       
           
      
        });


     
    </script>
</div>

<script>

</script>
