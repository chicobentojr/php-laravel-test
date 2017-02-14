@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <a href="{{route('favorites')}}">Favorites</a> > Artists
                </div>

                <div class="panel-body">
                  @forelse ($artists as $artist)
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img width="100" height="100" class="media-object" src="{{ $artist->images()->first()->url or '' }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><b>{{ $artist->name }}</b></h4>
                          <h5>Created at: {{ $artist->created_at }}</h4>
                        </div>
                      </div>
                  @empty
                    <li>Empty list!</li>
                  @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
