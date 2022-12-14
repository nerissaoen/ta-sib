<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo !empty($title) ? $title : null ?></h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="pendaftar"></div>
        </div>
    </div>
</main>
<script>
getGrafikColumn('pendaftar', <?= $grafik ?>, 'Grafik Pendaftar Berdasarkan Bank');

function getGrafikColumn(selector, data, title) {

    Highcharts.chart(selector, {
        chart: {
            type: 'column'
        },
        title: {
            text: title
        },
        xAxis: {
            categories: ['BCA', 'Mandiri', 'BRI', 'BNI']
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Sudah',
            data: [143, 142, 143, 130]
        }, {
            name: 'Belum',
            data: [20, 29, 19, 22]
        }]
    });
}
</script>