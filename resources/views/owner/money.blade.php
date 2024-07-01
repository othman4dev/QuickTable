@extends('layouts.owner')
@section('content')
<section class="all">
    <section class="table-heading">
        <h1>Money Manager</h1>
    </section>
    <section class="table-events">
        <div class="charts">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Orders</th>
                        <th>Money Made</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->price }} $</td>
                        <td>
                            @if ($item->total_quantity == null)
                                _
                            @else
                                {{ $item->total_quantity }}
                            @endif
                        </td>
                        <td>{{ $item->reservation_count * $item->total_quantity }}</td>
                        <td>{{ $item->price * $item->reservation_count * $item->total_quantity}} $</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="chart-container">
                <h1 class="chart-title">Last week reservations</h1>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </section>
</section>
<script>
    const ctx = document.getElementById('myChart');
    let today = new Date();
    let lastSevenDay = [];
    let reservations = [
        @foreach ($weekstats as $daystat)
            '{{ $daystat }}',
        @endforeach
    ];
    for (let i = 0; i < 7; i++) {
        let day = new Date(today.getFullYear(), today.getMonth(), today.getDate() - i);
        let ddmm = day.getDate() + ' / ' + (day.getMonth() + 1);
        lastSevenDay.push(ddmm);
    }
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [ lastSevenDay[6], lastSevenDay[5], lastSevenDay[4], lastSevenDay[3], lastSevenDay[2], 'Yesterday', 'Today' ],
        datasets: [{
          label: 'Reservations',
          data: [ reservations[6], reservations[5], reservations[4], reservations[3], reservations[2], reservations[1], reservations[0] ],
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(1, 85, 255, 0.688)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(1, 85, 255)'
            ],
          borderWidth: 1
        }]
        
      },
      
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            }
          }
        },
        animations: {
          tension: {
            duration: 1000,
            easing: 'linear',
            from: 1,
            to: 0,
            loop: true
          }
        }
    }});
    $(document).ready(function() {
        $('#myTable').DataTable({
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "10%", "targets": 1 },
                { "width": "20%", "targets": 2 },
                { "width": "10%", "targets": 3 }
            ]
        });
    });
</script>
@endsection