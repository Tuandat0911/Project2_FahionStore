@php use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Home', 'key' => 'statistics'])
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- AREA CHART -->

                        <!-- /.card -->

                        <!-- DONUT CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Number of Products</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- PIE CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Number of Users</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">
                        <!-- BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Monthly Revenue</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- STACKED BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Daily revenue</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            @php
                // Truy vấn cơ sở dữ liệu để lấy số lượng sản phẩm theo category_id
                $productCounts = \App\Models\Product::join('categories', 'products.category_id', '=', 'categories.id')
                                    ->select('categories.name', \Illuminate\Support\Facades\DB::raw('COUNT(products.id) as count'))
                                    ->groupBy('categories.name')
                                    ->pluck('count', 'categories.name')
                                    ->toArray();

                $categoryLabels = array_keys($productCounts);
                $productCounts = array_values($productCounts);
            @endphp

            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: {!! json_encode($categoryLabels) !!},
                datasets: [
                    {
                        data: {!! json_encode($productCounts) !!},
                        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#ff0000', '#a3ffb4', '#7a49a5', '#e23a08'],
                    }
                ]
            };
            var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            @php
                $rolesData = \App\Models\Role::join('role_user', 'roles.id', '=', 'role_user.role_id')
                        ->select('roles.name', \Illuminate\Support\Facades\DB::raw('COUNT(role_user.role_id) as count'))
                        ->groupBy('roles.name')
                        ->pluck('count', 'roles.name')
                        ->toArray();

                $roleLabels = array_keys($rolesData);
                $userCounts = array_values($rolesData);
            @endphp



        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieData = {
            labels: @json($roleLabels),
            datasets: [{
                data: @json($userCounts),
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
            }]
        };

        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };

        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });


    //-------------
            //- BAR CHART -
            //-------------
            @php
                // Thực hiện truy vấn SQL
                $revenues = DB::table('orders')
                    ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('SUM(total_amount) as total_revenue'))
                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
                    ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), 'desc')
                    ->limit(5)
                    ->get()
                    ->sortBy('month'); // Sắp xếp lại theo tháng tăng dần

                // Chuyển đổi dữ liệu thành định dạng cho Chart.js
                $months = [];
                $totals = [];

                foreach ($revenues as $revenue) {
                    $months[] = $revenue->month;
                    $totals[] = $revenue->total_revenue;
                }
            @endphp

            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = {
                labels: @json($months),
                datasets: [{
                    label: 'Total Revenue',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: @json($totals)
                }]
            };

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            };

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            @php
                // Thực hiện truy vấn SQL
                $revenues = DB::table('orders')
                    ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day"), DB::raw('SUM(total_amount) as total_revenue'))
                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                    ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), 'desc')
                    ->limit(5)
                    ->get()
                    ->sortBy('day'); // Sắp xếp lại theo ngày tăng dần

                // Chuyển đổi dữ liệu thành định dạng cho Chart.js
                $days = [];
                $totals = [];

                foreach ($revenues as $revenue) {
                    $days[] = $revenue->day;
                    $totals[] = $revenue->total_revenue;
                }
            @endphp

            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d');
            var stackedBarChartData = {
                labels: @json($days),
                datasets: [{
                    label: 'Total Revenue',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: @json($totals)
                }]
            };

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            };

            new Chart(stackedBarChartCanvas, {
                type: 'bar', // Đảm bảo rằng loại biểu đồ là stacked bar chart
                data: stackedBarChartData,
                options: stackedBarChartOptions
            });
        })
    </script>
@endsection


