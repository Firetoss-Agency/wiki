@extends('layouts.app')

@section('content')

  <div class="uk-section">
    <div class="uk-container">

      {!! get_search_form() !!}

      <hr>

      <div class="uk-grid-divider" uk-grid uk-height-match>

        @loop

        <div class="uk-width-1-3">

          {{ the_title() }}


          {{ the_excerpt() }}

        </div>

        @endloop

      </div>
    </div>
  </div>

  {!! UIkitPagination() !!}
@endsection


<li>SEO</li>
<li>PPC</li>
<li>Display Ads</li>
<li>Analytics</li>
<li>Email Automation</li>
