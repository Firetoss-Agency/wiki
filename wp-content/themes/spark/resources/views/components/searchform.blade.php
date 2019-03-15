{{-- TASK: UIkit --}}

<form role="search" method="get" class="search-form uk-search uk-search-navbar uk-width-1-1" action="{{ esc_url(home_url('/')) }}">
  {{--<label for="search">Search for:</label>--}}
  {{--<div class="input-group">--}}
    {{--<div class="input-group-button">--}}
      {{--<input type="submit" class="button" value="Search">--}}
    {{--</div>--}}
  {{--</div>--}}
    <input type="search" class="uk-search-input input-group-field search-field" value="{{ get_search_query() }}" id="search" placeholder="Search &hellip;" name="s" autofocus>
</form>
