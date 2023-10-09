@props(['category', 'id', 'text'])

<div class="end_buttons tag">
    <i class="fa-solid fa-pen"></i>
    <a href="/{{$category}}/{{$id}}/edit" class=" no_underline">{{$text}}</a>
</div>