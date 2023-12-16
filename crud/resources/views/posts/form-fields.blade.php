<label>
    Titulo
    <input name="titulo" type="text" value="{{old('titulo', $post->titulo)}}">
    @error('titulo')
        <br> 
        <small style="color: red">{{$message}}</small>
    @enderror
</label><br>
<label>
    Descripcion
    <textarea name="descripcion">{{old('descripcion', $post->descripcion)}}</textarea>
    @error('descripcion')
        <br> 
        <small style="color: red">{{$message}}</small>
    @enderror
</label><br>