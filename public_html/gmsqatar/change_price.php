<?php require "adheader.php"; ?>
<?php require "slidebar.php";

//  require "function.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Application Price-Google Play</h1><br>
                    <h4>(Get Service's Section)</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">App</li>
                    </ol>
                </div>
                <form action="" method="post">
                    <input type="submit" class="btn btn-danger" name="edit-btn" value="Edit Price">
                </form>
            </div>
        </div><!-- /.container-fluid -->
        <div class="row">


            <!-- ./col -->
        </div>
    </section>

    <!-- /.modal -->
    <!-- Main content -->

    <form action="adminFunction.php" method="post" enctype="multipart/form-data">
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Car Service (Basic Service)</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <input type="hidden" id="inputClientCompany" class="form-control" name="g_id" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['id']; ?>">
                            <?php if (isset($_POST['edit-btn'])) {
                                editPrice($conn);
                            }
                            function editPrice($conn)
                            
                            {
                                $g_id = $_SESSION['id'];
                                $sql = "SELECT * FROM app_price WHERE g_id='$g_id'";
                                $res = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($res) > 0) {
                                    $row = mysqli_fetch_assoc($res); ?>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Small Car Price(Petrol)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_s_car_ser_petrol" value="<?php if (isset($row['basic_s_car_ser_petrol'])) echo $row['basic_s_car_ser_petrol']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">HatchBack Car Price(Petrol)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_h_car_ser_petrol" value="<?php if (isset($row['basic_h_car_ser_petrol'])) echo $row['basic_h_car_ser_petrol']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Medium Car Price(Petrol)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_m_car_ser_petrol" value="<?php if (isset($row['basic_m_car_ser_petrol'])) echo $row['basic_m_car_ser_petrol']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Sedan Car Price(Petrol)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_se_car_ser_petrol" value="<?php if (isset($row['basic_se_car_ser_petrol'])) echo $row['basic_se_car_ser_petrol']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">SUV Car Price(Petrol)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_su_car_ser_petrol" value="<?php if (isset($row['basic_su_car_ser_petrol'])) echo $row['basic_su_car_ser_petrol']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Premium Car Price(Petrol)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_pr_car_ser_petrol" value="<?php if (isset($row['basic_pr_car_ser_petrol'])) echo $row['basic_pr_car_ser_petrol']; ?>" placeholder="Enter Price">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputClientCompany">HatchBack Car Price(diesel)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_s1_car_ser_diesel" value="<?php if (isset($row['basic_s1_car_ser_diesel'])) echo $row['basic_s1_car_ser_diesel']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Medium Car Price(diesel)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_s2_car_ser_diesel" value="<?php if (isset($row['basic_s2_car_ser_diesel'])) echo $row['basic_s2_car_ser_diesel']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Sedan Car Price(diesel)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_s3_car_ser_diesel" value="<?php if (isset($row['basic_s3_car_ser_diesel'])) echo $row['basic_s3_car_ser_diesel']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">SUV Car Price(diesel)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_s4_car_ser_diesel" value="<?php if (isset($row['basic_s4_car_ser_diesel'])) echo $row['basic_s4_car_ser_diesel']; ?>" placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Premium Car Price(diesel)</label>
                                        <input type="number" id="inputClientCompany" class="form-control" name="basic_s5_car_ser_diesel" value="<?php if (isset($row['basic_s5_car_ser_diesel'])) echo $row['basic_s5_car_ser_diesel']; ?>" placeholder="Enter Price">
                                    </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Car Service (Standard Service)</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">


                            <div class="form-group">
                                <label for="inputClientCompany">Small Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand1" value="<?php if (isset($row['stand1'])) echo $row['stand1']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand2" value="<?php if (isset($row['stand2'])) echo $row['stand2']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand3" value="<?php if (isset($row['stand3'])) echo $row['stand3']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand4" value="<?php if (isset($row['stand4'])) echo $row['stand4']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand5" value="<?php if (isset($row['stand5'])) echo $row['stand5']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand6" value="<?php if (isset($row['stand6'])) echo $row['stand6']; ?>" placeholder="Enter Price">
                            </div>

                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand7" value="<?php if (isset($row['stand7'])) echo $row['stand7']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand8" value="<?php if (isset($row['stand8'])) echo $row['stand8']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand9" value="<?php if (isset($row['stand9'])) echo $row['stand9']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand10" value="<?php if (isset($row['stand10'])) echo $row['stand10']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand11" value="<?php if (isset($row['stand11'])) echo $row['stand11']; ?>" placeholder="Enter Price">
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Car Service (Comprehensive Service)</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">


                            <div class="form-group">
                                <label for="inputClientCompany">Small Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand12" value="<?php if (isset($row['stand12'])) echo $row['stand12']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand13" value="<?php if (isset($row['stand13'])) echo $row['stand13']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand14" value="<?php if (isset($row['stand14'])) echo $row['stand14']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand15" value="<?php if (isset($row['stand15'])) echo $row['stand15']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand16" value="<?php if (isset($row['stand16'])) echo $row['stand16']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price(Petrol)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand17" value="<?php if (isset($row['stand17'])) echo $row['stand17']; ?>" placeholder="Enter Price">
                            </div>

                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand18" value="<?php if (isset($row['stand18'])) echo $row['stand18']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand19" value="<?php if (isset($row['stand19'])) echo $row['stand19']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand20" value="<?php if (isset($row['stand20'])) echo $row['stand20']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand21" value="<?php if (isset($row['stand21'])) echo $row['stand21']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price(diesel)</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="stand22" value="<?php if (isset($row['stand22'])) echo $row['stand22']; ?>" placeholder="Enter Price">
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Car Spa</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                        <h3>Interior Cleaning</h3>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputClientCompany">Small Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa1" value="<?php if (isset($row['spa1'])) echo $row['spa1']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa2" value="<?php if (isset($row['spa2'])) echo $row['spa2']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa3" value="<?php if (isset($row['spa3'])) echo $row['spa3']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa4" value="<?php if (isset($row['spa4'])) echo $row['spa4']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa5" value="<?php if (isset($row['spa5'])) echo $row['spa5']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa6" value="<?php if (isset($row['spa6'])) echo $row['spa6']; ?>" placeholder="Enter Price">
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3>Car Washing & Polishing</h3>
                        </div>

                        

                    <div class="card-body">

                            <div class="form-group">
                                <label for="inputClientCompany">Small Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa7" value="<?php if (isset($row['spa7'])) echo $row['spa7']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa8" value="<?php if (isset($row['spa8'])) echo $row['spa8']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa9" value="<?php if (isset($row['spa9'])) echo $row['spa9']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa10" value="<?php if (isset($row['spa10'])) echo $row['spa10']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa11" value="<?php if (isset($row['spa11'])) echo $row['spa11']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa12" value="<?php if (isset($row['spa12'])) echo $row['spa12']; ?>" placeholder="Enter Price">
                            </div>
                        </div>

                        <div>
                        <h3>Rubbing & Polishing</h3>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputClientCompany">Small Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa13" value="<?php if (isset($row['spa13'])) echo $row['spa13']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa14" value="<?php if (isset($row['spa14'])) echo $row['spa14']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa15" value="<?php if (isset($row['spa15'])) echo $row['spa15']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa16" value="<?php if (isset($row['spa16'])) echo $row['spa16']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa17" value="<?php if (isset($row['spa17'])) echo $row['spa17']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa18" value="<?php if (isset($row['spa18'])) echo $row['spa18']; ?>" placeholder="Enter Price">
                            </div>
                        </div>

                        <div>
                        <h3>Underbody AntiRust Coating</h3>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputClientCompany">Small Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa19" value="<?php if (isset($row['spa19'])) echo $row['spa19']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa20" value="<?php if (isset($row['spa20'])) echo $row['spa20']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa21" value="<?php if (isset($row['spa21'])) echo $row['spa21']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa22" value="<?php if (isset($row['spa22'])) echo $row['spa22']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa23" value="<?php if (isset($row['spa23'])) echo $row['spa23']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa24" value="<?php if (isset($row['spa24'])) echo $row['spa24']; ?>" placeholder="Enter Price">
                            </div>
                        </div>

                        <div>
                        <h3>Deep All Round Spa</h3>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputClientCompany">Small Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa25" value="<?php if (isset($row['spa25'])) echo $row['spa25']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa26" value="<?php if (isset($row['spa26'])) echo $row['spa26']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa27" value="<?php if (isset($row['spa27'])) echo $row['spa27']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa28" value="<?php if (isset($row['spa28'])) echo $row['spa28']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa29" value="<?php if (isset($row['spa29'])) echo $row['spa29']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="spa30" value="<?php if (isset($row['spa30'])) echo $row['spa30']; ?>" placeholder="Enter Price">
                            </div>
                        </div>


                    
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Car Painting</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputClientCompany">Small Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="paint1" value="<?php if (isset($row['paint1'])) echo $row['paint1']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">HatchBack Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="paint2" value="<?php if (isset($row['paint2'])) echo $row['paint2']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Medium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="paint3" value="<?php if (isset($row['paint3'])) echo $row['paint3']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Sedan Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="paint4" value="<?php if (isset($row['paint4'])) echo $row['paint4']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">SUV Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="paint5" value="<?php if (isset($row['paint5'])) echo $row['paint5']; ?>" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Premium Car Price</label>
                                <input type="number" id="inputClientCompany" class="form-control" name="paint6" value="<?php if (isset($row['paint6'])) echo $row['paint6']; ?>" placeholder="Enter Price">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Car A/C Service</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="inputClientCompany">Small Car Price (Standard Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac1" value="<?php if (isset($row['ac1'])) echo $row['ac1']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">HatchBack Car Price (Standard Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac2" value="<?php if (isset($row['ac2'])) echo $row['ac2']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Medium Car Price (Standard Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac3" value="<?php if (isset($row['ac3'])) echo $row['ac3']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Sedan Car Price (Standard Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac4" value="<?php if (isset($row['ac4'])) echo $row['ac4']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">SUV Car Price (Standard Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac5" value="<?php if (isset($row['ac5'])) echo $row['ac5']; ?>  " placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Premium Car Price (Standard Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac6" value="<?php if (isset($row['ac6'])) echo $row['ac6']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Small Car Price (Comprehensive Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac7" value="<?php if (isset($row['ac7'])) echo $row['ac7']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">HatchBack Car Price (Comprehensive Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac8" value="<?php if (isset($row['ac8'])) echo $row['ac8']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Medium Car Price (Comprehensive Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac9" value="<?php if (isset($row['ac9'])) echo $row['ac9']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Sedan Car Price (Comprehensive Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac10" value="<?php if (isset($row['ac10'])) echo $row['ac10']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">SUV Car Price (Comprehensive Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac11" value="<?php if (isset($row['ac11'])) echo $row['ac11']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Premium Car Price (Comprehensive Service)</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="ac12" value="<?php if (isset($row['ac12'])) echo $row['ac12']; ?>" placeholder="Enter Price">
                    </div>

                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Related Items</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="inputClientCompany">Car Washing</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="sus5" value="<?php if (isset($row['sus5'])) echo $row['sus5']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Radiator Flush</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="sus1" value="<?php if (isset($row['sus1'])) echo $row['sus1']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Clutch Overhaul</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="sus2" value="<?php if (isset($row['sus2'])) echo $row['sus2']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Brake Overhaul</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="sus3" value="<?php if (isset($row['sus3'])) echo $row['sus3']; ?>" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Suspension Overhaul</label>
                        <input type="number" id="inputClientCompany" class="form-control" name="sus4" value="<?php if (isset($row['sus4'])) echo $row['sus4']; ?>" placeholder="Enter Price">
                    </div>
                </div>
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12">
                    <!-- <a href="dashboard.php" class="btn btn-secondary">Cancel</a> -->
                    <?php


                                    if (isset($_POST['status']) == 1) {
                                        echo "<input type='submit' name='save_price' value='New Price' class='btn btn-success float-left'>";
                                    } else {
                                        echo "<input type='submit' name='update_price' value='Update' class='btn btn-success float-right'>";
                                    } ?>


                </div>
            </div>

        </section>
    </form>
<?php }
                            }
?>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">

    <strong>Copyright &copy;2022 <a href="">Garage Software Pvt Ltd</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(function Readdata() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>


</body>

</html>