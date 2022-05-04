<?php
require_once "./../db/function.php";
$sql = "SELECT loai_hang. ma_loai, loai_hang . ten_loai,COUNT(hang_hoa . so_luong) AS sl, MAX(gia) AS gia_cao, MIN(gia) AS gia_thap, AVG(gia) AS gia_tb 
FROM hang_hoa INNER JOIN loai_hang ON loai_hang . ma_loai = hang_hoa . ma_loai GROUP BY loai_hang. ma_loai, loai_hang . ten_loai";
$getdata = pdo_query($sql);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Danh Mục', 'Thống Kê Hàng Hóa'],
          <?php foreach ($getdata as $value) { ?>
            ['<?= $value['ten_loai']?>',    <?= $value['sl']?>],
          <?php } ?>
        ]);

        var options = {
          title: 'BIỂU ĐỒ THỐNG KÊ',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
    <h1 class="alert alert-danger" style="color:#fff; background-color:#b22830;">BIỂU ĐỒ THỐNG KÊ</h1>
    <div style="display: flex;">
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    <div style="width: 300px; height: 500px;"><a href="\du_an_mau\admin\thong_ke\list.php" class="btn btn-secondary">QUAY LẠI</a></div>
    </div>
    </div>
  </body>
</html>