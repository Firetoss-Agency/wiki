@php
    $breakpoint = '@m';
    $logo = '/wp-content/uploads/2019/03/Firetoss-Logo-e1552489577974.png';
@endphp

<header id="site-header">
    {{--<div class="uk-container">--}}
    <nav class="uk-navbar-container uk-navbar-transparent uk-navbar uk-padding uk-padding-small uk-padding-remove-vertical" uk-navbar="offset: 0; delay-hide: 500;">
        <div class="uk-navbar-left">
            <div class="uk-navbar-item">
                <a class="uk-logo" href="{{ home_url() }}">
                    <img src="{{ $logo }}" alt="Logo">
                </a>
            </div>
        </div>
        <div class="uk-navbar-right">
            <div class="nav-overlay uk-flex">
            @if(has_nav_menu('primary_navigation'))
                <ul class="uk-navbar-nav uk-visible{{ $breakpoint }}">
                    @php
                        wp_nav_menu([
                          'items_wrap'     => '%3$s',
                          'theme_location' => 'primary_navigation',
                          'walker'         => new UIkitNavigation()
                        ]);
                    @endphp
                </ul>
                <a class="uk-navbar-toggle uk-hidden{{ $breakpoint }}" uk-toggle uk-navbar-toggle-icon
                   href="#offcanvas-nav"></a>

            @endif

                <a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .nav-overlay; animation: uk-animation-fade"
                   href="#"></a>
            </div>


                <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>

                    <div class="uk-navbar-item uk-width-expand">
                        {!! get_search_form() !!}
                    </div>

                    <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade"
                       href="#"></a>

                </div>
        </div>


    </nav>
    {{--</div>--}}
</header>

@if(has_nav_menu('primary_navigation'))
    <nav id="offcanvas-nav" uk-offcanvas="flip: true; overlay: true;">
        <div class="uk-offcanvas-bar">

            <button class="uk-offcanvas-close" type="button" uk-close></button>

            <ul class="uk-nav-primary uk-nav-parent-icon" uk-nav="multiple: true">
                @php
                    wp_nav_menu([
                      'items_wrap'     => '%3$s',
                      'theme_location' => 'primary_navigation',
                      'walker'         => new UIkitMobileNavigation()
                    ]);
                @endphp
            </ul>

        </div>
    </nav>
@endif
