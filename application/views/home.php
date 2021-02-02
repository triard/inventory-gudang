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
                    <a href="<?php echo base_url('user/') ?>">
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
                    <a href="<?php echo base_url('input/') ?>">
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
                    <a href="<?php echo base_url('items/') ?>">
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
                        <div class="col-4">
                            <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('home/');?>"
                                method="post">
                                <div class="form-group">
                                    <input class="form-control" type="date" name="start"
                                        value="<?php echo $this->input->post('start') ?>" required>
                                </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input class="form-control" type="date" name="end"
                                    value="<?php echo $this->input->post('end') ?>" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                    class="glyphicon glyphicon-search"></i>
                                <i class="fas fa-filter"></i> Filter</button>
                            </form>
                        </div>
                    </div>
                    <!-- <div>
                    <a href="<?php echo site_url('home/');?>" class="btn btn-success">Bulan</a>
                    </div> -->
                    <table class="table table-sm table-striped">
                        <thead>
                            <?php
                            if($inputFilter == null && $this->input->post('start') != null){ 
                                
                            }else if($inputFilter != null ){
                                foreach ($inputFilter as $mi){ 
    
                                    $input_item[] = $mi->nama_item;
                                    $jml_qty_input[] = (float) $mi->total_stok;	
                                
                                    echo "<canvas id='BarChartInputs' width='90' height='36' 
                                    style='margin-bottom: -25px;'></canvas>'";
    
                                } } 
                            else{
                                    foreach ($mostInput as $mi){ 
                                    $input_item[] = $mi->nama_item;
                                    $jml_qty_input[] = (float) $mi->total_stok;	                                
                                    echo "<canvas id='BarChartInputs' width='90' height='36' 
                                    style='margin-bottom: -25px;'></canvas>'";
                                } 
                                } ?>
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
                    <div class="row">
                        <div class="col-4">
                            <form class="navbar-form navbar-left" role="search" action="<?php echo site_url('home/');?>"
                                method="post">
                                <div class="form-group">
                                    <input class="form-control" type="date" name="startOut"
                                        value="<?php echo $this->input->post('startOut') ?>" required>
                                </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input class="form-control" type="date" name="endOut"
                                    value="<?php echo $this->input->post('endOut') ?>" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                    class="glyphicon glyphicon-search"></i>
                                <i class="fas fa-filter"></i> Filter</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-sm table-striped">
                        <thead>
                            <?php
                            if($outputFilter == null && $this->input->post('startOut') != null){ 
                                
                            }else if($outputFilter != null ){
                                foreach ($outputFilter as $mo){ 
    
                                    $output_item[] = $mo->nama_item;
                                    $jml_qty_output[] = (float) $mo->total_stok;		
                                
                                    echo "<canvas id='BarChartOutputs' width='90' height='36' 
                                    style='margin-bottom: -25px;'></canvas>'";
    
                                } }else{
                                foreach ($mostOutput as $mo){ 
                                    $output_item[] = $mo->nama_item;
                                    $jml_qty_output[] = (float) $mo->total_stok;	
                                echo "<canvas id='BarChartOutputs' width='90' height='36' 
                                 style='margin-bottom: -25px;'></canvas>'";
                                } 
                                } ?>
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
<?php if($limit !=null){ ?>
<div id="modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
            <h4 class="modal-title text-white mb-1">Stok Hampir Habis</h4>
                <button type="button" class="close text-white mb-3" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</button>  
            </div>
            <div class="modal-body">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <td width="50">No</td>
                            <td>Produk</td>
                            <td>Jenis</td>
                            <td>Netto</td>
                            <td>Merk</td>
                            <td width="150">Minimal Stok</td>
                            <td width="100">Stok</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $no=1;
                         foreach ($limit as $l) { ?>
                        <tr>
                            <td><?php echo $no; ?>.</td>
                            <td><?php echo $l->nama_item ?></td>
                            <td><?php echo $l->jenis ?></td>
                            <td><?php echo $l->netto ?></td>
                            <td><?php echo $l->merk ?></td>
                            <td><?php echo $l->stok_limit ?></td>
                            <td><?php echo $l->stok?></td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php }else{} ?>
</div>

<script type="text/javascript">
$(window).load(function() {
    $('#modal').modal('show');
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
        labels: <?php echo json_encode($input_item);?>,
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
        labels: <?php echo json_encode($output_item);?>,
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