<div id="loop-wrapper" class="uk-grid-small" uk-grid uk-height-match>

    @loop

    <div class="wiki-card uk-width-1-3"  uk-scrollspy="cls: uk-animation-slide-right;">
        <a href="{{ the_permalink() }}" class="uk-link-heading">
            <div class="uk-card uk-card-primary uk-card-body uk-card-hover">

                <h3 class="uk-card-title">{{ the_title() }}</h3>

                @set($terms = get_the_terms(get_the_ID(), 'topic'))
                @foreach($terms as $term)
                    <span class="uk-label">{{ $term->name }}</span>
                @endforeach
                {{--{!! the_excerpt() !!} --}}
            </div>
        </a>
    </div>

    @endloop
</div>
