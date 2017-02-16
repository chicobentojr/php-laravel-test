@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Search</div>
              <div class="panel-body">
                <p>Search any <b>Track</b>, <b>Artist</b> or <b>Album</b> from Spotify Api</p>
                  <form class="form-horizontal" role="form" method="post" action="{{ route('search.post') }}">
                    {{ csrf_field() }}
                    <div class="col-lg-12">
                      <label for="type">Type:</label>
                      <select id="type" name="type" class="form-control">
                        <option value="artist">Artist</option>
                        <option value="track">Track</option>
                        <option value="album">Album</option>
                      </select>
                    </div>
                      <div class="col-lg-12">
                        <label for="query">Search:</label>
                        <div class="input-group">
                          <input id="query" type="text" value="{{ $query or '' }}" name="query" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Search</button>
                          </span>
                        </div>
                      </div>
                  </form>
              </div>
              @if (!empty($query))
                <div class="panel-heading">
                  Results for "{{ $query }}" at "{{ucfirst($type)}}"
                </div>
                <div class="panel-body">
                  @if ($type == 'track')
                    @forelse ($results as $item)
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img width="100" height="100" class="media-object" src="{{ $item['album']['images'][0]['url'] or '' }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><b>{{ $item['name']}}</b></h4>
                          <h5>{{ $item['album']['name']}}</h4>
                          <h6>{{ $item['artists'][0]['name']}}</h4>
                          <a href="{{ route('save.track',['id'=>$item['id']])}}">Save as favorite</a> |
                          <a href="{{ route('xml.download',['id'=>$item['id'],'type'=>$item['type']])}}">Download XML</a>
                        </div>
                      </div>
                    @empty
                      <li>No results found!</li>
                    @endforelse
                  @elseif ($type == 'artist')
                    @forelse ($results as $item)
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img width="100" height="100" class="media-object" src="{{ $item['images'][0]['url'] or '' }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><b>{{ $item['name']}}</b></h4>
                          <h5>Popularity: {{ $item['popularity'] }}</h4>
                          <a href="{{ route('save.artist',['id'=>$item['id']])}}">Save as favorite</a> |
                          <a href="{{ route('xml.download',['id'=>$item['id'],'type'=>$item['type']])}}">Download XML</a>
                        </div>
                      </div>
                    @empty
                      <li>No result found!</li>
                    @endforelse
                  @elseif ($type == 'album')
                    @forelse ($results as $item)
                      <div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img width="100" height="100" class="media-object" src="{{ $item['images'][0]['url'] }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><b>{{ $item['name']}}</b></h4>
                          <h5>{{ $item['artists'][0]['name']}}</h5>
                          <h5>{{ ucfirst($item['album_type']) }}</h4>
                          <a href="{{ route('save.album',['id'=>$item['id']])}}">Save as favorite</a> |
                          <a href="{{ route('xml.download',['id'=>$item['id'],'type'=>$item['type']])}}">Download XML</a>
                        </div>
                      </div>
                    @empty
                      <li>No results found!</li>
                    @endforelse
                  @else
                    <li>No results found!</li>
                  @endif
                </div>
              @endif
          </div>
            </div>
        </div>
    </div>
</div>
@endsection
