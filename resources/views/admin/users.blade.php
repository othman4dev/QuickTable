@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-events">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if (@$user->banned == 0)
                            Not Banned
                        @elseif (@$user->banned == 1)
                            Banned
                        @endif
                    </td>
                    <td>
                        @if (@$user->role == 'User')
                            <a href="/upgrade/{{ $user->id }}" class="action-btn">Turn Organizator <i class="bi bi-person-check-fill"></i></a>
                        @elseif (@$user->role == 'Organizator')
                            <a href="/downgrade/{{ $user->id }}" class="action-btn">Turn User <i class="bi bi-person-dash-fill"></i></a>
                        @endif
                        @if (@$user->banned == 0 && @$user->role !== 'Admin')
                            <a href="/users/ban/{{ $user->id }}" class="action-btn">Ban <i class="bi bi-x-circle-fill"></i></a>
                        @elseif (@$user->banned == 1 && @$user->role !== 'Admin')
                            <a href="/events/unban/{{ $user->id }}" class="action-btn"> Unban <i class="bi bi-person-check"></i></a>
                        @endif
                       
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</section>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endsection