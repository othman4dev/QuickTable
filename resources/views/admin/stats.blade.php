@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-heading">
        <h1>Statistiques</h1>
    </section>
    <section class="stats">
        <div class="card-stat">
            <div class="absolute-illu">
                <div class="circle-1 blue"></div>
                <div class="circle-2 blue"></div>
            </div>
            <div class="stat-option">
                <i class="bi bi-people-fill stat-icon grey"></i>
                <h2>Users</h2>
            </div>
            <p>{{ $users }}</p>
        </div>
        <div class="card-stat">
            <div class="absolute-illu">
                <div class="circle-1 yellow"></div>
                <div class="circle-2 yellow"></div>
            </div>
            <div class="stat-option">
                <i class="bi bi-person-fill-lock stat-icon grey"></i>
                <h2>Owners</h2>
                
            </div><p>{{ $owners}}</p>
        </div>
        <div class="card-stat">
            <div class="absolute-illu">
                <div class="circle-1 green"></div>
                <div class="circle-2 green"></div>
            </div>
            <div class="stat-option">
                <i class="bi bi-person-fill-gear stat-icon grey"></i>
                <h2>Admins</h2>
                
            </div><p>{{ $admins}}</p>
        </div>
        <div class="card-stat">
            <div class="absolute-illu">
                <div class="circle-1 red"></div>
                <div class="circle-2 red"></div>
            </div>
            <div class="stat-option">

                <i class="bi bi-file-post stat-icon grey"></i>
                <h2>Posts</h2>
                
            </div><p>{{ $posts }}</p>
        </div>
        <div class="card-stat">
            <div class="absolute-illu">
                <div class="circle-1 purple"></div>
                <div class="circle-2 purple"></div>
            </div>
            <div class="stat-option">
                <i class="bi bi-ticket-detailed-fill stat-icon grey"></i>
                <h2>Reservations</h2>
                
            </div><p>{{ $reservations }}</p>
        </div>
    </section>
    <section class="tops">
        <div class="top5" data-aos="fade-up">
            <div class="absolute-illu2">
                <div class="circle-1 blue"></div>
                <div class="circle-2 blue"></div>
            </div>
            <div class="top5-title">
                <h1 class="top-h1">Top Reservators</h1>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">John Doe</p>
                        <p>JohnDoe15@gmail.com</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">5</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">John Doe</p>
                        <p>JohnDoe15@gmail.com</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">5</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">John Doe</p>
                        <p>JohnDoe15@gmail.com</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">5</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">John Doe</p>
                        <p>JohnDoe15@gmail.com</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">5</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">John Doe</p>
                        <p>JohnDoe15@gmail.com</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">5</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
        </div>
        <div class="top5" data-aos="fade-up">
            <div class="top5-title">
                <h1 class="top-h1">Top Businesses</h1>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">Black Milk</p>
                        <p>Owner : Othman Kharbouch</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">255</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">Black Milk</p>
                        <p>Owner : Othman Kharbouch</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">255</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">Black Milk</p>
                        <p>Owner : Othman Kharbouch</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">255</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">Black Milk</p>
                        <p>Owner : Othman Kharbouch</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">255</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="top5-case">
                <div class="mini-profile">
                    <div class="mini-profile-img"></div>
                    <div class="mini-profile-texts">
                        <p style="font-size: 13px">Black Milk</p>
                        <p>Owner : Othman Kharbouch</p>
                    </div>
                </div>
                <div class="mini-stat">
                    <p class="mini-stat-num">255</p>
                    <p class="mini-stat-text">Reservations</p>
                </div>
            </div>
            <div class="absolute-illu2">
                <div class="circle-1 green"></div>
                <div class="circle-2 green"></div>
            </div>
        </div>
    </section>
</section>
<section class="editModal" id="addModal" style="display: none;">
    <form action="/addCat" method="post" class="modal-form">
        @csrf
        <h2>Add Category <i class="bi bi-x-lg" style="cursor: pointer" onclick="this.parentNode.parentNode.parentNode.style.display='none'"></i></h2>
        <label class="modal-label">
            Category name
        <input type="text" class="modal-inp" name="category">
        </label>
        <input type="submit" class="form-btn" value="Add">
    </form>
</section>
<section class="editModal" id="editModal" style="display: none;">
    <form method="post" action="/editCat" class="modal-form">
        @csrf
        <h2>Edit Category <i class="bi bi-x-lg" style="cursor: pointer" onclick="this.parentNode.parentNode.parentNode.style.display='none'"></i></h2>
        <input type="hidden" class="modal-inp" value="" id="cat-id" name="id">
        <label class="modal-label">
            Category name
        <input type="text" class="modal-inp" name="category" id="category-name">
        </label>
        <input type="submit" class="form-btn" value="Edit">
    </form>
</section>
<section class="editModal" id="deleteModal" style="display: none;">
    <form method="GET" class="modal-form">
        @csrf
        <h2>Delete Category <i class="bi bi-x-lg" style="cursor: pointer" onclick="this.parentNode.parentNode.parentNode.style.display='none'"></i></h2>
        <p>Are you sure you want to delete :</p>
        <p id="category-name"></p>
        <input type="submit" class="form-btn" value="Delete">
    </form>
</section>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endsection