@extends('layouts.app')
@section('content')

<section class="all">
    <section class="advertisement">
        <div class="overplay">
            <h1 class="title-ad">Quick<img src="assets/table.svg" class="inline-img" alt="">able</h1>
            <h2 class="sub-ad">Reserve Your Seat Anywhere.</h2>
            <h5 class="types">Restaurants , Coffee shops, Barber shops or Hair salons</h5>
        </div>
        <div class="slider" id="slider">
            
        </div>
    </section>
    <section class="feed" style="width: 100%">
        <section class="my-city">
            <div class="nearby">
                <h1>Nearby</h1>
            </div>
            @if (count($posts) == 0)
                <div class="nearby-option">
                    <div class="no-events-nearby">
                        <h1><i class="bi bi-emoji-frown-fill"></i> No Events Yet</h1>
                        <p>Start adding events to your profile</p>
                    </div>
                </div>
            @endif
            @foreach ($posts as $post)
            <div class="nearby-option" onclick="window.location.href='/getEvent/{{ $post->post_id}}'">
                <div class="nearby-option-logo" style="background-image: url('{{ $post->background_image }}');background-size:cover;background-position:center;">
                    
                </div>
                <div class="nearby-option-texts">
                    <h3 class="nearby-option-title">{{ Illuminate\Support\Str::limit($post->title, 20) }}</h3>
                    <p class="nearby-option-description"></p>
                </div>
                <div class="nearby-option-logo">
                    {{ floor($post->id) }}$
                </div>
                
            </div>
            @endforeach
        </section>
        <section class="posts">
            @foreach ( $posts as $post)
            <div class="post" data-aos="fade-up">
                <div class="post-header">
                    <div class="post-profile">
                        <div class="post-profile-image">
                        </div>
                        <div class="post-profile-texts">
                            <span class="post-profile-name">{{ @$post->name }}</span>
                            <span class="post-profile-description">{{ \Carbon\Carbon::parse($post->created_at)->format('l jS F Y h:i A') }}</span>
                        </div>
                    </div>
                    <div class="post-buttons">
                        @if (@$post->reserved !== null)
                            <button class="post-btns-btn" disabled> Reserved <i class="bi bi-check"></i></button>
                        @elseif ( @$post->reserved == null) 
                            <button class="post-btns-btn" onclick="reserveAjax( {{ $post->post_id }} , this)"> Reserve <i class="bi bi-person-check-fill"></i></button>
                        @endif
                        <button class="post-btns-btn" onclick="showMore(this.nextElementSibling)">More <i class="bi bi-three-dots-vertical button-icons"></i></button>
                        <div class="more-dropdown">
                            <div class="more-option" onclick="window.location.href = '/getEvent/{{ $post->post_id }}'">
                                <i class="bi bi-bookmark" style="font-size: 15px;"></i>
                                <span>More Info</span>
                            </div>
                            <div class="more-option" onclick="this.parentNode.parentNode.parentNode.parentNode.style.animationName = 'hideEvent'">
                                <i class="bi bi-eye-slash" style="font-size: 15px;"></i>
                                <span>Hide</span>
                            </div>
                            <div class="more-option">
                                <i class="bi bi-exclamation-triangle-fill" style="font-size: 15px;"></i>
                                <span>Report</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-body">
                    <div class="post-image" style="background-image: url('../{{ $post->image }}')">
                        
                    </div>
                    <div class="post-side">
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <p class="cateogory-event">{{ $post->business_type }}</p>
                        <p class="post-description">
                            {!! $post->description !!}
                            @if (strlen($post->description) > 200)
                                <div class="post-side-overlay">
                                    <p class="read-more" onclick="readMore(this)">Read More...</p>
                                </div>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="post-footer">
                    <div class="post-likes">
                        <i class="bi bi-heart like-btn"></i>
                        <span>100</span>
                    </div>
                    <div class="post-likes">
                        <i class="bi bi-chat chat-btn" onclick="showComment(this)"></i>
                        <span>12</span>
                    </div>
                    <div class="post-comment">
                        <form class="note-form" method="post">
                            <input type="text" class="note-inp" placeholder="Write a positive comment ...">
                            <button class="note-btn"><i class="bi bi-send" style="font-size: 18px;"></i></button>
                        </form>
                    </div>
                    <div class="post-likes">
                        <i class="bi bi-share share-btn"></i>
                        <span>5</span>
                    </div>
                    <div class="post-likes">
                        <i class="bi bi-question-circle question-btn" onclick="showNote(this)"></i>
                        <span>5</span>
                    </div>
                    <div class="post-note">
                        <form class="note-form" method="post">
                            <input type="text" class="note-inp" placeholder="Send a note or a question ...">
                            <button class="note-btn"><i class="bi bi-send" style="font-size: 18px;"></i></button>
                        </form>
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