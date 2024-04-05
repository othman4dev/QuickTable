@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-heading">
        <h1>Businesses</h1>
    </section>
    <section class="table-events" style="min-height:84.5%;">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($businesses as $business)
                <tr data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <td>{{ $business->name }}</td>
                    <td>{!! Illuminate\Support\Str::limit($business->description , 75) !!}</td>
                    <td>{{ $business->address }}</td>
                    <td>{{ $business->email }}</td>
                    <td>{{ $business->phone }}</td>
                    <td>{{ $business->business_type }}</td>
                    <td>{{ $business->created_at }}</td>
                    <td>
                        <a href="/business/{{ $business->id }}" class="action-btn">Open <i class="bi bi-box-arrow-up-right"></i></a>
                        <a href="/business/delete/{{ $business->id }}" class="action-btn">Delete <i class="bi bi-trash3-fill"></i></a>
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
    $(document).ready(function() {
    $('#myTable').DataTable({
        "columnDefs": [
            { "width": "5%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "15%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "10%", "targets": 4 },
            { "width": "10%", "targets": 5 },
            { "width": "10%", "targets": 6 },
            { "width": "15%", "targets": 7 }
        ]
    });
});
</script>
@endsection