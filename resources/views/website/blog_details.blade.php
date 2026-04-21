@extends('website.layouts.master')

@section('title', 'Blog Details - '. env('APP_NAME') )

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
<x-breadcrumb title="News Details" pageName="Latest News" bgImage="frontend/img/bg/9.jpg" />
<!-- BREADCRUMB AREA END -->

<!-- PAGE DETAILS AREA START (blog-details) -->
<div class="ltn__page-details-area ltn__blog-details-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__blog-details-wrap">
                    <div class="ltn__page-details-inner ltn__blog-details-inner">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-category">
                                    <a href="#">{{$news->category->name}}</a>
                                </li>
                            </ul>
                        </div>
                        <h2 class="ltn__blog-title">{{ $news->title }}</h2>
                        <img src="{{ route('imagecache', ['template'=>'cpmd','filename' => $news->fi()]) }}" alt="{{ $news->title }}">
                        <div class="ltn__blog-meta">
                            <ul>
                                <!-- <li class="ltn__blog-author">
                                    <a href="#"><img src="{{ asset('frontend/img/blog/author.jpg') }}" alt="#">By: Ethan</a>
                                </li> -->
                                <li class="ltn__blog-date">
                                    <i class="far fa-calendar-alt"></i>{{ $news->created_at->format('M d, Y') }}
                                </li>
                                <!-- <li>
                                    <a href="#"><i class="far fa-comments"></i>35 Comments</a>
                                </li> -->
                            </ul>
                        </div>
                        <p>{!! $news->description !!}</p>

                    </div>
                    <!-- blog-tags-social-media -->
                    <div class="ltn__blog-tags-social-media mt-80 row">
                        <div class="ltn__tagcloud-widget col-lg-8">
                            <h4>Releted Tags</h4>
                            <ul>
                                <li>
                                    <a href="#">Popular</a>
                                </li>
                                <li>
                                    <a href="#">Business</a>
                                </li>
                                <li>
                                    <a href="#">ux</a>
                                </li>
                            </ul>
                        </div>
                        <div class="ltn__social-media text-right text-end col-lg-4">
                            <h4>Social Share</h4>
                            <x-blog-media />
                        </div>
                    </div>
                    <hr>
                    <!-- prev-next-btn --> 
                    <div class="ltn__prev-next-btn row mb-50">
                        <div class="blog-prev col-lg-6">
                            <h6>Prev Post</h6>
                            <h3 class="ltn__blog-title"><a href="#">Tips On Minimalist</a></h3>
                        </div>
                        <div class="blog-prev blog-next text-right text-end col-lg-6">
                            <h6>Next Post</h6>
                            <h3 class="ltn__blog-title"><a href="#">Less Is More</a></h3>
                        </div>
                    </div>
                    <hr>
                    <!-- related-post -->
                    <div class="related-post-area mb-50">
                        <h4 class="title-2">Related Post</h4>
                        <div class="row">
                            @forelse($relatedPosts as $relate)
                            <div class="col-md-6">
                                <!-- Blog Item -->
                                <div class="ltn__blog-item ltn__blog-item-6">
                                    <div class="ltn__blog-img">
                                        <a href="{{ route('singleNews', ['id' => $relate->id]) }}"><img src="{{ route('imagecache', ['template'=>'cpmd','filename' => $relate->fi()]) }}"
                                                alt="{{ $relate->title }}"></a>
                                    </div>
                                    <div class="ltn__blog-brief">
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date ltn__secondary-color">
                                                    <i class="far fa-calendar-alt"></i>{{ $relate->created_at->format('M d, Y') }}
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="ltn__blog-title"><a href="{{ route('singleNews', ['id' => $relate->id]) }}">{{ $relate->title }}</a></h3>
                                        <p>Lorem ipsum dolor sit amet, conse ctet ur adipisicing elit, sed doing.</p>
                                    </div>
                                </div>
                            </div>
                            @empty 
                            <p>There have no related post</p>
                            @endforelse
                            {{--<div class="col-md-6">
                                <!-- Blog Item -->
                                <div class="ltn__blog-item ltn__blog-item-6">
                                    <div class="ltn__blog-img">
                                        <a href="blog-details.html"><img src="{{ asset('frontend/img/blog/blog-details/12.jpg') }}"
                                                alt="Image"></a>
                                    </div>
                                    <div class="ltn__blog-brief">
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date ltn__secondary-color">
                                                    <i class="far fa-calendar-alt"></i>June 22, 2020
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="ltn__blog-title"><a href="blog-details.html">A series of iOS 7
                                                inspire
                                                vector icons sense.</a></h3>
                                        <p>Lorem ipsum dolor sit amet, conse ctet ur adipisicing elit, sed doing.</p>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                    <!-- comment-area -->
                    <div class="ltn__comment-area mb-50">
                        <div class="ltn-author-introducing clearfix">
                            <div class="author-img">
                                <img src="{{ asset('frontend/img/blog/author.jpg') }}" alt="Author Image">
                            </div>
                            <div class="author-info">
                                <h6>Written by</h6>
                                <h1>Rosalina D. William</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation is enougn for today.</p>
                            </div>
                        </div>
                        <h4 class="title-2">03 Comments</h4>
                        <div class="ltn__comment-inner">
                            <ul>
                                <li>
                                    <div class="ltn__comment-item clearfix">
                                        <div class="ltn__commenter-img">
                                            <img src="{{ asset('frontend/img/testimonial/1.jpg') }}" alt="Image">
                                        </div>
                                        <div class="ltn__commenter-comment">
                                            <h6><a href="#">Adam Smit</a></h6>
                                            <span class="comment-date">20th May 2020</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus,
                                                omnis fugit corporis iste magnam ratione.</p>
                                            <a href="#" class="ltn__comment-reply-btn"><i
                                                    class="icon-reply-1"></i>Reply</a>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="ltn__comment-item clearfix">
                                                <div class="ltn__commenter-img">
                                                    <img src="{{ asset('frontend/img/testimonial/3.jpg') }}" alt="Image">
                                                </div>
                                                <div class="ltn__commenter-comment">
                                                    <h6><a href="#">Adam Smit</a></h6>
                                                    <span class="comment-date">21th May 2020</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                        Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                    <a href="#" class="ltn__comment-reply-btn"><i
                                                            class="icon-reply-1"></i>Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="ltn__comment-item clearfix">
                                        <div class="ltn__commenter-img">
                                            <img src="{{ asset('frontend/img/testimonial/4.jpg') }}" alt="Image">
                                        </div>
                                        <div class="ltn__commenter-comment">
                                            <h6><a href="#">Adam Smit</a></h6>
                                            <span class="comment-date">25th May 2020</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus,
                                                omnis fugit corporis iste magnam ratione.</p>
                                            <a href="#" class="ltn__comment-reply-btn"><i
                                                    class="icon-reply-1"></i>Reply</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <!-- comment-reply -->
                    <div class="ltn__comment-reply-area ltn__form-box mb-10">
                        <h4 class="title-2">Post Comment</h4>
                        <form action="#">
                            <div class="input-item input-item-textarea ltn__custom-icon">
                                <textarea placeholder="Type your comments...."></textarea>
                            </div>
                            <div class="input-item input-item-name ltn__custom-icon">
                                <input type="text" placeholder="Type your name....">
                            </div>
                            <div class="input-item input-item-email ltn__custom-icon">
                                <input type="email" placeholder="Type your email....">
                            </div>
                            <div class="input-item input-item-website ltn__custom-icon">
                                <input type="text" name="website" placeholder="Type your website....">
                            </div>
                            <label class="mb-0 input-info-save"><input type="checkbox" name="agree"> Save my name,
                                email, and website in this browser for the next time I comment.</label>
                            <div class="btn-wrapper">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit"><i
                                        class="far fa-comments"></i> Post Comment</button>
                            </div>
                        </form>
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
                    <x-blog-media />

                    <!-- Tagcloud Widget -->
                    <x-blog-tag /> 

                    <!-- Banner Widget -->
                    <x-blog-banner />

                </aside>
            </div>
        </div>
    </div>
</div>
<!-- PAGE DETAILS AREA END -->

<!-- FEATURE AREA START ( Feature - 3) -->
<x-footer-feature />
<!-- FEATURE AREA END -->
@endsection