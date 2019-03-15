@extends('layouts.app')

@section('content')

    <div class="uk-flex">

        @include('components.sidebar')

        <div id="content" class="uk-width-expand">

            @include('components.breadcrumbs')

            <div class="main uk-padding">

                <h1>{{ the_archive_title() }}</h1>

                <div class="uk-grid-medium" uk-grid uk-height-match>

                    {{--@set($parent_terms = get_terms( 'topic' , array( 'parent' => get_queried_object()->term_id, 'orderby' => 'slug', 'hide_empty' => false ) ))--}}


{{--                    @foreach ( $parent_terms as $pterm )--}}

{{--                        <a href="{{ get_term_link( $term ) }}">{{ $term->name }}</a>--}}

                    {{--@endforeach--}}



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
    </div>

@endsection

