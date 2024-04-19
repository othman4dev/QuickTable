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
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($businesses as $business)
                <tr data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <td style="background-image: url('{{ $business->background_image }}');background-position:center;background-size: cover;color:#fff;position:relative;">
                        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);z-index: 0;"></div>
                        <div style="z-index: 2;color:#fff;position:relative">{{ $business->name }}</div>
                    </td>
                    <td>{{ $business->address }}</td>
                    <td>{{ $business->phone }}</td>
                    <td>{{ $business->business_type }}</td>
                    <td>
                        @if ($business->status == 0)
                            <div class="status-not-active">
                                <span style="color: #f1c40f">Not Active</span>
                            </div>
                        @elseif ($business->status == 1)
                        <div class="status-active">
                            <span style="color: #2ecc71">Active</span>
                        </div>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($business->created_at)->format('d / m / Y') }}</td>
                    <td>
                        <a href="/getBusiness/{{ $business->id }}" class="action-btn">Open <i class="bi bi-box-arrow-up-right"></i></a>
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
        
    });
});
</script>
@endsection