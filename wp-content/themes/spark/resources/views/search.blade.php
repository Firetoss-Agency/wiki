@extends('layouts.app')

@section('content')

    <div class="uk-flex">

        @include('components.sidebar')


        <div id="content" class="uk-width-expand uk-flex uk-flex-wrap">

            <div class="main">

               <div class="search-header uk-padding">
                   {!! get_search_form() !!}
               </div>

               <div class="uk-grid-medium  uk-padding" uk-grid uk-height-match>
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

            @include('components.pagination')

        </div>
    </div>
@endsection
