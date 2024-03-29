@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-events">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Places</th>
                    <th>Spots</th>
                    <th>Categpory</th>
                    <th>Date & Time</th>
                    <th>Price</th>
                    <th>User ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{!! Illuminate\Support\Str::limit($post->description , 25) !!}</td>
                    <td>{{Illuminate\Support\Str::limit($post->location , 25)}}</td>
                    <td>{{ $post->places }}</td>
                    <td>{{ $post->spots }}</td>
                    <td>{{ $post->category }}</td>
                    <td>{{ $post->date }}<br>{{ $post->time }}</td>
                    <td>{{ $post->price }} $</td>
                    <td>{{ $post->user_id }}</td>
                    <td>
                        @if ($post->approved == 0)
                            Pending
                        @elseif ($post->approved == 1)
                            Approved
                        @endif
                    </td>
                    <td>
                        @if ($post->approved == 0)
                            <a href="/events/approve/{{ $post->event_id }}" class="action-btn">Approve <i class="bi bi-check-circle-fill"></i></a>
                            <a href="/events/delete/{{ $post->event_id }}" class="action-btn">Delete <i class="bi bi-trash3-fill"></i></a>
                        @else
                            <a href="/events/reject/{{ $post->event_id }}" class="action-btn"> Disapprove <i class="bi bi-x-circle-fill"></i></a>
                            <a href="/events/delete/{{ $post->event_id }}" class="action-btn">Delete <i class="bi bi-trash3-fill"></i></a>
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