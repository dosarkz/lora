
    {{--@foreach($lists as $list)--}}
        {{--<li class="treeview {{active_link_sub($list->getUrl())}}">--}}
            {{--<a href="{{$list->getUrl()}}">--}}
                {{--<i class="fa {{$list->getIcon()}}"></i><span>{{$list->getTitle()}}</span>--}}
                {{--@if($list->getSubMenu())  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>    @endif--}}
            {{--</a>--}}

            {{--@if($list->getSubMenu())--}}
                {{--<ul class="treeview-menu">--}}
                    {{--@foreach($list->getSubMenu() as $sub_menu)--}}

                        {{--<li class="{{active_link_with_class($sub_menu->getUrl(),'active')}}"><a href="{{$sub_menu->getUrl()}}"><i class="fa {{$sub_menu->getIcon()}}"></i> {{$sub_menu->getTitle()}}--}}
                                {{--@if($sub_menu->getSubMenu())  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>    @endif--}}
                            {{--</a>--}}
                            {{--@if($sub_menu->getSubMenu())--}}

                                {{--<ul class="treeview-menu">--}}
                                    {{--@foreach($sub_menu->getSubMenu() as $sub)--}}
                                        {{--<li class="{{active_link_with_class($sub->getUrl(),'active')}}"><a href="{{$sub->getUrl()}}"><i class="fa {{$sub->getIcon()}}"></i> {{$sub->getTitle()}}</a>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--@endif--}}

                        {{--</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--@endif--}}
        {{--</li>--}}
    {{--@endforeach--}}
