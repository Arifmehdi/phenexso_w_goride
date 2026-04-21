@extends('website.layouts.master')

@section('title', 'News - '. env('APP_NAME') )

@section('meta')
<meta name="description"
    content="Contact North Bengal for inquiries, product details, or business queries. Get in touch via phone, email, or visit our office.">
<meta name="keywords" content="contact north bengal, contact us, north bengal inquiries, phone, email, office location">
<meta property="og:title" content="Contact Us - North Bengal">
<meta property="og:description" content="Reach North Bengal for product inquiries or business partnerships.">
<meta property="og:image" content="{{ asset('frontend/assets/img/northbengal/contact_banner.png') }}">
<meta property="og:type" content="website">
@endsection
@section('content')
<!-- BREADCRUMB AREA START -->
<x-breadcrumb title="News" pageName="News" bgImage="frontend/img/bg/9.jpg" />
<!-- BREADCRUMB AREA END -->

<!-- BLOG AREA START -->
<div class="ltn__blog-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__blog-list-wrap">
                    <!-- Blog Item -->
                    @forelse($news as $post)
                    <div class="ltn__blog-item ltn__blog-item-5">
                        <div class="ltn__blog-img">
                            <a href="{{ route('singleNews', ['id' => $post->id]) }}">
                                <img src="{{ route('imagecache', ['template'=>'cpmd','filename' => $post->fi()]) }}" alt="{{$post->title}}">
                            </a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-category">
                                        <a href="#">{{ $post->category->name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="{{ route('singleNews', ['id' => $post->id]) }}">{{ $post->title }}</a></h3>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <!-- <li>
                                        <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                    </li> -->
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>{{ $post->created_at->format('M d Y') }}
                                    </li>
                                </ul>
                            </div>
                            <p>{{ \Illuminate\Support\Str::limit($post->excerpt, 300, '...') }}</p>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-author">
                                            <a href="#"><img src="{{ asset('frontend/img/blog/author.jpg') }}"
                                                    alt="Author image">By: Ethan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="{{ route('singleNews', ['id' => $post->id]) }}"><i class="fas fa-arrow-right"></i>Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty 
                    <p>There no blog here </p>
                    @endforelse
                    <!-- Blog Item (Video) -->
                    {{--<div class="ltn__blog-item ltn__blog-item-5 ltn__blog-item-video">
                        <div class="ltn__video-img">
                            <img src="{{ asset('frontend/img/blog/32.jpg') }}" alt="video popup bg image">
                            <a class="ltn__video-icon-2 ltn__secondary-bg ltn__video-icon-2-border---"
                                href="https://www.youtube.com/embed/X7R-q9rsrtU?autoplay=1&amp;showinfo=0"
                                data-rel="lightcase:myCollection">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-category">
                                        <a href="#">Business</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">Adipisicing elit, sed do eiusmod
                                    tempor
                                    incididunt ut labore et dolore.</a></h3>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>June 22, 2020
                                    </li>
                                </ul>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint</p>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-author">
                                            <a href="#"><img src="{{ asset('frontend/img/blog/author.jpg') }}"
                                                    alt="#">By: Ethan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html"><i class="fas fa-arrow-right"></i>Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <!-- Blog Item (Gallery) -->
                    {{--<div class="ltn__blog-item ltn__blog-item-5 ltn__blog-item-gallery">
                        <div class="ltn__blog-gallery-active slick-arrow-1 slick-arrow-1-inner">
                            <div class="ltn__blog-gallery-item">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/33.jpg') }}"
                                        alt="Image"></a>
                            </div>
                            <div class="ltn__blog-gallery-item">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/34.jpg') }}"
                                        alt="Image"></a>
                            </div>
                            <div class="ltn__blog-gallery-item">
                                <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/31.jpg') }}"
                                        alt="Image"></a>
                            </div>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-category">
                                        <a href="#">Business</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">Magna aliqua. Ut enim ad minim venia
                                    m, quis nostrud exercitation ullamco</a></h3>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>June 22, 2020
                                    </li>
                                </ul>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint</p>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-author">
                                            <a href="#"><img src="{{ asset('frontend/img/blog/author.jpg') }}"
                                                    alt="#">By: Ethan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html"><i class="fas fa-arrow-right"></i>Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <!-- Blog Item (Audio) -->
                    {{--<div class="ltn__blog-item ltn__blog-item-5 ltn__blog-item-audio">
                        <div class="post-audio embed-responsive embed-responsive-16by9">
                            <iframe
                                src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/837045328&amp;color=%23ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></iframe>

                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-category">
                                        <a href="#">Business</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">Laboris nisi ut aliquip ex ea
                                    commodo
                                    consequat. Duis aute irure dolor.</a></h3>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>June 22, 2020
                                    </li>
                                </ul>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint</p>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-author">
                                            <a href="#"><img src="{{ asset('frontend/img/blog/author.jpg') }}"
                                                    alt="#">By: Ethan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html"><i class="fas fa-arrow-right"></i>Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <!-- Blog Item (No Image) -->
                    {{--<div class="ltn__blog-item ltn__blog-item-5 ltn__blog-item-no-image">
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-category">
                                        <a href="#">Business</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">In reprehenderit in voluptate velit
                                    esse
                                    cillum dolore eu fugiat nulla pariatur.</a></h3>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>June 22, 2020
                                    </li>
                                </ul>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint</p>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-author">
                                            <a href="#"><img src="{{ asset('frontend/img/blog/author.jpg') }}"
                                                    alt="#">By: Ethan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="blog-details.html"><i class="fas fa-arrow-right"></i>Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <!-- Blog Item (Background Image) -->
                    {{--<div class="ltn__blog-item ltn__blog-item-5 ltn__blog-item-bg-image bg-image bg-overlay-white-90"
                        data-bg="{{ asset('frontend/img/blog/2.jpg') }}">
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-category">
                                        <a href="#">Business</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="blog-details.html">Culpa qui officia deserunt mollit
                                    anim
                                    id est laborum. Sed ut perspiciatis</a></h3>
                            <div class="ltn__blog-meta mb-0">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>June 22, 2020
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>--}}
                    <!--  -->
                    <!-- Blog Item (Quote) -->
                    <div class="ltn__blog-item ltn__blog-item-5 ltn__blog-item-quote bg-image bg-overlay-theme-90"
                        data-bg="{{ asset('frontend/img/blog/3.jpg') }}">
                        <div class="ltn__blog-brief">
                            <blockquote>
                                <a href="blog-details.html">Excepteur sint occaecat cupida
                                    tat non proident, sunt in.</a>
                            </blockquote>
                            <div class="ltn__blog-meta mb-0">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                    </li>
                                    <li class="ltn__blog-date">
                                        <i class="far fa-calendar-alt"></i>June 22, 2020
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__pagination-area text-center">
                            <div class="ltn__pagination">
                                {{-- Laravel Pagination Links --}}
                                {{ $news->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar-area blog-sidebar ltn__right-sidebar">
                    <!-- Author Widget -->
                    <x-blog-author />

                    <!-- Search Widget -->
                    <x-blog-search />

                    <!-- Menu Widget (Category) -->
                    <x-blog-category />

                    <!-- Popular Post Widget -->
                    <x-blog-popular />

                    <!-- Social Media Widget -->
                     <div class="widget ltn__social-media-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Never Miss News</h4>
                        <div class="ltn__social-media-2">
                            <x-blog-media />
                        </div>
                    </div>

                    <!-- Tagcloud Widget -->
                    <x-blog-tag /> 

                    <!-- Banner Widget -->
                    <x-blog-banner />

                </aside>
            </div>
        </div>
    </div>
</div>
<!-- BLOG AREA END -->
@endsection