<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">

            <?php
            $navbar = Navbar::withBrand(config('app.name'), url('/admin/dashboard'))->inverse();
            if (Auth::check()) {
                $arrayLinks = [
                    [
                        'link' => route('admin.users.index'),
                        'title' => 'Usuários'
                    ],
                    [
                        'link' => route('admin.category.index'),
                        'title' => 'Categorias'
                    ],                    [
                        'link' => route('admin.series.index'),
                        'title' => 'Séries'
                    ],
                    [
                        'link' => route('admin.videos.index'),
                        'title' => 'Vídeos'
                    ],                    
                ];
//                $menus = Navigation::links($arrayLinks);


                $menu = Navigation::links([[
                        'Menu',
                        $arrayLinks
                    ]])->left();
                $logout = Navigation::links([[
                        Auth::user()->name,
                        [
                            [
                                'link' => route('admin.logout'),
                                'title' => 'Logout',
                                'linkAttributes' => [
                                    'onClick' => "event.preventDefault();document.getElementById(\"form-logout\").submit();"
                                ]
                            ]
                        ]
                    ]])->right();
                $navbar->withContent($menu)->withContent($logout);
            }
            ?>

            {!! $navbar !!}

            <?php
            $formLogout = FormBuilder::plain([
                        'id' => 'form-logout',
                        'route' => ['admin.logout'],
                        'method' => 'POST',
                        'style' => 'display:none',
                    ])
            ?>


            {!! form($formLogout) !!}            


            @if(Session::has('message'))
            <div class="container">
                {!! Alert::success(Session::get('message'))->close() !!}
            </div>
            @endif

            @if(Session::has('danger'))
            <div class="container">
                {!! Alert::danger(Session::get('danger'))->close() !!}
            </div>
            @endif            

            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
