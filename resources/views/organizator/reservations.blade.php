@extends('layouts.organizator')
@section('content')
<section class="all">
    <section class="table-events">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Verification Code</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $event)
                <tr>
                    <td>{{ $event->firstname }} {{ $event->lastname }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->time }}</td>
                    <td>{{ $event->token }}</td>
                    <td>{{ $event->price }} $</td>
                    <td>
                        @if ($event->status == 0)
                            <a href="/approveReservation/{{ $event->reservation_id }}" class="action-btn">Approve <i class="bi bi-file-earmark-check"></i></a>
                            <a href="/rejectReservation/{{ $event->reservation_id }}" class="action-btn">Reject <i class="bi bi-file-earmark-x"></i></a>
                        @elseif ($event->status == 1)
                            <p style="text-align: center">Approved <i class="bi bi-check"></i></p>
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