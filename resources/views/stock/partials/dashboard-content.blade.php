<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pagehader  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h3 class="mb-2">Stock Management Overall Summary </h3>
                <p class="pageheader-text">Lorem ipsum dolor sit ametllam fermentum ipsum eu porta consectetur
                    adipiscing elit.Nullam vehicula nulla ut egestas rhoncus.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Stock Management Overall Summary</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- pagehader  -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- metric -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Total Barang</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1 text-primary">{{count($barangs)}}</h1>
                    </div>

                </div>
                <div id="sparkline-1">
                </div>
            </div>
        </div>
        <!-- /. metric -->
        <!-- metric -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Gudang</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1 text-primary">{{count($gudangs)}}</h1>
                    </div>
                </div>
                <div id="sparkline-2">
                </div>
            </div>
        </div>
        <!-- /. metric -->
        <!-- metric -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Nilai Barang di Gudang</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1 text-primary">0</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-danger">
                    </div>
                </div>
                <div id="sparkline-3">
                </div>
            </div>
        </div>
        <!-- /. metric -->
        <!-- metric -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Total Transaksi</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1 text-primary">{{$totalTransaksi}}</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success">
                    </div>
                </div>
                <div id="sparkline-4"></div>
            </div>
        </div>
        <!-- /. metric -->
    </div>
    <!-- ============================================================== -->
    <!-- revenue  -->
    <!-- ============================================================== -->
    <div class="row">

        <!-- ============================================================== -->
        <!-- end reveune  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- total sale  -->
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Total Sale</h5>
                <div class="card-body">
                    <canvas id="total-sale" width="220" height="155"></canvas>
                    <div class="chart-widget-list">
                        <p>
                            <span class="fa-xs text-primary mr-1 legend-title"><i
                                    class="fa fa-fw fa-square-full"></i></span><span class="legend-text"> Direct</span>
                            <span class="float-right">$300.56</span>
                        </p>
                        <p>
                            <span class="fa-xs text-secondary mr-1 legend-title"><i
                                    class="fa fa-fw fa-square-full"></i></span>
                            <span class="legend-text">Affilliate</span>
                            <span class="float-right">$135.18</span>
                        </p>
                        <p>
                            <span class="fa-xs text-brand mr-1 legend-title"><i
                                    class="fa fa-fw fa-square-full"></i></span> <span
                                class="legend-text">Sponsored</span>
                            <span class="float-right">$48.96</span>
                        </p>
                        <p class="mb-0">
                            <span class="fa-xs text-info mr-1 legend-title"><i
                                    class="fa fa-fw fa-square-full"></i></span> <span class="legend-text"> E-mail</span>
                            <span class="float-right">$154.02</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Top Selling Products</h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Image</th>
                                    <th class="border-0">Product Name</th>
                                    <th class="border-0">Product Id</th>
                                    <th class="border-0">Quantity</th>
                                    <th class="border-0">Price</th>
                                    <th class="border-0">Order Time</th>
                                    <th class="border-0">Customer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="m-r-10"><img src="{{asset('img/stock/product-pic.jpg')}}" alt="user"
                                                class="rounded" width="45"></div>
                                    </td>
                                    <td>Product #1 </td>
                                    <td>id000001 </td>
                                    <td>20</td>
                                    <td>$80.00</td>
                                    <td>27-08-2018 01:22:12</td>
                                    <td>Patricia J. King </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="m-r-10"><img src="{{asset('img/stock/product-pic-2.jpg')}}"
                                                alt="user" class="rounded" width="45"></div>
                                    </td>
                                    <td>Product #2 </td>
                                    <td>id000002 </td>
                                    <td>12</td>
                                    <td>$180.00</td>
                                    <td>25-08-2018 21:12:56</td>
                                    <td>Rachel J. Wicker </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="m-r-10"><img src="{{asset('img/stock/product-pic-3.jpg')}}"
                                                alt="user" class="rounded" width="45"></div>
                                    </td>
                                    <td>Product #3 </td>
                                    <td>id000003 </td>
                                    <td>23</td>
                                    <td>$820.00</td>
                                    <td>24-08-2018 14:12:77</td>
                                    <td>Michael K. Ledford </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <div class="m-r-10"><img src="{{asset('img/stock/product-pic-4.jpg')}}"
                                                alt="user" class="rounded" width="45"></div>
                                    </td>
                                    <td>Product #4 </td>
                                    <td>id000004 </td>
                                    <td>34</td>
                                    <td>$340.00</td>
                                    <td>23-08-2018 09:12:35</td>
                                    <td>Michael K. Ledford </td>
                                </tr>
                                <tr>
                                    <td colspan="8"><a href="#" class="btn btn-outline-light float-right">View
                                            Details</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end total sale  -->
        <!-- ============================================================== -->
    </div>


</div>