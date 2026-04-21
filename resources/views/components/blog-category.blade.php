<div class="widget ltn__menu-widget ltn__menu-widget-2 ltn__menu-widget-2-color-2">
    <h4 class="ltn__widget-title ltn__widget-title-border">Categories</h4>
    <ul>
        @forelse($categories as $category)
        <li><a href="#">{{$category->name}} </a></li>
        @empty 
        <p>There have no categories</p>
        @endforelse
        <!-- <li><a href="#">Business <span>26</span></a></li>
        <li><a href="#">Consultant <span>30</span></a></li>
        <li><a href="#">Creative <span>71</span></a></li>
        <li><a href="#">UI/UX <span>56</span></a></li>
        <li><a href="#">Technology <span>60</span></a></li> -->
    </ul>
</div>