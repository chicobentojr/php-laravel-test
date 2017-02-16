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
                    @forelse ($tracks as $track)
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img width="100" height="100" class="media-object" src="{{ $track->album()->first()->images()->first()->url or '' }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><b>{{ $track->name }}</b></h4>
                          <h5>{{ $track->artists()->first()->name }}</h5>
                          <h6>{{ $track->album()->first()->name }}</h6>
                        </div>
                      </div>
                    @empty
                      <li> Favorites no found! </li>
                    @endforelse
                    {{ $tracks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
