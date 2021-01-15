<section class="content">
        <div class="card">
            <div class="card-header" style="background-color: #ecf0f1;">
                <h1>Dashboard</h1>
                <small>Selamat Datang</small>
            </div>
        </div>
    <?php if($this->session->userdata('level') == 'superadmin') { ?>
    <div class="row">
        <div class="col-md-3">
            <div class="card rounded">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-4 p-3 text-center text-white"><i class="fas fa-user  fa-3x"></i></div>

                        <div class="col-8 text-white">Total User<h3 class="text-white">10</h3>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                <a href="#">
                    <div class="float-left">
                        <h6>Lihat Detail</h6>
                    </div>
                    <div class="float-right"><i class="fas fa-chevron-right"></i></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card rounded">
                <div class="card-header bg-warning">
                    <div class="row">
                        <div class="col-4 p-3 text-center text-white"><i class="fas fa-people-carry fa-3x"></i></div>

                        <div class="col-8 text-white">Total Supplier<h3 class="text-white">20</h3>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <a href="#">
                    <div class="float-left">
                        <h6>Lihat Detail</h6>
                    </div>
                    <div class="float-right"><i class="fas fa-chevron-right"></i></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card rounded">
                <div class="card-header bg-success">
                    <div class="row">
                        <div class="col-4 p-3 text-center text-white"><i class="fas fa-boxes fa-3x"></i></div>

                        <div class="col-8 text-white">Total Barang<h3 class="text-white">40</h3>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                <a href="#">
                    <div class="float-left">
                        <h6>Lihat Detail</h6>
                    </div>
                    <div class="float-right"><i class="fas fa-chevron-right"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Stok Barang kurang</h4>

                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <td>Produk</td>
                                <td width="150">Minimal Stok</td>
                                <td width="100">Stok</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>xxx</td>
                                <td>100</td>
                                <td>80</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Barang Masuk</h4>
                    <table class="table table-sm table-striped">
                        <thead>
                            <canvas id="BarChartInputs"></canvas>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Barang Keluar</h4>
                    <table class="table table-sm table-striped">
                        <thead>
                            <canvas id="BarChartOutputs"></canvas>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer hidden-xs-down">
        <p>© <?php echo date("Y");?>.</p>
    </footer>
</section>
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("BarChartInputs");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
            label: "Revenue",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: [4215, 5312, 6251, 7841, 9821, 14984],
        }],
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'month'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 6
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 15000,
                    maxTicksLimit: 5
                },
                gridLines: {
                    display: true
                }
            }],
        },
        legend: {
            display: false
        }
    }
});
</script>
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("BarChartOutputs");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
            label: "Revenue",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: [4215, 5312, 6251, 7841, 9821, 14984],
        }],
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'month'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 6
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 15000,
                    maxTicksLimit: 5
                },
                gridLines: {
                    display: true
                }
            }],
        },
        legend: {
            display: false
        }
    }
});
</script>