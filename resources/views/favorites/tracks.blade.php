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
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            {{-- <img width="100" height="100" class="media-object" src="{{ $track->artists()->first()->images()->first()->url }}"> --}}
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><b>{{ $track->name }}</b></h4>
                          {{-- <h5>{{ $item['album']['name']}}</h4> --}}
                          {{-- <h6>{{ $track->artists()->first()->name }}</h4> --}}
                        </div>
                      </div>
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
