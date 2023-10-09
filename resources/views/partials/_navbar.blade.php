<nav class="navbar">
    <a class="navbar_logo" href="/">
        <img src="https://bimms.net/wp-content/uploads/2018/05/cropped-bimms-logo-e1529003825645.png">
    </a>
    <div class="navbar_auth">
        @auth
            <div class="logged_in_navbar">
                <img src="{{url('/images/user-default.png')}}" class="user_navbar_picture"/>
                <div class="user_navbar_dropdown">
                    <div class="user_navbar_name">
                        <p>
                            {{auth()->user()->username}}
                        </p>
                        <i class="fa-sharp fa-solid fa-caret-down"></i>
                    </div>
                    <div class="user-dropdown-content">
                        <a href="/management"><i class="fa-solid fa-list-check"></i> Management</a>
                        <a href="/account"><i class="fa-solid fa-gear"></i> Settings</a>
                        <form id="logout" method="POST" action="/logout">
                            @csrf
                            <a href="javascript:{}" onclick="document.getElementById('logout').submit();"><i class="fa-solid fa-door-open"></i> Logout</a>
                        </form>
                      </div>
                </div>
            </div>
        @else
            <a class="navbar_reg no_decoration_link" href="/register">
                <i class="fa-solid fa-user-plus"></i>
                Register Now!
            </a>
            <a class="navbar_log" href="/login">
                Login
                <i class="fa-solid fa-right-to-bracket"></i>
            </a>
        @endauth
    </div>
</nav>