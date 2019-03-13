@extends('layouts.app')

@section('content')


    @loop
    <div class="uk-section uk-section-muted uk-section-xsmall">
        <div class="uk-container">
            <ul class="uk-breadcrumb">
                {!! get_breadcrumb() !!}
            </ul>
        </div>
    </div>

        <div class="uk-container">
            <div class="uk-flex">

                <div id="content" class="uk-padding uk-padding-remove-horizontal">
                    <h1>{{ the_title() }}</h1>

                    {!!  the_content() !!}

                </div>

            </div>
        </div>

    @endloop

@endsection


