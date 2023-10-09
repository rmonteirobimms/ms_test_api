@if(session()->has('msg'))
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{session('msg')}}
    </div>
@endif