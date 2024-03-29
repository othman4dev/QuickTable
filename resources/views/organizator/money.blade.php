@extends('layouts.organizator')
@section('content')
<section class="all">
    <section class="table-events">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Price</th>
                    <th>Places</th>
                    <th>Spots</th>
                    <th>Reservations</th>
                    <th>Money made</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($myevents as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->time }}</td>
                    <td>{{ $event->price }} $</td>
                    <td>{{ $event->places }}</td>
                    <td>{{ $event->spots }}</td>
                    <td>{{ $event->places - $event->spots }}</td>
                    <td>{{ $event->price * ($event->places - $event->spots) }} $</td>
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