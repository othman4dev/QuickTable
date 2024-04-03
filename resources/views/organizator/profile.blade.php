@extends('layouts.organizator')
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
                    <h1 class="user-name">{{ session('user')->firstname }} {{ session('user')->lastname }} <i class="bi bi-patch-check-fill verified"></i></h1>
                    <p class="user-description">{{ @$user->description }} Description for the business</p>
                </div>
                <div class="user-status">
                    <div class="user-status-item">
                        <h1>Role</h1>
                        <span>{{ session('user')->role }}</span>
                    </div>
                    <div class="user-status-item">
                        <h1>Approved Events</h1>
                        <span>100</span>
                    </div>
                    <div class="user-status-item">
                        <h1>Pending Events</h1>
                        <span>100</span>
                    </div>
                    <div class="user-status-item">
                        <h1>Reservations</h1>
                        <span>100</span>
                    </div>
                </div>
            </div>
        </section>
            <section class="add-post">
                <div class="add-post-header" onclick="showAdd(this.nextElementSibling,this)">
                    <h1 class="add-post-title">Add An Event</h1>
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div class="add-post-body" style="display: none">
                    <form action="/addEvent" method="post" class="add-post-form" enctype="multipart/form-data">
                        @csrf
                        <div class="add-post-inputs">
                            <div class="col-1">
                                <div class="post-input-container">
                                    <label for="title" class="add-post-label">Title</label>
                                    <input type="text" name="title" id="title" class="add-post-inp" required>
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
                                <select name="category" id="category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $(document).ready(function() {
                                        $('#category').select2();
                                    });
                                </script>
                            </div>
                            <div class="col-2">
                                <div class="inp-wrap">
                                    <div class="post-input-container">
                                        <label for="price" class="add-post-label">Price</label>
                                        <input type="number" name="price" id="price" class="add-post-inp" required>
                                    </div>
                                    <div class="post-input-container">
                                        <label for="spots" class="add-post-label">Spots</label>
                                        <input type="number" name="spots" id="spots" class="add-post-inp" required>
                                    </div>
                                </div>
                                <div class="post-input-container">
                                    <label for="location" class="add-post-label">Location</label>
                                    <input type="text" name="location" id="location" class="add-post-inp" required>
                                </div>
                                <div class="post-input-container">
                                    <label for="date" class="add-post-label">Date</label>
                                    <input type="date" name="date" id="date" class="add-post-inp" required>
                                </div>
                                <div class="post-input-container">
                                    <label for="time" class="add-post-label">Time</label>
                                    <input type="time" name="time" id="time" class="add-post-inp" required>
                                </div>
                                <div class="post-input-container">
                                    <label for="image" class="add-post-label">Event Image</label>
                                    <input type="file" accept=".jpg , .png , .gif , .jpeg , .jfif , .svg" name="image" id="image" class="add-post-file" required>
                                </div>
                                <div class="add-post-btns">
                                    <input type="submit" class="add-post-btn" value="Add Event">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="feed" style="width: 100%">
                <section class="my-city">
                    <div class="nearby">
                        <h1>Top Events</h1>
                    </div>
                    @foreach ($myposts as $post)
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
                </section>
                <section class="posts">
                    @foreach ($myposts as $post)
                    <div class="post">
                        <div class="post-header">
                            <div class="post-profile">
                                <div class="post-profile-image">
                                </div>
                                <div class="post-profile-texts">
                                    <span class="post-profile-name">{{ session('user')->firstname }} {{ session('user')->lastname }}</span>
                                    <span class="post-profile-description">{{ $post->location }}, {{ $post->created_at }}</span>
                                </div>
                            </div>
                            <div class="post-buttons">
                                <button class="post-btns-btn" disabled>
                                    @if ($post->approved == 0)
                                        Pending <i class="bi bi-circle" style="font-size: 20px"></i>
                                    @elseif ($post->approved == 1)
                                        Approved <i class="bi bi-check-circle-fill" style="font-size: 20px"></i>
                                    @elseif ($post->approved == 2)
                                        Rejected <i class="bi bi-exclamation-circle-fill" style="font-size: 20px"></i>
                                    @endif
                                </button>
                                <button onclick="window.location.href='/edit/{{ $post->event_id}}'" class="post-btns-btn">Edit <i class="bi bi-pencil-square"></i></button>
                                <button onclick="window.location.href='/deleteEvent/{{ $post->event_id}}'" class="post-btns-btn">Delete <i class="bi bi-trash3-fill"></i></button>
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
                    @if (count($myposts) == 0)

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