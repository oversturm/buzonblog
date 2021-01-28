<x-app-layout>
    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-400">{{$post->name}}</h1>

        <div class="text-lg text-gray-400 mb-4">
             {!!$post->extract!!}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Contenido principal --}}
            <div class="lg:col-span-2">
                <figure>
                    {{-- LLamamos a la clase Storage accedemos al metodo url dentro de ese metodo tenemos que pasarle lo que tenemos en base de datos primero accemos al objeto post luego le pedimos relacion que tenemos con image y que me retorne lo qe tenga almacena en el campo url--}}
                    @if ($post->image)
                        <img class="w-full h-80 object-cover object-center" src=" {{Storage::url($post->image->url)}} " alt="">
                    @else
                        <img class="w-full h-80 object-cover object-center" src="https://cdn.pixabay.com/photo/2020/07/23/01/09/field-5430070_1280.jpg" alt="">
                    @endif
                </figure>

                <div class="text-base text-gray-500 mt-4">
                    {!!$post->body!!}
                </div>

            </div>

            {{-- Contenido relaccionado --}}
            <aside>

                <h1 class="text-2xl font-bold mb-4">Más en {{ $post->category->name }} </h1>

                <ul>
                    @foreach ($similares as $similar)
                        <li class="mb-4">
                            <a class="flex" href="{{ route('posts.show', $similar) }}">

                            @if ($similar->image)
                                <img class="w-36 h-20 object-cover object-center" src=" {{ Storage::url($similar->image->url) }}" alt="">
                            @else
                                <img class="w-36 h-20 object-cover object-center" src="https://cdn.pixabay.com/photo/2020/07/23/01/09/field-5430070_1280.jpg" alt="">
                            @endif

                            <span class="ml-2 text-gray-400"> {{$similar->name}} </span>
                        </a>
                        </li>
                    @endforeach
                </ul>

            </aside>
        </div>

    </div>
</x-app-layout>
