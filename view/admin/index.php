<!doctype html>
<html lang="en">
<?php $title = "Trang chủ" ?>
<?php include "view/admin/layout/asset-header.php" ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<body>
    <?php include "view/admin/layout/header.php" ?>
    <div class="container main">
        <h1>trang chủ</h1>
        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
        <script>
            const xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
            const yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

            new Chart("myChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: yValues[0] - 1,
                                max: yValues[yValues.length-1] + 1
                            }
                        }],
                    }
                }
            });
        </script>
    </div>
    <?php include "view/admin/layout/asset-footer.php" ?>
</body>

</html>