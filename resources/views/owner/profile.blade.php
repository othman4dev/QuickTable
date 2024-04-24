@extends('layouts.owner')
@section('content')
    <section class="all">
        <section class="profile">
            <div class="user-banner" style="background-image: url('{{ session('business')->background_image }}')">
                <div class="user-overlay">
                    <div class="corner-edit" onclick="showBannerModal()">
                        <i class="bi bi-pencil-square" style="font-size: 20px"></i>
                    </div>
                </div>
            </div>
            <div class="user-info" style="position: relative">
                <div class="corner-edit" onclick="showInfoModal()">
                    <i class="bi bi-pencil-square" style="font-size: 20px"></i>
                </div>
                <div class="user-pp" style="background-image: url('{{ session('user')->pp}}');height: 150px;min-width:150px">

                </div>
                
                <div class="user-texts">
                    <h1 class="user-name">{{ session('business')->name }} <i class="bi bi-patch-check-fill verified"></i></h1>
                    <p style="font-size: 11px">Owner : {{ session('user')->firstname }} {{ session('user')->lastname }}</p>
                    <p class="user-description">{{ session('business')->description }}</p>
                </div>
                <div class="user-status">
                    <div class="user-status-item">
                        <h1>Business Type</h1>
                        <span>{{ session('business')->business_type }}</span>
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
        </section>
        <section class="edit-profile-section">
            <p>Profile Editors</p>
            <div class="edit-btns">
                <button class="edit-btn-profile" onclick="showBannerModal()">Edit Banner <i class="bi bi-pen"></i></button>
                <button class="edit-btn-profile" onclick="showInfoModal()">Edit Info<i class="bi bi-pen"></i></button>
                <button class="edit-btn-profile" onclick="showMenuAdd();showProtection()">Add Item To Menu<i class="bi bi-plus-circle"></i></button>
                <button class="edit-btn-profile" onclick="showSliders()">Edit Sliders<i class="bi bi-pen"></i></button>
            </div>
        </section>
        <section class="under-profile" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <section class="swippers" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="swiper-section" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="swiper-title">
                        <h1>{{ session('slider1_title') }}</h1>
                    </div>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                          <img class="swiper-slide" src="{{ session('slider1')[0] }}" alt="">
                          <img class="swiper-slide" src="{{ session('slider1')[1] }}" alt="">
                          <img class="swiper-slide" src="{{ session('slider1')[2] }}" alt="">
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
                <div class="swiper-section" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="swiper-title">
                        <h1>{{ session('slider2_title') }}</h1>
                    </div>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                          <img class="swiper-slide" src="{{ session('slider2')[0] }}" alt="">
                          <img class="swiper-slide" src="{{ session('slider2')[1] }}" alt="">
                          <img class="swiper-slide" src="{{ session('slider2')[2] }}" alt="">
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </section>
            <div class="under-profile-menu" style="font-family: 'Reem Kufi', sans-serif !important;" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="corner-edit">
                    <i class="bi bi-pencil-square" style="font-size: 20px"></i>
                </div>
                <div class="menu-header">
                    <h1>Menu</h1>
                </div>
                @if (count(session('menu')) == 0)
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
                        @foreach (session('menu')->take(5) as $item)
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
                            $menu2 = null;
                            if (count(session('menu')) > 5) {
                                $menu2 = collect(session('menu'))->slice(5, 5);
                            }
                        @endphp
                        <span class="col-title">
                            Items
                        </span>
                        @if (count($menu2) > 0 )
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
                            if (count(session('menu')) > 10) {
                                $menu3 = collect(session('menu'))->slice(10, 5);
                            }
                        @endphp
                        <span class="col-title">
                            Items
                        </span>
                        @if (count($menu3) > 0)
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
                            $menu4 = null;
                            if (count(session('menu')) > 15) {
                                $menu4 = collect(session('menu'))->slice(15, 5);
                            }
                        @endphp
                        <span class="col-title">
                            Items
                        </span>
                        @if (count($menu4) > 0)
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
            <section class="add-post" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="add-post-header" onclick="showAdd(this.nextElementSibling,this)">
                    <h1 class="add-post-title">Add a post</h1>
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div class="add-post-body" style="display: none">
                    <form action="/addPost" method="post" class="add-post-form" enctype="multipart/form-data">
                        @csrf
                        <div class="add-post-inputs">
                            <div class="col-1">
                                <div class="post-input-container">
                                    <label for="title" class="add-post-label">Title</label>
                                    <input type="text" name="title" id="title" class="add-post-inp" required oninput="lengthCheck(this,'Please use shorter titles (max 50 characters) for better user experience. Provide detailed information in the description.',50)" placeholder="Title of the post*">
                                    <div id="title-counter" class="counter">

                                    </div>
                                </div>
                                <script>
                                    tinymce.init({
                                      selector: '#desc',
                                      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
                                      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                    });
                                  </script>
                                <div class="post-input-container">
                                    <label for="desc" class="add-post-label">Description</label>
                                    <textarea id="desc" name="description" class="add-post-inp" placeholder="Description"></textarea>
                                </div>
                                <div class="question-answer">
                                    <div class="image-question-container">
                                        <input type="checkbox" id="image-question" name="image-question" class="image-question" onchange="addImage(this)" checked>
                                        <label for="image-question">Add Image</label>
                                    </div>
                                    <div class="post-input-container" style="flex-grow:1;">
                                        <input type="file" accept=".jpg , .png , .gif , .jpeg , .jfif , .svg" name="image" id="image" class="add-post-file">
                                    </div>
                                </div>
                                <div class="add-post-btns">
                                    <input type="submit" class="add-post-btn" value="Add Event">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="feed" style="width: 100%" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <section class="my-city">
                    <div class="nearby">
                        <h1>Menu</h1>
                    </div>
                    @foreach (session('menu') as $item)
                    <div class="nearby-option">
                        <div class="nearby-option-logo">
                        
                        </div>
                        <div class="nearby-option-texts">
                            <h3 class="nearby-option-title">{{ Illuminate\Support\Str::limit($item->name, 20) }}</h3>
                            <p class="nearby-option-description"></p>
                        </div>
                        <div class="nearby-option-logo">
                            {{ floor($item->price) }} $
                        </div>
                    </div>
                    @endforeach
                </section>
                <section class="posts">
                    @foreach ($myposts as $post)
                    <div class="post" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="post-header">
                            <div class="post-profile">
                                <div class="post-profile-image" style="background-image: url('{{ session('user')->pp }}');background-position:center;background-size:cover;">
                                </div>
                                <div class="post-profile-texts">
                                    <span class="post-profile-name">{{ session('business')->name }}</span>
                                    <span class="post-profile-description">Owner : {{ session('user')->firstname }} {{ session('user')->lastname }}</span>
                                </div>
                            </div>
                            <div class="post-buttons">
                                <button onclick="window.location.href='/edit/{{ $post->post_id}}'" class="post-btns-btn">Edit <i class="bi bi-pencil-square"></i></button>
                                <button onclick="window.location.href='/deleteEvent/{{ $post->post_id}}'" class="post-btns-btn">Delete <i class="bi bi-trash3-fill"></i></button>
                            </div>
                        </div>
                        <div class="post-body">
                            @if ($post->image !== null)
                                <div class="post-image" style="background-image: url('../{{ $post->image }}')"></div>
                            @endif
                            <div class="post-side">
                                <h3 class="post-title">{{ $post->title }}</h3>
                                <p class="cateogory-event">{{ session('business')->business_type }}</p>
                                <p class="post-description">
                                    {!! $post->description !!}
                                </p>
                            </div>
                        </div>
                        <div class="post-footer">
                            
                        </div>
                    </div>
                    @endforeach
                    @if (count($myposts) == 0)
                        <div class="post" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                            <div class="no-events">
                                <h1><i class="bi bi-emoji-frown-fill"></i> No Posts Yet</h1>
                                <p>Start adding posts to your profile</p>
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