@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Upload</div>
              <div class="panel-body">
                <p>Upload any <b>Track</b>, <b>Artist</b> or <b>Album</b> in XML format from MySpotify</p>
                @if (session('error'))
                <div class="alert alert-danger">
                  <strong>{{ session('error') }}</strong>
                </div>
                @endif
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('xml.upload') }}">
                  {{ csrf_field() }}
                  <div class="col-lg-12">
                    <label for="query">File:</label>
                    <div class="input-group">
                      <input type="file" accept="text/xml" name="doc" class="form-control" required/>
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Upload</button>
                      </span>
                    </div>
                  </div>
                </form>
              </div>
          </div>
            </div>
        </div>
    </div>
@endsection
