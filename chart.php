<?php require_once "db.php"; ?>

<?php
try {
    $stmt = $conn->prepare("SELECT * FROM temperature ORDER BY `timestamp` Desc LIMIT 1;");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($stmt->fetchAll() as $k => $v) {
        echo json_encode($v["temperature"]);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<script>
    google.charts.load("current", {
        packages: ["gauge"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Label", "Value"],
            ["Memory",
                <?php
                try {
                    $stmt = $conn->prepare("SELECT * FROM temperature ORDER BY `timestamp` Desc LIMIT 1;");
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    foreach ($stmt->fetchAll() as $k => $v) {
                        echo json_encode($v["temperature"]);
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;
                ?>
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