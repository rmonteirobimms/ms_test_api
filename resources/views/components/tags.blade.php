@props(['all_tags', 'category'])

@if(trim($all_tags) != "")
    @php
        $tags =  explode(",", $all_tags);
    @endphp

    @if(count($tags))
        <div class="tags_row">
            @foreach ($tags as $tag)
                @php
                    $tag = trim($tag);
                    $category = trim($category);
                @endphp

                @if ($tag != "")
                    @if ($category != "")
                        <a href='/{{$category}}?tag={{$tag}}' class="tag no_underline">{{$tag}}</a>
                    @else
                        <p class="tag">{{$tag}}</p>
                    @endif
                @endif
            @endforeach
        </div>
    @endif
@endif