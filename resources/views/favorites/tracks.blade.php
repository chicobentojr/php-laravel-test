@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <a href="{{route('favorites')}}">Favorites</a> > Tracks
                </div>

                <div class="panel-body">
                  <ul>
                    @forelse ($tracks as $track)
                      <li>{{ $track->name }}</li>
                    @empty
                      <li> Favorite no found! </li>
                    @endforelse
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection