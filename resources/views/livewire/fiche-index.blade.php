<div>
<style>
table{
    font-size: 13px;
}
.form-control{
    height:33px;
}
.checkinfo{
    background-color: #ec3f3f;color:#fff;
}    
</style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('DECISIONS') }}
        </h2>
    </x-slot>
    <div class="container">
        
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-primary btn-sm col-5 col-md-2 activeAddFiche" data-bs-toggle="modal" data-bs-target="#modal_form_fiche" wire:click="create()" style="display: none"></button>
        </div>
        <button class="ficheclick" wire:model='ide'   data-bs-toggle="modal" data-bs-target="#modalFicheInfos" wire:click="ficheinfo"   style="display:none" ></button>
        <!--liste des fiche -->
        <div class="row">
            <div class="col-12 mt-4">
                <livewire:fiche-table :shareAnnee="$shareAnnee"/>
            </div>

            
        </div>
        <!--fin liste des fiche -->
      <!-- modal info fiche-->
      @include('livewire.modalFicheInfos')
      <!--fin modal -->
        <!-- modal -->
      
        <!--fin modal -->
    </div>
    @include('livewire.modal_form_fiches')
    
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
       @this.on('edit', (data) => {
        @this.idefiche = data.rowId //ce id ce trouve dans le bouton sectionner dans le controlleur de mon powergrid "ficheTable"
        $('.ficheclick').click()
       });

       @this.on('addFiche', function(){
        $('.activeAddFiche').click()
       })
      
    });
</script>