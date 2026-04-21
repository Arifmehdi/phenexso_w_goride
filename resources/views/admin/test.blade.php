

<li class="nav-item {{ session('lsbm') == 'galleries' ? ' menu-open ' : '' }}">
    <a href="#" class="nav-link {{ session('lsbm') == 'galleries' ? ' active ' : '' }}">
        <i class="nav-icon fas fas fa-bell"></i>
        <p>
            Galleries
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('galleries.index') }}"
                class="nav-link {{ session('lsbsm') == 'all_gallery' ? ' active ' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Galleries</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('galleries.create') }}"
                class="nav-link {{ session('lsbsm') == 'create_gallery' ? ' active ' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Gallery</p>
            </a>
        </li>

    </ul>
</li>










<li class="nav-item {{ session('lsbm') == 'contact'? ' menu-open ' : ''}}">
    <a href="#" class="nav-link {{ session('lsbm') == 'contact'? ' active ' : ''}}">
        <i class="nav-icon fas fa-pager"></i>
        <p>
            Contact
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('all-contacts') }}" class="nav-link {{ session('lsbsm') == 'allContact'? ' active ' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Contacts</p>
            </a>
        </li>

    </ul>
</li>