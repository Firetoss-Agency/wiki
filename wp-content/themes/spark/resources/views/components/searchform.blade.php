{{-- TASK: UIkit --}}
<form role="search" method="get" class="search-form" action="{{ esc_url(home_url('/')) }}">
  <label for="search">Search for:</label>
  <div class="input-group">
    <input type="search" class="input-group-field search-field" value="{{ get_search_query() }}" id="search" placeholder="Search &hellip;" name="s">
    <div class="input-group-button">
      <input type="submit" class="button" value="Search">
    </div>
  </div>
</form>
