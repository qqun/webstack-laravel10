        <div class="sidebar-menu toggle-others fixed">
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="{{ route('home.index') }}" class="logo-expanded">
                            <img src="{{ $system['logo'] }}" width="100%" alt="" />
                        </a>
                        <a href="index.html" class="logo-collapsed">
                            <img src="{{ asset('/assets/images/logo-collapsed@2x.png') }}" width="40" alt="" />
                        </a>
                    </div>
                    <div class="mobile-menu-toggle visible-xs">
                        <a href="#" data-toggle="user-info-menu">
                            <i class="linecons-cog"></i>
                        </a>
                        <a href="#" data-toggle="mobile-menu">
                            <i class="fa-bars"></i>
                        </a>
                    </div>
                </header>
                <ul id="main-menu" class="main-menu">
                    @foreach($category as $cat)
                    <li>
                        @if($cat->children_count == 0 && $cat->parent_id == 0)
                        <a href="#{{$cat->title}}" class="smooth">
                            <i class="fa fa-fw {{ $cat->icon }}"></i>
                            <span class="title">{{$cat->title}}</span>
                        </a>
                        @elseif($cat->children_count != 0 && $cat->parent_id == 0)
                        <a>
                            <i class="fa fa-fw {{ $cat->icon }}"></i>
                            <span class="title">{{$cat->title}}</span>
                        </a>
                        <ul>
                            @foreach($cat->children as $child)
                            <li>
                                <a href="#{{ $child->title }}" class="smooth">
                                    <span class="title">{{ $child->title }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach



                    <li>
                        <a href="{{ route('home.about') }}" class="">
                            <i class="linecons-heart"></i>
                            <span class="tooltip-blue">关于我们</span>
                            <span class="label label-Primary pull-right hidden-collapsed">♥︎</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>