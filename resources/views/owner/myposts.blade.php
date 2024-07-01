@extends('layouts.owner')
@section('content')
    <section class="all">
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
                <div class="nearby-option" onclick="window.location.href='/getItem/{{ $item->id}}'">
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
@endsection