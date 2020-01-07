@foreach($lists as $list)
    @foreach($list->menuParentItems as $item)
        <li class="nav-item @if($item->subs->count() > 0)has-treeview @endif">
            <a href="{{$item->url}}" class="nav-link {{active_link_sub($item->url)}}">
                <i class="nav-icon fas {{$item->icon}}"></i>
                <p>{{$item->title}} @if($item->subs->count() > 0)<i class="right fas fa-angle-left">@endif</i></p>
            </a>

            @if($item->subs->count())
                <ul class="nav nav-treeview">
                    @foreach($item->subs as $sub_menu)
                        <li class="nav-item @if($sub_menu->subs->count()) has-treeview @endif">
                            <a href="{{$sub_menu->url}}"
                               class="nav-link {{active_link_with_class($sub_menu->url,'active')}}">
                                <i class="fas {{$sub_menu->icon}} nav-icon"></i>
                                <p>{{$sub_menu->title}} </p>
                            </a>

                            @if($sub_menu->subs->count())
                                <ul class="nav nav-treeview">
                                    @foreach($sub_menu->subs as $sub)
                                        <li class="nav-item">
                                            <a href="{{$sub->url}}"
                                               class="nav-link {{active_link_with_class($sub->url,'active')}}">
                                                <i class="fas {{$sub->icon}} nav-icon"></i>
                                                <p>{{$sub->title}}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif

        </li>
    @endforeach
@endforeach
