@extends('layouts.admin')
@section('content')
<div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4>Dashboard </h4>
                </div>

           
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Claims</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalReclamations) }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Open Claim</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($openReclamations) }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Closed Claim</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ number_format($closedReclamations) }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-envelope   fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

         
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($user) }}   </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
    <div>
   <div class="row">
      <div class="col-sm-6"> <div id="piechart" style="width: 494px; height: 300px;"></div></div>
       <div class="col-sm-6"><canvas id="myChart" width="490" height="300"></canvas></div></div>
    </div>
   
    
</div>
@endsection
@section('scripts')
@parent
<script>
google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Total ', 'l'],
      ['Total Claim', <?php echo $totalReclamations ?>],
      ['Opened Claim', <?php echo  $openReclamations ?>],
      ['Closed Claim', <?php echo $closedReclamations ?>]
    ]);

    var options = {
      title:  'Daily Activities'
     
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
  var ctx = document.getElementById('myChart');
  ctx.style.backgroundColor = 'rgba(255,255,255,255)';
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        
        labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'],
        datasets: [{
            label: 'Number Of Users',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>

@endsection
