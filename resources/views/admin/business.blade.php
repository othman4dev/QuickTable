@extends('layouts.admin')
@section('content')
    <section class="all">
        <section class="profile">
            <div class="user-banner" style="background-image: url('{{ $business->background_image }}')">
                <div class="user-overlay">
                    
                </div>
            </div>
            <div class="user-info" style="position: relative">
                <div class="user-pp" style="background-image: url('{{ $business->pp }}');height: 150px;min-width:150px">

                </div>
                
                <div class="user-texts">
                    <h1 class="user-name">{{ $business->name }} <i class="bi bi-patch-check-fill verified"></i></h1>
                    <p style="font-size: 11px">Owner : {{ $business->firstname }} {{ $business->lastname }}</p>
                    <p class="user-description">{{ $business->description }}</p>
                </div>
                <div class="user-status">
                    <div class="user-status-item">
                        <h1>Business Type</h1>
                        <span>{{ $business->business_type }}</span>
                    </div>
                    <div class="user-status-item">
                        <h1>Posts</h1>
                        <span>{{ $postCount }}</span>
                    </div>
                    <div class="user-status-item">
                        <h1>Reservations</h1>
                        <span>{{ $reservationCount }}</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="edit-profile-section">
            <p>Reservator</p>
            <div class="edit-btns">
                <button class="post-btns-btn" onclick="reportBusiness({{ $business->businessId }},this)" >Report <i class="bi bi-exclamation-diamond-fill"></i></button>
                <button class="post-btns-btn" onclick="showReserveModal();" style="width: 190px;">Reserve A Table <i class="bi bi-ticket-perforated-fill"></i></button>
            </div>
        </section>
        <section class="under-profile" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <section class="swippers" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="swiper-section" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="swiper-title">
                        <h1>{{ $slider1_title }}</h1>
                    </div>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($slider1 as $item)
                                <img class="swiper-slide" src="{{ $item }}" alt="">
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
                <div class="swiper-section" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="swiper-title">
                        <h1>{{ $slider2_title }}</h1>
                    </div>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($slider2 as $item)
                                <img class="swiper-slide" src="{{ $item }}" alt="">
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </section>
            <div class="under-profile-menu" style="font-family: 'Reem Kufi', sans-serif !important;" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="menu-header">
                    <h1>Menu</h1>
                </div>
                @if (count($menu) == 0)
                    <div class="no-events" style="height: 90%">
                    <h1><i class="bi bi-emoji-frown-fill"></i> No Items Yet</h1>
                    <p>Start adding items to your menu</p>
                    </div>
                @else
                <div class="menu-cols" id="cols1">
                    <div class="menu-col">
                        <span class="col-title">
                            Items
                        </span>
                        @foreach ($menu->take(5) as $item) 
                        <div class="menu-item" onclick="showMenuItem('{{ $item->name }}','{{ $item->description }}',{{ $item->price }} , {{ $item->id }});showProtection()">
                            <div class="menu-item-img">
                                
                            </div>
                            <div class="menu-item-name">
                                {{ $item->name }}
                            </div>
                            <div class="menu-item-prices">
                                {{ $item->price }}$
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="menu-line"></div>
                    <div class="menu-col">
                        @php
                            $menu2 = '';
                            if (count($menu) > 5) {
                                $menu2 = collect($menu)->slice(5, 5);
                            }
                        @endphp
                        <span class="col-title">
                            Items
                        </span>
                        @if (count($menu) > 5 )
                            @foreach ($menu2 as $item) 
                            <div class="menu-item" onclick="showMenuItem('{{ $item->name }}','{{ $item->description }}',{{ $item->price }} , {{ $item->id }});showProtection()">
                                <div class="menu-item-img">

                                </div>
                                <div class="menu-item-name">
                                    {{ $item->name }}
                                </div>
                                <div class="menu-item-prices">
                                    {{ $item->price }} $
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="nexter">
                            <span class="next-btn" onclick="showNextMenu()">
                                Next <i class="bi bi-arrow-right-circle-fill"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="menu-cols hidden" id="cols2">
                    <div class="menu-col">
                        @php
                            $menu3 = '';
                            if (count($menu) > 10) {
                                $menu3 = collect($menu)->slice(10, 5);
                            }
                        @endphp
                        <span class="col-title">
                            Items
                        </span>
                        @if (count($menu) > 10)
                            @foreach ($menu3 as $item) 
                            <div class="menu-item" onclick="showMenuItem('{{ $item->name }}','{{ $item->description }}',{{ $item->price }} ,{{ $item->id }});showProtection()">
                                <div class="menu-item-img">

                                </div>
                                <div class="menu-item-name">
                                    {{ $item->name }}
                                </div>
                                <div class="menu-item-prices">
                                    {{ $item->price }} $
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="menu-line"></div>
                    <div class="menu-col">
                        @php
                            $menu4 = '';
                            if (count($menu) > 15) {
                                $menu4 = collect($menu)->slice(15, 5);
                            }
                        @endphp
                        <span class="col-title">
                            Items
                        </span>
                        @if (count($menu) > 15)
                            @foreach ($menu4 as $item) 
                            <div class="menu-item" onclick="showMenuItem('{{ $item->name }}','{{ $item->description }}',{{ $item->price }}, {{ $item->id }});showProtection()">
                                <div class="menu-item-img">

                                </div>
                                <div class="menu-item-name">
                                    {{ $item->name }}
                                </div>
                                <div class="menu-item-prices">
                                    {{ $item->price }} $
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="nexter">
                            <span class="next-btn" onclick="showPrevMenu()">
                                <i class="bi bi-arrow-left-circle-fill"></i> Previous
                            </span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
            <section class="feed" style="width: 100%" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <section class="posts">
                    @foreach ($myposts as $post)
                    <div class="post" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="post-header">
                            <div class="post-profile">
                                <div class="post-profile-image" style="background-image: url('{{ $business->pp }}');background-position:center;background-size:cover;">
                                </div>
                                <div class="post-profile-texts">
                                    <span class="post-profile-name">{{ $business->name }}</span>
                                    <span class="post-profile-description">Owner : {{ $business->firstname }} {{ $business->lastname }}</span>
                                </div>
                            </div>
                            <div class="post-buttons">
                                <button class="post-btns-btn" onclick="showMore(this.nextElementSibling)">More <i class="bi bi-three-dots-vertical button-icons"></i></button>
                                <div class="more-dropdown">
                                    <div class="more-option" onclick="window.location.href = '/getPost/{{ $post->id }}'">
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
                            @if ($post->image !== null)
                                <div class="post-image" style="background-image: url('../{{ $post->image }}')"></div>
                            @endif
                            <div class="post-side">
                                <h3 class="post-title">{{ $post->title }}</h3>
                                <p class="cateogory-event">{{ $business->business_type }}</p>
                                <p class="post-description">
                                    {!! $post->description !!}
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
                    @endforeach
                    @if (count($myposts) == 0)

                        <div class="post" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                            <div class="no-events">
                                <h1><i class="bi bi-emoji-frown-fill"></i> No Events Yet</h1>
                                <p>Start adding events to your profile</p>
                            </div>
                        </div>  
                    @endif
                </section>
            </section>
        </section>
        <script>
            const swiper = new Swiper('.swiper', {
          // Optional parameters
          direction: 'horizontal',
          loop: true,

          // If we need pagination
          pagination: {
            el: '.swiper-pagination',
          },
      
          // Navigation arrows
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
      
          // And if we need scrollbar
          scrollbar: {
            el: '.swiper-scrollbar',
          },
        });
        </script>
@endsection