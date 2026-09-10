<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Include Bootstrap & Custom CSS for Laravel View -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Metric Stat Cards -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-hover stat-card-accent-primary mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-custom small fw-bold text-uppercase">TOTAL SISWA</span>
                                <div class="avatar-icon-box avatar-icon-primary"><i class="ti ti-users"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">2,840</div>
                            <div class="small text-success fw-semibold"><i class="ti ti-arrow-up-right me-1"></i> +14.2% dari bulan lalu</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-hover stat-card-accent-success mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-custom small fw-bold text-uppercase">KURSUS AKTIF</span>
                                <div class="avatar-icon-box avatar-icon-success"><i class="ti ti-book-2"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">42</div>
                            <div class="small text-muted-custom">8 dipublikasi minggu ini</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-hover stat-card-accent-warning mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-custom small fw-bold text-uppercase">TOTAL PENDAPATAN</span>
                                <div class="avatar-icon-box avatar-icon-warning"><i class="ti ti-currency-dollar"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">$38,920</div>
                            <div class="small text-success fw-semibold"><i class="ti ti-arrow-up-right me-1"></i> +9.1% pertambahan</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-hover stat-card-accent-danger mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-custom small fw-bold text-uppercase">TINGKAT KELULUSAN</span>
                                <div class="avatar-icon-box avatar-icon-danger"><i class="ti ti-subtask"></i></div>
                            </div>
                            <div class="h2 fw-bold heading-custom mb-1">88.5%</div>
                            <div class="small text-success fw-semibold"><i class="ti ti-arrow-up-right me-1"></i> +3.2% efisiensi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section (Area & Donut Charts) -->
            <div class="row g-3 mb-4">
                <div class="col-lg-8">
                    <div class="card card-hover mb-0 h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0"><i class="ti ti-chart-line me-2 text-primary"></i> Grafik Pendapatan & Pendaftaran</h3>
                        </div>
                        <div class="card-body">
                            <div id="chart-revenue-laravel" style="min-height: 310px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-hover mb-0 h-100">
                        <div class="card-header">
                            <h3 class="card-title mb-0"><i class="ti ti-chart-donut me-2 text-success"></i> Distribusi Kategori</h3>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <div id="chart-categories-laravel" class="w-100" style="min-height: 290px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ApexCharts JS CDN & Logic -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isDark = document.documentElement.classList.contains('dark') || document.documentElement.getAttribute('data-theme') === 'dark';
            const textColor = isDark ? '#8a99ad' : '#64748b';
            const borderColor = isDark ? '#243049' : '#e2e8f0';

            // Revenue Chart
            new ApexCharts(document.querySelector("#chart-revenue-laravel"), {
                series: [{
                    name: 'Pendapatan ($)',
                    data: [14200, 18500, 21000, 25400, 22800, 31200, 29500, 34800, 38920, 41500, 44200, 48500]
                }, {
                    name: 'Pendaftaran Siswa',
                    data: [210, 280, 310, 390, 340, 460, 420, 510, 580, 620, 670, 710]
                }],
                chart: { type: 'area', height: 310, toolbar: { show: false }, fontFamily: 'Plus Jakarta Sans, sans-serif' },
                colors: ['#206bc4', '#0ca678'],
                stroke: { curve: 'smooth', width: 2.5 },
                fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.35, opacityTo: 0.03 } },
                dataLabels: { enabled: false },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    labels: { style: { colors: textColor } },
                    axisBorder: { color: borderColor }
                },
                yaxis: { labels: { style: { colors: textColor } } },
                grid: { borderColor: borderColor, strokeDashArray: 4 },
                legend: { position: 'top', horizontalAlign: 'right', labels: { colors: textColor } }
            }).render();

            // Categories Chart
            new ApexCharts(document.querySelector("#chart-categories-laravel"), {
                series: [45, 25, 18, 12],
                labels: ['Web Dev', 'UI/UX', 'Data Science', 'Mobile App'],
                chart: { type: 'donut', height: 290, fontFamily: 'Plus Jakarta Sans, sans-serif' },
                colors: ['#206bc4', '#0ca678', '#f59f00', '#4299e1'],
                legend: { position: 'bottom', labels: { colors: textColor } },
                stroke: { width: 0 },
                plotOptions: { pie: { donut: { size: '68%' } } }
            }).render();
        });
    </script>
</x-app-layout>
