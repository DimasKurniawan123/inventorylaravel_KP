@extends('layout.layout')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <canvas id="masuk"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <canvas id="keluar"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Get the canvas element
  var ctx = document.getElementById('masuk').getContext('2d'); 

  var masuk = @json($masuk); // Use Blade directive to convert PHP array to JSON
  var tgl = @json($tgl_masuk); // Use Blade directive to convert PHP array to JSON
  // Create the chart
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: tgl,
      datasets: [{
        label: 'Barang Masuk',
        data: masuk,
        borderColor: 'rgba(75, 192, 192, 1)', // Customize the line color
        fill: false // Remove the area below the line
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true // Start the y-axis from zero
        }
      }
    }
  });
</script>
<script>
  // Get the canvas element
  var ctx = document.getElementById('keluar').getContext('2d'); 

  var masuk = @json($keluar); // Use Blade directive to convert PHP array to JSON
  var tgl = @json($tglkeluar); // Use Blade directive to convert PHP array to JSON
  // Create the chart
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: tgl,
      datasets: [{
        label: 'Barang Keluar',
        data: masuk,
        borderColor: 'rgba(75, 192, 192, 1)', // Customize the line color
        fill: false // Remove the area below the line
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true // Start the y-axis from zero
        }
      }
    }
  });
</script>
@endsection
