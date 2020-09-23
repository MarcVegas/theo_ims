<nav class="ui top fixed secondary teal inverted menu">
    <div class="left menu">
        <a href="#" class="sidebar-menu-toggler item" data-target="#sidebar">
        <i class="sidebar icon"></i>
        </a>
        <a href="#" class="header item">
        THEO IMS
        </a>
    </div>

    <div class="right menu">
        <div class="item">
            <div class="ui dropdown icon teal button">
                <i class="bell icon"></i>
                <div class="menu">
                    <div class="header">
                    My Notifications
                    </div>
                    <div class="item">
                        <div class="ui red empty circular label"></div>
                        Several items are out of stock
                    </div>
                    <div class="item">
                        <div class="ui blue empty circular label"></div>
                        Ordered items will arrive today
                    </div>
                </div>
            </div>
        </div>
        <div class="ui dropdown item">
            <div class="text">
                <img class="ui avatar image" src="/storage/images/{{Auth::user()->avatar}}" id="sideAvatar">
                {{ Auth::user()->name }}
            </div>
            <div class="menu">
                <a href="#" class="item"><i class="info circle icon"></i> Profile</a>
                <a class="item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="sign-out icon"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>