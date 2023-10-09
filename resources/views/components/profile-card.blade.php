@props(['profile'])

<a href = "/profile/{{$profile->id}}" class="one_third_card no_decoration_link">
    @php 
        $url = '/images/user-default.png';
        // Retrieve media files from the 'avatar' collection
        $avatarMedia = $profile->getMedia('avatars')->sortByDesc('created_at')->first();
        if($avatarMedia){
            $url = str_replace('localhost', 'localhost:8000', $avatarMedia->getUrl());
        }
    @endphp
    <img class="image-with-border-radius img_in_card" src="{{ asset($url) }}">
    <div class = "location_card">
        <p class = "bold underline">{{ $profile->name }} </p>
    </div>
</a>