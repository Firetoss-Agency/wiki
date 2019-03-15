<div class="uk-grid-small" uk-grid uk-height-match>

    @set($children = get_terms( 'topic', array(
    'child_of'=> get_queried_object()->term_id,
    'parent'=>  get_queried_object_id(),

    )))

    @foreach($children as $child)

        <div class="uk-width-1-6">
            <a href="{{ get_term_link($child) }}" class="uk-link-heading">
                <div class="uk-card uk-card-secondary uk-card-body uk-card-hover uk-card-small">

                    <h6>{{ $child->name }}</h6>

                    {{--{{ the_excerpt() }}--}}

                </div>
            </a>
        </div>

    @endforeach
</div>
