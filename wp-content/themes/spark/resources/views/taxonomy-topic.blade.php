@extends('layouts.app')

@section('content')

    <div class="uk-flex">

        @include('components.sidebar')

        <div id="content" class="uk-width-expand uk-flex uk-flex-wrap">

            <div class="main" >

                @include('components.breadcrumbs')

                <div class="uk-padding">

                    <h1>{{ the_archive_title() }}</h1>

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

            @include('components.pagination')

        </div>
    </div>

@endsection

