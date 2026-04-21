<div class="widget ltn__popular-post-widget">
    <h4 class="ltn__widget-title ltn__widget-title-border">Popular Feeds</h4>
    <ul>
        @forelse($popular_posts as $popular_post)
        <li>
            <div class="popular-post-widget-item clearfix">
                <div class="popular-post-widget-img">
                    <a href="{{ route('singleNews', ['id' => $popular_post->id]) }}"><img src="{{ route('imagecache', ['template'=>'cpmd','filename' => $popular_post->fi()]) }}" alt="#"></a>
                </div>
                <div class="popular-post-widget-brief">
                    <h6><a href="{{ route('singleNews', ['id' => $popular_post->id]) }}">{{ $popular_post->title }}</a></h6>
                    <div class="ltn__blog-meta">
                        <ul>
                            <li class="ltn__blog-date">
                                <a href="#"><i class="far fa-calendar-alt"></i>{{ $popular_post->created_at->format('M d , Y')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
        @empty 
        <p>Here no popular post</p>
        @endforelse
    </ul>
</div>
