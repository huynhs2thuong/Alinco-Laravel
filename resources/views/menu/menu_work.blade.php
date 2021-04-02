
<div class="menu-{{ ($form !== '') ? $form : 'null' }} custom-container">
    <nav class="navbar navbar-expand-lg justify-content-end align-items-end" id="nav">
        <a class="navbar-brand" href="@lang('page.url')">
            <img class="img-fluid" src="assets/images/alinco/main/logo-dark.png" alt="logo-alinco" />
        </a>
        <button id="hamburger-menu-modal" class="hamburger hamburger-dark hamburger--slider d-block d-lg-none" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav">
            @foreach($menu as $title)
                <li class="nav-item {{ ($title->id == 3) ? 'nav-item_group' : '' }} {{ ($check == $title->id) ? 'active' : '' }}">
                    @if($title->id == 3)
                        <a class="nav-link" href="{{ $title->canonical }}" target="_blank">{{$title->title}}</a>
                    @else
                        <a class="nav-link" href="{{ action('SiteController@' . $title->alias_en  ) }}">{{$title->title}}</a>
                    @endif
                </li>
            @endforeach
                <li class="nav-item dropdown">
                @if($current_locale == 'vi')
                <a class="nav-link nav-link-en" href="/en">EN</a> 
                @else
                <a class="nav-link nav-link-vi" href="/vi">VN</a> 
                @endif               
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-12 social z-index-1 text-right justify-content-end pt-2">
        <ul class="social__menu">
        @foreach($icon as $icons)
            <li class="social__menu__item">
                <a class="" href="{{$icons->excerpt}}" target="_blank"><i class="{{$icons->description}}"></i></a>
            </li>
        @endforeach
            <!-- <li class="social__menu__item">
                <a class="" href="https://www.facebook.com/alinco.com.vn/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li class="social__menu__item">
                <a class="" href="https://www.youtube.com/channel/UCcHxR4_FU5fPE2JIJ2o61rQ" target="_blank"><i class="fab fa-youtube"></i></a>
            </li>
            <li class="social__menu__item">
                <a class="" href="https://www.instagram.com/alinco.ltd/" target="_blank"><i class="fab fa-instagram"></i></a>
            </li> -->
        </ul>
    </div>
</div>