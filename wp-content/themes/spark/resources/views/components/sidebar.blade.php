
<a class="uk-navbar-toggle uk-hidden{{ $breakpoint }}" uk-toggle uk-navbar-toggle-icon href="#offcanvas-nav"></a>

{{--@if(has_nav_menu('primary_navigation'))--}}

    <nav id="offcanvas-nav" uk-offcanvas="flip: true; overlay: true;">
        <div class="uk-offcanvas-bar">

              <button class="uk-offcanvas-close" type="button" uk-close></button>

              <ul class="uk-nav-primary uk-nav-parent-icon" uk-nav="multiple: true">
                    @php
                        wp_nav_menu([
                          'items_wrap'     => '%3$s',
                          'theme_location' => 'sidebar_navigation',
                          'walker'         => new UIkitMobileNavigation()
                        ]);
                    @endphp
              </ul>

        </div>
    </nav>

{{--@endif--}}
