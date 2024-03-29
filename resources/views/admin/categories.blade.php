@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-heading">
        <h1>Categories</h1>
        <a class="table-head-btn" onclick="addCat('addModal')">Add Category <i class="bi bi-plus-circle"></i></a>
    </section>
    <section class="table-events">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th style="width: 120px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category }}</td>
                    <td style="width: 120px">
                        <a class="action-btn" onclick="transferEdit({{ $category->id }},'{{ $category->category }}')">Edit<i class="bi bi-pencil-square"></i></a>
                        <a class="action-btn" onclick="transferDel({{ $category->id }},'{{ $category->category }}')">Delete<i class="bi bi-trash3-fill"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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