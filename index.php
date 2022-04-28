<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dashboard</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
  <!-- //////////////////////////// -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
  <div class="container">
    <header>
      <h1>Dashboard</h1>
    </header>
    <main>
      <section class="option-section">
        <form action="#" method="GET">
          <select name="category" id="category">
            <option value="">Select Category</option>
            <?php
            try {
              $stmt = $conn->prepare("SELECT device_name FROM device_table");
              $stmt->execute();

              // set the resulting array to associative
              $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
              foreach ($stmt->fetchAll() as $k => $v) {
                echo "<option>";
                echo $v["device_name"];
                echo "</option>";
              }
            } catch (PDOException $e) {
              echo "Error: " . $e->getMessage();
            }
            ?>
          </select>
          <input type="submit" name="submit" value="submit" />
        </form>
      </section>
      <section class="chart-section">
        <div id="chart_div"></div>
      </section>
    </main>
    <div>
</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>
  google.charts.load("current", {
    packages: ["gauge"]
  });
  google.charts.setOnLoadCallback(drawChart);

  <?php
  try {
    $stmt = $conn->prepare("SELECT * FROM temperature ORDER BY `timestamp` Desc LIMIT 1;");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($stmt->fetchAll() as $k => $v) {
      $temperature = $v["temperature"];
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  ?>

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ["Label", "Value"],
      ["Memory",
        <?php echo $temperature ?>
      ],
    ]);

    var options = {
      width: 400,
      height: 120,
      redFrom: 90,
      redTo: 100,
      yellowFrom: 75,
      yellowTo: 90,
      minorTicks: 5,
    };

    var chart = new google.visualization.Gauge(
      document.getElementById("chart_div")
    );

    chart.draw(data, options);
  }
</script>

</html>