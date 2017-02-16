@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <a href="{{route('favorites')}}">Favorites</a> > Albums
                </div>

                <div class="panel-body">
                    @forelse ($albums as $album)
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img width="100" height="100" class="media-object" src="{{ $album->images->first()->url or '' }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><b>{{ $album->name }}</b></h4>
                          <h5>{{ $album->artists->first()->name }}</h5>
                          <h5>{{ ucfirst($album['album_type']) }}</h4>
                        </div>
                      </div>
                    @empty
                      <li>Empty list!</li>
                    @endforelse
                    {{ $albums->links() }}
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
