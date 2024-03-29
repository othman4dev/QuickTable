@extends('layouts.app')
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
                    <th>Location</th>
                    <th>Price</th>
                    <th>Spots</th>
                    <th>Ticket</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->time }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->price }} $</td>
                    <td>{{ $event->spots }}</td>
                    <td>
                        @if ($event->status == 0)
                            <p>Pending</p>
                        @elseif ($event->status == 1)
                            <a class="action-btn" style="width: 150px" onclick="showTicket(this,`{{ $event->title }}`,`{{ $event->category }}`,`{{ $event->date }}`,`{{ $event->time }}`,`{{ $event->price }}`,`{{ $event->token }}`,`{{ $event->location }}`,`{{ $event->image }}`)">See Ticket<i class="bi bi-ticket-detailed"></i></a>
                        @endif
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
            <div class="icon-wrapper close" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'">
                <i class="bi bi-x-lg" style="cursor: pointer" ></i>
            </div>          
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

        <div class="ticket" id="ticket">
            <div class="left">
                <div class="image">
                    <p class="admit-one">
                        <span>EVENTO</span>
                        <span>EVENTO</span>
                        <span>EVENTO</span>
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
                        <h2 id="event_category" style="font-size:100%;">EVENTO</h2>
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
                    <span>EVENTO</span>
                    <span>EVENTO</span>
                    <span>EVENTO</span>
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
    $(document).ready( function () {
        $('#myTable').DataTable();
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