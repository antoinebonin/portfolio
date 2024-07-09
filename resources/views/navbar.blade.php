<nav>
    <a class="profil" href="/">A.<span>BONIN</span></a>
    @foreach($navbar as $menu)
        @if(count($menu->children) > 0)
            <div class="dropdown">
                <a class="dropbtn" href="{{$menu->page->fullUrl}}">
                    <x-heroicon-o-chevron-down/>{{$menu->title}}
                </a>
                <div class="dropdown-content">
                    @foreach($menu->children as $submenu)
                        <a href="{{$submenu->page->fullUrl}}">{{$submenu->title}}</a>
                    @endforeach
                </div>
            </div>
        @else
            <a href="{{$menu->page->fullUrl}}">{{$menu->title}}</a>
        @endif
    @endforeach
</nav>
