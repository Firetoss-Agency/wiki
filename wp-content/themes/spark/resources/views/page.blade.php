@extends('layouts.app')

@section('content')


    @loop

    <div class="uk-flex">

       @include('components.sidebar')


        <div id="content" class="uk-width-expand">

            @include('components.breadcrumbs')

            <div class="main uk-padding">

                <h1>{{ the_title() }}</h1>

                {!!  the_content() !!}
            </div>

        </div>

    </div>


    @endloop

@endsection


