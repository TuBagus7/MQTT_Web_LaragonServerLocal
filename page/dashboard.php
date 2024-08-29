<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script src="mqtt/dashboard.js"></script> <!-- Tambahkan baris ini -->
</head>
<body>

<?php
$sql = "SELECT * FROM devices WHERE active = 'Yes'";
$result = mysqli_query($conn, $sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><span id="suhu">-</span> C</h3>

                            <p>Suhu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-temperature-high"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h3><span id="kelembaban">-</span> %</h3>

                            <p>Kelembaban</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-water"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3 id="usonic">-</h3>

                            <p>Ultrasonic</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Servo</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row margin">
                                <div class="col-sm-12">
                                    <input id="servo" onchange="publishServo(this)" type="text">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Lampu</h3>
                        </div>
                        <div class="card-body table-responsive pad">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary" id="label-lampu1-nyala">
                                    <input type="radio" name="lampu1" onchange="publishLampu(this)" id="lampu1-nyala" autocomplete="off"> Nyala
                                </label>
                                <label class="btn btn-primary" id="label-lampu1-mati">
                                    <input type="radio" name="lampu1" onchange="publishLampu(this)" id="lampu1-mati" autocomplete="off"> Mati
                                </label>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-indigo">
                        <div class="card-header">
                            <h3 class="card-title">Status Perangkat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Serial Number</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['serial_number'] ?></td>
                                        <td><?php echo $row['location'] ?></td>
                                        <td style="color:red;" id="monitoring/status/<?php echo $row['serial_number'] ?>">offline</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

</body>
</html>
