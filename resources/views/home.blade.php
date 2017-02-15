@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Home</div>
              <div class="panel-body">
                <p>Search any <b>Track</b>, <b>Artist</b> and <b>Album</b> from Spotify Api</p>
                  <form class="form-horizontal" role="form" action="{{ route('results') }}">
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
                          <input id="query" type="text" name="query" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Search</button>
                          </span>
                        </div>
                      </div>
                  </form>
              </div>
          </div>
            </div>
        </div>
    </div>
</div>
@endsection
