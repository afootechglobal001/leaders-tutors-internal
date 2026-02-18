


<?php if ($page=='staff_reg'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD NEW STAFF</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-div">

                <div class="alert">Kindly fill the form below to <span>ADD NEW STAFF</span></div>

                <div class="title">FULL NAME: <span>*</span></div>
                <input  id="reg_fullname" type="text" class="text_field" placeholder="FULL NAME" title="FULL NAME" />

                <div class="title">EMAIL ADDRESS: <span>*</span></div>
                <input id="reg_email" type="email" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS" />

                <div class="title">PHONE NUMBER: <span>*</span><div id="mobile_info" style="float:right;font-size:12px;display:none;color:#f00"><span>Mobile not accepted!</span></div></div>
                <input id="reg_mobile" type="tel" class="text_field" onkeypress="isNumber_Check()" placeholder="PHONE NUMBER" title="PHONE NUMBER"  />      

                <div class="title">HOME ADDRESS: <span>*</span></div>
                <input id="reg_address" type="text" class="text_field" placeholder="HOME ADDRESS" title="HOME ADDRESS"  />

                <div class="title">SELECT ROLE: <span>*</span></div>
                <select id="reg_role_id" class="text_field selectinput" title="SELECT ROLE">
                    <option value="" selected="selected">SELECT ROLE</option>
                        <script>_get_select_role('reg_role_id');</script>
                </select>
            
                <div class="title">SELECT STATUS: <span>*</span></div>
                <select id="reg_status_id" class="text_field selectinput" title="SELECT STATUS">
                    <option value="" selected="selected">SELECT STATUS</option>
                    <script>_get_select_status('reg_status_id','1,2');</script>
                </select> 
                <button class="action-btn" type="button" title="SUBMIT" id="add_staff_btn" onclick="_add_staff('');"> <i class="bi-check"></i> SUBMIT </button>  
            </div>
        </div> 
    </div>
<?php } ?>


<?php if ($page=='my_profile'){?>
    <?php include 'staff-profile.php';?>
<?php } ?>


<?php if ($page=='staff_profile'){?>
    <div class="overlay-off-div">
        <div class="user-profile-div animated fadeInUp" >
            <div class="top-panel-div">
                <span><i class="bi-person"></i> ADMINISTRATIVE PROFILE</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
            <div class="profile-content-div">

        
                <div class="bg-img">
                    
                    <div class="mini-profile">
                        <label>
                            <div class="img-div" id="current_user_passport1">
                                <img src="" alt=""/>                                
                            </div> 
                        </label>

                        <div class="text-div">
                            <div class="name" id="staff_login_fullname"></div>
                            <div class="text">
                                STATUS: <strong id="staff_status_name"> </strong> | LAST LOGIN DATE: <strong id="last_login_time"> </strong>
                            </div>                 
                        </div>
                    </div>
                </div>

                <div class="user-in">
                    <div class="title">BASIC INFORMATION</div>
                        
                    <div class="profile-segment-div col-3">
                        <div class="segment-title">FULLNAME:</div>
                        <div class="text-field-div no-border">
                            <input id="updt_fullname" type="text" class="text_field text_field2" placeholder="FULLNAME" title="FULLNAME"/>
                        </div>
                    </div>

                    <div class="profile-segment-div col-4">
                        <div class="segment-title">EMAIL:</div>
                        <div class="text-field-div no-border">
                            <input id="updt_email" type="text" class="text_field text_field2" placeholder="EMAIL" title="EMAIL"/>
                        </div>
                    </div>

                    <div class="profile-segment-div col-3">
                        <div class="segment-title">HOME ADDRESS:</div>
                        <div class="text-field-div no-border">
                            <input id="updt_address" type="text" class="text_field text_field2" placeholder="HOME ADDRESS" title="HOME ADDRESS"/>
                        </div>
                    </div>

                    <div class="profile-segment-div col-4"><div id="mobile_info" style="float:right;font-size:12px;display:none;color:#f00"><span>Mobile not accepted!</span></div>
                        <div class="segment-title">PHONE NUMBER:</div>
                        <div class="text-field-div no-border">
                            <input id="updt_mobile" type="text" class="text_field text_field2" onkeypress="isNumber_Check()" placeholder="PHONE NUMBER" title="PHONE NUMBER"/>
                        </div>
                    </div>
                </div>
                

                <div class="user-in">
                    <div class="title">ACCOUNT INFORMATION</div>
                    
                    <div class="profile-segment-div col-5">
                        <div class="segment-title">STAFF ID:</div>
                        <div class="text-field-div">
                            <input id="s_staff_id" type="text" class="text_field" readonly="readonly" placeholder="STAFF ID" title="STAFF ID"/>
                            <span>&nbsp;<i class="bi-lock"></i></span>
                        </div>
                    </div>

                    <div class="profile-segment-div col-6">
                        <div class="segment-title">DATE OF REGISTRATION:</div>
                        <div class="text-field-div">
                            <input id="s_created_time" type="text" readonly="readonly" class="text_field" placeholder="Date Of Registration" title="Date Of Registration"/>
                            <span>&nbsp;<i class="bi-lock"></i></span>
                        </div>
                    </div>

                    <div class="profile-segment-div col-7">
                        <div class="segment-title">LAST LOGIN DATE:</div>
                        <div class="text-field-div">
                            <input id="s_last_login" type="text" class="text_field" readonly="readonly" placeholder="Last Login Date" title="Last Login Date" />
                            <span>&nbsp;<i class="bi-lock"></i></span>
                        </div>
                    </div>
                </div>   

                <div class="user-in user-in-bottom">
                    <div class="title">ADMINISTRATIVE INFORMATION</div>
                    <div class="profile-segment-div col-6">
                        <div class="segment-title">STAFF ROLE:</div>
                        <div class="text-field-div no-border">
                            <select class="text_field text_field2" id="updt_role_id" style="background:#fff;">                                       
                            <option value="">SELECT ROLE </option>
                                <script>_get_select_role('updt_role_id');</script>
                        </select>
                        </div>
                    </div> 


                    <div class="profile-segment-div col-7">
                        <div class="segment-title">STAFF STATUS:</div>
                        <div class="text-field-div no-border">
                            <select class="text_field text_field2" readonly="readonly" id="updt_status_id" style="background:#fff;" >                       
                            <option value="">SELECT STATUS </option>
                            <script> _get_select_status('updt_status_id','1,2');</script>
                        </select>
                        </div>
                    </div>
                    <button class="btn" type="button" id="update_btn" onclick="_update_staff_profile('<?php echo $ids?>');"> UPDATE PROFILE <i class="bi-check"></i></button>     
                </div> 
            </div>
                    
        </div> 
    </div>
    <script>_get_staff_profile('<?php echo $ids?>');</script>
<?php } ?>


<?php if ($page=='add_and_update_subject'){ ?>
    <div class="overlay-off-div">
        <div class="slide-form-div center-form-div animated fadeInUp">
            <div class="fly-title-div">
                <div class="in">
                        <span id="panel-title"><i class="bi-pencil-square"></i> ADD NEW SUBJECT</span>          
                    <div class="close" title="Close" onclick="_alert_close();">X</div>
                </div>
            </div>

            <div class="img-back-div">
                <legend >Click to Upload Subject Pix <i class="bi-upload" ></i></legend>
                <label>
                    <div class="img-div" title="Click To Upload Subject Image">
                        <div class="img-in">
                            <div id=""><img id="subject-pix" src="<?php echo $website_url?>/admin/a/all-images/images/sample.jpg" alt="exam-pix"/></div>
                            <input type="file" id="thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="subj_pix.UpdatePreview(this);"/>
                        </div>
                    </div>
                </label>
            </div>
            
            <div class="container-back-div container-back-div2" >
                <div class="inner-div">

                    <div class="alert">Kindly fill the form below to <span>ADD NEW SUBJECT</span></div>

                    <div class="title">SUBJECT NAME: <span>*</span></div>
                    <input id="subject_name" type="text"  class="text_field" placeholder="SUBJECT NAME" title="SUBJECT NAME"/>
                    
                    <div class="title">SUBJECT URL: <span>*</span></div>
                    <input id="urls" type="text"  class="text_field" placeholder="SUBJECT URL" title="SUBJECT URL"/>          

                    <div class="title">SELECT STATUS: <span>*</span></div>
                    <select id="reg_status_id" class="text_field selectinput" title="SELECT STATUS">
                        <option value="" selected="selected"> SELECT STATUS</option>
                        <script>_get_select_status('reg_status_id','1,2');</script>
                    </select>
                    <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_subject('');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div> 
        </div>
    </div>
<?php } ?>


<?php if ($page=='update_subject'){ ?>
    <div class="overlay-off-div">
        <div class="slide-form-div center-form-div animated fadeInUp">
            <div class="fly-title-div">
                <div class="in">              
                    <span id="panel-title"><i class="bi-pencil-square"></i> UPDATE SUBJECT</span>
                    <div class="close" title="Close" onclick="_alert_close();">X</div>
                </div>
            </div>

            <div class="img-back-div">
                <legend >Click to Upload Subject Pix <i class="bi-upload" ></i></legend>
                <label>
                    <div class="img-div" title="Click To Upload Exam Pix">
                        <div class="img-in">
                            <div id="view_pix"><img id="subject-pix" src="<?php echo $website_url?>/admin/a/all-images/images/sample.jpg" alt="exam-pix"/></div>
                            <input type="file" id="thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="subj_pix.UpdatePreview(this);"/>
                        </div>
                    </div>
                </label>
            </div>
            
            <div class="container-back-div container-back-div2" >
                <div class="inner-div">

                    <div class="alert">Kindly fill the form below to <span>UPDATE SUBJECT</span></div>

                    <div class="title">SUBJECT NAME: <span>*</span></div>
                    <input id="updt_subject_name" type="text"  class="text_field" placeholder="SUBJECT NAME" title="SUBJECT NAME"/>
                    
                    <div class="title">SUBJECT URL: <span>*</span></div>
                    <input id="updt_urls" type="text"  class="text_field" placeholder="SUBJECT URL" title="SUBJECT URL"/>          

                    <div class="title">SELECT STATUS: <span>*</span></div>
                    <select id="updt_status_id" class="text_field selectinput" title="SELECT STATUS">
                        <option value="" selected="selected"> SELECT STATUS</option>
                        <script>_get_select_status('updt_status_id','1,2');</script>
                    </select>
                    <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_update_subject('<?php echo $ids?>');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div> 
        </div>
    </div>
    <script>_fetch_each_subject('<?php echo $ids?>');</script>
<?php } ?>


<?php if ($page=='add_classes'){ ?>
    <div class="overlay-off-div">
        <div class="slide-form-div center-form-div animated fadeInUp">
            <div class="fly-title-div">
                <div class="in">
                        <span id="panel-title"><i class="bi-pencil-square"></i> ADD NEW CLASS</span>          
                    <div class="close" title="Close" onclick="_alert_close();">X</div>
                </div>
            </div>

            <div class="img-back-div">
                <legend >Click to Upload Class Pix <i class="bi-upload" ></i></legend>
                <label>
                    <div class="img-div" title="Click To Upload Exam Pix">
                        <div class="img-in">
                            <div id=""><img id="subject-pix" src="<?php echo $website_url?>/admin/a/all-images/images/sample.jpg" alt="exam-pix"/></div>
                            <input type="file" id="thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="subj_pix.UpdatePreview(this);"/>
                        </div>
                    </div>
                </label>
            </div>
            
            <div class="container-back-div container-back-div2" >
                <div class="inner-div">

                    <div class="alert">Kindly fill the form below to <span>ADD NEW CLASS</span></div>

                    <div class="title">CLASS NAME: <span>*</span></div>
                    <input id="class_name" type="text"  class="text_field" placeholder="CLASS NAME" title="CLASS NAME"/>
                    
                    <div class="title">CLASS URL: <span>*</span></div>
                    <input id="urls" type="text"  class="text_field" placeholder="CLASS URL" title="CLASS URL"/>          

                    <div class="title">SELECT STATUS: <span>*</span></div>
                    <select id="reg_status_id" class="text_field selectinput" title="SELECT STATUS">
                        <option value="" selected="selected"> SELECT STATUS</option>
                        <script>_get_select_status('reg_status_id','1,2');</script>
                    </select>
                    <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_classes('');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div> 
        </div>
    </div>
<?php } ?>


<?php if ($page=='update_classes'){ ?>
    <div class="overlay-off-div">
        <div class="slide-form-div center-form-div animated fadeInUp">
            <div class="fly-title-div">
                <div class="in">              
                    <span id="panel-title"><i class="bi-pencil-square"></i> UPDATE CLASS</span>
                    <div class="close" title="Close" onclick="_alert_close();">X</div>
                </div>
            </div>

            <div class="img-back-div">
                <legend >Click to Upload Class Pix <i class="bi-upload" ></i></legend>
                <label>
                    <div class="img-div" title="Click To Upload Exam Pix">
                        <div class="img-in">
                            <div id="view_pix"><img id="subject-pix" src="<?php echo $website_url?>/admin/a/all-images/images/sample.jpg" alt="exam-pix"/></div>
                            <input type="file" id="thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="subj_pix.UpdatePreview(this);"/>
                        </div>
                    </div>
                </label>
            </div>
            
            <div class="container-back-div container-back-div2" >
                <div class="inner-div">
                    <div class="alert">Kindly fill the form below to <span>UPDATE CLASS</span></div>

                    <div class="title">CLASS NAME: <span>*</span></div>
                    <input id="updt_class_name" type="text"  class="text_field" placeholder="CLASS NAME" title="CLASS NAME"/>
                    
                    <div class="title">SUBJECT URL: <span>*</span></div>
                    <input id="updt_urls" type="text"  class="text_field" placeholder="CLASS URL" title="CLASS URL"/>          

                    <div class="title">SELECT STATUS: <span>*</span></div>
                    <select id="updt_status_id" class="text_field selectinput" title="SELECT STATUS">
                        <option value="" selected="selected"> SELECT STATUS</option>
                        <script>_get_select_status('updt_status_id','1,2');</script>
                    </select>
                    <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_update_classes('<?php echo $ids?>');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div> 
        </div>
    </div>
    <script>_fetch_each_class('<?php echo $ids?>');</script>
<?php } ?>


<?php if ($page=='dept_reg'){ ?>
    <div class="overlay-off-div">
        <div class="slide-form-div center-form-div animated fadeInUp">
            <div class="fly-title-div">
                <div class="in">
                    <span id="panel-title"><i class="bi-pencil-square"></i> ADD NEW DEPARTMENT</span>
                    <div class="close" title="Close" onclick="_alert_close();">X</div>
                </div>
            </div>

            <div class="img-back-div">
                <legend >Click to Upload Department Pix <i class="bi-upload" ></i></legend>
                <label>
                    <div class="img-div" title="Click To Upload Exam Pix">
                        <div class="img-in">
                            <div id="view_exam"><img id="subject-pix" src="<?php echo $website_url?>/admin/a/all-images/images/sample.jpg" alt="Exam pix" /></div>
                            <input type="file" id="thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="subj_pix.UpdatePreview(this);"/>
                        </div>
                    </div>
                </label>
            </div>
            
            <div class="container-back-div container-back-div2" >
                <div class="inner-div">

                    <div class="alert">Kindly fill the form below to <span>ADD NEW DEPARTMENT</span></div>

                    <div class="title">DEPARTMENT NAME: <span>*</span></div>
                    <input id="department_name" type="text" class="text_field" placeholder="DEPARTMENT NAME" title="DEPARTMENT NAME" />
                    
                    <div class="title">DEPARTMENT URL: <span>*</span></div>
                    <input id="urls" type="text"  class="text_field" placeholder="DEPARTMENT URL" title="DEPARTMENT URL"/>
                    
                    <div class="title">SEO KEYWORDS: <span>*</span></div>
                    <textarea id="seo_keywords" class="text_field textarea" rows="2" maxlength="160" title="SEO KEYWORDS" placeholder="SEO KEYWORDS"></textarea>

                    <div class="title">SEO DESCRIPTION: <span>*</span></div>
                    <textarea id="seo_description" class="text_field textarea" rows="2" maxlength="160" title="SEO DESCRIPTION" placeholder="SEO DESCRIPTION"></textarea>
                
                    <div class="title">SELECT STATUS: <span>*</span></div>
                    <select id="reg_status_id" class="text_field selectinput" title="SELECT STATUS">
                        <option value="" selected="selected"> SELECT STATUS</option>
                        <script>_get_select_status('reg_status_id','1,2');</script>
                    </select> 
                    <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_department('');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div> 
        </div>
    </div>
<?php } ?>


<?php if ($page=='update_dept'){ ?>
    <div class="overlay-off-div">
        <div class="slide-form-div center-form-div animated fadeInUp">
            <div class="fly-title-div">
                <div class="in">
                    <span id="panel-title"><i class="bi-pencil-square"></i> UPADTE DEPARTMENT</span>
                    <div class="close" title="Close" onclick="_alert_close();">X</div>
                </div>
            </div>

            <div class="img-back-div">
                <legend >Click to Upload Department Pix <i class="bi-upload" ></i></legend>
                <label>
                    <div class="img-div" title="Click To Upload Exam Pix">
                        <div class="img-in">
                            <div id="view_pix"><img id="subject-pix" src="<?php echo $website_url?>/admin/a/all-images/images/sample.jpg" alt="Exam pix" /></div>
                            <input type="file" id="thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="subj_pix.UpdatePreview(this);"/>
                        </div>
                    </div>
                </label>
            </div>
            
            <div class="container-back-div container-back-div2" >
                <div class="inner-div">

                    <div class="alert">Kindly fill the form below to <span> UPADTE DEPARTMENT </span></div>

                    <div class="title">DEPARTMENT NAME: <span>*</span></div>
                    <input id="updt_department_name" type="text" class="text_field" placeholder="DEPARTMENT NAME" title="DEPARTMENT NAME" />
                    
                    <div class="title">DEPARTMENT URL: <span>*</span></div>
                    <input id="updt_urls" type="text"  class="text_field" placeholder="DEPARTMENT URL" title="DEPARTMENT URL"/>
                    
                    <div class="title">SEO KEYWORDS: <span>*</span></div>
                    <textarea id="updt_seo_keywords" class="text_field textarea" rows="2" maxlength="160" title="SEO KEYWORDS" placeholder="SEO KEYWORDS"></textarea>

                    <div class="title">SEO DESCRIPTION: <span>*</span></div>
                    <textarea id="updt_seo_description" class="text_field textarea" rows="2" maxlength="160" title="SEO DESCRIPTION" placeholder="SEO DESCRIPTION"></textarea>
                
                    <div class="title">SELECT STATUS: <span>*</span></div>
                    <select id="updt_status_id" class="text_field selectinput" title="SELECT STATUS">
                        <option value="" selected="selected"> SELECT STATUS</option>
                        <script>_get_select_status('updt_status_id','1,2');</script>
                    </select> 
                    <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_update_department('<?php echo $ids?>');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div> 
        </div>
    </div>
    <script>_fetch_each_department('<?php echo $ids?>');</script>
<?php } ?>


<?php if ($page=='add_class_dept'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW CLASS</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div" >
            <div class="inner-div" id="status_id">

                <div class="alert" id="search_keywords">Kindly check the checkboxes to add a new class under <span id="department1_name">XXX</span> Department</div>

                <div class="title">SELECT CLASS: <span>*</span></div>
                    <div class="subject-info-div">
                        <div class="div-in" id="fetch_classes_checkbox">
                            <label for="">
                                <!-- <div class="radio-in-div">
                                    <div class="radio"><input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY"><div class="border"></div></div>
                                    <span>JUPEB</span>
                                </div> -->
                            </label>                       
                        </div>                  
                    </div>
                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_class_dept('<?php echo $ids?>');"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div> 
    </div>
    <script> _get_fetch_all_classes('fetch_classes_checkbox');</script>
    <script>_get_fetch_form_class_dept('<?php echo $ids?>');</script>
<?php } ?>


<?php if ($page=='add_subject_class'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW SUBJECT</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div" >
            <div class="inner-div" id="status_id">

                <div class="alert" id="search_keywords">Kindly check the checkboxes to add a new subject under <span id="class1_name">XXX</span> Class</div>

                <div class="title">SELECT CLASS: <span>*</span></div>
                    <div class="subject-info-div">
                        <div class="div-in" id="fetch_subject_checkbox">
                            <label for="">
                                <!-- <div class="radio-in-div">
                                    <div class="radio"><input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY"><div class="border"></div></div>
                                    <span>JUPEB</span>
                                </div> -->
                            </label>                       
                        </div>                  
                    </div>
                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_subject_class('<?php echo $department_id?>','<?php echo $class_id?>');"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div> 
    </div>
    <script> _get_fetch_all_subject('fetch_subject_checkbox');</script>
    <script>_get_fetch_form_subject_class('<?php echo $department_id?>','<?php echo $class_id?>');</script>
<?php } ?>
     

<?php if ($page=='select_class_form'){?>
	<div class="caption-div animated zoomIn">
        <div  class="title-div select-title"><button class="close-btn" onclick="_alert_close()"><i class="bi-x-lg"></i></button></div>
        <div class="div-in animated fadeInRight">
            <div class="alert alert-success"> Hi, You are about to view <strong><span>Tutorial</span></strong> videos. <br/> Kindly select <strong>department</strong> & <strong>Class</strong> to Continue.</div>

            <div class="title">SELECT DEPARTMENT: <span>*</span></div>
            <select id="department_id" onchange="_get_class('department_id','class_id');" class="text_field selectinput" title="SELECT DEPARTMENT">
                <option value="" selected="selected">SELECT DEPARTMENT</option>
                <script>_get_select_department('department_id');</script>
            </select> 

            <div class="title">SELECT CLASS: <span>*</span></div>
            <select id="class_id" class="text_field selectinput" title="SELECT DEPARTMENT FIRST">
                <option value="" selected="selected">SELECT DEPARTMENT FIRST</option>           
            </select>
            <button class="btn" type="button" id="submit_btn"  title="Proceed"  onclick="_fetch_department_class_subject('');" ><i class="bi-check"></i> PROCEED </button>
        </div>
    </div>
<?php } ?>


<?php if ($page=='video_reg'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD NEW VIDEO</span>
                <div class="close" title="Close" onclick="_alert_close2();">X</div>
            </div>
        </div>

        <div class="container-back-div" >
            <div class="inner-div">
                <div class="alert alert-success">
                    <p>Kindly fill the form below to add a new tutorial:</p>
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>DEPARMTMENT:</div>
                            <div><span id="tut_department_name">xxxx</span></div>
                        </div>
                        <div class="alert-list">
                            <div>CLASS:</div>
                            <div><span id="tut_class_name">xxxx</span></div>
                        </div>
                        <div class="alert-list">
                            <div>SUBJECT:</div>
                            <div><span id="tut_subject_name">xxxx</span></div>
                        </div>
                    </div>
                </div>               

                <div class="title">SELECT TERM: <span>*</span></div>
                <select id="term_id" class="text_field selectinput" title="SELECT TERM">
                    <option value="" selected="selected">SELECT TERM</option>
                    <script>_get_select_term('term_id');</script>
                </select> 

                <div class="title">SELECT WEEK: <span>*</span></div>
                <select id="week_id" class="text_field selectinput" title="SELECT WEEK">
                    <option value="" selected="selected">SELECT WEEK</option>
                    <script>_get_select_week('week_id');</script>
                </select> 

                <!-- <div class="title">SELECT VIDEO SERIES: <span>*</span></div>
                <select id="series_id" class="text_field selectinput" title="VIDEO SERIES">
                    <option value="" selected="selected">VIDEO SERIES</option>
                    <script>_get_select_series('series_id');</script>
                </select>  -->

                <div class="title">TOPIC: <span>*</span></div>
                <input id="topic" type="text"  class="text_field" placeholder="TOPIC" title="TOPIC"/>

                <div class="title">URL: <span>*</span></div>
                <input id="urls" type="text"  class="text_field" placeholder="URL" title="URL"/>

                <div class="title">SEO KEYWORDS: <span>*</span></div>
                <textarea id="seo_keywords" class="text_field textarea" rows="2" maxlength="160" title="SEO KEYWORDS" placeholder="SEO KEYWORDS"></textarea>

                <div class="title">SEO DESCRIPTION: <span>*</span></div>
                <textarea id="seo_description" class="text_field textarea" rows="2" maxlength="160" title="SEO DESCRIPTION" placeholder="SEO DESCRIPTION"></textarea>

                <div class="title">CLASS SUMMARY: <span>*</span></div>
                <script src="js/TextEditor.js" referrerpolicy="origin"></script>
                <script>tinymce.init({selector:'#summary',  // change this value according to your HTML
                plugins: "link, image, table"
                });</script>
                <textarea style="width: 100%;" rows="20" id="summary" title="CLASS SUMMARY" placeholder="CLASS SUMMARY"></textarea>
                <br clear="all"/>
                
                <div class="video-img-back-div">
                    <legends>Click to Upload Video Image <i class="bi-upload"></i></legends>
                    <label>
                        <div class="img-div bottom-image-div" title="Click To Upload Tutorial Video Image">
                            <img id="subject-pix" src="<?php echo $website_url?>/admin/a/all-images/images/default.png" alt="Default Image">
                            <input type="file" id="thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="subj_pix.UpdatePreview(this);" />
                        </div>
                    </label> 
                </div>


                <div class="video-img-back-div">
                    <legend style="cursor:pointer;">Click to Upload Video <i class="bi-upload"></i></legend>
                        <label>
                            <div class="img-div video-div" title="Click To Upload Tutorial Video">
                                <div id="view_sub_topic_video" class="video-container">
                                    <video src="" id="videoDisplay" name="sub_video" controls="controls" loop="" class="video-slide"></video>
                                    <div id="video-background" class="background-image">
                                        <img src="<?php echo $website_url?>/admin/a/all-images/images/default.png" alt="Default Image">
                                    </div>
                                </div>
                                <input name="sub_video" id="video" onchange="showVideo(this)" type="file" style="display:none;">
                            </div>
                        </label> 
                        <script>     
                            var videoDisplay = document.getElementById('videoDisplay');
                            var videoInput = document.getElementById('video');
                            var legendElement = document.querySelector('legend');
                            
                            // Add click event listener to the legend element
                            legendElement.addEventListener('click', function () {
                                videoInput.click();
                            });
                        
                            videoInput.addEventListener('change', function () {
                                showVideo(this);
                            });
                        
                            function showVideo(input) {
                                var videoDisplay = document.getElementById('videoDisplay');
                                var videoBackground = document.getElementById('video-background');
                        
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        videoDisplay.src = e.target.result;
                                        videoBackground.style.display = 'none'; // Hide the default background image
                                        videoDisplay.style.display = 'block'; // Show the video
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                </div>

                <div class="title">VIDEO DURATION: <span>*</span> (HH:MM:SS)</div>
                <input id="duration" type="text" class="text_field" placeholder="00:00:00" title="VIDEO DURATION"/>              
                
                <div class="pdf-back-div">
                    <div class="title">CLASS MATERIAL (PDF): <span>*</span></div>
                    <legend id="pdf_legend" style="cursor:pointer;">Click to Upload PDF <i class="bi-upload"></i></legend>
                    <div class="div-in" id="pdf_upload_area">
                        <label>
                            <div id="pdf_display" class="pdf-container background-display">
                                <embed id="pdfFile" src="" type="application/pdf" width="100%" height="350px" style="display: none;">                          
                                <div id="pdf-background" class="background-text" style="cursor:pointer;">
                                    <img src="<?php echo $website_url?>/admin/a/all-images/images/default.png" alt="Default Image">
                                </div>
                            </div>
                            <input type="file" id="material" onchange="showPdf(this)" name="pdf_file" accept=".pdf" style="display: none;">
                        </label>
                    </div>
                    <div id="file-list">
                        <!-- PDF will be displayed here -->
                    </div>
                </div>


                <script>
                    var pdfDisplay = document.getElementById('pdf_display');
                    var pdfInput = document.getElementById('material');
                    var fileList = document.getElementById('file-list');
                    var legendElement = document.getElementById('pdf_legend');
                    var pdfEmbed = document.getElementById('pdfFile');

                    function showPdf(input) {
                        if (input.files && input.files[0]) {
                            var file = URL.createObjectURL(input.files[0]);
                            pdfDisplay.classList.add('embed-display');
                            pdfDisplay.classList.remove('background-display');
                            pdfEmbed.style.display = 'block'; // Display the PDF embed
                            pdfEmbed.src = file;
                            pdfDisplay.querySelector('.background-text').style.display = 'none';

                            // Show file size
                            var fileSize = input.files[0].size;
                            var sizeInMB = (fileSize / (1024 * 1024)).toFixed(2); // Convert to MB with two decimal places
                            fileList.innerHTML = 'File size: ' + sizeInMB + ' MB';
                        }
                    }   


                    // Trigger file input click on the legend click
                    legendElement.addEventListener('click', function() {
                        pdfInput.click();
                    });

                    // Drag and drop functionality
                    pdfDisplay.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        pdfDisplay.classList.add('drag-over');
                    });

                    pdfDisplay.addEventListener('dragleave', function() {
                        pdfDisplay.classList.remove('drag-over');
                    });

                    pdfDisplay.addEventListener('drop', function(e) {
                        e.preventDefault();
                        pdfDisplay.classList.remove('drag-over');
                        var file = e.dataTransfer.files[0];
                        pdfInput.files = e.dataTransfer.files;
                        showPdf(pdfInput);
                    });


                </script>

                <div class="title">SELECT STATUS: <span>*</span></div>
                <select id="reg_status_id" class="text_field select_input" title="SELECT STATUS">
                    <option value="" selected="selected"> SELECT STATUS</option>
                    <script>_get_select_status('reg_status_id','1,2');</script>
                </select> 

                <div class="alert alert-success" id="progress-alert">
                    <span>UPLOADING IN PROGRESS...</span><br>
                    Please DO NOT close this panel as the process takes some time.
                    <div class="ajax-progress">0%</div>
                </div> 

                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_tutorial_video('<?php echo $department_id?>','<?php echo $class_id?>','<?php echo $subject_id?>');"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div> 
    </div>
    <script>_get_fetch_department_class_subject_form('<?php echo $department_id?>','<?php echo $class_id?>')</script>
    <script>_get_fetch_subject_form('<?php echo $subject_id?>')</script>
<?php } ?>


<?php if ($page=='update_video'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE VIDEO</span>
                <div class="close" title="Close" onclick="_alert_close2();">X</div>
            </div>
        </div>

        <div class="container-back-div" >
            <div class="inner-div">
                <div class="alert alert-success">
                    <p>Kindly fill the form below to update tutorial:</p>
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>DEPARMTMENT:</div>
                            <div><span id="tut_department_name">xxxx</span></div>
                        </div>
                        <div class="alert-list">
                            <div>CLASS:</div>
                            <div><span id="tut_class_name">xxxx</span></div>
                        </div>
                        <div class="alert-list">
                            <div>SUBJECT:</div>
                            <div><span id="update_subject_name">xxxx</span></div>
                        </div>
                    </div>
                </div>  

                <div class="title">SUBJECT: <span>*</span></div>
                <select id="subject_id" class="text_field selectinput" title="SUBJECT">
                    <option value="" selected="selected"></option>
                    <script>_fetch_select_subject('subject_id');</script>
                </select> 

                <div class="title">SELECT TERM: <span>*</span></div>
                <select id="term_id" class="text_field selectinput" title="SELECT TERM">
                    <option value="" selected="selected">SELECT TERM</option>
                    <script>_get_select_term('term_id');</script>
                </select> 

                <div class="title">SELECT WEEK: <span>*</span></div>
                <select id="week_id" class="text_field selectinput" title="SELECT WEEK">
                    <option value="" selected="selected">SELECT WEEK</option>
                    <script>_get_select_week('week_id');</script>
                </select> 

                <!-- <div class="title">SELECT VIDEO SERIES: <span>*</span></div>
                <select id="series_id" class="text_field selectinput" title="VIDEO SERIES">
                    <option value="" selected="selected">VIDEO SERIES</option>
                    <script>_get_select_series('series_id');</script>
                </select>  -->

                <div class="title">TOPIC: <span>*</span></div>
                <input id="topic" type="text"  class="text_field" placeholder="TOPIC" title="TOPIC"/>

                <div class="title">URL: <span>*</span></div>
                <input id="urls" type="text"  class="text_field" placeholder="URL" title="URL"/>

                <div class="title">SEO KEYWORDS: <span>*</span></div>
                <textarea id="seo_keywords" class="text_field textarea" rows="2" maxlength="160" title="SEO KEYWORDS" placeholder="SEO KEYWORDS"></textarea>

                <div class="title">SEO DESCRIPTION: <span>*</span></div>
                <textarea id="seo_description" class="text_field textarea" rows="2" maxlength="160" title="SEO DESCRIPTION" placeholder="SEO DESCRIPTION"></textarea>

                <div class="title">CLASS SUMMARY: <span>*</span></div>
                <script src="js/TextEditor.js" referrerpolicy="origin"></script>
                <script>tinymce.init({selector:'#summary',  // change this value according to your HTML
                plugins: "link, image, table"
                });</script>
                <textarea style="width: 100%;" rows="20" id="summary" title="CLASS SUMMARY" placeholder="CLASS SUMMARY"></textarea>
                <br clear="all"/>
                
                
                <div class="video-img-back-div">
                    <legends>Click to Upload Video Image <i class="bi-upload"></i></legends>
                    <label>
                        <div class="bottom-image-div" title="Click to upload tutorial Video Image">
                            <div id="view_tutorial_pix"><img id="subject-pix" src="<?php echo $website_url?>/admin/a/all-images/images/default.png" alt="Default Image"></div>
                            <input type="file" id="thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="subj_pix.UpdatePreview(this);" />
                        </div>
                    </label> 
                </div>


                <div class="video-img-back-div">
                    <legend style="cursor:pointer;">Click to Upload Video <i class="bi-upload"></i></legend>
                        <label>
                            <div class="img-div video-div" title="Click to upload tutorial Video">
                                <div id="view_sub_topic_video" class="video-container">
                                    <video src="" id="videoDisplay" name="sub_video" controls="controls" loop="" class="video-slide"></video>
                                    <div id="video-background" class="background-image">
                                        <img src="<?php echo $website_url?>/admin/a/all-images/images/default.png" alt="Default Image">
                                    </div>
                                </div>
                                <input name="sub_video" id="video" onchange="showVideo(this)" type="file" style="display:none;">
                            </div>
                        </label> 
                        <script>     
                            var videoDisplay = document.getElementById('videoDisplay');
                            var videoInput = document.getElementById('video');
                            var legendElement = document.querySelector('legend');
                            
                            // Add click event listener to the legend element
                            legendElement.addEventListener('click', function () {
                                videoInput.click();
                            });
                        
                            videoInput.addEventListener('change', function () {
                                showVideo(this);
                            });
                        
                            function showVideo(input) {
                                var videoDisplay = document.getElementById('videoDisplay');
                                var videoBackground = document.getElementById('video-background');
                        
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        videoDisplay.src = e.target.result;
                                        videoBackground.style.display = 'none'; // Hide the default background image
                                        videoDisplay.style.display = 'block'; // Show the video
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                </div>

                <div class="title">VIDEO DURATION: <span>*</span> (HH:MM:SS)</div>
                <input id="duration" type="text" class="text_field" placeholder="00:00:00" title="VIDEO DURATION"/>              
                
                <div class="pdf-back-div">
                    <div class="title">CLASS MATERIAL (PDF): <span>*</span></div>
                    <legend id="pdf_legend" style="cursor:pointer;">Click to Upload PDF <i class="bi-upload"></i></legend>
                    <div class="div-in" id="pdf_upload_area">
                        <label>
                            <div id="pdf_display" class="pdf-container background-display">
                                <embed id="pdfFile" src="" type="application/pdf" width="100%" height="350px" style="display: none;">                          
                                <div id="pdf-background" class="background-text" style="cursor:pointer;">
                                    <img src="<?php echo $website_url?>/admin/a/all-images/images/default.png" alt="Default Image">
                                </div>
                            </div>
                            <input type="file" id="material" onchange="showPdf(this)" name="pdf_file" accept=".pdf" style="display: none;">
                        </label>
                    </div>
                    <div id="file-list">
                        <!-- PDF will be displayed here -->
                    </div>
                </div>


                <script>
                    var pdfDisplay = document.getElementById('pdf_display');
                    var pdfInput = document.getElementById('material');
                    var fileList = document.getElementById('file-list');
                    var legendElement = document.getElementById('pdf_legend');
                    var pdfEmbed = document.getElementById('pdfFile');

                    function showPdf(input) {
                        if (input.files && input.files[0]) {
                            var file = URL.createObjectURL(input.files[0]);
                            pdfDisplay.classList.add('embed-display');
                            pdfDisplay.classList.remove('background-display');
                            pdfEmbed.style.display = 'block'; // Display the PDF embed
                            pdfEmbed.src = file;
                            pdfDisplay.querySelector('.background-text').style.display = 'none';

                            // Show file size
                            var fileSize = input.files[0].size;
                            var sizeInMB = (fileSize / (1024 * 1024)).toFixed(2); // Convert to MB with two decimal places
                            fileList.innerHTML = 'File size: ' + sizeInMB + ' MB';
                        }
                    }   


                    // Trigger file input click on the legend click
                    legendElement.addEventListener('click', function() {
                        pdfInput.click();
                    });

                    // Drag and drop functionality
                    pdfDisplay.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        pdfDisplay.classList.add('drag-over');
                    });

                    pdfDisplay.addEventListener('dragleave', function() {
                        pdfDisplay.classList.remove('drag-over');
                    });

                    pdfDisplay.addEventListener('drop', function(e) {
                        e.preventDefault();
                        pdfDisplay.classList.remove('drag-over');
                        var file = e.dataTransfer.files[0];
                        pdfInput.files = e.dataTransfer.files;
                        showPdf(pdfInput);
                    });


                </script>

                <div class="title">SELECT STATUS: <span>*</span></div>
                <select id="updt_status_id" class="text_field select_input" title="SELECT STATUS">
                    <option value="" selected="selected"> SELECT STATUS</option>
                    <script>_get_select_status('updt_status_id','1,2');</script>
                </select> 

                <div class="alert alert-success" id="progress-alert">
                    <span>UPLOADING IN PROGRESS...</span><br>
                        Please DO NOT close this panel as the process takes some time.
                    <div class="ajax-progress">0%</div>
                </div> 

                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_update_tutorial_video('<?php echo $department_id?>','<?php echo $class_id?>','<?php echo $tutorial_id?>');"> <i class="bi-check"></i> SUBMIT </button>

            </div>
        </div> 
    </div>
    <script>_get_fetch_each_video_tutorial('<?php echo $tutorial_id?>')</script>
    <script>_get_fetch_department_class_subject_form('<?php echo $department_id?>','<?php echo $class_id?>')</script>
    <script>_get_fetch_subject_form('<?php echo $subject_id?>')</script>
<?php } ?>



<?php if ($page=='alert-read'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-bell"></i> Notification Details</span>
                <div class="close" title="Close" onclick="_alert_close2();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-div">
                <div class="alert alert-success">
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>User ID:</div>
                            <div><span id="read_user_id">xxxx</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Action Performed By:</div>
                            <div><span id="user_name">xxxx</span></div>
                        </div>
                        <div class="alert-list">
                            <div>IP Address Used:</div>
                            <div><span id="ip_address">xxxx</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Computer Used:</div>
                            <div><span id="system_name">xxxx</span></div>
                        </div>
                    </div>
                </div>


                <div class="alert alert-success">
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>Alert ID:</div>
                            <div><span id="alert_id">xxxx</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Date:</div>
                            <div><span id="created_time">xxxx</span></div>
                        </div>
                    </div>
                </div>

                <div class="title">Alert Details:</div>
                <div class="alert alert-success" id="alert_detail">xxxx</div>

                <button class="action-btn" onclick="_alert_close2();"> <i class="bi-check"></i> OK </button>
            </div>
        </div> 
    </div>
    <script>_fetch_read_alert('<?php echo $ids?>');</script>
<?php } ?>


<?php if ($page=='faqs_reg'){ ?>
    <div class="overlay-off-div">
        <div class="slide-form-div animated fadeInRight">
            <div class="fly-title-div">
                <div class="in">
                        <span id="panel-title"><i class="bi-plus-square"></i> ADD NEW FAQ</span>               
                    <div class="close" title="Close" onclick="_alert_close();">X</div>
                </div>
            </div>


            <div class="container-back-div">
                <div class="inner-div">

                <div class="alert">Kindly fill the form below to <span>ADD NEW FAQ</span></div>

                <div class="title">FAQ CATEGORY: <span>*</span></div>
                <select id="cat_id" class="text_field select_field" title="SELECT FAQ's CATEGORY">
                    <option value=""> SELECT FAQ CATEGORY</option>
                    <script>_get_cat('cat_id');</script>
                </select>

                <div class="title">FAQ QUESTION: <span>*</span></div>
                <input id="faq_question" type="text" class="text_field" placeholder="Type Question Here" title="Question" title="FULL NAME"/>
                            
                <div class="title">FAQ ANSWER: <span>*</span></div>
                    <script src="js/TextEditor.js" referrerpolicy="origin"></script>
                    <script>tinymce.init({selector:'#faq_answer',  // change this value according to your HTML
                    plugins: "link, image, table"
                    });</script>
                    <textarea style="width:100%;" rows="20" id="faq_answer" title="Type Answer Here" placeholder="Type Answer Here"></textarea>

                <div class="title">SELECT STATUS: <span>*</span></div>
                    <select id="reg_status_id" class="text_field select_field" title="SELECT STATUS">
                        <option value="" selected="selected">SELECT STATUS</option>
                        <script>_get_select_status('reg_status_id','1,2');</script>
                    </select> 

                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_or_register_faq('<?php echo $ids?>');"> <i class="bi-check"></i> SUBMIT </button>
                
                </div>
            </div> 
        </div>
    </div>
<?php } ?>



 <!-- USER FORM -->
<?php if ($page=='user_details'){ ?>
    <div class="overlay-off-div">
        <div class="user-profile-div user animated fadeInUp">
            <div class="top-panel-div">
                <span><i class="bi-person"></i> USER DETAILS</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>

            <div class="profile-content-div">

                <div class="bg-img">
                    <div class="mini-profile">
                        <label>
                            <div class="img-div" id="current_user_pass">
                            <img src="<?php echo $website_url?>/admin/a/all-images/images/avatar.jpg" alt="Profile Picture">                                
                            </div> 
                        </label>

                        <div class="text-div">
                            <div class="name" id="user_login_fullname"></div>
                            <div class="text">
                                STATUS: <strong id="user_status_name"> </strong> | LAST LOGIN DATE: <strong id="user_last_login"> </strong>
                            </div>               
                        </div>
                    </div>
                </div>

                <div class="button-div">
                    <button class="btn-history active-btn" id="next-all" onclick="_get_detail('user_profile_details','<?php echo $ids?>','<?php echo $ids?>', 'all')"><i class="bi-person"></i> PROFILE</button>
                    <button class="btn-history" id="next-trans" onclick="_get_detail('transaction_history_detail','<?php echo $ids?>', 'trans')"><i class="bi-credit-card"></i> TRANSACTION HISTORY</button>
                    <button class="btn-history" id="next-wallet" onclick="_get_detail('wallet_history_details','<?php echo $ids?>', 'wallet')"><i class="bi-credit-card"></i> WALLET HISTORY</button>
                </div>

                <br clear="all"/>
                <br clear="all"/>
                <div class="details-div">
                    <h4>TOTAL WALLET BALANCE</h4>
                    <div class="wallet-details-div">
                        <div class="inner-div">
                            <div class="amount">₦ <span id="amount_received">0.00</span> 
                                <p>TOTAL AMOUNT RECIEVED</p>
                            </div>
                        </div>

                        <div class="inner-div">
                            <div class="amount">₦ <span id="amount_withdraw">0.00</span> 
                                <p>TOTAL AMOUNT SPENT</p>
                            </div>
                        </div>
                        
                        <div class="inner-div no-border">
                            <div class="amount">₦ <span id="wallet_balance">0.00</span> 
                                <p>AVAILABLE BALANCE</p>
                            </div>
                        </div>
                    </div>
                    <br clear="all" /> 

                        
                    <div class="search-details" id="get_detail"> 
                
                            <div class="title" style="text-align:left; padding-left:20px;font-size:12px;"><i class="bi-person"></i> USER PROFILE  </div>
                                        
                            <div class="user-in">
                                <div class="title">BASIC INFORMATION</div>
                        
                                <div class="profile-segment-div col-3">
                                    <div class="segment-title">FULLNAME:</div>
                                    <div class="text-field-div no-border">
                                        <input id="updt_fullname" type="text" class="text_field text_field2" placeholder="FULLNAME" title="FULLNAME"/>
                                    </div>
                                </div>


                                <div class="profile-segment-div col-8">
                                    <div class="segment-title">EMAIL:</div>
                                    <div class="text-field-div no-border">
                                        <input id="updt_email" type="text" class="text_field text_field2" placeholder="EMAIL" title="EMAIL"/>
                                    </div>
                                </div>

                                <div class="profile-segment-div col-3"><div id="mobile_info" style="float:right;font-size:12px;display:none;color:#f00"><span>Mobile not accepted!</span></div>
                                    <div class="segment-title">PHONE NUMBER:</div>
                                    <div class="text-field-div no-border">
                                        <input id="updt_mobile" type="text" class="text_field text_field2" onkeypress="isNumber_Check()" placeholder="PHONE NUMBER" title="PHONE NUMBER"/>
                                    </div>
                                </div>


                                <div class="profile-segment-div col-7">
                                    <div class="segment-title">STAFF STATUS:</div>
                                    <div class="text-field-div no-border">
                                        <select class="text_field text_field2" readonly="readonly" id="updt_status_id" style="background:#fff;" >                       
                                            <option value="" >SELECT STATUS </option>
                                            <script> _get_select_status('updt_status_id','1,2');</script>
                                        </select>
                                    </div>
                                </div>
                                <br clear="all" /> 
                                <br clear="all" /> 
                                <button class="upt-btn" type="button" id="update_btn" onclick="_update_user_profile('<?php echo $ids?>');"> UPDATE PROFILE <i class="bi-check"></i></button>
                            </div>         
                    </div>
                </div>
            </div>  
            
        </div> 
    </div>
<?php } ?>

<?php if($page=='user_profile_details'){?>
    <div class="search-details" id="get_detail"> 
             
        <div class="title" style="text-align:left; padding-left:20px;font-size:12px;"><i class="bi-person"></i> USER PROFILE  </div>
                        
        <div class="user-in">
            <div class="title">BASIC INFORMATION</div>
    
            <div class="profile-segment-div col-3">
                <div class="segment-title">FULLNAME:</div>
                <div class="text-field-div no-border">
                    <input id="updt_fullname" type="text" class="text_field text_field2" placeholder="FULLNAME" title="FULLNAME"/>
                </div>
            </div>


            <div class="profile-segment-div col-8">
                <div class="segment-title">EMAIL:</div>
                <div class="text-field-div no-border">
                    <input id="updt_email" type="text" class="text_field text_field2" placeholder="EMAIL" title="EMAIL"/>
                </div>
            </div>

            <div class="profile-segment-div col-3"><div id="mobile_info" style="float:right;font-size:12px;display:none;color:#f00"><span>Mobile not accepted!</span></div>
                <div class="segment-title">PHONE NUMBER:</div>
                <div class="text-field-div no-border">
                    <input id="updt_mobile" type="text" class="text_field text_field2" onkeypress="isNumber_Check()" placeholder="PHONE NUMBER" title="PHONE NUMBER"/>
                </div>
            </div>


            <div class="profile-segment-div col-7">
                <div class="segment-title">STAFF STATUS:</div>
                <div class="text-field-div no-border">
                    <select class="text_field text_field2" readonly="readonly" id="updt_status_id" style="background:#fff;" >                       
                        <option value="" >SELECT STATUS </option>
                        <script> _get_select_status('updt_status_id','1,2');</script>
                    </select>
                </div>
            </div>
            <br clear="all" /> 
            <br clear="all" /> 
            <button class="upt-btn" type="button" id="update_btn" onclick="_update_user_profile('<?php echo $ids?>');"> UPDATE PROFILE <i class="fa fa-check"></i></button>
        </div>   
    </div>
<?php }?>

<?php if($page=='transaction_history_detail'){?>
    <div class="search-details" id="get_detail">
        <div class="title" style="text-align:left; padding-left:20px;font-size:12px;"><i class="bi-person"></i> USER TRANSACTION HISTORY  </div>  
            <div class="fetch-div" id="view">
                <div class="table-div animated fadeIn" id="search-content">
                    <div class="div-in">
                        <div class="container-title title2"><i class="bi bi-credit-card"></i>  TRANSACTIONS </div>
                        <div class="input-search-div">
                            <div class="custom_search">Custom Search: <span>*</span></div>
                            <input id="datepicker-from" type="date" class="text_field srchtxt" placeholder="Select Date From" title="Select Date From" />
                            <input id="datepicker-to" type="date" class="text_field srchtxt" placeholder="Select Date To" title="Select Date To"/>
                            <button type="button" class="btn" onclick=" _fetch_custom_report('<?php echo $page?>','<?php echo $ids?>','custom_search','')"><i class="bi-check"></i>Apply</button>
                        </div>

                        <table class="table" cellspacing="0" style="width:100%" id="fetch_all_transaction_history">
                            <script>_get_user_transaction('<?php echo $page?>','<?php echo $ids?>','','','','');</script> 
                            <tr class="tb-col">
                                <td>SN</td>
                                <td>DATE</td>
                                <td>TRANSACTION ID</td>
                                <td>TRANSACTION TYPE</td>
                                <td>TRANSACTION METHOD</td>
                                <td>AMOUNT</td>
                                <td>STATUS</td>
                                <td>ACTION</td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>2023-08-03 12:25:27</td>
                                <td>TRANS00012384883</td>
                                <td>CREDIT</td>
                                <td>CREDIT/DEBIT CARD</td>
                                <td><span>₦</span> 2,000.00</td>
                                <td><div class="status-div SUCCESS">SUCCESS</div></td>
                                <td><button class="btn"><i class="bi bi-eye"></i> DETAILS</button></td>
                            </tr> 

                        </table>
                        <div class="bottom-count-div">
                            <div class="text">
                                <span id="trans_count">0</span> of <span id="trans_total_count">0</span>
                            </div>
                            <button class="top-btn bottom-btn" type="button" ><i class="bi bi-eye"></i> View More</button>
                        </div>
                    </div>
                </div>
            </div>
    </div> 
<?php }?>

<?php if ($page=='transaction_details'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi bi-credit-card"></i> TRANSACTIONS</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div" >
            <div class="inner-div">

                <div id="View_transaction_details"> 
                    <div class="alert alert-success">
                        <span>TRANSACTION DETAILS</span>
                        <div class="trans-statistics">Transaction ID: <div class="value" id="transaction_id">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Transaction Type: <div class="value" id="transaction_type">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Transaction Method: <div class="value" id="transaction_method">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Amount: <div class="value" id="amount"> Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Date: <div class="value" id="date">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Status: <div class="value" id="status">Xxxx</div><br clear="all" /></div>
                    </div>

                    <div class="alert alert-success">
                        <span>EXAM SUBSCRIPTION DETAILS</span>
                        <div class="trans-statistics">Exam Name: <div class="value" id="view_abbreviation">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Subject Name: <div class="value" id="view_subject_name">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Topic Name: <div class="value" id="view_topic_name">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Sub-Topic Name: <div class="value" id="view_sub_topic_name">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Start Date: <div class="value" id="view_start_date"> Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Due Date: <div class="value" id="view_due_date">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Status: <div class="value" id="view_subcription_status_name">Xxxx</div><br clear="all" /></div>
                    </div> 
                        
                </div>
            </div>
        </div> 
    </div>
<?php } ?>

<?php if($page=='wallet_history_details'){?>
    <div class="search-details" id="get_detail">
    <div class="title" style="text-align:left; padding-left:20px;font-size:12px;"><i class="bi-person"></i> USER WALLET HISTORY  </div>  
        <div class="fetch-div" id="view">
            <div class="table-div animated fadeIn" id="search-content">
                <div class="div-in">
                    <div class="container-title title2"><i class="bi bi-credit-card"></i>  WALLET HISTORY </div>
                    <div class="input-search-div">
                        <div class="custom_search">Custom Search: <span>*</span></div>
                        <input id="datepicker-from" type="date" class="text_field srchtxt" placeholder="Select Date From" title="Select Date From" />
                        <input id="datepicker-to" type="date" class="text_field srchtxt" placeholder="Select Date To" title="Select Date To"/>
                        <button type="button" class="btn" onclick=" _fetch_custom_report('<?php echo $page?>','<?php echo $ids?>','custom_search','')"><i class="bi-check"></i>Apply</button>
                    </div>
                    <table class="table" cellspacing="0" style="width:100%" id="fetch_all_wallet_history">
                     <script>_get_user_wallet_history_details('<?php echo $page?>','<?php echo $ids?>','','','','');</script>
                            <tr class="tb-col">
                                <td>SN</td>
                                <td>DATE</td>
                                <td>TRANSACTION ID</td>
                                <td>BALANCE BEFORE</td>
                                <td>AMOUNT LOADED</td>
                                <td>BALANCE AFTER</td>
                                <td>TRANSACTION TYPE</td>
                                <td>STATUS</td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>2023-08-03 12:25:27</td>
                                <td>TRANS00012384883</td>
                                <td><span>₦</span> 1,000.00</td>
                                <td><span>₦</span> 3,000.00</td>
                                <td><span>₦</span> 4,000.00</td>
                                <td>CREDIT</td>
                                <td><div class="status-div SUCCESS">SUCCESS</div></td>
                            </tr>

                     </table>
                    <div class="bottom-count-div">
                        <div class="text">
                            <span id="current_count">0</span> of <span id="total_count">0</span>
                        </div>
                        <button class="top-btn bottom-btn"  type="button" ><i class="bi bi-eye"></i> View More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php }?>













 <!-- CBT FORM -->
<?php if ($page=='cbt_page_details'){?>
    <div class="cbt-creation-panel">
        <div class="side-bar">
            <div class="div-in">
                <div class="video-div" id="view_cbt_video">
                    <video src="<?php echo $website_url?>/admin/a/all-images/body-pix/default.png" id="videoDisplay" name="sub_video" controls="controls" loop="" class="video-slide"></video>
                </div>

                <div class="text-div">
                    
                    <div class="list-div">
                        <div><i class="bi-buildings"></i> Department:</div>
                        <span id="department_name">xxxx</span>
                    </div>

                    <div class="list-div">
                        <div><i class="bi-book"></i> Class:</div>
                        <span id="class_name">xxxx</span>
                    </div>

                    <div class="list-div">
                        <div><i class="bi-book"></i> Subject:</div>
                        <span id="subject_name">xxxx</span>
                    </div>

                    <div class="list-div">
                        <div><i class="bi-book"></i> Term:</div>
                        <span id="term_name">xxxx</span>
                    </div>

                    <div class="list-div">
                        <div><i class="bi-book"></i> Week:</div>
                        <span id="week_name">xxxx</span>
                    </div>

                    <div class="list-div">
                        <div><i class="bi-book"></i> Topic:</div>
                       <span id="topic">xxxx</span>
                    </div>

                    <div class="list-div no-border">
                        <div><i class="bi-clock"></i> Class Duration:</div>
                        <span id="duration">xxxx</span>
                    </div>
                    
                </div>
               
            </div>
        </div>

        <div class="cbt-content-div">   
            <div class="title-div">
                <ul>
                    <li class="active-li" title="Question Bank" id="question_bank_details" onclick="_get_page_contents('question_bank_details','<?php echo $ids?>')">Question Bank </li>
                    <li title="Quiz Questions" id="quiz_question" onclick="_get_page_contents('quiz_question','<?php echo $ids?>')">Quiz Questions</li>
                    <li title="Load Question Manually" id="load_questions_manually" onclick="_get_page_contents('load_questions_manually','<?php echo $ids?>')">Load Questions Manually</li>
                    <li title="Load Question Automatically" id="load_questions_automatically" onclick="_get_page_contents('load_questions_automatically','<?php echo $ids?>')">Load Questions Automatically</li>
                </ul>
                <button class="close-btn" onclick="_alert_close()" title="Close"><i class="bi-x-lg"></i></button> 
            </div>
            
            <div id="get_page_details">
                <script> _checkAll();</script>
                <div class="question-back-div">
                    <div class="top-div">
                        <label>
                            <input type="checkbox" id="parent">
                            <span>All Questions</span>
                        </label>
                        <div>
                            <button class="btn" id="submit_btn" title="Set Questions As Quiz" onclick="_set_questions_as_quiz('<?php echo $ids?>');"><i class="bi-check2-circle"></i> Set Questions As Quiz</button>
                        </div>
                    </div>

                    <div class="question-body-div" id="fetch_all_question_bank">                   
                        <script>_get_fetch_question_bank('<?php echo $ids?>')</script>                  
                        <!-- <div class="question-div">
                            <div class="div-in">
                                <div class="check-div">
                                    <label>
                                        <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                        <span>Question 1</span>
                                    </label>
                                    <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                                </div>

                                <div class="each-question">
                                    <div class="text-div">
                                        <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                        <div class="options-div">
                                            
                                            <div class="each-option">
                                                <div class="letter">A</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option correct-option">
                                                <div class="letter">B</div>

                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">C</div>

                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">D</div>
                                                <div>House</div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="question-div">
                            <div class="div-in">
                                <div class="check-div">
                                    <label>
                                        <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                        <span>Question 2</span>
                                    </label>
                                    <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                                </div>

                                <div class="each-question">
                                    <div class="pix-div"><img src="all-images/body-pix/computer.png" alt="Computer"/></div>
                                    <div class="text-div">
                                        <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                        <div class="options-div">
                                            
                                            <div class="each-option">
                                                <div class="letter">A</div>
                                                <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">B</div>
                                                <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">C</div>
                                                <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">D</div>
                                                <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                                <div>House</div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="question-div">
                            <div class="div-in">
                                <div class="check-div">
                                    <label>
                                        <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                        <span>Question 3</span>
                                    </label>
                                    <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                                </div>

                                <div class="each-question">
                                    <div class="text-div">
                                        <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                        <div class="options-div">
                                            
                                            <div class="each-option">
                                                <div class="letter">A</div>
                                                <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">B</div>
                                                <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">C</div>
                                                <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">D</div>
                                                <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                                <div>House</div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="question-div">
                            <div class="div-in">
                                <div class="check-div">
                                    <label>
                                        <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                        <span>Question 4</span>
                                    </label>
                                    <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                                </div>

                                <div class="each-question">
                                    <div class="pix-div"><img src="all-images/body-pix/computer.png" alt="Computer"/></div>
                                    <div class="text-div">
                                        <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                        <div class="options-div">
                                            
                                            <div class="each-option">
                                                <div class="letter">A</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">B</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">C</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">D</div>
                                                <div>House</div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div> -->
                    </div>
                </div> 
            </div>    
        </div>      
    </div>
    <script>_get_fetch_quiz_details('<?php echo $ids?>')</script>
<?php }?>

<?php if ($page=='question_bank_details'){ ?>
    <script> _checkAll();</script>
    <div id="get_page_details">
        <div class="question-back-div">
            <div class="top-div">
                <label>
                    <input type="checkbox" id="parent">
                    <span>All Questions</span>
                </label>
                <div>
                    <button class="btn" id="submit_btn" title="Set Questions As Quiz" onclick="_set_questions_as_quiz('<?php echo $ids?>');"><i class="bi-check2-circle"></i> Set Questions As Quiz</button>
                </div>
            </div>

            <div class="question-body-div" id="fetch_all_question_bank">             
                <script>_get_fetch_question_bank('<?php echo $ids?>')</script>
              
                <!-- <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                <span>Question 1</span>
                            </label>
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                        </div>

                        <div class="each-question">
                            <div class="text-div">
                                <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                <div class="options-div">
                                    
                                    <div class="each-option">
                                        <div class="letter">A</div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option correct-option">
                                        <div class="letter">B</div>

                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">C</div>

                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">D</div>
                                        <div>House</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> -->

                <!-- <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                <span>Question 2</span>
                            </label>
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                        </div>

                        <div class="each-question">
                            <div class="pix-div"><img src="all-images/body-pix/computer.png" alt="Computer"/></div>
                            <div class="text-div">
                                <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                <div class="options-div">
                                    
                                    <div class="each-option">
                                        <div class="letter">A</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">B</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">C</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">D</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> -->

                <!-- <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                <span>Question 3</span>
                            </label>
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                        </div>

                        <div class="each-question">
                            <div class="text-div">
                                <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                <div class="options-div">
                                    
                                    <div class="each-option">
                                        <div class="letter">A</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">B</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">C</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">D</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> -->

                <!-- <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                <span>Question 4</span>
                            </label>
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                        </div>

                        <div class="each-question">
                            <div class="pix-div"><img src="all-images/body-pix/computer.png" alt="Computer"/></div>
                            <div class="text-div">
                                <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                <div class="options-div">
                                    
                                    <div class="each-option">
                                        <div class="letter">A</div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">B</div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">C</div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">D</div>
                                        <div>House</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>                  
                    </div>
                </div> -->
            </div>
        </div> 
    </div>
<?php }?>

<?php if ($page=='quiz_question'){ ?>    
    <div id="get_page_details">
        <div class="question-back-div">
            <div class="top-div">
                <label>
                    <span>Quiz Questions</span>&nbsp;&nbsp;
                    <div class="text"><i class="bi-clock"></i> Quiz Duration:</div>
                    <span id="quiz_duration">00:00:00</span> 
                </label>

                <div id="quiz_status">
                    <!-- <button class="btn" title="Activate Question(s)" onClick="_get_secondary_form_with_id('set_quiz_time_form')"><i class="bi-check2-circle"></i> Activate Quiz</button>
                    <button class="btn delete" title="Delete Question(s)"><i class="bi-trash"></i> Deactivate Quiz</button> -->
                </div>
            </div>

            <div class="question-body-div" id="fetch_all_quiz_question">             
                <script>_get_fetch_quiz_question('<?php echo $ids?>')</script>
                <!-- <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Question 1</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="text-div">
                                <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                <div class="options-div">
                                    
                                    <div class="each-option">
                                        <div class="letter">A</div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option correct-option">
                                        <div class="letter">B</div>

                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">C</div>

                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">D</div>
                                        <div>House</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Question 2</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="pix-div"><img src="all-images/body-pix/computer.png" alt="Computer"/></div>
                            <div class="text-div">
                                <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                <div class="options-div">
                                    
                                    <div class="each-option">
                                        <div class="letter">A</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">B</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">C</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">D</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Question 3</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="text-div">
                                <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                <div class="options-div">
                                    
                                    <div class="each-option">
                                        <div class="letter">A</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">B</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">C</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">D</div>
                                        <div class="pix"><img src="all-images/body-pix/house.png" alt="house"/></div>
                                        <div>House</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Question 4</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="pix-div"><img src="all-images/body-pix/computer.png" alt="Computer"/></div>
                            <div class="text-div">
                                <div><p>______________ is an electronic machine that accept data, process data and provide output.</p></div>
                                <div class="options-div">
                                    
                                    <div class="each-option">
                                        <div class="letter">A</div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">B</div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">C</div>
                                        <div>House</div>
                                    </div>

                                    <div class="each-option">
                                        <div class="letter">D</div>
                                        <div>House</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> -->
            </div>
        </div> 
    </div> 
<?php }?>

<?php if ($page=='load_questions_manually'){ ?>
    <script src="js/TextEditor.js" referrerpolicy="origin"></script>

    <div id="get_page_details">
        <div class="question-back-div">
            <div class="top-div">
                <label>
                    <?php if (empty($question_id)){
                        $pageTitle="Load Questions Manually";
                    }else{
                        $pageTitle="Update This Question";
                    }?>
                    <span><?php echo $pageTitle; ?></span>
                </label>
            </div>

            <div class="question-body-div">
                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Set Question</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="pix-div">
                                <label>
                                    <img id="quiz_question_pix" src="all-images/body-pix/default.png" alt="Default Image">
                                    <input type="file" id="question_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quiz_question_pix_preview.UpdatePreview(this);" />
                                </label>
                            </div>

                            <div class="text-div">                             
                                <script>tinymce.init({selector:'#question_text',  // change this value according to your HTML
                                plugins: "link, image, table"
                                });</script>
                                <textarea style="width: 100%;" rows="10" id="question_text" title="QUIZ QUESTION" placeholder="QUIZ QUESTION"></textarea>
                            </div>
                        </div>                      
                    </div>
                </div>


                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Option A</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="pix-div">
                                <label>
                                    <img id="quiz_option_a_pix" src="all-images/body-pix/default2.png" alt="Default Image">
                                    <input type="file" id="option_a_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quiz_option_a_pix_preview.UpdatePreview(this);" />
                                </label>
                            </div>

                            <div class="text-div">       
                                <script>tinymce.init({selector:'#option_a',  // change this value according to your HTML
                                plugins: "link, image, table"
                                });</script>
                                <textarea style="width: 100%;" rows="10" id="option_a" title="OPTION A" placeholder="OPTION A"></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Option B</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="pix-div">
                                <label>
                                    <img id="quiz_option_b_pix" src="all-images/body-pix/default2.png" alt="Default Image">
                                    <input type="file" id="option_b_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quiz_option_b_pix_preview.UpdatePreview(this);" />
                                </label>
                            </div>

                            <div class="text-div">                           
                                <script>tinymce.init({selector:'#option_b',  // change this value according to your HTML
                                plugins: "link, image, table"
                                });</script>
                                <textarea style="width: 100%;" rows="10" id="option_b" title="OPTION B" placeholder="OPTION BY"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Option C</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="pix-div">
                                <label>
                                    <img id="quiz_option_c_pix" src="all-images/body-pix/default2.png" alt="Default Image">
                                    <input type="file" id="option_c_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quiz_option_c_pix_preview.UpdatePreview(this);" />
                                </label>
                            </div>

                            <div class="text-div">                              
                                <script>tinymce.init({selector:'#option_c',  // change this value according to your HTML
                                plugins: "link, image, table"
                                });</script>
                                <textarea style="width: 100%;" rows="10" id="option_c" title="OPTION C" placeholder="OPTION C"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Option D</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="pix-div">
                                <label>
                                    <img id="quiz_option_d_pix" src="all-images/body-pix/default2.png" alt="Default Image">
                                    <input type="file" id="option_d_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quiz_option_d_pix_preview.UpdatePreview(this);" />
                                </label>
                            </div>

                            <div class="text-div">                            
                                <script>tinymce.init({selector:'#option_d',  // change this value according to your HTML
                                plugins: "link, image, table"
                                });</script>
                                <textarea style="width: 100%;" rows="10" id="option_d" title="OPTION D" placeholder="OPTION D"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Option E</span>
                            </label>
                        </div>

                        <div class="each-question">
                            <div class="pix-div">
                                <label>
                                    <img id="quiz_option_e_pix" src="all-images/body-pix/default2.png" alt="Default Image">
                                    <input type="file" id="option_e_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="quiz_option_e_pix_preview.UpdatePreview(this);" />
                                </label>
                            </div>

                            <div class="text-div">               
                                <script>tinymce.init({selector:'#option_e',  // change this value according to your HTML
                                plugins: "link, image, table"
                                });</script>
                                <textarea style="width: 100%;" rows="10" id="option_e" title="OPTION E" placeholder="OPTION E"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Set Correct Option</span>
                            </label>
                        </div>
                                
                        <input id="answer" type="text" class="text_field" placeholder="A, B, C, D, E" title="QUIZ ANSWER"/>               
                        <?php if(!empty($question_id)){ ?>
                            <div>
                                <button class="btn" id="update_btn" title="Update Questions" onclick="_update_questions_manually('<?php echo $ids?>','<?php echo $question_id?>');"><i class="bi-cloud-upload"></i> Update Questions</button>
                            </div>
                        <?php }else{?>
                            <div>
                                <button class="btn" id="submit_btn" title="Upload Questions" onclick="_add_questions_manually('<?php echo $ids?>');"><i class="bi-cloud-upload"></i> Upload Questions</button>
                            </div>
                        <?php }?>                       
                    </div>
                </div>
            </div>
        </div> 
    </div> 
    <?php if(!empty($question_id)){ ?>
        <script>_get_fetch_each_quiz_question('<?php echo $ids?>','<?php echo $question_id?>')</script>
    <?php } ?>
<?php }?>

<?php if ($page=='load_questions_automatically'){ ?>
    <div id="get_page_details">
        <div class="question-back-div">
            <div class="top-div">
                <label>
                    <span>Load Questions Automatically</span>
                </label>
            </div>

            <div class="question-body-div">
                <div class="question-div">
                    <div class="div-in">
                        <div class="check-div">
                            <label>
                                <span>Upload <i>(CSV Format Only)</i></span>
                            </label>
                            <div>
                                <button class="btn" type="button" id="submit_btn" title="Download Question Template" onclick="_download_question_template();"><i class="bi-download"></i> Download Question Template</button>
                            </div>
                        </div>
                        
                        <input id="quiz_question_template" name="quiz_question_template" type="file" class="text_field" placeholder="Choose File (.CSV)" title="Choose File (.CSV)" accept=".csv"/>
                        <div>
                            <button class="btn" type="button" id="auto_btn" title="Upload Questions" onclick="_add_questions_automatically('<?php echo $ids?>');"><i class="bi-cloud-upload"></i> Upload Questions</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
<?php }?>

<?php if ($page=='set_quiz_time_form'){?>
	<div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title-text">SET QUIZ DURATION</div>
            <button class="close-btn" onclick="_alert_secondary_close()"><i class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success"> Hi, you are about to set <strong><span>Quiz Duration</span></strong> time. <br/> Kindly input <strong>Hour</strong>, <strong>Minutes</strong>, and <strong>Seconds</strong> to continue.</div>
            <div class="input-div">
                <div class="input-div-in">
                    <div class="title">Hour</div>
                    <select id="quiz_hour" class="text_field selectinputs" title="00:">
                        <option value="" selected="selected"> -- </option>
                        <script>_fetchTimeCountOption('quiz_hour', 12);</script>
                    </select>
                </div>
                <div class="input-div-in">
                    <div class="title">Minutes</div>
                    <select id="quiz_min" class="text_field selectinputs" title="00:">
                        <option value="" selected="selected"> -- </option>
                        <script>_fetchTimeCountOption('quiz_min', 60);</script>
                    </select>
                </div>
                <div class="input-div-in">
                    <div class="title">Seconds</div>
                    <select id="quiz_sec" class="text_field selectinputs" title="00;">
                        <option value="" selected="selected"> -- </option>
                        <script>_fetchTimeCountOption('quiz_sec', 60);</script>
                    </select>
                </div>
            </div>          
            <button class="btn" type="button" id="submit_btn" title="Proceed" onclick="_activate_quiz('<?php echo $ids?>');"><i class="bi-check"></i> PROCEED </button>
        </div>
    </div>

<?php }?>



    <!-- AGENT FORM -->
<?php if ($page=='agent_reg'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW AGENT</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-div">
                <div class="alert">Kindly fill the form below to <span>ADD A NEW AGENT</span></div>

                <div class="alert alert-success">
                    <span>COMPANY DETAILS</span>
                    <div class="title">COMPANY NAME: <span>*</span></div>
                    <input id="company_name" type="text" class="text_field" placeholder="COMPANY NAME" title="COMPANY NAME" onkeyup="updateCompanyTitle()"/>
                    <div class="title">COMPANY ADDRESS: <span>*</span></div>
                    <input id="company_address" type="text" class="text_field" placeholder="COMPANY ADDRESS" title="COMPANY ADDRESS"/>
                    <div class="title">COMPANY PHONE NUMBER: <span>*</span></div>
                    <input id="company_phone" type="tel" class="text_field" onkeypress="isNumber_Check()" placeholder="COMPANY PHONE NUMBER" title="COMPANY PHONE NUMBER"/>
                    <div class="title">COMPANY EMAIL ADDRESS:</div>
                    <input id="company_email" type="text" class="text_field" placeholder="COMPANY EMAIL ADDRESS" title="COMPANY EMAIL ADDRESS"/>

                    <div class="title">COMPANY LOGO: <i>(JPG, PNG FORMAT ONLY)</i><span>*</span></div>
                    <div class="pix-div">
                        <label>
                            <img id="agent_pix" src="all-images/images/sample.jpg" alt="Default Image">
                            <input type="file" id="company_logo" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="agent_pix_preview.UpdatePreview(this);" />
                        </label>
                    </div>

                    <div class="title">SELECT COMPANY STATUS: <span>*</span></div>
                    <select id="reg_company_status_id" class="text_field selectinput" title="SELECT COMPANY STATUS">
                        <option value="" selected="selected">SELECT COMPANY STATUS</option>
                        <script>_get_select_status('reg_company_status_id','1,2');</script>
                    </select> 
                </div>

                <div class="alert alert-success">
                    <span>CONTACT PERSON</span>
                    <div class="title">FULLNAME: <span>*</span></div>
                    <input id="contact_name" type="text" class="text_field" placeholder="FULLNAME" title="FULLNAME"/>
                    <div class="title">EMAIL ADDRESS: <span>*</span></div>
                    <input id="contact_email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS"/>
                    <div class="title">PHONE NUMBER: <span>*</span></div>
                    <input id="contact_phone" type="tel" class="text_field" onkeypress="isNumber_Check()" placeholder="PHONE NUMBER" title="PHONE NUMBER"/>
                    <div class="title">SELECT ROLE: <span>*</span></div>
                    <select id="reg_contact_role_id" class="text_field selectinput" title="SELECT ROLE">
                        <option value="" selected="selected">SELECT ROLE</option>
                        <script>_get_select_role('reg_contact_role_id');</script>
                    </select> 
                    <div class="title">SELECT CONTACT PERSON STATUS: <span>*</span></div>
                    <select id="reg_contact_status_id" class="text_field selectinput" title="SELECT CONTACT PERSON STATUS">
                        <option value="" selected="selected">SELECT CONTACT PERSON STATUS</option>
                        <script>_get_select_status('reg_contact_status_id','1,2');</script>
                    </select> 
                </div>

                <div class="alert alert-success">
                    <span>COMMISSION DISTRIBUTION</span>
                    <div class="title">LEADERS TUTOR (%):</div>
                    <input id="leaders_tutors_commission" type="text" class="text_field" onkeypress="isNumber_Check()" placeholder="(%)" title="LEADERS TUTOR (%)"/>
                    <div class="title">LEADERS NETWORK (%):</div>
                    <input id="leaders_network_commission" type="text" class="text_field" onkeypress="isNumber_Check()" placeholder="(%)" title="LEADERS NETWORK (%)"/>
                    <div class="title" id="company_title">COMPANY NAME (%):</div>
                    <input id="company_commission" type="text" class="text_field" onkeypress="isNumber_Check()" placeholder="(%)" title="COMPANY NAME (%)"/>            
                </div>
                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_agent('');"> <i class="bi-check"></i> SUBMIT </button>             
            </div>
        </div>  
    </div>

    <script>
        function updateCompanyTitle() {
            const companyName = document.getElementById('company_name');              
            const companyTitle = document.getElementById('company_title');                  
            const defaultTitleText = "COMPANY NAME (%):";

            if (companyName.value.trim() === '') {
                companyTitle.textContent = defaultTitleText;
            } else {
                companyTitle.textContent = companyName.value + " (%):";
            }
        }
    </script>
<?php } ?>

<?php if ($page=='agent_profile'){?>
    <div class="agent-profile-div animated fadeInUp">
        <div class="top-panel-div">
            <span><i class="bi-person-check-fill"></i> AGENT DETAILS</span>
            <div class="close" title="Close" onclick="_alert_close();">X</div>
        </div>

        <div class="body-content-div">
            <div class="mini-profile-div">
                <div class="profile-content">
                    <span><i class="bi-speedometer2"></i> Agent Dashboard</span>
                    <div class="main-profile">
                        <div class="inner-profile">
                            <div class="img-div"><img src="all-images/images/avatar.jpg" id="agent_logo" alt="Agent Profile"/></div> 
                            <div class="pro-text-div">
                               <h2 id="name">xxxx</h2>
                                <div class="info">
                                    <div>
                                       <p>Email: <span id="email">xxxx</span></p>
                                       <p>Phone: <span id="phone">xxxx</span></p>
                                    </div> 
                                    <div id="show_status_name"></div>                              
                                </div>                                              
                            </div>
                        </div>

                        <div class="wallet-div">
                            <h3><i class="bi-credit-card"></i> COMMISSION WALLET</h3>
                            <div class="text-div">
                                <div class="amount" id="wallet_balance">xxxx</div>
                                <div class="txt">TOTAL AMOUNT RECEIVED</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="agent-btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Dashboard" id="dashboard_details" onclick="_get_agent_page_contents('dashboard_details','<?php echo $ids?>')">Dashboard</li>
                        <li title="Contact Person" id="contact_person_details" onclick="_get_agent_page_contents('contact_person_details','<?php echo $ids?>')">Contact Person</li>
                        <li title="Referees" id="referees_details" onclick="_get_agent_page_contents('referees_details','<?php echo $ids?>')">Referees</li>
                        <li>Transaction History</li>
                    </ul>
                </div>
            </div>

            <div class="company-back-details">              
                <div class="company-back-div-in">
                    <div class="company-detail">
                        <div class="div-in">
                            <div class="title-div"><span><i class="bi-person-check-fill"></i> COMPANY DETAILS</span> <button class="btn" title="Edit Company Profile" onclick="_get_secondary_form_with_id('update_agent_form','<?php echo $ids?>');"><i class="bi-pencil-square"></i> EDIT PROFILE</button></div>
                            <div class="company-profile">
                                <div class="detail-list">
                                    <div class="title">COMPANY ID:</div>
                                    <span id="company_id">xxxx</span>
                                </div>
                                <div class="detail-list">
                                    <div class="title">COMPANY NAME:</div>
                                    <span id="name_detail">xxxx</span>
                                </div>
                                <div class="detail-list">
                                    <div class="title">COMPANY ADDRESS:</div>
                                    <span id="address">xxxx</span>
                                </div>
                                <div class="detail-list">
                                    <div class="title">COMPANY PHONE NUMBER:</div>
                                    <span id="phone_detail">xxxx</span>
                                </div>
                                <div class="detail-list">
                                    <div class="title">COMPANY EMAIL ADDRESS:</div>
                                    <span id="email_detail">xxxx</span>
                                </div>
                                <div class="detail-list">
                                    <div class="title">DATE OF REGISTRATION:</div>
                                    <span id="created_time">xxxx</span>
                                </div>
                                <div class="detail-list">
                                    <div class="title">COMPANY REFERRAL CODE:</div>
                                    <div class="copy-back-div">
                                        <span id="referral_code_detail">xxxx</span>
                                        <div class="copy-div" id="copyText" title="Click to copy Referral Code" onClick="_copyText();"><i class="bi bi-clipboard"></i></div>
                                    </div>                               
                                </div>
                                <div class="detail-list">
                                    <div class="title">COMPANY STATUS:</div>
                                    <span id="status_name_detail">xxxx</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart-back-div">
                        <div class="chart-div-notifications">
                            <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for</div> 
                            
                                <div class="text">
                                    <div class="custom-srch-div">
                                        <input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
                                        <input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
                                        <button type="button" class="btn" onclick=" _fetch_custom_dashboard_report('dashboard_report','custom_search')">Apply</button>
                                    </div>
                                </div>

                                <div class="text text-right" onclick="select_search()">
                                    <span id="srch-text">Last 30 Days</span>&nbsp;<i class="fa fa-sort-down (alias)"></i>
                                    <div class="srch-select">
                                    <div id="srch-today" onclick="get_dashboard_report('srch-today', 'view_today_search');">Today</div>
                                    <div id="srch-week" onclick="get_dashboard_report('srch-week', 'view_thisweek_search');">This Week</div>
                                    <div id="srch-7" onclick="get_dashboard_report('srch-7', 'view_7days_search');">Last 7 Days</div>
                                    <div id="srch-month" onclick="get_dashboard_report('srch-month', 'view_thismonth_search');">This Month</div>
                                    <div id="srch-30" onclick="get_dashboard_report('srch-30', 'view_30days_search');">Last 30 Days</div>
                                    <div id="srch-90" onclick="get_dashboard_report('srch-90', 'view_90days_search');">Last 90 Days</div>
                                    <div id="srch-year" onclick="get_dashboard_report('srch-year', 'view_thisyear_search');">This Year</div>
                                    <div id="srch-1year" onclick="get_dashboard_report('srch-1year', 'view_1year_search');">Last 1 Year</div>
                                    <div onclick="srch_custom('Custom Search')">Custom Search</div>
                                </div>
                                <div class="icon-div"><i class="bi-caret-down"></i></div>
                            </div>
                        
                            <br clear="all" />
                        </div>

                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        <script>
                            $(document).ready(function() {

                            var chart = new CanvasJS.Chart("chartContainer", {
                                animationEnabled: true,
                                theme: "light1",
                                title:{
                                    text: ""
                                },
                                axisX:{
                                    valueFormatString: "DD MMM",
                                    crosshair: {
                                        enabled: true,
                                        snapToDataPoint: true
                                    }
                                },
                                axisY: {
                                    title: "",
                                    includeZero: true,
                                    crosshair: {
                                        enabled: true
                                    }
                                },
                                toolTip:{
                                    shared:true
                                },  
                                legend:{
                                    cursor:"pointer",
                                    verticalAlign: "bottom",
                                    horizontalAlign: "left",
                                    dockInsidePlotArea: true,
                                    itemclick: toogleDataSeries
                                },
                                data: [{
                                    type: "line",
                                    showInLegend: true,
                                    name: "Sales",
                                    markerType: "square",
                                    xValueFormatString: "DD MMM, YYYY",
                                    color: "#29BA00",
                                    dataPoints: [
                                        
                                        { x: new Date(2024, 1, 10), y: 1000 },
                                        { x: new Date(2024, 1, 8), y: 650 },
                                        { x: new Date(2024, 1, 7), y: 970 },
                                        { x: new Date(2024, 1, 6), y: 420 },
                                        { x: new Date(2024, 1, 4), y: 720 },
                                        { x: new Date(2024, 1, 2), y: 200 },
                                        { x: new Date(2024, 1, 1), y: 820 },
                                        { x: new Date(2024, 0, 29), y: 960 },
                                        { x: new Date(2024, 0, 27), y: 150 },
                                        { x: new Date(2024, 0, 25), y: 700 },
                                        { x: new Date(2024, 0, 23), y: 555 },
                                        { x: new Date(2024, 0, 19), y: 362 },
                                        { x: new Date(2024, 0, 17), y: 446 },
                                        { x: new Date(2024, 0, 16), y: 825 },
                                        { x: new Date(2024, 0, 15), y: 270 },
                                        
                                    ]
                                },
                                {
                                    type: "line",
                                    showInLegend: true,
                                    name: "Wallet",
                                    lineDashType: "dash",
                                    dataPoints: [
                                        
                                        { x: new Date(2024, 1, 10), y: 1000 },
                                        { x: new Date(2024, 1, 8), y: 900 },
                                        { x: new Date(2024, 1, 7), y: 800 },
                                        { x: new Date(2024, 1, 6), y: 700 },
                                        { x: new Date(2024, 1, 4), y: 600 },
                                        { x: new Date(2024, 1, 2), y: 500 },
                                        { x: new Date(2024, 1, 1), y: 900 },
                                        { x: new Date(2024, 0, 29), y: 1000 },
                                        { x: new Date(2024, 0, 27), y: 800 },
                                        { x: new Date(2024, 0, 25), y: 500 },
                                        { x: new Date(2024, 0, 23), y: 875 },
                                        { x: new Date(2024, 0, 19), y: 675 },
                                        { x: new Date(2024, 0, 17), y: 995 },
                                        { x: new Date(2024, 0, 16), y: 400 },
                                        { x: new Date(2024, 0, 15), y: 600 },
                                    ]
                                }]
                            });
                            chart.render();

                            function toogleDataSeries(e){
                                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                    e.dataSeries.visible = false;
                                } else{
                                    e.dataSeries.visible = true;
                                }
                                chart.render();
                            }
                            })

                            _arps_matrix('<?php echo $db_day30;?>','<?php echo $db_today;?>');
                            _payment_matrix('<?php echo $db_day30;?>','<?php echo $db_today;?>');
                            _get_all_count();              
                        </script>
                    </div>
                </div>                   
            </div> 
        </div>     
    </div> 
    <script>_get_fetch_each_agent('<?php echo $ids?>');</script>
<?php } ?>

<?php if ($page=='dashboard_details'){?>
    <div class="company-back-div-in">
        <div class="company-detail">
            <div class="div-in">
                <div class="title-div"><span><i class="bi-person-check-fill"></i> COMPANY DETAILS</span> <button class="btn" title="Edit Company Profile" onclick="_get_secondary_form_with_id('update_agent_form','<?php echo $ids?>');"><i class="bi-pencil-square"></i> EDIT PROFILE</button></div>
                <div class="company-profile">
                    <div class="detail-list">
                        <div class="title">COMPANY ID:</div>
                        <span id="company_id">xxxx</span>
                    </div>
                    <div class="detail-list">
                        <div class="title">COMPANY NAME:</div>
                        <span id="name_detail">xxxx</span>
                    </div>
                    <div class="detail-list">
                        <div class="title">COMPANY ADDRESS:</div>
                        <span id="address">xxxx</span>
                    </div>
                    <div class="detail-list">
                        <div class="title">COMPANY PHONE NUMBER:</div>
                        <span id="phone_detail">xxxx</span>
                    </div>
                    <div class="detail-list">
                        <div class="title">COMPANY EMAIL ADDRESS:</div>
                        <span id="email_detail">xxxx</span>
                    </div>
                    <div class="detail-list">
                        <div class="title">DATE OF REGISTRATION:</div>
                        <span id="created_time">xxxx</span>
                    </div>
                    <div class="detail-list">
                        <div class="title">COMPANY REFERRAL CODE:</div>
                        <div class="copy-back-div">
                            <span id="referral_code_detail">xxxx</span>
                            <div class="copy-div" id="copyText" title="Click to copy Referral Code" onClick="_copyText();"><i class="bi bi-clipboard"></i></div>
                        </div>                               
                    </div>
                    <div class="detail-list">
                        <div class="title">COMPANY STATUS:</div>
                        <span id="status_name_detail">xxxx</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="chart-back-div">
            <div class="chart-div-notifications">
                <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for</div> 
                
                    <div class="text">
                        <div class="custom-srch-div">
                            <input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
                            <input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
                            <button type="button" class="btn" onclick=" _fetch_custom_dashboard_report('dashboard_report','custom_search')">Apply</button>
                        </div>
                    </div>

                    <div class="text text-right" onclick="select_search()">
                        <span id="srch-text">Last 30 Days</span>&nbsp;<i class="fa fa-sort-down (alias)"></i>
                        <div class="srch-select">
                        <div id="srch-today" onclick="get_dashboard_report('srch-today', 'view_today_search');">Today</div>
                        <div id="srch-week" onclick="get_dashboard_report('srch-week', 'view_thisweek_search');">This Week</div>
                        <div id="srch-7" onclick="get_dashboard_report('srch-7', 'view_7days_search');">Last 7 Days</div>
                        <div id="srch-month" onclick="get_dashboard_report('srch-month', 'view_thismonth_search');">This Month</div>
                        <div id="srch-30" onclick="get_dashboard_report('srch-30', 'view_30days_search');">Last 30 Days</div>
                        <div id="srch-90" onclick="get_dashboard_report('srch-90', 'view_90days_search');">Last 90 Days</div>
                        <div id="srch-year" onclick="get_dashboard_report('srch-year', 'view_thisyear_search');">This Year</div>
                        <div id="srch-1year" onclick="get_dashboard_report('srch-1year', 'view_1year_search');">Last 1 Year</div>
                        <div onclick="srch_custom('Custom Search')">Custom Search</div>
                    </div>
                    <div class="icon-div"><i class="bi-caret-down"></i></div>
                </div>
            
                <br clear="all" />
            </div>

            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
            <script>
                $(document).ready(function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light1",
                    title:{
                        text: ""
                    },
                    axisX:{
                        valueFormatString: "DD MMM",
                        crosshair: {
                            enabled: true,
                            snapToDataPoint: true
                        }
                    },
                    axisY: {
                        title: "",
                        includeZero: true,
                        crosshair: {
                            enabled: true
                        }
                    },
                    toolTip:{
                        shared:true
                    },  
                    legend:{
                        cursor:"pointer",
                        verticalAlign: "bottom",
                        horizontalAlign: "left",
                        dockInsidePlotArea: true,
                        itemclick: toogleDataSeries
                    },
                    data: [{
                        type: "line",
                        showInLegend: true,
                        name: "Sales",
                        markerType: "square",
                        xValueFormatString: "DD MMM, YYYY",
                        color: "#29BA00",
                        dataPoints: [
                            
                            { x: new Date(2024, 1, 10), y: 1000 },
                            { x: new Date(2024, 1, 8), y: 650 },
                            { x: new Date(2024, 1, 7), y: 970 },
                            { x: new Date(2024, 1, 6), y: 420 },
                            { x: new Date(2024, 1, 4), y: 720 },
                            { x: new Date(2024, 1, 2), y: 200 },
                            { x: new Date(2024, 1, 1), y: 820 },
                            { x: new Date(2024, 0, 29), y: 960 },
                            { x: new Date(2024, 0, 27), y: 150 },
                            { x: new Date(2024, 0, 25), y: 700 },
                            { x: new Date(2024, 0, 23), y: 555 },
                            { x: new Date(2024, 0, 19), y: 362 },
                            { x: new Date(2024, 0, 17), y: 446 },
                            { x: new Date(2024, 0, 16), y: 825 },
                            { x: new Date(2024, 0, 15), y: 270 },
                            
                        ]
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Wallet",
                        lineDashType: "dash",
                        dataPoints: [
                            
                            { x: new Date(2024, 1, 10), y: 1000 },
                            { x: new Date(2024, 1, 8), y: 900 },
                            { x: new Date(2024, 1, 7), y: 800 },
                            { x: new Date(2024, 1, 6), y: 700 },
                            { x: new Date(2024, 1, 4), y: 600 },
                            { x: new Date(2024, 1, 2), y: 500 },
                            { x: new Date(2024, 1, 1), y: 900 },
                            { x: new Date(2024, 0, 29), y: 1000 },
                            { x: new Date(2024, 0, 27), y: 800 },
                            { x: new Date(2024, 0, 25), y: 500 },
                            { x: new Date(2024, 0, 23), y: 875 },
                            { x: new Date(2024, 0, 19), y: 675 },
                            { x: new Date(2024, 0, 17), y: 995 },
                            { x: new Date(2024, 0, 16), y: 400 },
                            { x: new Date(2024, 0, 15), y: 600 },
                        ]
                    }]
                });
                chart.render();

                function toogleDataSeries(e){
                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    } else{
                        e.dataSeries.visible = true;
                    }
                    chart.render();
                }
                })

                _arps_matrix('<?php echo $db_day30;?>','<?php echo $db_today;?>');
                _payment_matrix('<?php echo $db_day30;?>','<?php echo $db_today;?>');
                _get_all_count();              
            </script>
        </div>
    </div> 
    <script>_get_fetch_each_agent('<?php echo $ids?>');</script>
<?php } ?>

<?php if ($page=='contact_person_details'){?>
    <div class="company-back-div-in">     
        <div class="dashboard-content">
            <div class="btn-div">
                <div class="alert alert-success agent-alert"> <span><i class="bi-people-fill"></i> COMPANY CONTACT PERSONS </span><button class="btn" title="Add New Staff" onclick="_get_secondary_form_with_id('contact_person_reg_form','<?php echo $ids?>');"><i class="bi-pencil-square"></i> ADD NEW STAFF</button></div>
            </div>

            <div class="list" id="fetch_all_contact_person"> 
                <script>_get_fetch_all_contact_person('<?php echo $ids?>');</script>             
                <!-- <div class="student-profile">
                    <div class="details">
                        <div class="status-icon"><i class="bi-check"></i></div>
                        <div class="pix"><img src="<?php //echo $website_url?>/admin/a/all-images/images/avatar.jpg" alt="Profile Picture"/></div>
                        <div class="text">
                            <h3>Paul Emmanuel</h3>
                            <div class="info">
                                <div>
                                    <p>Email: <span>seunemmanuel107@gmail.com</span></p>
                                    <p>Phone: <span>08060881905</span></p>
                                </div>                               
                                <button class="status-btn ACTIVE">ACTIVE</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn" title="View Details" onclick="_get_secondary_form_with_id('update_contact_person_form','<?php echo $ids?>');">VIEW DETAILS</button>
                </div> -->
            </div> 
         </div>   
    </div> 
<?php } ?>

<?php if ($page=='update_agent_form'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE AN AGENT</span>
                <div class="close" title="Close" onclick="_alert_secondary_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-div">
                <div class="alert">Kindly fill the form below to <span>UPDATE AN AGENT</span></div>

                <div class="alert alert-success">
                    <span>COMPANY DETAILS</span>
                    <div class="title">COMPANY NAME: <span>*</span></div>
                    <input id="company_name" type="text" class="text_field" placeholder="COMPANY NAME" title="COMPANY NAME" onkeyup="updateCompanyTitle()"/>
                    <div class="title">COMPANY ADDRESS: <span>*</span></div>
                    <input id="company_address" type="text" class="text_field" placeholder="COMPANY ADDRESS" title="COMPANY ADDRESS"/>
                    <div class="title">COMPANY PHONE NUMBER: <span>*</span></div>
                    <input id="company_phone" type="tel" class="text_field" onkeypress="isNumber_Check()" placeholder="COMPANY PHONE NUMBER" title="COMPANY PHONE NUMBER"/>
                    <div class="title">COMPANY EMAIL ADDRESS:</div>
                    <input id="company_email" type="text" class="text_field" placeholder="COMPANY EMAIL ADDRESS" title="COMPANY EMAIL ADDRESS"/>
                    <div class="title">COMPANY REFERRAL CODE:</div>
                    <input id="company_referral_code" type="text" class="text_field" placeholder="COMPANY REFERRAL CODE" title="COMPANY REFERRAL CODE"/>

                    <div class="title">COMPANY LOGO: <i>(JPG, PNG FORMAT ONLY)</i><span>*</span></div>
                    <div class="pix-div">
                        <label>
                           <img id="agent_pix" src="all-images/images/sample.jpg" alt="Default Image">
                            <input type="file" id="company_logo" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="agent_pix_preview.UpdatePreview(this);" />
                        </label>
                    </div>

                    <div class="title">SELECT COMPANY STATUS: <span>*</span></div>
                    <select id="reg_company_status_id" class="text_field selectinput" title="SELECT COMPANY STATUS">
                        <option value="" selected="selected">SELECT COMPANY STATUS</option>
                        <script>_get_select_status('reg_company_status_id','1,2');</script>
                    </select> 
                </div>            

                <div class="alert alert-success">
                    <span>COMMISSION DISTRIBUTION</span>
                    <div class="title">LEADERS TUTOR (%):</div>
                    <input id="leaders_tutors_commission" type="tel" class="text_field" onkeypress="isNumber_Check()" placeholder="(%)" title="LEADERS TUTOR (%)"/>
                    <div class="title">LEADERS NETWORK (%):</div>
                    <input id="leaders_network_commission" type="text" class="text_field" onkeypress="isNumber_Check()" placeholder="(%)" title="LEADERS NETWORK (%)"/>
                    <div class="title" id="company_title">COMPANY NAME (%):</div>
                    <input id="company_commission" type="text" class="text_field" onkeypress="isNumber_Check()" placeholder="(%)" title="COMPANY NAME (%)"/>            
                </div>
                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_update_agent('<?php echo $ids?>');"> <i class="bi-check"></i> UPDATE PROFILE </button>             
            </div>
        </div>  
    </div>
    <script>_get_fetch_each_agent('<?php echo $ids?>');</script>
    <script>
        function updateCompanyTitle() {
            const companyName = document.getElementById('company_name');              
            const companyTitle = document.getElementById('company_title');                  
            const defaultTitleText = "COMPANY NAME (%):";

            if (companyName.value.trim() === '') {
                companyTitle.textContent = defaultTitleText;
            } else {
                companyTitle.textContent = companyName.value + " (%):";
            }
        }
    </script>
   
<?php } ?>

<?php if ($page=='contact_person_reg_form'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW STAFF</span>
                <div class="close" title="Close" onclick="_alert_secondary_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-div">
                <div class="alert">Kindly fill the form below to <span>ADD A NEW STAFF</span></div>

                <div class="alert alert-success">
                    <span>CONTACT PERSON</span>
                    <div class="title">FULLNAME: <span>*</span></div>
                    <input id="contact_name" type="text" class="text_field" placeholder="FULLNAME" title="FULLNAME"/>
                    <div class="title">EMAIL ADDRESS: <span>*</span></div>
                    <input id="contact_email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS"/>
                    <div class="title">PHONE NUMBER: <span>*</span></div>
                    <input id="contact_phone" type="tel" class="text_field" onkeypress="isNumber_Check()" placeholder="PHONE NUMBER" title="PHONE NUMBER"/>
                    <div class="title">SELECT ROLE: <span>*</span></div>
                    <select id="reg_contact_role_id" class="text_field selectinput" title="SELECT ROLE">
                        <option value="" selected="selected">SELECT ROLE</option>
                        <script>_get_select_role('reg_contact_role_id');</script>
                    </select> 
                    <div class="title">SELECT CONTACT PERSON STATUS: <span>*</span></div>
                    <select id="reg_contact_status_id" class="text_field selectinput" title="SELECT CONTACT PERSON STATUS">
                        <option value="" selected="selected">SELECT CONTACT PERSON STATUS</option>
                        <script>_get_select_status('reg_contact_status_id','1,2');</script>
                    </select> 
                </div>                         
                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_add_contact_person('<?php echo $ids?>');"> <i class="bi-check"></i> SUBMIT </button>             
            </div>
        </div>  
    </div>

    <script>
        function updateCompanyTitle() {
            const companyName = document.getElementById('company_name');              
            const companyTitle = document.getElementById('company_title');                  
            const defaultTitleText = "COMPANY NAME (%):";

            if (companyName.value.trim() === '') {
                companyTitle.textContent = defaultTitleText;
            } else {
                companyTitle.textContent = companyName.value + " (%):";
            }
        }
    </script>
   
<?php } ?>

<?php if ($page=='update_contact_person_form'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE STAFF</span>
                <div class="close" title="Close" onclick="_alert_secondary_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-div">
                <div class="alert">Kindly fill the form below to <span>UPDATE STAFF</span></div>

                <div class="alert alert-success">
                    <span>CONTACT PERSON</span>
                    <div class="title">FULLNAME: <span>*</span></div>
                    <input id="contact_name" type="text" class="text_field" placeholder="FULLNAME" title="FULLNAME"/>
                    <div class="title">EMAIL ADDRESS: <span>*</span></div>
                    <input id="contact_email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS"/>
                    <div class="title">PHONE NUMBER: <span>*</span></div>
                    <input id="contact_phone" type="tel" class="text_field" onkeypress="isNumber_Check()" placeholder="PHONE NUMBER" title="PHONE NUMBER"/>
                    <div class="title">SELECT ROLE: <span>*</span></div>
                    <select id="reg_contact_role_id" class="text_field selectinput" title="SELECT ROLE">
                        <option value="" selected="selected">SELECT ROLE</option>
                        <script>_get_select_role('reg_contact_role_id');</script>
                    </select> 
                    <div class="title">SELECT CONTACT PERSON STATUS: <span>*</span></div>
                    <select id="reg_contact_status_id" class="text_field selectinput" title="SELECT CONTACT PERSON STATUS">
                        <option value="" selected="selected">SELECT CONTACT PERSON STATUS</option>
                        <script>_get_select_status('reg_contact_status_id','1,2');</script>
                    </select> 
                </div>                         
                <button class="action-btn" type="button" title="SUBMIT" id="submit_btn" onclick="_update_contact_person('<?php echo $company_id?>','<?php echo $staff_id?>');"> <i class="bi-check"></i> UPDATE PROFILE </button>             
            </div>
        </div>  
    </div>
    <script>_get_fetch_each_contact_person('<?php echo $company_id?>','<?php echo $staff_id?>');</script>
    <script>
        function updateCompanyTitle() {
            const companyName = document.getElementById('company_name');              
            const companyTitle = document.getElementById('company_title');                  
            const defaultTitleText = "COMPANY NAME (%):";

            if (companyName.value.trim() === '') {
                companyTitle.textContent = defaultTitleText;
            } else {
                companyTitle.textContent = companyName.value + " (%):";
            }
        }
    </script>
   
<?php } ?>

<?php if ($page=='referees_details'){?>
    <div class="company-back-div-in">     
        <div class="dashboard-content">
            <div class="btn-div">
                <div class="alert alert-success"> <span><i class="bi-people-fill"></i> COMPANY REFEREES LIST </span></div>
            </div>
            <div class="list">
                
                <div class="student-profile">
                    <div class="details">
                        <div class="pix"><img src="<?php echo $website_url?>/admin/a/all-images/images/avatar.jpg" alt="Profile Picture"/></div>
                        <div class="text">
                            <h3>Paul Emmanuel</h3>
                            <div class="info">
                                <div>
                                    <p>Email: <span>seunemmanuel107@gmail.com</span></p>
                                </div>                               
                                <button class="status-btn ACTIVE">ACTIVE</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn" title="View Details">VIEW DETAILS</button>
                </div>

                <div class="student-profile">
                    <div class="details">
                        <div class="pix"><img src="<?php echo $website_url?>/admin/a/all-images/images/avatar.jpg" alt="Profile Picture"/></div>
                        <div class="text">
                            <h3>Ajayi Oluwabukola</h3>
                            <div class="info">
                                <div>
                                    <p>Email: <span>ajayi200@gmail.com</span></p>
                                </div>                               
                                <button class="status-btn ACTIVE">ACTIVE</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn" title="View Details">VIEW DETAILS</button>
                </div>
            </div> 
         </div>   
    </div> 
<?php } ?>


<?php if ($page=='app_settings'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
            <span id="back_icon" style="display:none; cursor:pointer;" ><i class="bi-arrow-left" style="cursor:pointer;" onclick="_prev_page('account_settings_id');" ></i> &nbsp;&nbsp;</span>
            <span id="panel-title"><span id="header_icon"> <i class="bi-gear"></i> </span id="app_text"> APP SETTINGS</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-div">
                <div class="setting_detail" id="account_settings_id">   

                    <div class="settings-div"  onclick="_next_page('account_detail','back_icon','account');">
                        <div class="div-in">
                            <div class="icon-div">
                            <i class="bi-bank" ></i> 
                            </div>
                            <div class="text-div">
                                <h4 id="account">ACCOUNT DETAILS</h4>
                                <span>Manage your account information</span>
                                <i class="bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="settings-div" onclick="_next_page('channge_password','back_icon','password');">
                        <div class="div-in">
                            <div class="icon-div">
                        <i class="bi-lock"></i>
                            </div>
                            <div class="text-div">
                                <h4 id="password">CHANGE PASSWORD</h4>
                                <span>Manage and change password</span>
                                <i class="bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="setting_detail" id="account_detail">     
                    <div class="alert alert-success"><span>SMTP DETAILS</span>
                        <div class="title"> SENDER NAME:</div>
                        <input id="sender_name" type="text" class="text_field" placeholder="SENDER NAME" title="SENDER NAME"/>
                        <div class="title"> SMTP HOST:</div>
                        <input id="smtp_host" type="text" class="text_field" placeholder="SMTP HOST" title="SMTP HOST"/>
                        <div class="title"> SMTP USERNAME:</div>
                        <input id="smtp_username" type="text" class="text_field" placeholder="SMTP USERNAME" title="SMTP USERNAME"/>
                        <div class="title"> SMTP PASSWORD:</div>
                        <input id="smtp_password" type="text" class="text_field" placeholder=" SMTP PASSWORD" title=" SMTP PASSWORD"/>
                        <div class="title"> SMTP PORT:</div>
                        <input id="smtp_port" type="text" class="text_field" placeholder="SMTP PORT" title="SMTP PORT"/>
                        <div class="title"> SUPPORT EMAIL:</div>
                        <input id="support_email" type="text" class="text_field" placeholder="SUPPORT EMAIL" title="SUPPORT EMAIL"/>
                        <div class="title"> SUBSCRIPTION AMOUNT:</div>
                        <input id="subcription_amount" type="text" class="text_field" placeholder="SUBSCRIPTION AMOUNT" title="SUBSCRIPTION AMOUNT"/>
                        <div class="title">PAYSTACK PAYMENT KEY:</div>
                        <input id="paystack_payment_key" type="text" class="text_field" placeholder="PAYSTACK PAYMENT KEY" title="PAYSTACK PAYMENT KEY"/>
                    </div>
                    <button class="action-btn" type="button" title="SUBMIT" id="update_btn" onclick="_update_backend_settings();"> <i class="bi-check"></i> UPDATE ACCOUNT </button>
                </div>

                <div class="setting_detail" id="channge_password">   
                    <div class="alert">Fill all fields to change your <span>PASSWORD</span>  </div>
                    <div class="title">OLD PASSWORD: <span>*</span></div>
                    <div class="password-container">
                        <input type="password" id="old_password" onkeyup="_show_password_visibility('old_password','reset_pass')" class="text_field" placeholder="ENTER OLD PASSWORD" title="ENTER YOUR OLD PASSWORD"><br/>
                        <div id="reset_pass" onclick="_togglePasswordVisibility('old_password','reset_pass')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>

                    <div class="title">CREATE NEW PASSWORD: <span>*</span><span id="message">Password Not Matched!</span></div>
                    <input type="password" id="new_password" class="text_field"  placeholder="CREATE NEW PASSWORD" title="CREATE NEW PASSWORD"><br/>
                
                    <div class="title" style="float:left;">COMFIRM NEW PASSWORD:<span >*</span>  <div id='message' style="float:right;margin-left:10px;"></div></div>
                    <input type="password" id="confirm_password" onkeyup=" _check_password_match();" class="text_field" placeholder="COMFIRM NEW PASSWORD" title="COMFIRM NEW PASSWORD">
                
                    <div class="pswd_info" style="color:#8c8d8d" >At least 8 charaters required including upper & lower cases and special characters and numbers.</div>
                    <button class="action-btn" id="submit_btn" type="button" onclick="_update_user_password();" title="CHANGE PASSWORD"> CHANGE PASSWORD</button>
                    
                </div>

            </div>
        </div> 
    </div>
<script>_fetch_settings();</script>
<?php } ?>



<?php if ($page=='logout_confirm_form'){?>
	<div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
			<div class="img"><img src="<?php echo $website_url?>/admin/all-images/images/warning.gif"/></div>
            <h2>Are you sure to log-out?</h2>
             Please, confirm your log-out action.
            <div class="btn-div">
                <button class="btn" onclick="_logout();">YES</button>
                <button class="btn no-btn" onclick="_alert_close();">NO</button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page=='access_key_validation_info'){?>
	<div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
			<div class="img"><img src="<?php echo $website_url?>/admin/all-images/images/warning.gif"/></div>
            <h2>INVALID ACCESS TOKEN</h2>
            Please LogIn Again
            <button class="btn" onclick="_logout();"><i class="bi-check"></i> Okay, Log-In </button>
        </div>
    </div>
<?php } ?>



