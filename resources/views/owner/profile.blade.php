@extends('layouts.owner')
@section('content')
    <section class="all">
        <section class="profile">
            <div class="user-banner" style="background-image: url('../assets/default_banner.jpg')">
                <div class="user-overlay">
                </div>
            </div>
            <div class="user-info">
                <img src="../assets/organizator.webp" alt="" style="height: 100px">
                
                <div class="user-texts">
                    <h1 class="user-name">{{ session('business')->name }} <i class="bi bi-patch-check-fill verified"></i></h1>
                    <p style="font-size: 11px">Owner : {{ session('user')->firstname }} {{ session('user')->lastname }}</p>
                    <p class="user-description">{{ session('business')->description }} Description for the business</p>
                </div>
                <div class="user-status">
                    <div class="user-status-item">
                        <h1>Business Type</h1>
                        <span>{{ session('business')->business_type }}</span>
                    </div>
                    <div class="user-status-item">
                        <h1>Posts</h1>
                        <span>{{ 100 }}</span>
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
                <button class="edit-btn-profile" onclick="">Edit Banner <i class="bi bi-pen"></i></button>
                <button class="edit-btn-profile">Edit Info<i class="bi bi-pen"></i></button>
                <button class="edit-btn-profile">Edit Menu<i class="bi bi-pen"></i></button>
                <button class="edit-btn-profile">Edit Sliders<i class="bi bi-pen"></i></button>
            </div>
        </section>
        <section class="under-profile">
            <section class="swippers" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="swiper-section">
                    <div class="swiper-title">
                        <h1>Places / Facilities</h1>
                    </div>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                          <img class="swiper-slide" src="assets/s1.jfif" alt="">
                          <img class="swiper-slide" src="assets/s2.jpg" alt="">
                          <img class="swiper-slide" src="assets/s3.jpg" alt="">
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
                <div class="swiper-section">
                    <div class="swiper-title">
                        <h1>Best Plates / Dishes / Services</h1>
                    </div>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                          <img class="swiper-slide" src="assets/s1.jfif" alt="">
                          <img class="swiper-slide" src="assets/s2.jpg" alt="">
                          <img class="swiper-slide" src="assets/s3.jpg" alt="">
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </section>
            <div class="under-profile-menu" style="font-family: 'Reem Kufi', sans-serif !important;">
                <div class="menu-header">
                    <h1>Menu</h1>
                </div>
                <div class="menu-cols">
                    
                    <div class="menu-col">
                        <span class="col-title">
                            Drinks
                        </span>
                        <div class="menu-item">
                            <div class="menu-item-img">
                                
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                    </div>
                    <div class="menu-line"></div>
                    <div class="menu-col">
                        <span class="col-title">
                            Drinks
                        </span>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="menu-item">
                            <div class="menu-item-img">
    
                            </div>
                            <div class="menu-item-name">
                                Black Coffee
                            </div>
                            <div class="menu-item-price">
                                1.5$
                            </div>
                        </div>
                        <div class="nexter">
                            <span class="next-btn">
                                Next <i class="bi bi-arrow-right-circle-fill"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
            <section class="add-post" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="add-post-header" onclick="showAdd(this.nextElementSibling,this)">
                    <h1 class="add-post-title">Add a post</h1>
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div class="add-post-body" style="display: none">
                    <form action="/addEvent" method="post" class="add-post-form" enctype="multipart/form-data">
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
                                        <input type="checkbox" id="image-question" name="image-question" class="image-question" onchange="addImage(this)">
                                        <label for="image-question">Add Image</label>
                                    </div>
                                    <div class="post-input-container" style="flex-grow:1;">
                                        <input type="file" accept=".jpg , .png , .gif , .jpeg , .jfif , .svg" name="image" id="image" class="add-post-file" disabled>
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
                    @foreach ($menu as $item)
                    <div class="nearby-option" onclick="window.location.href='/getItem/{{ $item->item_id}}'">
                        <div class="nearby-option-logo" style="background-image: url('{{ $item->image }}');background-size:cover;background-position:center;">
                        
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
                                <div class="post-profile-image">
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