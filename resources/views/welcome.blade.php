<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<link rel="shortcut icon" type="image/png" href="asset/img/logo.png" type="image/x-icon" />
        <!-- SITE TITLE -->
        <title> DOB ARCHIVE</title>
        <!-- Latest Bootstrap min CSS -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <!-- Google Font -->
        <link href="http://fonts.googleapis.com/css?family=Cousine:400,700|Montserrat:400,700" rel="stylesheet" type="text/css">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">

        <!--- owl carousel Css-->
        <link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.min.css">

        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

    </head>
	
    <body data-spy="scroll" data-offset="80">
	

		
        <!-- START NAVBAR -->
        <div class="navbar navbar-default navbar-fixed-top main-menu">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    
                    </button>
                    <div style="text-align: center"><img src="asset/img/doblogo.jpeg" height="70" width="100" ></div>
                    <div style="text-align: center"><a class="navbar-brand" href="/dashboard"> Direction de l'Orientation <br> et des Bourses</a></div>                    
                </div>
                <div class="navbar-collapse collapse">
                    
                    <nav>
                        <ul class="nav navbar-nav navbar-right">
                            @if (Route::has('login'))
                                @auth
                                <li><a href="{{ url('/dashboard') }}" class="page-scroll" style="color: #fff">Accueil</a></li>
                                @else
                                <li><a href="{{ route('login') }}" class="page-scroll">Se connecter</a></li>
            
                                    @if (Route::has('register'))
                                    <li style="display: none"> <a href="{{ route('register') }}" class="page-scroll">Créer un compte</a></li>
                                    @endif
                                @endauth
                            
                        @endif
                            
                        </ul>
                    </nav>
                </div>
            </div>
            <!--- END CONTAINER -->
        </div>
        <!-- END NAVBAR -->
		
        <!-- START SLIDER -->
        <section id="home">
			<div class="home-slider owl-carousel">
			      <!-- single slide -->	
				 <div data-background="assets/img/bg/1173533.jpg" class="full-screen bg-img">
					<div class="hero-content">
						 <div class="hero-content-inner">
                            
							 <p>Bienvenue</p>
							 <h2>Système archivage des post-orientations des élèves.</h2>
                             <a href="/dashboard" class="page-scroll btn-home-3">Plus d'informations</a>
						</div>
					</div>
				 </div>	
				 <!-- end single slide -->
			      <!-- single slide -->	
				 <div data-background="assets/img/bg/1173608.jpg" class="full-screen bg-img">
					<div class="hero-content">
						 <div class="hero-content-inner">
							 <p>Bienvenue</p>
							 <h2>Système d'archivage des affectations des élèves</h2>
                             <a href="/dashboard" class="page-scroll btn-home-3">Plus d'informations</a>
						</div>
					</div>
				 </div>	
				 <!-- end single slide -->
			      <!-- single slide -->	
				 <div data-background="assets/img/bg/office-2761159_1280.png" class="full-screen bg-img">
					<div class="hero-content">
						 <div class="hero-content-inner">
							 <p>Bienvenue</p>
							 <h2>Système d'archivage des fiches de décisions</h2>
							 <a href="/dashboard" class="page-scroll btn-home-3">Plus d'informations</a>
						</div>
					</div>
				 </div>	
				 <!-- end single slide -->
			</div>
        </section>
        <!-- END SLIDER -->
		

	
        <!-- Latest jQuery -->
        <script src="assets/js/jquery-1.12.4.min.js"></script>
        <!-- Latest compiled and minified Bootstrap -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/owlcarousel/js/owl.carousel.min.js"></script>
        <!-- scrolltopcontrol js -->

        <script src="assets/js/scripts.js"></script>
    </body>
</html>