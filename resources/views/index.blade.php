<!DOCTYPE html>
<html lang="zh">

@include('layouts.header')

<body class="page-body">
    <!-- skin-white -->
    <div class="page-container">
@include('layouts.sidebar')
        <div class="main-content">
            
            <nav class="navbar user-info-navbar" role="navigation">
                <!-- User Info, Notifications and Menu Bar -->
                <!-- Left links for user info navbar -->
                <ul class="user-info-menu left-links list-inline list-unstyled">
                    <li class="hidden-sm hidden-xs">
                        <a href="#" data-toggle="sidebar">
                            <i class="fa-bars"></i>
                        </a>
                    </li>
                    <li class="dropdown hover-line language-switcher">
                        <a href="{{ route('home.index') }}" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('/assets/images/flags/flag-cn.png') }}" alt="flag-cn" /> Chinese
                        </a>
                        <ul class="dropdown-menu languages">
                           
                            <li class="active">
                                <a href="{{ route('home.index') }}">
                                    <img src="{{ asset('/assets/images/flags/flag-cn.png') }}" alt="flag-cn" /> Chinese
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="user-info-menu right-links list-inline list-unstyled">
                    <li class="hidden-sm hidden-xs">
                        <a href="https://github.com/WebStackPage/WebStackPage.github.io" target="_blank">
                            <i class="fa-github"></i>  GitHub
                        </a>
                    </li>
                </ul>
                <!-- <a href="https://github.com/WebStackPage/WebStackPage.github.io" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png') }}" alt="Fork me on GitHub"></a> -->

            </nav>

@foreach($category as $c)
@if(count($c->sites) != 0)
<h4 class="text-gray"><i class="linecons-tag" style="margin-right: 7px;" id="{{$c->title}}"></i>{{ $c->title }}</h4>

<div class="row">
    @foreach($c->sites as $s)
    <div class="col-sm-3">
        <div class="xe-widget xe-conversations box2 label-info" onclick="window.open('{{ $s->url }}', '_blank')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $s->url }}">
            <div class="xe-comment-entry">
                <a class="xe-user-img">
                    <img data-src="{{ asset($s->thumb) }}" class="lozad img-circle" width="40">
                </a>
                <div class="xe-comment">
                    <a href="#" class="xe-user-name overflowClip_1">
                        <strong>{{ $s->title }}</strong>
                    </a>
                    <p class="overflowClip_2">{{ $s->describe }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endforeach

            
           
            <br />
@include('layouts.footer')
        </div>
    </div>
    <!-- 锚点平滑移动 -->
    <script type="text/javascript">
    $(document).ready(function() {
         //img lazy loaded
         const observer = lozad();
         observer.observe();

        $(document).on('click', '.has-sub', function(){
            var _this = $(this)
            if(!$(this).hasClass('expanded')) {
               setTimeout(function(){
                    _this.find('ul').attr("style","")
               }, 300);
              
            } else {
                $('.has-sub ul').each(function(id,ele){
                    var _that = $(this)
                    if(_this.find('ul')[0] != ele) {
                        setTimeout(function(){
                            _that.attr("style","")
                        }, 300);
                    }
                })
            }
        })
        $('.user-info-menu .hidden-sm').click(function(){
            if($('.sidebar-menu').hasClass('collapsed')) {
                $('.has-sub.expanded > ul').attr("style","")
            } else {
                $('.has-sub.expanded > ul').show()
            }
        })
        $("#main-menu li ul li").click(function() {
            $(this).siblings('li').removeClass('active'); // 删除其他兄弟元素的样式
            $(this).addClass('active'); // 添加当前元素的样式
        });
        $("a.smooth").click(function(ev) {
            ev.preventDefault();

            public_vars.$mainMenu.add(public_vars.$sidebarProfile).toggleClass('mobile-is-visible');
            ps_destroy();
            $("html, body").animate({
                scrollTop: $($(this).attr("href")).offset().top - 30
            }, {
                duration: 500,
                easing: "swing"
            });
        });
        return false;
    });

    var href = "";
    var pos = 0;
    $("a.smooth").click(function(e) {
        $("#main-menu li").each(function() {
            $(this).removeClass("active");
        });
        $(this).parent("li").addClass("active");
        e.preventDefault();
        href = $(this).attr("href");
        pos = $(href).position().top - 30;
    });
    </script>
    <!-- Bottom Scripts -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('/assets/js/resizeable.js') }}"></script>
    <script src="{{ asset('/assets/js/joinable.js') }}"></script>
    <script src="{{ asset('/assets/js/xenon-api.js') }}"></script>
    <script src="{{ asset('/assets/js/xenon-toggles.js') }}"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="{{ asset('/assets/js/xenon-custom.js') }}"></script>
    <script src="{{ asset('/assets/js/lozad.js') }}"></script>
</body>

</html>

