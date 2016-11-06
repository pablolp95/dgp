@extends('main')

@section('content')
    <div class="container">
        <div class="row padded">
            <div class="col s12">
                <div class="row">
                    <div class="col s12">
                        <h1 class="grey-text text-darken-4">@yield('elem_title')</h1>
                        <h5 class="grey-text text-darken-1">@yield('elem_description')</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <nav>
                    <div class="nav-wrapper">
                        @yield('search')
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <table class="responsive-table hoverable-table">
                    @yield('table')
                </table>
            </div>
        </div>
        <div class="col s12">
            <div class="container-fluid">
                @yield('form')
            </div>
        </div>
        <div class="row">
            <div class="col s12 center-align">
                @yield('pagination')
            </div>
        </div>
    </div>
@endsection