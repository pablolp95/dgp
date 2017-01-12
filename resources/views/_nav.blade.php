<?php
$menu_elems = [
        route("dashboard") => "Panel",
        route("logout") => "Cerrar Sesión"
]
?>
<div class="navbar-fixed">
    <nav class="indigo">
        <div class="nav-wrapper container">
            <a href="{{route('dashboard')}}" class="brand-logo">Museo Caja Granada</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                @foreach($menu_elems as $url => $elem)
                    <li><a href="{!! $url !!}" class="uppercase">{!! $elem !!}</a></li>
                @endforeach
            </ul>

            <ul id="nav-mobile" class="side-nav">
                @foreach($menu_elems as $url => $elem)
                    <li><a href="{!! $url !!}">{!! $elem !!}</a> </li>
                @endforeach
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>
</div>
