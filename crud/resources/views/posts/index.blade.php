<x-layouts.app title="Blog">

    <h1>Blog</h1>

    <a href="{{route('post.create')}}"> Crear post</a>

    @foreach($posts as $post)
        <div style="display: flex">
            <a href="{{route('post.show', $post)}}"><h5>{{$post->titulo}}</h5></a>
            &nbsp;
            <a href="{{route('post.edit', $post)}}">Edit</a>&nbsp;
            <form action="{{route('post.destroy', $post)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach

</x-layouts.app>