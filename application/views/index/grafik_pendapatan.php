<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo !empty($title) ? $title : null ?></h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="pendaftar"></div>
        </div>
    </div>
</main>
<script>
    getGrafikPie('pendaftar', <?= $data ?>, 'Grafik Pendapatan');
    function getGrafikPie(selector, data, title, ) {
        var bca = 24450000;
        var mandiri = 25650000;
        var bni = 22800000;
        var bri = 24300000;
        
        Highcharts.chart(selector, {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: title
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.jumlah:.1f} Hasil Pendapatan </b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Pendapatan',
                colorByPoint: true,
                data: [{
                    name: 'BCA',
                    jumlah: bca,
                    y: Math.floor(Math.random() * 30) + 1,
                }, {
                    name: 'Mandiri',
                    jumlah: mandiri,
                    y: Math.floor(Math.random() * 30) + 1,
                }, {
                    name: 'BNI',
                    jumlah: bni,
                    y: Math.floor(Math.random() * 30) + 1,
                }, {
                    name: 'BRI',
                    jumlah: bri,
                    y: Math.floor(Math.random() * 30) + 1,
                }],
            }]
        });

        // Highcharts.chart(selector, {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: title
        //     },
        //     subtitle: {
        //         text: subtitle
        //     },
        //     xAxis: {
        //         categories: categories,
        //         crosshair: true
        //     },
        //     yAxis: {
        //         min: 0,
        //         title: {
        //             text: 'Pendapatan'
        //         }
        //     },
        //     tooltip: {
        //         headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        //         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        //         '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        //         footerFormat: '</table>',
        //         shared: true,
        //         useHTML: true
        //     },
        //     plotOptions: {
        //         column: {
        //             pointPadding: 0.2,
        //             borderWidth: 0
        //         }
        //     },
        //     series: data,
        //     credits: {
        //         enabled : false 
        //     }
        // });
    }
</script>