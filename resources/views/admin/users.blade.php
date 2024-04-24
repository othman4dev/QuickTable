@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-heading">
        <h1>Users</h1>
    </section>
    <section class="table-events" style="min-height:84.5%;">
        <table id="myTable" class="display" >
            <thead>
                <tr>
                    <th>Profile Picture</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <td >
                        <img src="{{ $user->pp }}" style="height:40px;width:40px;border-radius:50%; " alt="">
                    </td>
                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->status == 1)
                            <div class="status-active">
                                <span style="color: #2ecc71">Active</span>
                            </div>
                        @elseif ($user->status == 0)
                            <div class="status-not-active">
                                <span style="color: #f10f0f">Banned</span>
                            </div>
                            
                        @endif
                    </td>
                    <td>
                        @if (@$user->role == 'User')
                            <a href="/upgrade/{{ $user->id }}" class="action-btn">Turn Owner<i class="bi bi-person-check-fill"></i></a>
                        @elseif (@$user->role == 'Owner')
                            <a href="/downgrade/{{ $user->id }}" class="action-btn">Turn User<i class="bi bi-person-dash-fill"></i></a>
                        @endif
                        @if (@$user->banned == 0 && @$user->role !== 'Admin')
                            <a href="/userBan/{{ $user->id }}" class="action-btn">Ban <i class="bi bi-x-circle-fill"></i></a>
                        @elseif (@$user->banned == 1 && @$user->role !== 'Admin')
                            <a href="/userUnban/{{ $user->id }}" class="action-btn"> Unban <i class="bi bi-person-check"></i></a>
                        @endif
                       
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</section>
<script>
    $(document).ready(function() {
    $('#myTable').DataTable({
        
    });
});
</script>
@endsection