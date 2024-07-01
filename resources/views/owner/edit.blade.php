@extends('layouts.owner')
@section('content')
    <section class="all">
        <section class="posts">
            <div class="post" data-aos="fade-up" data-aos-anchor-placement="top-bottom" style="margin-top: 15px">
                <div class="post-header">
                    <div class="post-profile">
                        <div class="post-profile-image" style="background-image: url('{{ session('user')->pp }}');background-size:cover;background-postion:center;">
                        </div>
                        <div class="post-profile-texts">
                            <span class="post-profile-name">{{ session('business')->name }}</span>
                            <span class="post-profile-description">Owner : {{ session('user')->firstname }} {{ session('user')->lastname }}</span>
                        </div>
                    </div>
                    <div class="post-buttons">
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
        </section>
        <section class="add-post" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="add-post-body">
                <form action="/editPost" method="post" class="add-post-form" enctype="multipart/form-data">
                    @csrf
                    <div class="add-post-inputs">
                        <div class="col-1">
                            <input type="text" class="hidden" value="{{ $post->post_id }}" name="id">
                            <div class="post-input-container">
                                <label for="title" class="add-post-label">Title</label>
                                <input type="text" name="title" id="title" class="add-post-inp" value="{{ $post->title }}" required oninput="lengthCheck(this,'Please use shorter titles (max 50 characters) for better user experience. Provide detailed information in the description.',50)" placeholder="Title of the post*">
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
                                <textarea id="desc" name="description" class="add-post-inp" placeholder="Description">{{ $post->description }}</textarea>
                            </div>
                            <div class="question-answer">
                                <div class="image-question-container">
                                    <input type="checkbox" id="image-question" name="image-question" class="image-question" onchange="addImage(this)" @if ($post->image)
                                        checked
                                    @endif>
                                    <label for="image-question">Add Image</label>
                                </div>
                                <div class="post-input-container" style="flex-grow:1;">
                                    <input type="file" accept=".jpg , .png , .gif , .jpeg , .jfif , .svg" name="image" id="image" class="add-post-file">
                                    <p class="labels" style="color: #000;font-style:italic">Image Unchanged</p>
                                </div>
                            </div>
                            <div class="add-post-btns">
                                <input type="submit" class="add-post-btn" value="Edit Post">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
</section>
@endsection