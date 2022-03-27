<ul class="c-sidebar-nav">
    @can('book-list')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/">
                <i class="c-sidebar-nav-icon fas fa-fw fa-house"></i>
                @lang('site.dashboard')
            </a>
        </li>
    @endcan

    @can('category-list')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('category.index') }}">
                <i class="c-sidebar-nav-icon fa fa-list-alt" aria-hidden="true"></i>
                @lang('site.categories')
            </a>
        </li>
    @endcan

    @can('author-list')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('author.index') }}">
                <i class="c-sidebar-nav-icon fa-solid fa-feather"></i>

                @lang('site.authors')
            </a>
        </li>
    @endcan

    @can('book-edit')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('book.index') }}">
                <i class="c-sidebar-nav-icon fa-solid fa-book"></i>
                @lang('site.books')
            </a>
        </li>
    @endcan

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('order.index') }}">
            <i class="c-sidebar-nav-icon fa-solid fa-truck"></i>
            @lang('site.orders')
        </a>
    </li>

    @can('user-list')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
                <i class="c-sidebar-nav-icon fa-solid fa-user"></i>
                @lang('site.users')
            </a>
        </li>
    @endcan

    @can('role-list')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('role.index') }}">
                <i class="c-sidebar-nav-icon fa-solid fa-user"></i>
                @lang('site.roles')
            </a>
        </li>
    @endcan
    <li class="c-sidebar-nav-divider"></li>
    <li class="c-sidebar-nav-item mt-auto"></li>
    <li class="c-sidebar-nav-item"><a href="#" class="c-sidebar-nav-link"
            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt"></i>
            Logout</a>
    </li>
</ul>
