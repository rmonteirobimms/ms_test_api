@props(['profile'])
<form action="/tasks">
    <button type="submit" style = "border:none; background: transparent;"  class="one_third_card no_decoration_link">
        @php 
            $url = '/images/user-default.png';
            // Retrieve media files from the 'avatar' collection
            $avatarMedia = $profile->getMedia('avatars')->sortByDesc('created_at')->first();
            if($avatarMedia){
                $original_url = $avatarMedia->getUrl();
                if(strpos($original_url, '8000') === false){
                    $url = str_replace('localhost', 'localhost:8000', $original_url);
                }
            }
        @endphp

        <input type="hidden" value="{{$profile->id}}" name="profile_id">
        <img class="image-with-border-radius img_in_card" src="{{ asset($url) }}">

        <div class = "location_card">
            <p class = "bold underline">{{ $profile->name }} </p>
        </div>

    </button>
</form>