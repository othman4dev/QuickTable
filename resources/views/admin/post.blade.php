@extends('layouts.admin')
@section('content')
    <section class="all">
        <section class="feed grow">
            <section class="posts">
                <div class="user-info" style="position: relative;margin:15px;margin-right:0px;border-radius:5px">
                    <div class="user-pp" style="background-image: url('{{ $post->owner_pp}}');height: 150px;min-width:150px"></div>
                    <div class="user-texts">
                        <h1 class="user-name">{{ $post->name }} <i class="bi bi-patch-check-fill verified"></i></h1>
                        <p style="font-size: 11px">Owner : {{ $post->firstname }} {{ $post->lastname }}</p>
                        <p class="user-description">{{ $post->description }}</p>
                    </div>
                    <div class="user-status">
                        <div class="user-status-item">
                            <h1>Business Type</h1>
                            <span>{{ $post->business_type }}</span>
                        </div>
                        <div class="user-status-item">
                            <h1>Posts</h1>
                            <span>{{ $postCount }}</span>
                        </div>
                        <div class="user-status-item">
                            <h1>Reservations</h1>
                            <span>100</span>
                        </div>
                    </div>
                </div>
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
                        <div class="post-likes">
                            <i class="bi bi-heart like-btn"></i>
                            <span>{{ $post->likes }}</span>
                        </div>
                        <div class="post-likes" onclick="showNote(this)">
                            <i class="bi bi-question-circle question-btn" ></i>
                            <span>Send a note</span>
                        </div>
                        <div class="post-note">
                            <form class="note-form" method="post">
                                <input type="text" class="note-inp" placeholder="Send a note or a question ...">
                                <button class="note-btn"><i class="bi bi-send" style="font-size: 18px;"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
@endsection