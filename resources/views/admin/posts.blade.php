@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-events">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Business Name</th>
                    <th>Business Type</th>
                    <th>Owner</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td style="padding-right:20px">
                        @if ($post->image)
                            <img src="{{ $post->image }}" alt="" style="width: 50px;height: 50px;border-radius: 50%;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{!! Illuminate\Support\Str::limit($post->description , 75) !!}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->business_type }}</td>
                    <td>{{ $post->firstname}} {{ $post->lastname }}</td>
                    <td>
                        <a href="/post{{ $post->post_id }}" class="action-btn" style="border-radius: 0px">Open <i class="bi bi-box-arrow-up-right"></i></a>
                        <a href="/posts/delete/{{ $post->post_id }}" class="action-btn" style="border-radius: 0px">Delete <i class="bi bi-trash3-fill"></i></a>
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
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "10%", "targets": 1 },
                { "width": "20%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },   
                { "width": "15%", "targets": 6 }
            ]
        });
    });
</script>
@endsection