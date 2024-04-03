@extends('layouts.app')
@section('content')
    <section class="all">
        <section class="feed grow">
            <section class="posts">
                <div class="post">
                    <div class="post-header">
                        <div class="post-profile">
                            <div class="post-profile-image">
                            </div>
                            <div class="post-profile-texts">
                                <span class="post-profile-name">{{ @$event->firstname }} {{ @$event->lastname }}</span>
                                <span class="post-profile-description">{{ $event->location }}, {{ $event->created_at }}</span>
                            </div>
                        </div>
                        <div class="post-buttons">
                            @if (@$event->reserved !== null)
                                <button class="post-btns-btn" disabled> Reserved <i class="bi bi-check"></i></button>
                            @elseif ( @$event->reserved == null) 
                                <button class="post-btns-btn" onclick="reserveAjax( {{ $event->event_id }} , this)"> Reserve <i class="bi bi-person-check-fill"></i></button>
                            @endif
                            <button class="post-btns-btn" onclick="showMore(this.nextElementSibling)">More <i class="bi bi-three-dots-vertical button-icons"></i></button>
                            <div class="more-dropdown">
                                <div class="more-option">
                                    <i class="bi bi-bookmark" style="font-size: 15px;"></i>
                                    <span>Save</span>
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
                        <div class="post-image" style="background-image: url('../assets/s1.jfif')">

                        </div>
                        <div class="post-side">
                            <h3 class="post-title">{{ $event->title }}</h3>
                            <p class="cateogory-event">{{ $event->category }}</p>
                            <p class="post-description">
                                {!! $event->description !!}
                            </p>
                        </div>
                    </div>
                    <div class="post-footer">
                        <div class="post-likes">
                            <p class="post-likes-desc">
                                Price :
                            </p>
                            <span>
                                @if ($event->price == 0)
                                    Free
                                @else
                                    {{ $event->price }} $
                                @endif
                                </span>
                        </div>
                        <div class="post-likes">
                            <p class="post-likes-desc">
                                Empty Spots :
                            </p>
                            <span>{{ $event->spots }}</span>
                        </div>
                        <div class="post-likes">
                            <p class="post-likes-desc">
                                Total Spots :
                            </p>
                            <span>{{ $event->places }}</span>
                        </div>
                        <div class="post-likes">
                            <p class="post-likes-desc">
                                {{ number_format(100 - ($event->spots * 100 / $event->places), 2) }}% Full
                            </p>
                            <div class="slider-per">
                                <div class="per" style="width: {{ 100 - ( $event->spots * 100 / $event->places ) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
@endsection