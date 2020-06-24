<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Sistema de Compras e Vendas Online')
    </title>

    <!-- Scripts -->
    
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}" />
    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="{{ asset('js/script.js') }}"></script>
</head>
<style>
    body {
        font-family: arial;
    }
</style>
<body id="" style="margin-top:3em; background: #eee; ">
    
    <nav class="navbar fixed-top navbar-expand-lg 
    shadow-sm navbar-dark" style="background: #066094;"> 
        <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ BASE_URL }}/images/logo.png" width="20px" 
            alt="{{ config('app.name', 'Laravel') }}" style="display:inline">
        </a> 
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"> 
                    <a class="nav-link" href="{{ BASE_URL }}" 
                    data-abc="true"><i class="fa fa-home"></i> </span></a> 
                </li>
                <li class="nav-item active"> 
                    <a class="nav-link" href="{{ BASE_URL }}/cart" 
                    data-abc="true"><i class="fa fa-shopping-cart"></i> 
                    <span class="badge total-cart badge-light text-danger">
                        {{ count($_SESSION['itens']) }}
                    </span>
                    </a> 
                </li>
                
             </ul>

             <ul class="navbar-nav">

                @guest
                <li class="nav-item">
                    <a class="nav-link active btn bg-success mr-md-2" href="{{ BASE_URL }}/login">{{ __('Entrar') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link active btn bg-primary" href="{{ BASE_URL }}/register">{{ __('Regista-te') }}</a>
                    </li>
                @endif
                @else
                <li class="nav-item active"> 
                    <a class="nav-link" href="{{ BASE_URL }}/profile" 
                    data-abc="true">Perfil </span></a> 
                </li>
                @if(Auth::check() && Auth::user()->role == 1) 
                <li class="nav-item active"> 
                    <a class="nav-link" href="{{ BASE_URL }}/admin" 
                    data-abc="true">Administração </span></a> 
                </li>
                @endif
                @endguest

             </ul>


        </div>
        </div>
    </nav>

    <div id="">

        <div class="py-1">
            @yield('content')
        </div>

        <div id="form" style="display: none">
            
            <div id="searchBox" class="searchBox bg-white p-3" style="width: 95%; max-width: 400px">
                <button onclick="closeSearch()" class="btn 
                text-white btn-secondary form-control mb-3">Fechar A Pesquisa</button>
                <form action="/" method="GET">
                    <div class="form-group">
                      <select name="cat" id="cat" class="form-control">
                          <option value="">Selecione uma categoria</option>
                          <?php 
                          $categories = App\models\Category::all();
                          ?>
                          @foreach($categories as $cat) 
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" 
                      id="q" name="q"
                      placeholder="O que procuras?">
                    </div>
                    <button type="submit" class="btn form-control btn-primary"> <i class="fa fa-search"></i> </button>
                </form>
            </div>
        </div>

        <div id="search">
        </div>

        <div id="success" class="text-white"></div>

    </div>
    @include('includes.footer')
</body>
</html>
