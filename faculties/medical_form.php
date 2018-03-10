<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Medical Form | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
</head>
<style type="text/css">
  span.error {
  color: red;
}
table#physical td {
  text-align: center;
}
</style>
<body>

  <!-- Navbar -->
  <?php include 'header.php'; ?>
  <!-- End of Navbar -->

  <!-- Content -->
	<div id="wrapper">

    <!-- Sidebar Menu Items -->
    <div id="sidebar-wrapper">
      <nav id="spy">
        <ul class="sidebar-nav">                    
          <li>
            <a href="/LUMDRMS/"><i class="col-1 fa fa-bar-chart" aria-hidden="true"></i>Dashboard</a>
          </li>
          <li>
            <a href="/LUMDRMS/calendar/"><i class="col-1 fa fa-calendar" aria-hidden="true"></i>Activities</a>
          </li>
          <li>
            <a href="/LUMDRMS/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
          </li>
          <li class="active">
            <a href="/LUMDRMS/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
          </li>
          <li role="presentation" class="have-child">
            <a role="menuitem" data-toggle="collapse" href="#demo" data-parent="#accordion"><i class="col-1 fa fa-book" aria-hidden="true"></i>Records <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
            <ul id="demo" class="panel-collapse collapse">
              <li>
              <a class="med" role="submenuitem" data-toggle="collapse"><i class="col-1 fa fa-medkit" aria-hidden="true"></i>Medical <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
              <ul id="med" class="panel-collapse collapse">
                <li>
                  <a href="/LUMDRMS/medical/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
                </li>
                <li>
                  <a href="/LUMDRMS/medical/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
                </li>
              </ul>
            </li>  
            <li>
              <a class="den" role="submenuitem" data-toggle="collapse"><i class="col-1 fa fa-smile-o" aria-hidden="true"></i>Dental <i class="col-1 fa fa-caret-down" aria-hidden="true"></i></a>
              <ul id="den" class="panel-collapse collapse">
                <li>
                  <a href="/LUMDRMS/dental/students/"><i class="col-1 fa fa-graduation-cap" aria-hidden="true"></i>Students</a>
                </li>
                <li>
                  <a href="/LUMDRMS/dental/faculties/"><i class="col-1 fa fa-briefcase" aria-hidden="true"></i>Faculty and Staff</a>
                </li>
              </ul>
            </li>
            </ul>
          </li>
          <?php 
            if ($userRow['role'] == 'superadmin') {?>
            <li>
              <a href="/LUMDRMS/users"><i class="col-1 fa fa-user-md" aria-hidden="true"></i>User Accounts</a>
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

            if (isset($_GET['FacultyID']) && is_numeric($_GET['FacultyID']) && $_GET['FacultyID'] > 0) {

              $FacultyID = $_GET['FacultyID'];
              $res = "SELECT * FROM `faculty_stats` JOIN `faculties` ON `faculties`.`facultyNo`=`faculty_stats`.`facultyNo` WHERE FacultyID=".$_GET['FacultyID'];
              $result = $DB_con->query($res);
              $row = $result->fetch_array(MYSQLI_BOTH);
           
              if(!empty($row)){
          ?>
    
          <!-- Page Heading -->
          <div class="row">           
            <h1 class="page-header">Faculty and Staff Medical Form <span class="text-danger pull-right" id="errmsg"></span>
            </h1>
            <ol class="breadcrumb">
              <li><a href="/LUMDRMS/"><i class="fa fa-home"></i> Home</a></li>
              <li><a href="/LUMDRMS/faculties/">Faculty and Staff</a></li>
              <li class="current"><em>Medical Form</em></li>
            </ol>
          </div>            
          <!-- End of Page Heading -->  

          <!-- Start of Form -->
          <form action="action.php" id="med_form" method="post" autocomplete="">

            <div class="row">
              <!-- Review of System -->
              <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="panel-title">
                    <strong>REVIEW OF SYSTEM</strong>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="col-lg-3">
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Recurrent Headache"> <span class="lbl"></span>Recurrent Headache
                      </label>                         
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Blurring of Vision"> <span class="lbl"></span>Blurring of Vision
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Abdominal Pain"> <span class="lbl"></span>Abdominal Pain
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Cough and colds"> <span class="lbl"></span>Cough and colds
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Chest Pain"> <span class="lbl"></span>Chest pain
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline" title="Loss Of Consciousness" data-toggle="tooltip" data-placement="right" >
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="LOC/Seizure"> <span class="lbl"></span>LOC/Seizure
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Easy fatigability"> <span class="lbl"></span>Easy fatigability
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Easy bruisability"> <span class="lbl"></span>Easy bruisability
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Fever"> <span class="lbl"></span>Fever
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Vomiting"> <span class="lbl"></span>Vomiting
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline" title="Low Bowel Movement" data-toggle="tooltip" data-placement="right" >
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="LBM"> <span class="lbl"></span>LBM
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="sysRev_list[]" value="Dysuria"> <span class="lbl"></span>Dysuria
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" id="otherSysRevCheck" "> <span class="lbl"></span> Other 
                      </label>
                      <input type="text" class="form-control" name="sysRev_list[]" id="otherSysRev" style="display: none;">
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Review of System -->

              <!-- Past Medical History -->
              <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="panel-title">
                    <strong>MEDICAL HISTORY</strong>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="col-lg-3">
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Bronchial Asthma"> <span class="lbl"></span>Bronchial Asthma
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline" title="Pulmonary Tuberculosis" data-toggle="tooltip" data-placement="right">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="PTB"> <span class="lbl"></span>PTB
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Allergy"> <span class="lbl"></span>Allergy
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Hypertension"> <span class="lbl"></span>Hypertension
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline" title="Urinary Tract Infection" data-toggle="tooltip" data-placement="right" >
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="UTI"> <span class="lbl"></span>UTI
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Surgery"> <span class="lbl"></span>Surgery
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Cardiovascular DSE"> <span class="lbl"></span>Cardiovascular DSE
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Bleeding Disorder"> <span class="lbl"></span>Bleeding Disorder
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="form-check-input" name="medHis_list[]" value="Skin Disorder"> <span class="lbl"></span>Skin Disorder
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
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
                <div class="col-lg-6">
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <strong>PERSONAL AND SOCIAL HISTORY</strong>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div class="form-check">
                        <table width="100%">
                          <tr>
                            <td><label class="form-check-label">Alcoholic Drinker: </label></td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" name="drinker" value="Yes"> <span class="lbl"></span>Yes
                              </label> 
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" name="drinker" value="No"> <span class="lbl"></span>No
                              </label> 
                            </td>
                          </tr>     
                          <tr>
                            <td><label class="form-check-label">Smoker: </label></td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" name="smoker" value="Yes"> <span class="lbl"></span>Yes
                              </label> 
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" name="smoker" value="No"> <span class="lbl"></span>No
                              </label> 
                            </td>
                          </tr>
                          <tr>
                            <td><label class="form-check-label">Use of Illicit Drugs: </label></td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" name="drug_user" value="Yes"> <span class="lbl"></span>Yes
                              </label> 
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" name="drug_user" value="No"> <span class="lbl"></span>No
                              </label> 
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <strong>OB/GYNE HISTORY</strong>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div class="form-check">
                        <table width="100%">
                          <tr>
                            <td><label>Menstrual Cycle:</label></td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" name="mens" value="Regular"> <span class="lbl"></span>Regular
                              </label> 
                              <label class="radio-inline">
                                <input type="radio" name="mens" value="Irregular"> <span class="lbl"></span>Irregular
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="mens" value="Not Applicable"> <span class="lbl"></span>Not Applicable
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td><label>Duration:</label></td>
                            <td>
                              <select class="form-control input-sm" name="duration">
                                <option value="">Select</option>
                                <option value="2 to 4 days">2 to 4 days</option>
                                <option value="5 to 7 days">5 to 7 days</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label class="checkbox-inline">
                                <input type="checkbox" value="Dysmenorrhea" name="dys[]" id="dys"> <span class="lbl"></span><strong>Dysmenorrhea</strong>
                              </label> 
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" value="G" name="dys[]" class="dys" disabled > <span class="lbl"></span>G
                              </label> 
                              <label class="radio-inline">
                                <input type="radio" value="P" name="dys[]" class="dys" disabled > <span class="lbl"></span>P
                              </label>
                            </td>
                          </tr>
                        </table>  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End -->

              <!-- Physical Exam -->
              <div class="row">
                <div class="container-fluid">
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <strong>PHYSICAL EXAMINATION</strong>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label>Height: <small><i>(cm)</i></small></label> <span class="error pull-right" id="errHeight"></span>
                            <input type="text" class="form-control value" name="height" id="height" decimaldigits='1' /> 
                            <br>
                            <label>Weight: <small><i>(kg)</i></small></label>  
                            <input type="text" class="form-control value" name="weight" id="weight" decimaldigits='2' /> 
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label>Body Mass Index:</label> 
                            <input type="text" class="form-control" name="bmi[]" id="bmi" readonly style="cursor: not-allowed;" />
                            <br>
                            <label>BMI Category:</label> 
                            <input type="text" class="form-control" name="bmi[]" id="category" readonly style="cursor: not-allowed;" />
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-inline">
                            <label>Blood Pressure: <small><i>(mmHg)</i></small></label>
                            <br>
                            <input type="text" style="width: 80px;" class="form-control" id="upper" name="upper" placeholder="Upper #" /> / 
                            <input type="text" style="width: 80px;" class="form-control" id="lower" name="lower" placeholder="Lower #" />
                          </div> 
                          <br>
                          <label>BP Reading:</label>
                          <input type="text" class="form-control" name="bp" id="bp_reading" readonly /> 
                        </div>
                        <div class="col-lg-2">   
                          <div class="form-group">
                            <label>Cardiac Rate: </label>
                            <input type="text" class="form-control" name="cr"> 
                            <br>
                            <label>Respiratory Rate: </label>
                            <input type="text" class="form-control" name="rr"> 
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label>Temperature: <small><i>(&#x2103; )</i></small></label>
                            <input type="text" class="form-control" name="temp"> 
                          </div>
                        </div>
                      </div>    
                      <table class="table table-bordered table-responsive" id="physical">
                        <thead>
                          <tr>
                            <th>Category</th>
                            <th width="70px">Normal</th>
                            <th colspan="2">Abnormal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>General Survey</th>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="gen_sur" value="Normal" id="normal_gen"> <span class="lbl"></span>
                              </label>
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="gen_sur" value="Abnormal" id="abnormal_gen"> <span class="lbl"></span>
                              </label>
                            </td>
                            <td>
                              <input type="text" id="input_abnormal_gen" class="form-control" name="gen_sur">
                            </td>
                          </tr>
                          <tr>
                            <th>Skin</th>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="skin" value="Normal" id="normal_skin"> <span class="lbl"></span>&nbsp;
                              </label>
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="skin" value="Abnormal" id="abnormal_skin"> <span class="lbl"></span>
                              </label>
                            </td>
                            <td>
                              <input type="text" id="input_abnormal_skin" class="form-control" name="skin" />
                            </td>
                          </tr>
                          <tr>
                            <th>HEENT</th>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="heent" value="Normal" id="normal_heent"> <span class="lbl"></span>&nbsp;
                              </label>
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="heent" value="Abnormal" id="abnormal_heent"> <span class="lbl"></span>
                              </label>
                            </td>
                            <td>
                              <input type="text" id="input_abnormal_heent" class="form-control" name="heent">
                            </td>
                          </tr>
                          <tr>
                            <th>Lungs</th>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="lungs" value="Normal" id="normal_lungs"> <span class="lbl"></span>&nbsp;
                              </label>
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="lungs" value="Abnormal" id="abnormal_lungs"> <span class="lbl"></span>
                              </label>
                            </td>
                            <td>
                              <input type="text" id="input_abnormal_lungs" class="form-control" name="lungs">
                            </td>
                          </tr>
                          <tr>
                            <th>Heart</th>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="heart" value="Normal" id="normal_heart"> <span class="lbl"></span>&nbsp;
                              </label>
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="heart" value="Abnormal" id="abnormal_heart"> <span class="lbl"></span>
                              </label>
                            </td>
                            <td>
                              <input type="text" id="input_abnormal_heart" class="form-control" name="heart">
                            </td>
                          </tr>
                          <tr>
                            <th>Abdomen</th>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="abdomen" value="Normal" id="normal_abdomen"> <span class="lbl"></span>&nbsp;
                              </label>
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="abdomen" value="Abnormal" id="abnormal_abdomen"> <span class="lbl"></span>
                              </label>
                            </td>
                            <td>
                              <input type="text" id="input_abnormal_abdomen" class="form-control" name="abdomen">
                            </td>
                          </tr>
                          <tr>
                            <th>Extremities</th>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="extreme" value="Normal" id="normal_extreme"> <span class="lbl"></span>&nbsp;
                              </label>
                            </td>
                            <td>
                              <label class="radio-inline">
                                <input type="radio" class="form-check-input" name="extreme" value="Abnormal" id="abdomen_extreme"> <span class="lbl"></span>
                              </label>
                            </td>
                            <td>
                              <input type="text" id="input_abnormal_extreme" class="form-control" name="extreme">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <br>

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Chest X ray:</label> <input type="text" class="form-control" name="xray">
                          </div>

                          <div class="form-inline">
                            <label>Assessment:</label> Physically &nbsp;<label class="radio-inline"><input type="radio" name="assess" value="fit"><span class="lbl"></span><strong>fit</strong></label>&nbsp;&nbsp; / <label class="radio-inline"><input type="radio" name="assess" value="fit"><span class="lbl"></span><strong>unfit</strong></label>&nbsp; at the same time of examination
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Plan/Recommendation:</label> 
                            <input type="text" class="form-control" name="plan">
                          </div>
                          <div class="form-group">
                            <?php if (!empty($userRow['first_name']) && !empty($userRow['last_name'])) {
                              $checked_by = $userRow['first_name']. " " .$userRow['last_name'];
                            } 
                            else {
                              $checked_by = $userRow['userName'];
                            }?>
                            <input type="hidden" name="checked_by" value="<?php echo $checked_by; ?>">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group" align="center">
                <input type="hidden" name="facultyNo" value="<?php echo $row['facultyNo']; ?>"/>
                <input type="hidden" name="FacultyID" value="<?php echo $row['FacultyID']; ?>"/>
                <input type="hidden" name="action_type" value="save"/>
                <input type="submit" class="btn btn-primary" id="save" name="btn-save" value="Save Record" />
              </div>
            <!-- End -->

            </div>

          </form>
          <!-- End of Form -->
          <?php }}
          else { header("Location: /LUMDRMS/students/");
          }
            ?>

        </div>  
      </div>
    </div>
    <!-- End of Main Screen -->

  </div>
  <!-- End of Content -->

  <footer class="footer">
    <div class="container-fluid">
        <p class="text-muted" align="right"><a href="http://lu.edu.ph/" target="_blank">Laguna University</a> &copy; 2017</p>
    </div>
  </footer>
    
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/custom.js"></script> 
<script src="../assets/js/form_validate_custom.js"></script> 
<script src="../assets/js/jquery.decimalize.js"></script> 
<script src="../assets/js/medical.js"></script> 

</body>
</html>
<?php ob_end_flush(); ?>