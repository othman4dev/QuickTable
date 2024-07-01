@extends('layouts.admin')
@section('content')
<section class="all">
    <section class="table-heading">
        <h1>Messages</h1>
    </section>
    <section class="table-events" style="min-height:84.5%;">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Role</th>
                    <th>Message</th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                <tr data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <td>{{ $message->firstname }} {{ $message->lastname }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->role }}</td>
                    <td>{{ $message->message }}</td>
                    <td>
                        <a onclick="openMessage('{{ $message->message }}')" class="action-btn">Open<i class="bi bi-box-arrow-up-right"></i></a>
                        <a href="/dismissReport/{{ $message->id }}" class="action-btn">Delete<i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</section>
<section id="messageModal" class="message-modal">
    <div class="menu-item-header" style="justify-content: space-between">
        <p style="font-size: 20px">Message</p>
        <div class="closer" onclick="this.parentNode.parentNode.style.display = 'none';hideProtection();">       
            <i class="bi bi-x-lg"></i>
        </div>
    </div>
    <div class="message-text">
        <p id="message"></p>
    </div>
</section>
<script>
    $(document).ready(function() {
    $('#myTable').DataTable({
        
    });
});
</script>
@endsection