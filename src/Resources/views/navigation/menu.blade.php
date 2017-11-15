
    @foreach($lists as $list)
@if($list->menu)
        @foreach($list->menu->menuParentItems as $item)
            <li class="treeview {{active_link_sub($item->url)}}">
                <a href="{{$item->url}}">
                    <i class="fa {{$item->icon}}"></i><span>{{$item->title}}</span>
                    @if($item->subs)  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>    @endif
                </a>
                @if($item->subs)
                    <ul class="treeview-menu">

                        @foreach($item->subs as $sub_menu)

                            <li class="{{active_link_with_class($sub_menu->url,'active')}}"><a href="{{$sub_menu->url}}">
                                    <i class="fa {{$sub_menu->icon}}"></i> {{$sub_menu->title}}

                                    @if($sub_menu->subs->count())  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>    @endif
                                </a>
                                @if($sub_menu->subs->count())
                                    <ul class="treeview-menu">
                                        @foreach($sub_menu->subs as $sub)
                                            <li class="{{active_link_with_class($sub->url,'active')}}"><a href="{{$sub->url}}">
                                                    <i class="fa {{$sub->icon}}"></i> {{$sub->title}}</a>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            @endforeach

        @endif

    @endforeach
