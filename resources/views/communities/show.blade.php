@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $community->name }}

                        <div class="float-right">
                            <a href="{{ route('communities.posts.create',$community) }}" class="btn btn-primary">Add Post</a>

                        </div>
                    </div>

                    <div class="card-body">
                        TBD
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
