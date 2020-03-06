<style>
    #weatherWidget .currentDesc {
        color: #ffffff !important;
    }

    .traffic-chart {
        min-height: 335px;
    }

    #flotPie1 {
        height: 150px;
    }

    #flotPie1 td {
        padding: 3px;
    }

    #flotPie1 table {
        top: 20px !important;
        right: -10px !important;
    }

    .chart-container {
        display: table;
        min-width: 270px;
        text-align: left;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    #flotLine5 {
        height: 105px;
    }

    #flotBarChart {
        height: 150px;
    }

    #cellPaiChart {
        height: 160px;
    }
</style>
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-news-paper"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $penerimaan['total'] ?></span></div>
                                    <div class="stat-heading">Penerimaan Material</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $pengeluaran['total'] ?></span></div>
                                    <div class="stat-heading">Pengeluaran Material</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-shuffle"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $antrian['total'] ?></span></div>
                                    <div class="stat-heading">Total Antrian Material</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="pe-7s-users"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">2986</span></div>
                                        <div class="stat-heading">Clients</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
        </div>
        <!-- /Widgets -->
        <!--  Traffic  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Traffic </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <!-- <canvas id="TrafficChart"></canvas>   -->
                                <!-- <div id="traffic-chart" class="traffic-chart"></div> -->
                                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>

                    </div> <!-- /.row -->
                    <div class="card-body"></div>
                </div>
            </div><!-- /# column -->
        </div>
        <!--  /Traffic -->
        <div class="clearfix"></div>

        <!-- /#add-category -->
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
<div class="clearfix"></div>
<script src="<?php echo base_url('assets/js/main.js') ?>"></script>
<script>
    $(document).ready(function() {
        var now = new Date().getFullYear();
        var receipt_chart = [];
        var product_chart = [];
        var get_receipt;
        var get_product;
        var tes = [
            83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3
        ];

        get_receipt = function() {
            var url = "<?php echo base_url('receipt/Allmonthly') ?>";
            return $.ajax({
                url: url,
                dataType: "json",
                type: "GET",
            });
        }

        get_product = function() {
            var url = "<?php echo base_url('productbill/Allmonthly') ?>";
            return $.ajax({
                url: url,
                dataType: "json",
                type: "GET",
            });
        }
        // get_product()
        //     .done(function(res) {
        //         $.each(res, function(index, items) {
        //             product_chart.push(parseInt(items.permonth));
        //         })
        //         console.log(product_chart);
        //     })

        get_receipt()
            .done(function(response) {
                $.each(response, function(index, item) {
                    receipt_chart.push(parseInt(item.permonth));
                })
                console.log(receipt_chart);
                get_product()
                    .done(function(res) {
                        $.each(res, function(index, item) {
                            product_chart.push(parseInt(item.permonth));
                        })
                        Highcharts.chart('container', {
                            chart: {
                                type: 'column',
                            },
                            title: {
                                text: 'Penerimaan Bahan dan Pengeluaran Bahan'
                            },
                            subtitle: {
                                text: 'Tahun (' + now + ')'
                            },
                            credits: {
                                enabled: false
                            },
                            xAxis: {
                                categories: [
                                    'Jan',
                                    'Feb',
                                    'Mar',
                                    'Apr',
                                    'May',
                                    'Jun',
                                    'Jul',
                                    'Aug',
                                    'Sep',
                                    'Oct',
                                    'Nov',
                                    'Dec'
                                ],
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'transaksi'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.0f} transaksi</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series: [{
                                name: 'Penerimaan',
                                data: receipt_chart

                            }, {
                                name: 'Pengeluaran',
                                data: product_chart

                            }]
                        });
                    })
            })
            .fail(function() {
                alert('Failed to fetch data')
            });
    });
</script>