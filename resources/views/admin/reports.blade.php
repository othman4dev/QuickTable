@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-heading">
        <h1>Reports</h1>
    </section>
    <section class="table-events" style="min-height:84.5%;">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Business Name</th>
                    <th>Reason</th>
                    <th>Business Owner</th>
                    <th>Business Phone</th>
                    <th>Submition Date</th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                <tr data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <td>{{ $report->user_firstname }} {{ $report->user_lastname }}</td>
                    <td>{{ $report->user_email }}</td>
                    <td>{{ $report->business_name }}</td>
                    <td>{{ $report->reason }}</td>
                    <td>{{ $report->owner_firstname }} {{ $report->owner_lastname }}</td>
                    <td>{{ $report->phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->created_at)->format('d / m / Y') }}</td>
                    <td>
                        <a href="/getBusiness/{{ $report->business_id }}" class="action-btn">Open <i class="bi bi-box-arrow-up-right"></i></a>
                        <a href="/dismissReport/{{ $report->report_id }}" class="action-btn">Delete<i class="bi bi-trash-fill"></i></a>
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