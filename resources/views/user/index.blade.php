@extends('layouts.app')
@section('content')

<section class="all">
    <section class="advertisement">
        <div class="overplay">
            <h1 class="title-ad">Quick<img src="{{ asset('assets/table.svg') }}" class="inline-img" alt="">able</h1>
            <h2 class="sub-ad">Reserve Your Seat Anywhere.</h2>
            <h5 class="types">Restaurants , Coffee shops, Barber shops or Hair salons</h5>
        </div>
        <div class="slider" id="slider">
            
        </div>
    </section>
    <section class="feed" style="width: 100%">
        <section class="my-city" id="mycity">
            <div class="nearby">
                <h1>Nearby</h1>
            </div>
            @if (count($businesses) == 0)
                <div class="nearby-option">
                    <div class="no-events-nearby">
                        <h1><i class="bi bi-emoji-frown-fill"></i> No Businesses Yet</h1>
                        <p>Please check later for new businesses</p>
                    </div>
                </div>
            @endif
            @foreach ($businesses as $business)
            <div class="business-card" style="background-image: url('{{ $business->background_image }}');cursor:pointer" onclick="window.location.href = '/getBusiness/{{$business->businessId}}'">
                <div class="business-card-overlay">

                </div>
                <div class="business-card-top">
                    <div class="business-card-logo" style="background-image: url('{{ $business->pp }}')">
                        
                    </div>
                    <div class="business-card-texts">
                        <h1 class="business-card-title">{{ $business->name }}</h1>
                        <p class="business-card-description">{{ $business->description }}</p>
                    </div>
                </div>
                <div class="business-card-bottom">
                    <div class="texts">
                        <p class="business-card-description">{{ $business->firstname }} {{ $business->lastname }}</p>
                        <p class="business-card-description">{{ $business->business_type }}</p>
                    </div>
                    <div class="texts">
                        <p class="business-card-description">{{ $business->address }}</p>
                        <p class="business-card-description">{{ $business->base_price }}$ / seat</p>
                    </div>
                    <div class="texts">
                        <p class="business-card-description">{{ $business->email }}</p>
                        <p class="business-card-description">{{ $business->phone }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
        <section class="posts">
            @foreach ( $posts as $post)
            <div class="post" data-aos="fade-up">
                <div class="post-header">
                    <div class="post-profile">
                        <div class="post-profile-image" style="background-image: url('{{ $post->owner_pp }}');background-position:center;background-size:cover;">
                        </div>
                        <div class="post-profile-texts">
                            <span class="post-profile-name">{{ @$post->name }}</span>
                            <span class="post-profile-description">{{ \Carbon\Carbon::parse($post->created_at)->format('l jS F Y h:i A') }}</span>
                        </div>
                    </div>
                    <div class="post-buttons">
                        <a href="/getBusiness/{{ $post->businessId }}" style="text-decoration: none"><button class="post-btns-btn" > Profile <i class="bi bi-person-check-fill"></i></button></a>
                        <button class="post-btns-btn" onclick="showMore(this.nextElementSibling)">More <i class="bi bi-three-dots-vertical button-icons"></i></button>
                        <div class="more-dropdown">
                            <div class="more-option" onclick="window.location.href = '/getPost/{{ $post->post_id }}'">
                                <i class="bi bi-bookmark" style="font-size: 15px;"></i>
                                <span>More Info</span>
                            </div>
                            <div class="more-option" onclick="this.parentNode.parentNode.parentNode.parentNode.style.animationName = 'hideEvent'">
                                <i class="bi bi-eye-slash" style="font-size: 15px;"></i>
                                <span>Hide</span>
                            </div>
                            <div class="more-option"  onclick="window.location.href = '/getBusiness/{{ $post->businessId }}'">
                                <i class="bi bi-exclamation-triangle-fill" style="font-size: 15px;"></i>
                                <span>Report</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-body">
                    @if ($post->image !== null)
                        <div class="post-image" style="background-image: url('../{{ $post->image }}')"></div>
                    @endif
                    <div class="post-side">
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <p class="cateogory-event">{{ $post->business_type }}</p>
                        <p class="post-description">
                            {!! $post->post_description !!}
                            @if (strlen($post->post_description) > 200)
                                <div class="post-side-overlay">
                                    <p class="read-more" onclick="readMore(this)">Read More...</p>
                                </div>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="post-footer">
                    <div class="post-likes" onclick="likeWithAjax({{ $post->post_id }},this)">
                        @if ($post->liked)
                            <i class="bi bi-heart-fill like-btn" style="color: red"></i>
                            <span>{{ $post->likes }}</span>
                        @else
                            <i class="bi bi-heart like-btn"></i>
                            <span>{{ $post->likes }}</span>
                        @endif 
                    </div>
                </div>
            </div>
            @endforeach
            {{ $posts->links() }}
            @if (count($posts) == 0)
                <div class="post">
                    <div class="no-events">
                        <h1><i class="bi bi-emoji-frown-fill"></i> No Events Yet</h1>
                        <p>Start adding events to your profile</p>
                    </div>
                </div>  
            @endif
        </section>
    </section>
</section>
@endsection