@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-8">
            <h3 class="mb-0" style="color: #2c3e50; font-weight: 600;">Tableau de Bord</h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Vue d'ensemble de la plateforme</p>
        </div>
        <div class="col-sm-4">
            <ol class="breadcrumb" style="justify-content: flex-end; margin-bottom: 0;">
                <li class="breadcrumb-item"><a href="#" style="color: #6c757d; text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active" style="color: #3498db; font-weight: 500;">Accueil</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <!-- Cards Statistiques -->
    <div class="row mb-5">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #3498db;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px; background: linear-gradient(135deg, #e3f2fd, #bbdefb);">
                                <i class="bi bi-people-fill" style="font-size: 1.5rem; color: #1976d2;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h5 class="mb-1" style="color: #7b8a8b; font-size: 0.9rem; font-weight: 500;">UTILISATEURS</h5>
                            <h2 class="mb-0" style="color: #2c3e50; font-weight: 700;">{{ $totalUsers ?? '0' }}</h2>
                        </div>
                    </div>
                    <a href="{{ route('users.index') }}" class="d-block mt-3 text-decoration-none" 
                       style="color: #3498db; font-weight: 500; font-size: 0.9rem;">
                        Voir détails →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #2ecc71;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px; background: linear-gradient(135deg, #e8f5e9, #c8e6c9);">
                                <i class="bi bi-translate" style="font-size: 1.5rem; color: #388e3c;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h5 class="mb-1" style="color: #7b8a8b; font-size: 0.9rem; font-weight: 500;">LANGUES</h5>
                            <h2 class="mb-0" style="color: #2c3e50; font-weight: 700;">{{ $totalLangues ?? '0' }}</h2>
                        </div>
                    </div>
                    <a href="{{ route('langues.index') }}" class="d-block mt-3 text-decoration-none" 
                       style="color: #2ecc71; font-weight: 500; font-size: 0.9rem;">
                        Voir détails →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #f1c40f;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 50px; height: 50px; background: linear-gradient(135deg, #fef9e7, #f9e79f);">
                        <i class="bi bi-geo-alt-fill" style="font-size: 1.5rem; color: #d4ac0d;"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-4">
                    <h5 class="mb-1" style="color: #7b8a8b; font-size: 0.9rem; font-weight: 500;">RÉGIONS</h5>
                    <h2 class="mb-0" style="color: #2c3e50; font-weight: 700;">{{ $totalRegions ?? '0' }}</h2>
                </div>
            </div>
            <a href="{{ route('regions.index') }}" class="d-block mt-3 text-decoration-none"
               style="color: #f1c40f; font-weight: 500; font-size: 0.9rem;">
                Voir détails →
            </a>
        </div>
    </div>
</div>


        <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border-left: 4px solid #e74c3c;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px; background: linear-gradient(135deg, #f9ebea, #f5b7b1);">
                        <i class="bi bi-journal-bookmark-fill" style="font-size: 1.5rem; color: #c0392b;"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-4">
                    <h5 class="mb-1" style="color: #7b8a8b; font-size: 0.9rem; font-weight: 500;">CONTENUS</h5>
                    <h2 class="mb-0" style="color: #2c3e50; font-weight: 700;">{{ $totalContenus ?? '0' }}</h2>
                </div>
            </div>
            <a href="{{ route('contenus.index') }}" class="d-block mt-3 text-decoration-none" 
               style="color: #e74c3c; font-weight: 500; font-size: 0.9rem;">
                Voir détails →
            </a>
        </div>
    </div>
</div>

    </div>

    <!-- Graphiques -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex flex-column">
                    <h6 class="mb-3" style="color: #2c3e50; font-weight: 600; font-size: 0.95rem;">
                        <i class="bi bi-people me-2" style="color: #3498db;"></i>
                        Utilisateurs
                    </h6>
                    <div id="usersChart" class="flex-grow-1 d-flex justify-content-center align-items-center" style="height: 250px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex flex-column">
                    <h6 class="mb-3" style="color: #2c3e50; font-weight: 600; font-size: 0.95rem;">
                        <i class="bi bi-translate me-2" style="color: #2ecc71;"></i>
                        Langues
                    </h6>
                    <div id="languesChart" class="flex-grow-1 d-flex justify-content-center align-items-center" style="height: 250px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex flex-column">
                    <h6 class="mb-3" style="color: #2c3e50; font-weight: 600; font-size: 0.95rem;">
                        <i class="bi bi-geo-alt me-2" style="color: #f1c40f;"></i>
                        Régions
                    </h6>
                    <div id="regionsChart" class="flex-grow-1 d-flex justify-content-center align-items-center" style="height: 250px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-body p-3 d-flex flex-column">
                    <h6 class="mb-3" style="color: #2c3e50; font-weight: 600; font-size: 0.95rem;">
                        <i class="bi bi-journal me-2" style="color: #e74c3c;"></i>
                        Contenus
                    </h6>
                    <div id="contenusChart" class="flex-grow-1 d-flex justify-content-center align-items-center" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Données des totaux depuis le controller
    const totalUsers = @json($totalUsers ?? 0);
    const totalLangues = @json($totalLangues ?? 0);
    const totalRegions = @json($totalRegions ?? 0);
    const totalContenus = @json($totalContenus ?? 0);

    // 1. Column Chart pour Utilisateurs - Données mensuelles réelles
    const usersOptions = {
        series: [{
            name: 'Nouveaux utilisateurs',
            data: @json($usersData)
        }],
        chart: {
            type: 'bar',
            height: 280,
            toolbar: {
                show: false
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 8,
                columnWidth: '60%',
                distributed: false,
                dataLabels: {
                    position: 'top'
                }
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val > 0 ? Math.round(val) : '';
            },
            offsetY: -20,
            style: {
                fontSize: '11px',
                fontWeight: 'bold',
                colors: ["#5a5c69"]
            }
        },
        xaxis: {
            categories: @json($mois),
            labels: {
                style: {
                    colors: '#95a5a6',
                    fontSize: '11px',
                    fontWeight: 500
                }
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return Math.round(val);
                },
                style: {
                    colors: '#95a5a6',
                    fontSize: '11px'
                }
            }
        },
        colors: ['#3498db'],
        grid: {
            borderColor: '#e7e7e7',
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: ['#2980b9'],
                inverseColors: false,
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100]
            }
        },
        title: {
            text: `Inscriptions Utilisateurs (${totalUsers} total)`,
            align: 'left',
            margin: 10,
            offsetX: 10,
            style: {
                fontSize: '16px',
                fontWeight: '600',
                color: '#2c3e50'
            }
        },
        subtitle: {
            text: 'Évolution sur 12 mois',
            align: 'left',
            offsetX: 10,
            style: {
                fontSize: '12px',
                color: '#7b8a8b'
            }
        },
        tooltip: {
            theme: 'light',
            y: {
                formatter: function (val) {
                    return val + " inscription(s)";
                }
            }
        }
    };

    // 2. Donut Chart Dynamique pour Langues avec vraies données
    const languesOptions = {
        series: [
            @json($languesParlees ?? 0),      // Langues parlées
            @json($languesNonParlees ?? 0)    // Langues non parlées
        ],
        chart: {
            type: 'donut',
            height: 280,
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800
            }
        },
        labels: ['Langues Parlées', 'Langues Non Parlées'],
        colors: ['#2ecc71', '#ecf0f1'],
        legend: {
            position: 'bottom',
            fontSize: '12px',
            fontWeight: 500,
            labels: {
                colors: '#2c3e50'
            },
            markers: {
                width: 12,
                height: 12,
                radius: 3
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                return opts.w.config.series[opts.seriesIndex];
            },
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                colors: ['#fff']
            },
            dropShadow: {
                enabled: true,
                blur: 3,
                opacity: 0.5
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '65%',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '14px',
                            fontWeight: 600,
                            color: '#2c3e50',
                            offsetY: -10
                        },
                        value: {
                            show: true,
                            fontSize: '24px',
                            fontWeight: 'bold',
                            color: '#2ecc71',
                            offsetY: 5,
                            formatter: function (val) {
                                return val;
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total Langues',
                            fontSize: '13px',
                            fontWeight: 600,
                            color: '#7b8a8b',
                            formatter: function (w) {
                                return totalLangues;
                            }
                        }
                    }
                },
                expandOnClick: true
            }
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['#fff']
        },
        title: {
            text: `Distribution des Langues (${totalLangues} au total)`,
            align: 'left',
            margin: 10,
            offsetX: 10,
            style: {
                fontSize: '16px',
                fontWeight: '600',
                color: '#2c3e50'
            }
        },
        subtitle: {
            text: `${@json($languesParlees ?? 0)} parlées / ${@json($languesNonParlees ?? 0)} non parlées`,
            align: 'left',
            offsetX: 10,
            style: {
                fontSize: '12px',
                color: '#7b8a8b'
            }
        },
        tooltip: {
            theme: 'light',
            fillSeriesColor: false,
            y: {
                formatter: function(val, opts) {
                    const total = totalLangues;
                    const percent = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                    return val + " langues (" + percent + "%)";
                }
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 250
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    // 3. Radar Chart pour Régions (graphique en étoile)
    const regionsOptions = {
        series: [{
            name: 'Couverture',
            data: [totalRegions, totalRegions * 0.8, totalRegions * 0.6, totalRegions * 0.9, totalRegions * 0.7]
        }],
        chart: {
            type: 'radar',
            height: 250,
            toolbar: {
                show: false
            }
        },
        xaxis: {
            categories: ['Nord', 'Sud', 'Est', 'Ouest', 'Centre']
        },
        yaxis: {
            show: false
        },
        fill: {
            opacity: 0.4
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['#f1c40f']
        },
        markers: {
            size: 4,
            colors: ['#f1c40f'],
            strokeColors: '#fff',
            strokeWidth: 2
        },
        colors: ['#f1c40f'],
        title: {
            text: 'Régions Couvertes',
            align: 'center',
            style: {
                fontSize: '16px',
                fontWeight: '600',
                color: '#2c3e50'
            }
        }
    };

    // 4. Line Chart pour Contenus - Basé sur les vraies dates
    const contenusOptions = {
        series: [{
            name: 'Contenus',
            data: @json($totaux)
        }],
        chart: {
            type: 'line',
            height: 250,
            toolbar: {
                show: false
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800
            }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        markers: {
            size: 6,
            colors: ['#fff'],
            strokeColors: '#e74c3c',
            strokeWidth: 2,
            hover: {
                size: 8
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val > 0 ? Math.round(val) : '';
            },
            offsetY: -10,
            style: {
                fontSize: '11px',
                fontWeight: 'bold',
                colors: ["#5a5c69"]
            },
            background: {
                enabled: true,
                foreColor: '#fff',
                borderRadius: 2,
                padding: 4,
                opacity: 0.9,
                borderWidth: 1,
                borderColor: '#e74c3c'
            }
        },
        xaxis: {
            categories: @json($dates),
            labels: {
                style: {
                    colors: '#95a5a6',
                    fontSize: '12px',
                    fontWeight: 500
                }
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return Math.round(val);
                },
                style: {
                    colors: '#95a5a6',
                    fontSize: '11px'
                }
            }
        },
        colors: ['#e74c3c'],
        grid: {
            borderColor: '#e7e7e7',
            strokeDashArray: 4,
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: true
                }
            }
        },
        title: {
            text: `Contenus Publiés (Total: ${totalContenus})`,
            align: 'left',
            margin: 10,
            offsetX: 10,
            style: {
                fontSize: '16px',
                fontWeight: '600',
                color: '#2c3e50'
            }
        },
        subtitle: {
            text: 'Derniers 7 jours',
            align: 'left',
            offsetX: 10,
            style: {
                fontSize: '12px',
                color: '#7b8a8b'
            }
        },
        tooltip: {
            theme: 'light',
            y: {
                formatter: function (val) {
                    return val + " contenu(s)";
                }
            }
        }
    };

    // Initialisation des charts avec délai pour s'assurer que le DOM est chargé
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            if(document.querySelector("#usersChart")) {
                const usersChart = new ApexCharts(document.querySelector("#usersChart"), usersOptions);
                usersChart.render();
            }
            if(document.querySelector("#languesChart")) {
                const languesChart = new ApexCharts(document.querySelector("#languesChart"), languesOptions);
                languesChart.render();
            }
            if(document.querySelector("#regionsChart")) {
                const regionsChart = new ApexCharts(document.querySelector("#regionsChart"), regionsOptions);
                regionsChart.render();
            }
            if(document.querySelector("#contenusChart")) {
                const contenusChart = new ApexCharts(document.querySelector("#contenusChart"), contenusOptions);
                contenusChart.render();
            }
        }, 100);
    });
</script>
@endpush