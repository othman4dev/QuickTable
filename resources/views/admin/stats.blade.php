@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="stats">
        <div class="card-stat">
            <i class="bi bi-person-fill stat-icon green"></i>
            <h2>Users</h2>
            <p>{{ $users }}</p>
        </div>
        <div class="card-stat">
            <i class="bi bi-person-fill-lock stat-icon yellow"></i>
            <h2>Organizators</h2>
            <p>{{ $organizators}}</p>
        </div>
        <div class="card-stat">
            <i class="bi bi-person-fill-gear stat-icon red"></i>
            <h2>Admins</h2>
            <p>{{ $admins}}</p>
        </div>
        <div class="card-stat">
            <i class="bi bi-shop-window stat-icon blue"></i>
            <h2>Events</h2>
            <p>{{ $events }}</p>
        </div>
        <div class="card-stat">
            <i class="bi bi-ticket-detailed stat-icon grey"></i>
            <h2>Reservations</h2>
            <p>{{ $reservations }}</p>
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