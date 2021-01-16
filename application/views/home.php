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

                        <div class="col-8 text-white">Total User<h3 class="text-white"><?php echo $user ?></h3>
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

                        <div class="col-8 text-white">Total Supplier<h3 class="text-white"><?php echo $supplier ?></h3>
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

                        <div class="col-8 text-white">Total Barang<h3 class="text-white"><?php echo $barang ?></h3>
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
                                <td width="50">No</td>
                                <td>Produk</td>
                                <td width="150">Minimal Stok</td>
                                <td width="100">Stok</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                         $no=1;
                         foreach ($limit as $l) { ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $l->nama_item ?></td>
                                <td><?php echo $l->stok_limit ?></td>
                                <td><?php echo $l->stok?></td>
                            </tr>
                            <?php $no++; } ?>
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
                    <div class="row">
                        <!-- <div class="col-4">
                            <form class="navbar-form navbar-left" role="search"
                                action="<?php echo site_url('home/');?>" method="post">
                                <div class="form-group">
                                    <input type="date" name="start" value="<?php echo $this->input->post('start') ?>">
                                </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="date" name="end" value="<?php echo $this->input->post('start') ?>">
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                    class="glyphicon glyphicon-search"></i>
                                    <i class="fas fa-filter"></i> Filter</button>
                            </form>
                        </div> -->
                    </div>
                    <table class="table table-sm table-striped">
                        <thead>
                        <?php
                            // if($inputFilter == null && $mostInput != null){ 
                                
                                foreach ($mostInput as $mi){ 

                                    $name_item[] = $mi->nama_item;
                                    $jml_qty_input[] = (float) $mi->total_stok;	
                                
                                echo "<canvas id='BarChartInputs' width='90' height='36' 
                                 style='margin-bottom: -25px;'></canvas>'";
                                } 
                            //  }else if($inputFilter != null && $mostInput != null){
                            // foreach ($inputFilter as $mi){ 

                            //     $name_item[] = $mi->nama_item;
            			    //     $jml_qty_input[] = (float) $mi->total_stok;	
                            
                            //     echo "<canvas id='BarChartInputs' width='90' height='36' 
                            //     style='margin-bottom: -25px;'></canvas>'";

                            // } }else{
                            //     echo "maaf kosong";
 

                            // } ?>
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
                        <?php
                            // if($inputFilter == null && $mostInput != null){ 
                                
                                foreach ($mostOutput as $mo){ 

                                    $name_item[] = $mo->nama_item;
                                    $jml_qty_output[] = (float) $mo->total_stok;	
                                
                                echo "<canvas id='BarChartOutputs' width='90' height='36' 
                                 style='margin-bottom: -25px;'></canvas>'";
                                } 
                                ?>
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
        labels: <?php echo json_encode($name_item);?>,
        datasets: [{
            label: "Total Stok",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: <?php echo json_encode($jml_qty_input);?>,
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
                    max: 1000,
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
        labels: <?php echo json_encode($name_item);?>,
        datasets: [{
            label: "Total Stok",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: <?php echo json_encode($jml_qty_output);?>,
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
                    max: 1000,
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