@extends('adminlte::page')

@section('title', 'Buzón Test Post')

@section('content_header')
    <h1>Editar nuevo Posts</h1>
@stop

@section('content')
        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{session('info')}}</strong>
            </div>
        @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($post,['route'=>['admin.posts.update', $post], 'autocomplete'=>'off', 'files'=>true, 'method'=>'put']) !!}

            @include('admin.posts.partials.form')

            {!! Form::submit('Actualizar post', ['class'=>'btn btn-primary btn-sm']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop


@section('css')
{{-- codigo css Imagenes --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }
        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@stop


@section('js')
{{-- codigo Plugin Slug --}}
    <script src=" {{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}} "></script>
{{-- codigo CKEDITOR --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
            });
    </script>
    {{-- codigo CKEDITOR para extracto y el body --}}
    <script>
        ClassicEditor
            .create( document.querySelector( '#extract' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
      {{-- Codigo para cambiar la imagen y previsualizar la que subimos --}}
    <script>
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>

@endsection
