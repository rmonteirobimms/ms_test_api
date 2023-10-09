@props(['category'])

<div class="search_and_add"
    @if(!Auth::check())
        style="justify-content: flex-end;"
    @endif
    >
    @auth
        <button class="add_button"><a class ="no_underline" style="color:white" href="/{{$category}}/create"><i class="fa-solid fa-plus"></i> Create new project!</a></button>
    @endauth
    <form class="title_with_searchbar">
        <label for="search_value" class="search_label m-0-1">Search:</label>
        <div class="search_bar m-0-1">
            <input name="search" type="text" class="no-border-input" id="search_value">
            <button type="submit" class="search_button"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>