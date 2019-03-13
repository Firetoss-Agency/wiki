@extends('layouts.app')

@section('content')
  @loop

  @endloop

  {!! UIkitPagination() !!}
@endsection
