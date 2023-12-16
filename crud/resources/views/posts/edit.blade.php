<x-layouts.app :title="$post->titulo">
    <h1>Editar Post</h1>

    <form action="{{route('post.update', $post)}}" method="POST">
        @csrf @method('PATCH')
        @include('posts.form-fields')

        
        <button type="submit">Enviar</button>
    </form>
    <a href="{{route('post.index')}}"> Regresar</a>

</x-layouts.app>


