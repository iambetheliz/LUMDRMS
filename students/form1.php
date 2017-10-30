<label>Student No.</label>
                    <input type="text" class="form-control" placeholder="000-0000" name="studentNo" id="studentNo" maxlength="8" autofocus="">
                    
                    <div class="form-group row">   
                      <div class="col-lg-3">          
                        <label class="col-form-label" for="inlineFormInput">Surname</label> 
                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Dela Cruz" name="last_name" id="last_name">
                      </div>
                      <div class="col-lg-3">
                        <label class="col-2 col-form-label" for="inlineFormInput">First Name</label> <span class="text-danger pull-right" id="errmsg"></span>
                        <input type="text" class="form-control" placeholder="Juan" name="first_name" id="first_name">
                      </div>
                      <div class="col-lg-2">
                        <label class="col-2 col-form-label" for="inlineFormInput">Middle Name</label> <span class="text-danger pull-right" id="errmsg"></span>
                        <input type="text" class="form-control" placeholder="Magdayao" name="middle_name" id="middle_name">
                      </div>     
                      <div class="col-lg-1">
                        <label class="col-2 col-form-label" for="inlineFormInput">Ext.</label> <span class="text-danger pull-right" id="errmsg"></span>
                        <input type="text" class="form-control" placeholder="Jr" name="ext" maxlength="2" id="ext">
                      </div>   
                      <div class="col-lg-1">
                        <label for="example-number-input" class="col-2 col-form-label">Age</label> <span class="text-danger pull-right" id="errormsg"></span>
                        <input class="form-control" type="text" placeholder="00" name="age" id="age" maxlength="2">
                      </div>
                      <div class="col-lg-2">
                        <label for="example-date-input" class="col-2 col-form-label">Sex</label>
                          <select class="form-control" name="sexOption">
                            <option value="undefined">Choose...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-6">
                        <label for="example-date-input" class="col-2 col-form-label">Program</label>
                        <select class="form-control" name="program">
                          <option value="undefined">Choose...</option>
                          <option value="BS Accountancy">BS Accountancy</option>
                          <option value="BS Computer Science">BS Computer Science</option>
                          <option value="BS Communication Arts">BS Communication Arts</option>
                          <option value="BS Education">BS Education</option>
                          <option value="BS Entrepreneurship">BS Entrepreneurship</option>
                          <option value="BS Information Technology">BS Information Technology</option>
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <label for="example-date-input" class="col-2 col-form-label">Year Level</label>
                        <select class="form-control" name="yearLevel">
                          <option value="undefined">Choose...</option>
                          <option value="1st">1st Year</option>
                          <option value="2nd">2nd Year</option>
                          <option value="3rd">3rd Year</option>
                          <option value="4th">4th Year</option>
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <label for="example-date-input" class="col-2 col-form-label">Semester</label>
                        <select class="form-control" name="semOption">
                          <option value="undefined">Choose...</option>
                          <option value="1st">1st</option>
                          <option value="2nd">2nd</option>
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <label for="example-date-input" class="col-2 col-form-label">Academic Year</label>
                          <?php
                            $currently_selected = date('Y'); 
                            $earliest_year = 2006; 
                            $latest_year = date('Y');
                          ?>
                          <select class="form-control" name="acadYear" id="acadYear">
                            <?php 
                              foreach ( range( $latest_year, $earliest_year ) as $i ) {
                                print '<option value="'.$i.' - '.++$i.'"'.(--$i === $currently_selected ? 'selected="selected"' : '').'>'.$i.' - '.++$i.'';
                                print '</option>';
                              }
                              print '</select>';
                            ?> 
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-12">
                        <label for="example-date-input" class="col-2 col-form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-6">
                        <label for="example-date-input" class="col-2 col-form-label">Contact Person in case of Emergency</label>
                        <input type="text" class="form-control" name="cperson" id="cperson">
                      </div>
                      <div class="form-group col-lg-3">
                        <label for="example-date-input" class="col-2 col-form-label">Cellphone No.</label>
                        <input type="text" name="cphone" id="cphone" class="form-control" placeholder="09358306457">
                      </div>
                      <div class="form-group col-lg-3">
                        <label for="example-date-input" class="col-2 col-form-label">Telephone No.</label>
                        <input type="text" name="tphone" id="tphone" class="form-control" placeholder="536-1234">
                      </div>
                    </div>