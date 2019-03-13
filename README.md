![alt text](https://firetoss.com/wp-content/uploads/2015/02/we-are-firetoss-.png "Firetoss Development")
# Spark - WordPress Starter Theme #

## Installation ##
* Clone repo into new WordPress install, replacing the original `/wp-content` directory
* Run `npm install` in project root `/`
* Compile with `npm run watch`
* Append `:3000` to `SITE_NAME.test` for live browser refreshing via BrowserSync

## Blade ##

### Displaying Data ###

##### Inline PHP #####
```blade
<div class="content">
  <p>{{ the_field('my_content') }}</p>
</div>
```

##### Multi-line PHP #####
```blade
@php
  $the_one = [
    'name' => 'Neo',
    'mentor' => 'Morpheus',
    'loves' => 'Trinity'
  ];
@endphp
```

##### Displaying Unescaped Data #####
<sup>By default, Blade `{{ }}` statements are automatically sent through PHP's `htmlspecialchars` function to prevent XSS attacks. If you do not want your data to be escaped, you may use the following syntax:</sup>
```blade
<div class="my-form">
  {!! do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]') !!}
</div>
```

### Commonly Used Directives ###

##### If Statements #####
```blade
@if(count($records) === 1)
  I have one record!
@elseif(count($records) > 1)
  I have multiple records!
@else
  I don't have any records!
@endif
```

##### Loops #####
```blade
@for($i = 0; $i < 10; $i++)
  The current value is {{ $i }}
@endfor

@foreach($users as $user)
  <p>This is user's ID is: {{ $user->id }}</p>
@endforeach

@while(true)
  <p>I'm looping forever.</p>
@endwhile
```

##### Including Partials #####
<sup>Note that we use dot notation instead of `/` for directory structures, as well as not needing to append `.blade.php` to the file name.</sup>
```blade
@include('partials.page-header')
```

##### Passing Data with an Include #####
<sup>archive-services.blade.php</sup>
```blade
@include('partials.page-header', ['current_id' => $page_id])
```
<sup>page-header.blade.php</sup>
```blade
<div>
  <h1>{{ the_title() }}</h1>
  <p>{{ the_field('FIELD_NAME', $current_id) }}</p>
</div>
```

See [Components](https://laravel.com/docs/5.7/blade#components-and-slots) for even more powerful includes.

##### Comments #####
```blade
{{-- This is a single line comment and will not be present in the rendered HTML --}}
```

```blade
{{-- 
  This is a multi-line comment and will 
  not be present in the rendered HTML 
--}}
```

&nbsp;

---

*For all native Blade directives and functionality, see the official docs [here](https://laravel.com/docs/5.7/blade).*

---

&nbsp;

### Custom Blade Directives ###

##### WordPress Loop #####
```blade
@loop
  <p>{{ the_title() }}</p>
  <div>{{ the_content() }}</div>
  <a href="{{ the_permalink() }}">Read More</a>
@endloop
```

##### WordPress WP_Query #####
```blade
@php
  $args = [
    'post_type' => 'services',
    'posts_per_page' => -1
  ];
@endphp
@query($args)
  <p>{{ the_title() }}</p>
  <div>{{ the_content() }}</div>
  <a href="{{ the_permalink() }}">Read More</a>
@endquery
```

##### WordPress Shortcodes #####
```blade
@shortcode('[shortcode_here]')
```

##### ACF Repeater #####
```blade
@repeater('FIELD_NAME')
  <p>{{ the_sub_field('SUB_FIELD_NAME') }}</p>
@endrepeater
```

##### ACF Relationship #####
```blade
@relationship('FIELD_NAME')
  <p>{{ the_title() }}</p>
  <div>{{ the_content() }}</div>
  <a href="{{ the_permalink() }}">Read More</a>
@endrelationship
```

##### ACF Flexible Content #####
```blade
@flexcontent('FIELD_NAME')
  @layout('LAYOUT_NAME')
    <p>{{ the_sub_field('SUB_FIELD_NAME') }}</p>
  @endlayout
@endflexcontent
```

##### Single Line Variable #####
```blade
@set($my_var = 'something')
```

## Directory Structure ##
```
├── README.md
├── package.json
├── webpack.mix.js
└── wp-content
    ├── index.php
    └── themes
        ├── index.php
        └── spark
            ├── app
            │   ├── controllers
            │   │   ├── App.php
            │   │   ├── PageHome.php
            │   │   └── api
            │   │       └── EndpointController.php
            │   ├── theme
            │   │   ├── acf-json
            │   │   │   ├── group_59497fa4d9548.json
            │   │   │   ├── group_59a59b2c46cd4.json
            │   │   │   ├── group_59a59b3a9a03b.json
            │   │   │   ├── group_59a59b512d690.json
            │   │   │   └── index.php
            │   │   ├── actions.php
            │   │   ├── filters.php
            │   │   ├── functions.php
            │   │   ├── post-types
            │   │   │   ├── post-types.php
            │   │   │   └── taxonomies.php
            │   │   └── setup.php
            │   └── util
            │       ├── directives.php
            │       ├── helpers.php
            │       ├── navigation.php
            │       └── pagination.php
            ├── composer.json
            ├── config
            │   ├── assets.php
            │   ├── theme.php
            │   └── view.php
            ├── public
            │   ├── css
            │   │   └── main.css
            │   ├── fonts
            │   ├── img
            │   ├── js
            │   │   └── main.js
            │   └── mix-manifest.json
            └── resources
                ├── functions.php
                ├── index.php
                ├── js
                │   ├── components
                │   │   └── google-maps-api-functions.js
                │   ├── main.js
                │   ├── routes
                │   │   ├── home.js
                │   │   └── site.js
                │   └── util
                │       ├── Router.js
                │       └── camelCase.js
                ├── screenshot.png
                ├── scss
                │   ├── components
                │   │   ├── _buttons.scss
                │   │   ├── _forms.scss
                │   │   ├── _type.scss
                │   │   └── _wp-classes.scss
                │   ├── global
                │   │   ├── _footer.scss
                │   │   ├── _nav.scss
                │   │   ├── _site.scss
                │   │   └── _util.scss
                │   ├── imports
                │   │   ├── _components.scss
                │   │   ├── _global.scss
                │   │   ├── _pages.scss
                │   │   └── _uikit.scss
                │   ├── main.scss
                │   ├── pages
                │   │   └── _home.scss
                │   └── uikit
                │       ├── _breakpoints.scss
                │       ├── _globals.scss
                │       └── _variables.scss
                ├── style.css
                └── views
                    ├── 404.blade.php
                    ├── components
                    │   ├── comments.blade.php
                    │   ├── entry-meta.blade.php
                    │   └── searchform.blade.php
                    ├── global
                    │   ├── footer.blade.php
                    │   └── nav.blade.php
                    ├── index.blade.php
                    ├── layouts
                    │   └── app.blade.php
                    ├── page-home.blade.php
                    ├── page.blade.php
                    ├── search.blade.php
                    └── single.blade.php
```
