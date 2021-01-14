<section class="content">
    <header class="content__title">
        <h1>Dashboard</h1>
        <small>Selamat Datang</small>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Stok Barang kurang</h4>

                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <td>Produk</td>
                                <td>Stok</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>xxx</td>
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
						<!-- <canvas id="line-chart"></canvas> -->
						menggunakan bar chart
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
						menggunakan bar chart
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer hidden-xs-down">
        <p>©  <?php echo date("Y");?>.</p>
    </footer>
</section>
<script>
$(document).ready(function() {
    setTimeout(function() {
        <?php if(isset($penjualan)) { ?>
        new Chart(document.getElementById("line-chart"), {
            type: 'bar',
            data: {
                labels: [
                    'wkwk'
                ],
                datasets: [
                 '10'   
                ]
            },
            options: {
                title: {
                    display: true,
                    text: ''
                }
            }
        });
        <?php } ?>
    }, 1500)
});

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
</script>