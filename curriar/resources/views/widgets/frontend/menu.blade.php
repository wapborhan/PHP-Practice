@isset($menu)
    @php
        if(!function_exists('menu_style')){
            function menu_style($item)
            {
                if(count($item->child) > 0){
                    $style = '
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-has-children menu-parent-item menu-item-7">
                        <a href="'. $item->link .'">'.$item->label.'</a>
                        <i class="ml-1 fas fa-chevron-down" data-toggle="collapse" 
                            data-target="#menu-'.$item->id.'" aria-expanded="true" 
                            aria-controls="menu-'.$item->id.'" onclick="rotate_icon(this)"
                            style="cursor: pointer;"></i>
                        <ul id="menu-'.$item->id.'" class="collapse" aria-labelledby="widget_menu_hierarchy">';
                    foreach ($item->child as $child) {
                        $style .= menu_style($child);
                    }
                    $style .= '</ul>
                        </li>';
                    return $style;
                }else{
                    return '
                    <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-401">
                        <a href="'. $item->link .'">'.$item->label.'</a>
                    </li>';
                }
            }
        }
    @endphp
    <div id="nav_menu-{{$menu->id}}" class="content-only widget bdaia-widget widget_nav_menu">
        <div class="widget-box-title widget-box-title-s4">
            <h3>Menu</h3>
        </div>
        <div class="widget-inner">
            <div class="menu-navigation-menu-container">
                <ul id="menu-navigation-menu" class="menu">
                    @forelse ($menu->items as $item)
                        {!! menu_style($item) !!}
                    @empty
                        
                    @endforelse
                    
                    
                </ul>
            </div>
        </div>
    </div>
    <script>
        function rotate_icon(icon) {
            icon.classList.toggle("fa-rotate-180");
        }
    </script>
@endisset