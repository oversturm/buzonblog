@extends('adminlte::page')

@section('title', 'Buzón Test')

@section('content_header')
    <h1>Crear Etiqueta</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.tags.store'] ) !!}
                {{-- formulario en partials incluido --}}
                @include('admin.tags.partials.form')

                {!! Form::submit('Crear etiqueta', ['class'=>'btn btn-primary btn-sm']) !!}

            {!! Form::close() !!}

            @error('color')
            <small class="text-danger">{{$message}}</small>
            @enderror

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    <script src=" {{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}} "></script>
    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
            });
    </script>
@endsection
