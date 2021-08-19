<li class="nav-item">
    @if(count($item->child) > 0)
        <a class="nav-link collapsePagesSideMenu" data-toggle="collapse" href="#sideNav_{{$item->id}}">
            {{$item->label}} <i class="fas fa-chevron-down"></i>
        </a>
        <div id="sideNav_{{$item->id}}" class="collapse sideNav_{{$item->id}}">
            <ul class="navbar-nav mt-2">
                @foreach ($item->child as $child)
                    @include('frontend.inc.nav_links',['item' => $child])
                @endforeach
            </ul>
        </div>
    @else
        <a class="nav-link" href="{{$item->link}}">{{$item->label}}</a>
    @endif
</li>