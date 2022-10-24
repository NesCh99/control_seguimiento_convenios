<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">


    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/css/swiper.css">  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    @yield('css')

    <title>CONTROL Y SEGUIMIENTO CONVENIOS </title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
 

    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/swiper.css')}}">  
    <link rel="stylesheet" href="{{url('//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css')}}">
    @yield('css')

    <title>CONTROL Y SEGUIMIENTO CONVENIOS </title>
    <link rel="icon" type="image/x-icon" href="{{url('img/logoEspoch.svg')}}">
    <script src="/js/table2excel.js"></script> 

</head>

<body >
    <header class="header">
    @include('layouts.header.header')    
    </header>  

   <section class="section">
        <aside class="aside">
           @include('layouts.aside.aside')  
        </aside> 
            <main class="main">
            @yield('workArea')
            </main>
        <footer class="footer">
            <p class="footer__text">
                   Escuela Superior Politécnica de Chimborazo © 2022
                   
            </p>
        </footer>

     </section>
    <script src="{{url('js/app.js')}}"></script>
    <script src="{{url('js/icons.js')}}"></script>
    <script src="{{url('js/jquery-3.6.0.min.js')}}"></script> 
    <script src="{{url('js/jquery.dataTables.min.js')}}"></script> 
    <script src="{{url('js/convenios.js')}}"></script> 
    <script src="{{url('js/swiper.js')}}"></script> 
    <script src="{{url('js/swiperControl.js')}}"></script> 
    <script src="{{url('js/chart.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    @yield('overlay')
    @yield('js')
    
</body>

</html>
