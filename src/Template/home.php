<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tmpr chart</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
</head>
<body>
    <script>
        let d = '<?php echo $json;?>';
    </script>
    <?php
//        echo "<pre>";
//        print_r($data);
//        print_r();

    ?>
    <div id="container"></div>
    <script src="/assets/js/tmpr.js"></script>
</body>
</html>