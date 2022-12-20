<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Customized CSS -->
    <link rel="stylesheet" href="{{asset('css/styles/main.css')}}">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&family=Oswald:wght@400;600&display=swap" rel="stylesheet">

    <!-- Slick css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Livewire -->
    @livewireStyles

    <title>VO inc.</title>
</head>
@php $locale = session()->get('locale'); @endphp

<body>
    <div id="app">

        <!-- Navigation -->
        <div class="vo-menu">
            <div class="container">
                <nav class="navbar navbar-dark navbar-expand-lg">
                    <div class="container-fluid no-padding">
                        <a class="navbar-brand" href="{{route('accueil')}}">
                            <img src="{{asset('assets/svg/logo-white.svg')}}" alt="VO logo" width="30" height="24">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo02">
                            <ul class="navbar-nav vo-navbar me-auto mb-2 mb-lg-0">
                                <li class="nav-item nav__vo__left__item">
                                    <a class="nav-link" href="{{route('voiture.index')}}">@lang('navigation.nav_catalogue')</a>
                                </li>
                                <li class="nav-item nav__vo__left__item">
                                    <a class="nav-link" href="{{route('politiques')}}">@lang('navigation.nav_politique_vente')</a>
                                </li>
                                <li class="nav-item nav__vo__left__item">
                                    <a class="nav-link" href="{{route('apropos')}}">@lang('navigation.nav_a_propos')</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav vo-navbar me-auto mb-2 mb-lg-0">
                                <div class='d-flex langues'>
                                    @if($locale=='en')
                                    <li class="nav-item nav__vo__right__item">
                                        <a class="nav-link" href="{{route('lang', 'fr')}}">FR</a>
                                    </li>
                                    @else
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('lang', 'en')}}">EN</a>
                                    </li>
                                    @endif

                                </div>
                                <div class="d-flex align-items-center">
                                    <iconpanier></iconpanier>({{ \Gloudemans\Shoppingcart\Facades\Cart::content()->count() }})
                                </div>
                                @if(Auth::check())
                                <li class="nav-item nav__vo__right__item d-flex align-items-center nav__connexion mx-2 my-avant-768">
                                    <a class="nav-link icon__connexion" href="{{route('commande.index')}}">
                                        <div class="d-flex align-items-center">{{ auth()->user()->nomUsager[0] }}</div>
                                    </a>
                                </li>
                                @if(Auth::user()->privilege_id != 4)
                                <li class="nav-item nav__vo__right__item d-flex align-items-center nav__connexion">
                                    <a class="nav-link" href="{{route('voiture.liste')}}">
                                        <div class="d-flex align-items-center"><i class="fa-solid fa-gear"></i></div>
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item nav__vo__right__item d-flex align-items-center nav__connexion">
                                    <a class="nav-link" href="{{route('deconnexion')}}"><i class="fa-solid fa-sign-out"></i></a>
                                </li>
                                @else
                                <li class="nav-item nav__vo__right__item d-flex align-items-center nav__connexion mx-2 my-avant-768">
                                    <a class="nav-link icon__connexion" href="{{route('connexion')}}"><i class="fa-solid fa-user"></i></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- fin de la navigation -->

        @yield('content')

        <!-- Footer -->
        <footer>
            <div class="footer__principal">
                <div class="container">
                    <div class="footer__principal__flex">
                        <div class="footer__logos">
                            <a href="{{route('accueil')}}" class='footer__brand-logo'>
                                <img src="{{asset('assets/svg/logo-white.svg')}}" alt="VO logo" class="footer__brand-logo-img">
                            </a>
                            <div class="footer__social">
                                <i class="fa-brands fa-twitter icon__social"></i>
                                <i class="fa-brands fa-facebook-f icon__social"></i>
                                <i class="fa-brands fa-instagram icon__social"></i>
                            </div>
                        </div>
                        <div class="footer__menu">
                            <div class='footer__menu__liens'>
                                <div class="footer__menu__lien">
                                    <a href="" class="footer__titre">@lang('footer.mon_compte')</a>
                                </div>
                                <div class="footer__menu__lien pt-3">
                                    <a href="{{route('contactez-nous')}}" class="footer__titre">@lang('formContact.contactez_nous')</a>
                                    <div class="footer__contact-info">
                                        <p class="pt-2">info@vo.ca</p>
                                        <div class="adresse pt-2">
                                            <p>3800 R. Sherbrooke E,</p>
                                            <p>Montréal, QC</p>
                                            <p>H1X 2A2</p>
                                        </div>
                                        <p class="pt-2">514 254 7131</p>
                                    </div>
                                </div>
                            </div>
                            <div class="footer__infolettre">
                                <div class="footer__langues">
                                    @if($locale=='en')
                                    <a href="{{route('lang', 'fr')}}" class="footer__titre {{$locale=='fr' ? 'font-weight-bold' : 'font-color-grey'}}">FR</a>
                                    @else
                                    <a href="{{route('lang', 'en')}}" class="footer__titre {{$locale=='en' ? 'font-weight-bold' : 'font-color-grey'}}">EN</a>
                                    @endif
                                </div>
                                <p class="footer__titre footer__infolettre__titre">@lang('footer.infolettre')</p>
                                <p class="footer__infolettre__body">@lang('footer.infolettre_text')</p>
                                <div class="footer__infolettre__form">
                                    <input class='footer__infolettre__input' type="email" placeholder="@lang('auth.email')">
                                    <button class='footer__infolettre__btn'><i class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__politiques font-color-grey">
                <div class="container">
                    <ul>
                        <div class='footer__politiques__liens'>
                            <li><a href="">@lang('footer.termes_condition')</a></li>
                            @if(Auth::check())
                            <li><a href="{{route('deconnexion')}}">@lang('footer.deconnexion')</a></li>
                            @else
                            <li><a href="{{route('connexion')}}">@lang('footer.connexion')</a></li>
                            @endif
                            <li><a href="">@lang('footer.vie_prive')</a></li>
                        </div>
                        <div>
                            <li>&copy; Copyright 2022 | @lang('footer.droit')</li>
                        </div>
                    </ul>
                </div>
            </div>
        </footer>

    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Slick Slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/slick.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- LivewireScript -->
    @livewireScripts

    <!-- VueJs script -->
    <!-- @yield('scripts') -->
</body>

</html>
