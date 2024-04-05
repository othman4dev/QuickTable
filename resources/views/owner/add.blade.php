@extends('layouts.owner')
@section('content')
    <section class="all">
        <section class="profile">
            <div class="user-banner" style="background-image: url('../assets/s4.jpeg')">
                <div class="user-overlay">
                </div>
            </div>
            <div class="user-info">
                <div class="user-pp">
                    <img src="assets/s2.jpg" alt="">
                </div>
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
                <div class="add-post-header" onclick="showAdd(this);this.lastElementChild.classList.remove('bi-caret-down');this.lastElementChild.classList.add('bi-caret-up');">
                    <h1 class="add-post-title">Add An Event</h1>
                    <i class="bi bi-caret-down"></i>
                </div>
                <div class="add-post-body">
                    <form action="/addEvent" method="post" class="add-post-form" enctype="multipart/form-data">
                        @csrf
                        <div class="add-post-inputs">
                            <div class="col-1">
                                <div class="post-input-container">
                                    <label for="title" class="add-post-label">Title</label>
                                    <input type="text" name="title" id="title" class="add-post-inp" required onkeyup="lengthCheck(this,'Please use shorter titles (max 50 characters) for better user experience. Provide detailed information in the description.',50)">
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
            <section class="feed">
                <section class="my-city">
                    <div class="nearby">
                        <h1>Top Events</h1>
                    </div>
                    @foreach ($myevents as $post)
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
                    @foreach ($myevents as $event)
                    <div class="post">
                        <div class="post-header">
                            <div class="post-profile">
                                <div class="post-profile-image">
                                </div>
                                <div class="post-profile-texts">
                                    <span class="post-profile-name">{{ session('user')->firstname }} {{ session('user')->lastname }}</span>
                                    <span class="post-profile-description">{{ $event->location }}, {{ $event->created_at }}</span>
                                </div>
                            </div>
                            <div class="post-buttons">
                                <button onclick="window.location.href='/edit/{{ $event->event_id}}'" class="post-btns-btn">Edit <i class="bi bi-pencil-square"></i></button>
                                <button onclick="window.location.href='/delete/{{ $event->event_id}}'" class="post-btns-btn">Delete <i class="bi bi-trash3-fill"></i></button>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-image" style="background-image: url('../{{ $event->image }}')">
                                
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
                    @endforeach
                </section>
            </section>
        </section>
@endsection