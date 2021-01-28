@props(['post'])

<article class="bg-white mb-4 shadow-lg rounded-lg overflow-hidden">
    @if ($post->image)
        <img class="w-full h-72 object-cover object-center" src=" {{ Storage::url($post->image->url)}} " alt="">
    @else
        <img class="w-full h-72 object-cover object-center" src="https://cdn.pixabay.com/photo/2020/07/23/01/09/field-5430070_1280.jpg" alt="">
    @endif
    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
             <a href="{{route('posts.show', $post)}}"> {{$post->name}} </a>
        </h1>
        <div class="text-gray-600 text-base">
            {!!$post->extract!!}
        </div>
    </div>
    <div class="px-6 pb-4 pt-4">
            @foreach ($post->tags as $tag)
                <a href=" {{route('posts.tag', $tag)}} " class="text-xs rounded-sm mb-4 bg-gray-600 text-white pt-1 pr-2 pl-2 pb-1 ml-1 mr-1"> {{$tag->name}} </a>
            @endforeach
    </div>
</article>
