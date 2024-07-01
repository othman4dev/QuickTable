@extends('layouts.owner')
@section('content')
<section class="all">
    <section class="table-heading">
        <h1>Reservations</h1>
    </section>
    <section class="table-events">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Expires at</th>
                    <th>Verification Code</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $event)
                <tr>
                    <td>{{ $event->firstname }} {{ $event->lastname }}</td>
                    <td>{{ $event->email }}</td>
                    <td>{{   date('d M Y', strtotime($event->created_at)) }}</td>
                    <td>{{ date('d M Y', strtotime($event->expires_at)) }}</td>
                    <td>{{ $event->token }}</td>
                    <td>{{ $event->price }} $</td>
                    <td>{{ $event->quantity }}</td>
                    <td>
                        @if ($event->status == 1)
                            <div class="status-active" style="width: 90px;">
                                <span style="color: #2ecc71">Valid<i class="bi bi-clock"></i></span>
                            </div>
                        @elseif ($event->status == 0)
                            <div class="status-not-active" style="width: 90px;">
                                <span style="color: #f10f0f;">Redeemed<i class="bi bi-clock"></i></span>
                            </div>
                        @endif

                    </td>
                    <td>
                        @if ($event->status == 1)
                            <a onclick="redeemAjax(this,{{ $event->reservation_id }})" class="action-btn">Redeem<i class="bi bi-file-earmark-check"></i></a>
                        @elseif ($event->status == 0)
                            <p style="text-align: center">Redeemed<i class="bi bi-check"></i></p>
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