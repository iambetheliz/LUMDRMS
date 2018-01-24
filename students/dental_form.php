<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dental Form | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
</head>
<body>

  <!-- Navbar -->
  <?php include 'header.php'; ?>
  <!-- End of Navbar -->

  <!-- Content -->
	<div id="wrapper">

    <!-- Sidebar Menu Items -->
    <div id="sidebar-wrapper">
      <nav id="spy">
        <ul class="sidebar-nav" role="menu">                    
          <li>
            <a href="/lu_clinic"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp; Dashboard</a>
          </li>
          <li>
            <a href="/lu_clinic/calendar/"><span class="fa fa-calendar"></span>&nbsp;&nbsp; Activities</a>
          </li>
          <li class="active have-child" role="presentation">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><span class="fa fa-book"></span>&nbsp;&nbsp; Records <i class="fa fa-caret-down"></i></a>
            <ul id="demo" class="panel-collapse collapse in">
              <li class="active">
                <a href="/lu_clinic/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
              </li>
              <li>
                <a href="/lu_clinic/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
              </li>
              <li>
                <a class="med" role="submenuitem" data-toggle="collapse" href="#med" data-parent="#med"><span class="fa fa-medkit"></span>&nbsp;&nbsp; Medical <i class="fa fa-caret-down"></i></a>
                <ul id="med" class="panel-collapse collapse">
                  <li>
                    <a href="/lu_clinic/medical/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                  </li>
                  <li>
                    <a href="/lu_clinic/medical/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
                  </li>
                </ul>
              </li>  
              <li>
                <a class="den" role="submenuitem" data-toggle="collapse" href="#den" data-parent="#den"><span class="fa fa-smile-o"></span>&nbsp;&nbsp; Dental <i class="fa fa-caret-down"></i></a>
                <ul id="den" class="panel-collapse collapse">
                  <li>
                    <a href="/lu_clinic/dental/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                  </li>
                  <li>
                    <a href="/lu_clinic/dental/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
                  </li>
                </ul>
              </li>
              <li>
                <a class="den" role="submenuitem" data-toggle="collapse" href="#soap" data-parent="#soap"><span class="fa fa-file-text-o"></span>&nbsp;&nbsp; S.O.A.P. <i class="fa fa-caret-down"></i></a>
                <ul id="soap" class="panel-collapse collapse">
                  <li>
                    <a href="/lu_clinic/soap/students/"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp; Students</a>
                  </li>
                  <li>
                    <a href="/lu_clinic/soap/faculties/"><span class="fa fa-briefcase"></span>&nbsp;&nbsp; Faculty and Staffs</a>
                  </li>
                </ul>
              </li> 
            </ul>
          </li>
          <?php 
            if ($userRow['role'] === 'superadmin') {?>
            <li>
              <a href="/lu_clinic/users"><span class="fa fa-lock"></span>&nbsp;&nbsp; User Accounts</a>
            </li>
          <?php    }
          ?>
        </ul>
      </nav>
    </div>  
    <!-- End of Sidebar -->

    <!-- Start of Main Screen -->
    <div id="page-content-wrapper">
      <div class="page-content">
        <div class="container-fluid">

          <?php 
            require_once '../includes/dbconnect.php';

            $DB_con = new mysqli("localhost", "root", "", "records");

            if (isset($_GET['StudentID']) && is_numeric($_GET['StudentID']) && $_GET['StudentID'] > 0) {

              $StudentID = $_GET['StudentID'];
              $res = "SELECT * FROM `students_stats` JOIN `students` ON `students`.`studentNo`=`students_stats`.`studentNo` WHERE StudentID=".$_GET['StudentID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>
    
          <!-- Page Heading -->
          <div class="row">
            <div class="container-fluid">             
              <h1 class="page-header">Student Dental Form <span class="text-danger pull-right" id="errmsg"></span></h1>
            </div>
          </div>            
          <!-- End of Page Heading -->  

          <!-- Start of Form -->
          <form action="action.php" method="post" autocomplete="">

            <div class="row">
              <div class="container-fluid">

                <!-- Past Medical History -->
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <strong>MEDICAL HISTORY</strong>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="col-lg-4">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Hypertension"> <span class="lbl"></span>Hypertension
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Diabetes"> <span class="lbl"></span>Diabetes
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Cardiovascular DSE"> <span class="lbl"></span>Cardiovascular DSE
                        </label>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Epilepsy"> <span class="lbl"></span>Epilepsy
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Bleeding Disorder"> <span class="lbl"></span>Bleeding Disorder
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Asthma"> <span class="lbl"></span>Asthma
                        </label>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Allergies"> <span class="lbl"></span>Allergies
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="checkbox-inline">
                          <input type="checkbox" class="form-check-input" id="otherMedHisCheck"> <span class="lbl"></span>Other
                        </label> 
                        <input type="text" class="form-control" name="medHis_list[]" id="otherMedHis" style="display: none;">
                      </div>
                    </div>

                  </div>
                </div>
                <!-- End Past Medical History -->

                <!-- Personal and Social -->
                <div class="row">
                  <div class="col-lg-8">
                    <div class="panel panel-success panel-table">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <strong>DENTITION STATUS</strong>
                        </div>
                      </div>
                      <div class="panel-body">
                          <table class="table table-bordered" align="center">
                            <tr>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D18" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D17" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D16" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D15" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D14" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D13" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D12" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D11" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D21" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D22" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D23" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D24" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D25" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D26" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D27" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D28" value="1"><span class="lbl"></span></label></td>
                            </tr>
                            <tr>
                              <td>18</td>
                              <td>17</td>
                              <td>16</td>
                              <td>15</td>
                              <td>14</td>
                              <td>13</td>
                              <td>12</td>
                              <td>11</td>
                              <td>21</td>
                              <td>22</td>
                              <td>23</td>
                              <td>24</td>
                              <td>25</td>
                              <td>26</td>
                              <td>27</td>
                              <td>28</td>
                            </tr>
                            <tr>
                              <td colspan="16" style="padding-left: 3px; padding-right: 3px;">
                                <img src="../images/dental2.jpg" class="dental img-fluid" alt="Responsive image">
                              </td>
                            </tr>
                            <tr>
                              <td>48</td>
                              <td>47</td>
                              <td>46</td>
                              <td>45</td>
                              <td>44</td>
                              <td>43</td>
                              <td>42</td>
                              <td>41</td>
                              <td>31</td>
                              <td>32</td>
                              <td>33</td>
                              <td>34</td>
                              <td>35</td>
                              <td>36</td>
                              <td>37</td>
                              <td>38</td>
                            </tr>
                            <tr>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D48" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D47" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D46" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D45" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D44" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D43" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D42" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D41" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D31" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D32" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D33" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D34" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D35" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D36" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D37" value="1"><span class="lbl"></span></label></td>
                              <td><label class="checkbox-inline"><input type="checkbox" class="form-check-input" name="D38" value="1"><span class="lbl"></span></label></td>
                            </tr>
                          </table>
                          <br>
                          <div class="col-lg-6">
                            <h4><strong>PERSONAL CONDITION:</strong></h4>
                            <div class="form-group">
                              <label class="radio-inline">
                                <input type="radio" name="per_con" value="Normal" id="normal" /> <span class="lbl"></span>Normal
                              </label>
                              <br>
                              <label>Remarks:</label> 
                              <input type="text" class="form-control" id="normal_rem" name="con_rem1" />
                            </div>
                            <div class="form-group">
                              <label class="radio-inline"> <span class="lbl"></span>
                                <input type="radio" name="per_con" value="Gingivitis" id="gingivitis" /> <span class="lbl"></span>Gingivitis
                              </label>
                              <br>
                              <label>Remarks:</label> 
                              <input type="text" class="form-control" name="con_rem2" id="gin_rem">
                              <br>
                              <label class="radio-inline">
                                <input type="radio" name="per_con" value="Periodontal Disease" id="perio" /> <span class="lbl"></span>Periodontal Disease
                              </label>                  
                              <br>
                              <label>Remarks:</label> 
                              <input type="text" class="form-control" id="perio_rem" name="con_rem3" >
                              <br><br>
                            </div>
                          </div>   
                          <div class="col-lg-6">
                            <h4>&nbsp;</h4>
                            <div class="form-group">
                              <label class="radio-inline">
                                <input type="radio" name="per_con" value="Other Abnormal Conditions" id="other" /> <span class="lbl"></span><strong>Other Abnormal Conditions</strong>
                              </label><br>      
                              <label>Remarks:</label> <input type="text" class="form-control" name="con_rem4" id="other_rem"><br>      
                              <label>Please specify:</label> <input type="text" class="form-control" id="other_con_spec" name="con_spec" id="con_spec">
                            </div>
                          </div>

                      </div>

                    </div>
                  </div>
                  <!-- End Condition -->
                  <div class="col-lg-4">
                    <div class="panel panel-success">
                      <div class="panel-heading">
                        <div class="panel-title">
                          <strong>INDEX: DMFT</strong>
                        </div>
                      </div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label>No. of T/Decayed:</label>
                          <br>
                          X - <input type="text" name="dec_x" class="form-control">
                          <br>
                          F - <input type="text" name="dec_f" class="form-control">
                          <br>
                          <label>No. of T/Missing:</label>
                          <input type="text" name="missing" class="form-control">
                          <br>
                          <label>No. of T/Filled:</label>
                          <input type="text" name="filled" class="form-control">
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="form-group">
                          <h4><strong>DENTAL PROSTHESES:</strong></h4>
                          <br>
                          <div class="form-group">
                            <label style="margin-right: 50px;">Denture Wearer:</label>
                            <label class="radio-inline">
                              <input type="radio" name="denture" value="Yes"> <span class="lbl"></span>Yes
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="denture" value="No"> <span class="lbl"></span>No
                            </label>
                            <br>      
                            <label>Remarks:</label> <input type="text" class="form-control" name="pro_rem1" id="pro_rem1"><br>      
                            <label>Please specify:</label> <input type="text" class="form-control" name="pro_sec1" id="pro_sec2">
                          </div>   
                          <div class="form-group">
                            <label style="margin-right: 45px;">Need for denture: </label>
                            <label class="radio-inline">
                              <input type="radio" name="need" value="Yes"> <span class="lbl"></span>Yes
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="need" value="No"> <span class="lbl"></span>No
                            </label> <br>      
                            <label>Remarks:</label> <input type="text" class="form-control" name="pro_rem2" id="pro_rem2"><br>      
                            <label>Please specify:</label> <input type="text" class="form-control" name="pro_sec2" id="pro_sec2"><br>      
                            <label>Remarks:</label> <input type="text" class="form-control" name="pro_rem3" id="pro_rem3">
                          </div>  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End -->

                <div class="form-inline" align="center">
                  <?php if (!empty($userRow['first_name']) && !empty($userRow['last_name'])) {
                    $checked_by = $userRow['first_name']. " " .$userRow['last_name'];
                  } 
                  else {
                    $checked_by = $userRow['userName'];
                  }?>
                  <input type="hidden" name="checked_by" value="<?php echo $checked_by; ?>">
                  <input type="hidden" name="studentNo" value="<?php echo $row['studentNo']; ?>"/>
                  <input type="hidden" name="StudentID" value="<?php echo $row['StudentID']; ?>"/>
                  <input type="hidden" name="action_type" value="save_dental"/>
                  <input type="submit" class="btn btn-primary" id="save" name="btn-save" value="Save Record" />
                </div>
              <!-- End -->

              </div>
            </div>

          </form>
          <!-- End of Form -->
          <?php }}?>

        </div>  
      </div>
    </div>
    <!-- End of Main Screen -->

  </div>
  <!-- End of Content -->

  <footer class="footer">
    <div class="container-fluid">
        <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; <?php echo date("Y"); ?></p>
    </div>
  </footer>
    
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<script src="../assets/js/form_validate_custom.js"></script> 
<script>
  $("input[name=per_con]").click(function () {
    if ($("#normal").is(":checked")) {
      $("#gin_rem").prop("disabled", true);
      $("#perio_rem").prop("disabled", true);
      $("#other_rem").prop("disabled", true);
      $("#other_con_spec").prop("disabled", true);
    } else if ($("#gingivitis").is(":checked")) {
      $("#gin_rem").prop("disabled", false);
      $("#normal_rem").prop("disabled", true);
      $("#perio_rem").prop("disabled", true);
      $("#other_rem").prop("disabled", true);
      $("#other_con_spec").prop("disabled", true);
    } else if ($("#perio").is(":checked")) {
      $("#gin_rem").prop("disabled", true);
      $("#normal_rem").prop("disabled", true);
      $("#perio_rem").prop("disabled", false);
      $("#other_rem").prop("disabled", true);
      $("#other_con_spec").prop("disabled", true);
    } else {
      $("#gin_rem").prop("disabled", true);
      $("#normal_rem").prop("disabled", true);
      $("#perio_rem").prop("disabled", true);
      $("#other_rem").prop("disabled", false);
      $("#other_con_spec").prop("disabled", false);
    }
  });
</script>
</body>
</html>
<?php ob_end_flush(); ?>