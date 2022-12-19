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

    <title>VO inc.</title>
</head>
@php $locale = session()->get('locale'); @endphp
<body>
    <div class="row">
        <!-- Navigation  ASIDE - côté admin -->

        <div class="col-12 col-lg-2">
            <div class="vo-admin-menu no-padding">
                <div>
                    <nav class="navbar navbar-expand-lg pl-3">
                        <div class="d-flex flex-column">
                            <a class="navbar-brand py-3 d-flex mr-auto" href="#">
                                <img src="{{asset('assets/svg/logo-white.svg')}}" alt="VO logo" width="30" height="24">
                            </a>
                            <ul class="navbar-nav vo-navbar me-auto mb-2 mb-lg-0">
                            <div class='d-flex langues'>
                                <li class="nav-item nav__vo__right__item">
                                    <a class="pl-0 nav-link {{$locale=='fr' ? 'font-weight-bold' : 'font-color-grey'}} " href="{{route('lang', 'fr')}}">FR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{$locale=='en' ? 'font-weight-bold' : 'font-color-grey'}}" href="{{route('lang', 'en')}}">EN</a>
                                </li>
                                <li class="nav-item nav__vo__right__item d-flex align-items-center nav__connexion">
                                <a class="nav-link" href="{{route('deconnexion')}}"><i class="fa-solid fa-sign-out"></i></a>
                            </li>
                            </div>
                            </ul>
                            <div class="d-flex flex-column text-white py-2">
                                <div class="titre__admin">
                                    <span class="fs-3">@lang('admin.nav')</span>
                                    <div class="ligne my-3 w-100"></div>
                                </div>
                                <ul class="nav flex__custom">
                                    <li class="nav-item">
                                        <a href="{{route('accueil')}}" class="text-white fs-5"><i class="fa-solid fa-house mr-1"></i>
                                            @lang('admin.accueil')</a>
                                    </li>
                                    <li class="py-3 nav-item">
                                        <a href="{{route('voiture.liste')}}" class="text-white fs-5"><i class="fa-regular fa-clipboard mr-1"></i>
                                            @lang('admin.inventaire')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('commande.liste')}}" class="text-white fs-6"><i class="fa-solid fa-receipt mr-1"></i>
                                            @lang('admin.commandes')</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

        </div>
        <!-- fin de la navigation admin -->
            @yield('content')
    </div>


    <!-- Footer -->

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Slick Slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/slick.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
