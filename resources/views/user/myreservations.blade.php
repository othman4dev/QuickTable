@extends('layouts.app')
@section('content')
<section class="all">
    <section class="table-events">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Business</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Code</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Ticket</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->business_name }}</td>
                    <td>{{ $reservation->item_name }}</td>
                    <td>{{ $reservation->price }} $</td>
                    <td>{{ $reservation->quantity }} Seats</td>
                    <td>{{ $reservation->price * $reservation->quantity }} $</td>
                    <td>{{ $reservation->token }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>
                        @if ($reservation->status == 1)
                            <div class="status-active" style="width: 90px;">
                                <span style="color: #2ecc71">Valid<i class="bi bi-clock"></i></span>
                            </div>
                        @elseif ($reservation->status == 0)
                            <div class="status-not-active" style="width: 90px;">
                                <span style="color: #f10f0f;">Redeemed<i class="bi bi-clock"></i></span>
                            </div>
                        @endif

                    </td>
                    <td>
                        <a class="action-btn" style="width: 150px;" onclick="showTicket(this,`{{ $reservation->business_name }}`,`{{ $reservation->item_name }}`,`{{ $reservation->reservation_date }}`,`{{ $reservation->quantity }}`,`{{ $reservation->price }}`,`{{ $reservation->token }}`,`{{ session('user')->firstname }} {{ session('user')->lastname }}`,`{{ $reservation->expires_at }}`,`url({{ $reservation->business_image }})`)">See Ticket<i class="bi bi-ticket-detailed"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</section>
<div class="ticket-display" id="ticketModal">
    <div class="image-big-content">
        <div class="image-big-close">
            <div class="icon-wrapper" id="downloadBTN" onclick="downloadTicket()">
                <i class="bi bi-download" style="cursor: pointer" ></i>
            </div>
            <div class="icon-wrapper close" onclick="this.parentNode.parentNode.parentNode.style.display = 'none';hideProtection()">
                <i class="bi bi-x-lg" style="cursor: pointer" ></i>
            </div>          
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

        <div class="ticket" id="ticket">
            <div class="left">
                <div class="image" id="ticket-image">
                    <p class="admit-one">
                        <span>QuickTable</span>
                        <span>QuickTable</span>
                    </p>
                    <div class="ticket-number">
                        <p id="event_token">
                            #20030220
                        </p>
                    </div>
                </div>
                <div class="ticket-info">
                    <p class="date" id="event_date">
                        <span>TUESDAY</span>
                        <span class="june-29">JUNE 29TH</span>
                        <span>2021</span>
                    </p>
                    <div class="show-name">
                        <h1 id="event_title" style="font-size:100%;">EXPLORER</h1>
                        <h2 id="event_category" style="font-size:100%;">QuickTable</h2>
                    </div>
                    <div class="time" id="event_time">
                        <p>8:00 PM <span>TO</span> 11:00 PM</p>
                        <p>DOORS <span>@</span> 7:00 PM</p>
                    </div>
                    <p class="location" id="event_location"><span>East High School</span>
                        <span class="separator"><i class="far fa-smile"></i></span><span>Salt Lake City, Utah</span>
                    </p>
                </div>
            </div>
            <div class="right">
                <p class="admit-one">
                    <span>QuickTable</span>
                    <span>QuickTable</span>
                </p>
                <div class="right-info-container">
                    <div class="show-name" >
                        <h1 id="event_price">SOUR Prom</h1>
                    </div>
                    <div class="time">
                        <p id="event_time2">8:00 PM <span>TO</span> 11:00 PM</p>
                    </div>
                    <div class="barcode" id="qrcode">
                        
                    </div>
                    <p class="ticket-number" id="event_token2">
                        #20030220
                    </p>
                </div>
            </div>
        </div>
</div>
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
                { "width": "15%", "targets": 6 },
                { "width": "10%", "targets": 7 }
            ]
        });
    });

</script>
<script>
    function setQR(token){
        let qrcodeplace = document.getElementById('qrcode');
        qrcodeplace.innerHTML = '';
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: token,
            width: 100,
            height: 100,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    }
    function downloadTicket(eventName) {
        var element = document.getElementById('ticket');
        var opt = {
            margin:       1,            
            filename:     eventName + '_Ticket.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
        };
        html2pdf().from(element).set(opt).save();
}
</script>

@endsection