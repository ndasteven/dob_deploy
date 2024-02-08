<div>
<style>
table{
    font-size: 13px;
}
.form-control{
    height:33px;
}
.checkinfo{
    background-color: #1f75d8;color:#fff;
}
</style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Etablissements') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-primary btn-sm col-5 col-md-1 activeAddScholl" wire:click="create" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none"></button>
        </div>
        <button class="ecoleclick" wire:model='ide'   data-bs-toggle="modal" data-bs-target="#modalSchoolInfos" wire:click="ecoleinfo"   style="display:none" ></button>
        <!--liste des élèves -->
        <div class="row">
            <div class="col-12 mt-4">
                <livewire:ecole-table/>
            </div>

            
        </div>
        <!--fin liste des élèves -->
         <!-- modal info ecole-->
         @include('livewire.modalSchoolInfos')
         <!--fin modal -->
        <!-- modal -->
        @include('livewire.modal_form_etablissements')
        <!--fin modal -->
    </div>
    
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
       @this.on('edit', (data) => {
        @this.idecole = data.rowId //ce id ce trouve dans le bouton sectionner dans le controlleur de mon powergrid "studentTable"
        $('.ecoleclick').click()
       });

       @this.on('addSchool', function(){
        $('.activeAddScholl').click()
       })
      
    });
</script>