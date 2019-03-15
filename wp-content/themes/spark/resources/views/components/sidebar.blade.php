<nav id="nav-sidebar" class="uk-width-medium@m uk-width-small uk-padding uk-padding-remove-horizontal uk-section-muted"
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
