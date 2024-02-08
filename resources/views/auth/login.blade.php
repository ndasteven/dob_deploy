<x-guest-layout>
    <link rel="stylesheet" href="asset/css/form.css">
    
        <div class="container-fluid" style="">
            
            <div class="row"  >
        <div class="col-md-6 d-none d-sm-block" style="padding: 0px; margin: 0px; " >
          <div class="content">
          <div class="images">
            <img class="img-slide" src="asset/img/bg1.jpeg" class="">
            <img class="img-slide" src="asset/img/bg2.jpg" class="">
            <img class="img-slide" src="asset/img/bg3.jpeg" class="">
            <img class="img-slide" src="asset/img/bg4.jpeg" class="">
            <img class="img-slide" src="asset/img/bg5.jpg" class="">
          </div>
          </div>
        </div>
            <div class="col-md-6"  style="background:linear-gradient(45deg, rgb(16, 137, 211) 0%, rgb(18, 177, 209) 100%);padding: 0px; margin: 0px; height: 100vh">
              <div class="container-of-form mx-auto" style="margin-top: 150px">
       
           <div class="col-4 mx-auto">
            <img src="asset/img/doblogo.jpeg"  alt="" >
            
           </div>
        
        <div class="heading">Se Connecter</div>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full input" type="email" name="email" placeholder="E-mail" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <div class="mt-4">
                <x-label for="password" value="{{ __('Mot de passe') }}" />
                <x-input id="password" class="block mt-1 w-full input" type="password" name="password" placeholder="Mot de Passe" required autocomplete="current-password" />
            </div>
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir') }}</span>
                </label>
            </div>
            <div>
            @if (Route::has('password.request'))
                <a class="forgot-password " href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié?') }}
                </a>
            @endif
            </div>
          
          <div>
            <x-button class="login-button" style="">
                {{ __('Se connecter') }}
            </x-button>
          </div>
          
        </form>
      </div>
                </div>
            </div>
        </div>
    
    
</x-guest-layout>
<script>
    var indexValue = 0;
    function slideShow(){
      setTimeout(slideShow, 5000);
      var x;
      const img = document.querySelectorAll(".img-slide");
      for(x = 0; x < img.length; x++){
        img[x].style.display = "none";
      }
      indexValue++;
      if(indexValue > img.length){indexValue = 1}
      img[indexValue -1].style.display = "block";
    }
    slideShow();
  </script>
