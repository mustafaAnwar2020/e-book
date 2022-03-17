<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="/">
            <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
            @lang('site.dashboard')
        </a>
    </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('category.index')}}">
                <i class="c-sidebar-nav-icon fa fa-list-alt" aria-hidden="true"></i>
                @lang('site.categories')
            </a>
        </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('author.index')}}">
            <i class="c-sidebar-nav-icon fa-solid fa-feather"></i>

            @lang('site.authors')
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('book.index')}}">
            <i class="c-sidebar-nav-icon fa-solid fa-book"></i>
            @lang('site.books')
        </a>
    </li>

    <li class="c-sidebar-nav-divider"></li>
    <li class="c-sidebar-nav-item mt-auto"></li>
    <li class="c-sidebar-nav-item"><a href="#" class="c-sidebar-nav-link"
            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt"></i>
            Logout</a>
    </li>
</ul>
