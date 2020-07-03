@extends('penjualan.template.template', [
    'elementActive' => 'dashboard'
])

@section('judul', 'dashboard')

@section('halaman', 'Dashboard')

@section('menu','Dashboard')
    

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i style="color:#fbc962 "class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Pelanggan</p>
                                    <p class="card-title">{{$pelanggan}}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                        <i class="fa fa-clock-o"></i> Data saat ini                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-address-card " style='color:#7cd6a4'></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Sales</p>
                                    <p class="card-title">{{$penjual}}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                        <i class="fa fa-clock-o"></i> Data saat ini                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i style="color:#f29b79 " class="fa fa-archive"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Barang</p>
                                    <p class="card-title">{{$barang}}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Data saat ini
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i style="color:#81d9dc " >Rp</i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Pemasukan Kas</p>
                                    <p class="card-title">{{$pendapatan}}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                        <i class="fa fa-clock-o"></i> Data saat ini                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        @if (auth()->user()->role == 'penjualan')
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Status Pemesanan</h5>
                        <p class="card-category">Data Pemesanan Terakhir </p>
                    </div>
                    <div class="card-body ">
                        <canvas id="chartPemesanan"></canvas>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-gray"></i> Baru
                            <i class="fa fa-circle text-primary"></i> Terkirim Sebagian
                            <i class="fa fa-circle text-warning"></i> Terkirim
                            <i class="fa fa-circle text-danger"></i> Selesai
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> {{$time}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Status Pengiriman</h5>
                        <p class="card-category">Data Pengiriman Terakhir </p>
                    </div>
                    <div class="card-body ">
                        <canvas id="chartPengiriman"></canvas>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-gray"></i> Dalam Pengiriman
                            <i class="fa fa-circle text-primary"></i> Terkirim
                            <i class="fa fa-circle text-warning"></i> Sudah Posting 
                            <i class="fa fa-circle text-danger"></i> Selesai
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> {{$time}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if (auth()->user()->role == 'piutang' || auth()->user()->role == 'penjualan' || auth()->user()->role == 'retur')

            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Status Penjualan</h5>
                        <p class="card-category">Data penjualan terakhir </p>
                    </div>
                    <div class="card-body ">
                        <canvas id="chartPenjualan"></canvas>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-gray"></i> Piutang
                            <i class="fa fa-circle text-primary"></i> Lunas
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> {{$time}}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if (auth()->user()->role == 'piutang' || auth()->user()->role == 'retur')

            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Status Retur Penjualan</h5>
                        <p class="card-category">Data Retur terakhir </p>
                    </div>
                    <div class="card-body ">
                        <canvas id="chartRetur"></canvas>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-gray"></i> Belum Posting
                            <i class="fa fa-circle text-primary"></i> Sudah Posting
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> {{$time}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if (auth()->user()->role == 'piutang')

            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Status Piutang Pelanggan</h5>
                        <p class="card-category">Data Piutang terakhir </p>
                    </div>
                    <div class="card-body ">
                        <canvas id="chartPiutang"></canvas>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-gray"></i> Belum Lunas
                            <i class="fa fa-circle text-primary"></i> Sudah Lunas
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> {{$time}}
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        pemesanandata=[{{$pbaru}},{{$pterkirims}},{{$pterkirim}},{{$pselesai}}]
        ctx = document.getElementById('chartPemesanan').getContext("2d");
        ydata = [{{$flunas}},{{$fpiutang}}]
        myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Baru', 'Terkirim Sebagian', 'Terkirim', 'Selesai'],
            datasets: [{
            label: "Emails",
            pointRadius: 0,
            pointHoverRadius: 0,
            backgroundColor: [
                '#e3e3e3',
                '#4acccd',
                '#fcc468',
                '#ef8157'
            ],
            borderWidth: 0,
            data: pemesanandata
            }]
        },

        options: {

            legend: {
            display: false
            },

            pieceLabel: {
            render: 'percentage',
            fontColor: ['white'],
            precision: 2
            },

            tooltips: {
            enabled: true
            },

            scales: {
            yAxes: [{

                ticks: {
                display: false
                },
                gridLines: {
                drawBorder: false,
                zeroLineColor: "transparent",
                color: 'rgba(255,255,255,0.05)'
                }

            }],

            xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                drawBorder: false,
                color: 'rgba(255,255,255,0.1)',
                zeroLineColor: "transparent"
                },
                ticks: {
                display: false,
                }
            }]
            },
        }
        });
    </script>
    <script>
        pengiriman=[{{$pdalam}},{{$prterkirim}},{{$pposting}},{{$prselesai}}]
        ctx = document.getElementById('chartPengiriman').getContext("2d");
        myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Dalam Pengiriman', 'Terkirim', 'Sudah Posting', 'Selesai'],
            datasets: [{
            label: "Emails",
            pointRadius: 0,
            pointHoverRadius: 0,
            backgroundColor: [
                '#e3e3e3',
                '#4acccd',
                '#fcc468',
                '#ef8157'
            ],
            borderWidth: 0,
            data: pengiriman
            }]
        },

        options: {

            legend: {
            display: false
            },

            pieceLabel: {
            render: 'percentage',
            fontColor: ['white'],
            precision: 2
            },

            tooltips: {
            enabled: true
            },

            scales: {
            yAxes: [{

                ticks: {
                display: false
                },
                gridLines: {
                drawBorder: false,
                zeroLineColor: "transparent",
                color: 'rgba(255,255,255,0.05)'
                }

            }],

            xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                drawBorder: false,
                color: 'rgba(255,255,255,0.1)',
                zeroLineColor: "transparent"
                },
                ticks: {
                display: false,
                }
            }]
            },
        }
        });
    </script>
    <script>
        ydata = [{{$flunas}},{{$fpiutang}}]

        ctx = document.getElementById('chartPenjualan').getContext("2d");
        ydata = [{{$flunas}},{{$fpiutang}}]
        myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Lunas', 'Piutang'],
            datasets: [{
            label: "Emails",
            pointRadius: 0,
            pointHoverRadius: 0,
            backgroundColor: [
                '#e3e3e3',
                '#4acccd',
                '#fcc468',
                '#ef8157'
            ],
            borderWidth: 0,
            data: ydata
            }]
        },

        options: {

            legend: {
            display: false
            },

            pieceLabel: {
            render: 'percentage',
            fontColor: ['white'],
            precision: 2
            },

            tooltips: {
            enabled: true
            },

            scales: {
            yAxes: [{

                ticks: {
                display: false
                },
                gridLines: {
                drawBorder: false,
                zeroLineColor: "transparent",
                color: 'rgba(255,255,255,0.05)'
                }

            }],

            xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                drawBorder: false,
                color: 'rgba(255,255,255,0.1)',
                zeroLineColor: "transparent"
                },
                ticks: {
                display: false,
                }
            }]
            },
        }
        });
    </script>
    
    <script>
        rdata = [{{$rbelum}},{{$rsudah}}]

        ctx = document.getElementById('chartRetur').getContext("2d");
        myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Belum Posting', 'Sudah Posting'],
            datasets: [{
            label: "Emails",
            pointRadius: 0,
            pointHoverRadius: 0,
            backgroundColor: [
                '#e3e3e3',
                '#4acccd',
                '#fcc468',
                '#ef8157'
            ],
            borderWidth: 0,
            data: rdata
            }]
        },

        options: {

            legend: {
            display: false
            },

            pieceLabel: {
            render: 'percentage',
            fontColor: ['white'],
            precision: 2
            },

            tooltips: {
            enabled: true
            },

            scales: {
            yAxes: [{

                ticks: {
                display: false
                },
                gridLines: {
                drawBorder: false,
                zeroLineColor: "transparent",
                color: 'rgba(255,255,255,0.05)'
                }

            }],

            xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                drawBorder: false,
                color: 'rgba(255,255,255,0.1)',
                zeroLineColor: "transparent"
                },
                ticks: {
                display: false,
                }
            }]
            },
        }
        });
    </script>
    <script>
        pdata = [{{$pbelum}},{{$psudah}}]

        ctx = document.getElementById('chartPiutang').getContext("2d");
        myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Belum Lunas', 'Sudah Lunas'],
            datasets: [{
            label: "Emails",
            pointRadius: 0,
            pointHoverRadius: 0,
            backgroundColor: [
                '#e3e3e3',
                '#4acccd',
                '#fcc468',
                '#ef8157'
            ],
            borderWidth: 0,
            data: pdata
            }]
        },

        options: {

            legend: {
            display: false
            },

            pieceLabel: {
            render: 'percentage',
            fontColor: ['white'],
            precision: 2
            },

            tooltips: {
            enabled: true
            },

            scales: {
            yAxes: [{

                ticks: {
                display: false
                },
                gridLines: {
                drawBorder: false,
                zeroLineColor: "transparent",
                color: 'rgba(255,255,255,0.05)'
                }

            }],

            xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                drawBorder: false,
                color: 'rgba(255,255,255,0.1)',
                zeroLineColor: "transparent"
                },
                ticks: {
                display: false,
                }
            }]
            },
        }
        });
    </script>
@endpush