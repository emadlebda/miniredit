<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            Newest Posts
        </div>

        <div class="card-body">
            @foreach ($newestPosts as $post)
                <a href="{{route('communities.posts.show',[$post->community,$post])}}">{{$post->title}}</a>
                <small class="mt-1">{{$post->created_at->diffForHumans()}}</small>
                <hr/>
            @endforeach
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Newest Communities
        </div>

        <div class="card-body">
            @foreach ($newestCommunities as $community)
                <a href="{{route('communities.show',$community)}}">{{$community->name}}</a>
                ({{$community->posts_count}} posts)
                <small class="mt-1">{{$community->created_at->diffForHumans()}}</small>
                <hr/>
            @endforeach
        </div>
    </div>
</div>
