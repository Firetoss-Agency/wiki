@extends('layouts.app')

@section('content')


    @loop

    <div class="uk-flex">

        <nav id="nav-sidebar" class="uk-width-medium uk-padding uk-padding-remove-horizontal uk-section-muted"
             uk-height-viewport="offset-top:true;offset:80;">
            <ul class="uk-nav-primary uk-nav-parent-icon" uk-nav="multiple: true">
                @php
                    wp_nav_menu([
                      'items_wrap'     => '%3$s',
                      'theme_location' => 'sidebar_navigation',
                      'walker'         => new UIkitMobileNavigation()
                    ]);
                @endphp
            </ul>
        </nav>


        <div id="content" class="uk-padding uk-width-expand">
            <ul class="uk-breadcrumb">
                {!! get_breadcrumb() !!}
            </ul>

            <h1>{{ the_title() }}</h1>

            {!!  the_content() !!}

        </div>

    </div>

    @endloop

@endsection

