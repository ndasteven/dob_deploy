<div>
    <style>
table{
    font-size: 13px;
}
.form-control{
    height:33px;
}
.checkinfo{
    background-color: rgb(204, 109, 21);color:#fff;
}

    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('DREN') }}
        </h2>
    </x-slot>
    <div class="container">
        @if (Auth::check() && Auth::user()->role === 'superAdmin' || Auth::user()->role === 'admin')
        <div class="row d-flex justify-content-end mt-4">
            <button class="btn btn-primary activeAddDren btn-sm col-5 col-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none">Créer une DREN</button>
        </div>
        @endif

        <!--liste des élèves -->
        <div class="row">
            <div class="col-12 mt-4">
                <livewire:dren-table />
            </div>   
        </div>
        <!--fin liste des élèves -->
        <!-- modal -->
        @include('livewire.modal_form_drens')
        <!--fin modal -->
    </div>
    
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
     

       @this.on('addDren', function(){
        $('.activeAddDren').click()
       })
      
    });
</script>
