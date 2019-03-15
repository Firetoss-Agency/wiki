@extends('layouts.app')

@section('content')

    <div class="uk-flex">

        @include('components.sidebar')

        <div id="content" class="uk-width-expand uk-flex uk-flex-wrap">

            <div class="main uk-width-1-1">

                @include('components.breadcrumbs')

                <div class="uk-padding">

                    <h1>{{ the_archive_title() }}</h1>

                    @include('components.topic-loop')

                    <hr>

                    @include('components.wiki-loop')

                </div>

            </div>

            @include('components.pagination')

        </div>
    </div>

@endsection

