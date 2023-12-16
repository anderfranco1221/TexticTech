<x-layouts.app title="Crear nuevos post">

    <h1>Crear nuevos post</h1>

    <form action="{{route('post.store',  $post)}}" method="POST">
        @csrf
        @include('posts.form-fields')

        <button type="submit">Enviar</button>
    </form>
    <a href="{{route('post.index')}}"> Regresar</a>

</x-layouts.app>