@extends('layouts.admin')
@section('content')

<section class="all">
    <section class="advertisement">
        <div class="overplay">
            <h1 class="title-ad"><img src="assets/LOGO.svg" style="height: 100px;margin-left:20px" class="inline-img" alt=""></h1>
            <h2 class="sub-ad">Find, Book, and Attend Events Effortlessly.</h2>
            <h5 class="types">Elevate Your Event Experience with Evento</h5>
        </div>
        <div class="slider" id="slider">
            
        </div>
    </section>
    <section class="feed">
        <section class="my-city">
            <div class="nearby">
                <h1>Nearby</h1>
            </div>
            @foreach ($posts as $post)
            <div class="nearby-option" onclick="window.location.href='/getEvent/{{ $post->event_id}}'">
                <div class="nearby-option-logo">
                    {{ $post->spots }}
                </div>
                <div class="nearby-option-texts">
                    <h3 class="nearby-option-title">{{ Illuminate\Support\Str::limit($post->title, 20) }}</h3>
                    <p class="nearby-option-description">{{ $post->category }}, {{ Illuminate\Support\Str::limit($post->location, 10) }}</p>
                </div>
                <div class="nearby-option-logo">
                    {{ floor($post->price) }}$
                </div>
                
            </div>
            @endforeach
            <div class="nearby-loading">
                <div class="loader"></div>
            </div>
        </section>
        <section class="posts">
            @foreach ( $posts as $post)
            <div class="post">
                <div class="post-header">
                    <div class="post-profile">
                        <div class="post-profile-image">
                        </div>
                        <div class="post-profile-texts">
                            <span class="post-profile-name">{{ @$post->firstname }} {{ @$post->lastname }}</span>
                            <span class="post-profile-description">{{ $post->location }}, {{ $post->created_at }}</span>
                        </div>
                    </div>
                    <div class="post-buttons">
                        
                    </div>
                </div>
                <div class="post-body">
                    <div class="post-image" style="background-image: url('../{{ $post->image }}')">
                        
                    </div>
                    <div class="post-side">
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <p class="cateogory-event">{{ $post->category }}</p>
                        <p class="post-description">
                            {!! $post->description !!}
                        </p>
                    </div>
                </div>
                <div class="post-footer">
                    <div class="post-likes">
                        <p class="post-likes-desc">
                            Price :
                        </p>
                        <span>
                            @if ($post->price == 0)
                                Free
                            @else
                                {{ $post->price }} $
                            @endif
                            </span>
                    </div>
                    <div class="post-likes">
                        <p class="post-likes-desc">
                            Empty Spots :
                        </p>
                        <span>{{ $post->spots }}</span>
                    </div>
                    <div class="post-likes">
                        <p class="post-likes-desc">
                            Total Spots :
                        </p>
                        <span>{{ $post->places }}</span>
                    </div>
                    <div class="post-likes">
                        <p class="post-likes-desc">
                            {{ number_format(100 - ($post->spots * 100 / $post->places), 2) }}% Full
                        </p>
                        <div class="slider-per">
                            <div class="per" style="width: {{ 100 - ( $post->spots * 100 / $post->places ) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
    </section>
</section>
@endsection