@extends('layouts.app')

@section('content')

    <div class="uk-section">
        <div class="uk-container">

            {!! get_search_form() !!}

            <hr>

            <div class="uk-grid-medium" uk-grid uk-height-match>

                @loop
                <div class="uk-width-1-3">
                    <a href="{{ the_permalink() }}">
                        <div class="uk-card uk-card-primary uk-card-body uk-card-hover">

                            <h2 class="uk-card-title">{{ the_title() }}</h2>

                            {{--{{ the_excerpt() }}--}}

                        </div>
                    </a>
                </div>

                @endloop

            </div>
        </div>
    </div>

    {!! UIkitPagination() !!}
@endsection
