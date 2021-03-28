<?php

/**
 * Author : Pedroletti Michael
 * CreationFile date : 08.02.2021
 * ModifFile date : 10.02.2021
 **/

ob_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil - CPA-CP</title>
    <style>
        .highcharts-figure, .highcharts-data-table table {
            min-width: 320px;
            max-width: 660px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
    <script rel="javascript" src="view/js/jquery.js"></script>
    <script rel="javascript" src="view/js/jquery-3.6.0.min.js"></script>
    <script rel="javascript" src="view/js/script.js"></script>
    <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<body>
<div class="container-fluid pt-3 mt-3">
    <div class="text-center mt-3">
        <h1>Statistiques</h1>
    </div>

    <!-- Pie charts with legend -->
    <div class="text-center d-inline-flex w-100 mt-3 mb-5 justify-content-center">
        <div class="float-left w-25">
            <figure class="highcharts-figure float-left ml-2 mr-2">
                <div id="numberOfBunkerByRegionPieChart"></div>
                <p class="highcharts-description">
                    Vous pouvez observer ci-dessus le nombre d'abris que contient chaque canton
                </p>
            </figure>
        </div>
        <div class="float-left w-25">
            <figure class="highcharts-figure float-left ml-2 mr-2">
                <div id="numberOfVisitByRegion"></div>
                <p class="highcharts-description">
                    Vous pouvez observer ci-dessus le nombre de visite qui ont été effectué par canton
                </p>
            </figure>
        </div>
        <div class="float-left w-25">
            <figure class="highcharts-figure float-left ml-2 mr-2">
                <div id="numberOfCounterInspectionByRegion"></div>
                <p class="highcharts-description">
                    Vous pouvez observer ci-dessus le nombre de contre visite qui ont été effectué par canton
                </p>
            </figure>
        </div>
    </div>

    <!-- Basic column chart -->
    <div class="text-center d-inline-block w-100 mt-3 mb-5">
        <div class="btn-group-vertical" role="group">
            <figure class="highcharts-figure">
                <div id="numberOfVisitAndCounterInspectionByMonth"></div>
                <p class="highcharts-description">
                    Nombre de visite et de contre visite par mois sur l'année 2021-2022
                </p>
            </figure>
        </div>
    </div>
</div>


<script>
    // Build all charts
    Highcharts.chart('numberOfBunkerByRegionPieChart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Nombre d\'abris par canton'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
            name: 'Pourcentage',
            colorByPoint: true,
            data: [<?php $i = 0; foreach ($stats['countBunkerRegion'] as $a) {
                if (count($stats['countBunkerRegion']) == $i + 1) {
                    echo "{name: '" . $a['region'] . "',y: " . $a['countRegion'] . "}";
                } else {
                    echo "{name: '" . $a['region'] . "',y: " . $a['countRegion'] . "},";
                }
                $i++;
            }?>]
        }]
    });

    Highcharts.chart('numberOfVisitByRegion', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Nombre de visite par canton'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
            name: 'Pourcentage',
            colorByPoint: true,
            data: [<?php $i = 0; foreach ($stats['countVisitRegion'] as $a) {
                if (count($stats['countVisitRegion']) == $i + 1) {
                    echo "{name: '" . $a['region'] . "',y: " . $a['countVisit'] . "}";
                } else {
                    echo "{name: '" . $a['region'] . "',y: " . $a['countVisit'] . "},";
                }
                $i++;
            }?>]
        }]
    });

    Highcharts.chart('numberOfCounterInspectionByRegion', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Nombre de contre-visite par canton'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
            name: 'Brands',
            colorByPoint: true,
            data: [<?php $i = 0; foreach ($stats['countCounterInspectionRegion'] as $a) {
                if (count($stats['countCounterInspectionRegion']) == $i + 1) {
                    echo "{name: '" . $a['region'] . "',y: " . $a['countCounterInspection'] . "}";
                } else {
                    echo "{name: '" . $a['region'] . "',y: " . $a['countCounterInspection'] . "},";
                }
                $i++;
            }?>]
        }]
    });

    Highcharts.chart('numberOfVisitAndCounterInspectionByMonth', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Nombre de visite et contre visite par mois'
        },
        subtitle: {
            text: 'Données récupérée des différentes visites et contres visites enregistrées'
        },
        xAxis: {
            categories: [
                'Janvier',
                'Février',
                'Mars',
                'Avril',
                'Mai',
                'Juin',
                'Juillet',
                'Août',
                'Septempbre',
                'Octobre',
                'Novembre',
                'Décembre'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nombre de visite et contre visite par mois'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '</tr>',
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
            name: 'Visite',
            data: [
                <?= $stats['tableMonthStats']['visitJan'].",".$stats['tableMonthStats']['visitFeb'].",".$stats['tableMonthStats']['visitMar'].",".$stats['tableMonthStats']['visitApr'].",".$stats['tableMonthStats']['visitMay'].",".$stats['tableMonthStats']['visitJun'].",".$stats['tableMonthStats']['visitJul'].",".$stats['tableMonthStats']['visitAug'].",".$stats['tableMonthStats']['visitSep'].",".$stats['tableMonthStats']['visitOct'].",".$stats['tableMonthStats']['visitNov'].",".$stats['tableMonthStats']['visitDec'];?>
            ]

        }, {
            name: 'Contre visite',
            data: [
                <?= $stats['tableMonthStats']['counterJan'].",".$stats['tableMonthStats']['counterFeb'].",".$stats['tableMonthStats']['counterMar'].",".$stats['tableMonthStats']['counterApr'].",".$stats['tableMonthStats']['counterMay'].",".$stats['tableMonthStats']['counterJun'].",".$stats['tableMonthStats']['counterJul'].",".$stats['tableMonthStats']['counterAug'].",".$stats['tableMonthStats']['counterSep'].",".$stats['tableMonthStats']['counterOct'].",".$stats['tableMonthStats']['counterNov'].",".$stats['tableMonthStats']['counterDec']; ?>
            ]

        }]
    });
</script>

</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
