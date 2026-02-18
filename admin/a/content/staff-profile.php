<div class="overlay-off-div">
    <div class="user-profile-div animated fadeInUp">
        <div class="top-panel-div">
            <i class="bi-person"></i> ADMINISTRATIVE PROFILE</span>
            <div class="close" title="Close" onclick="_alert_close();">X</div>
        </div>

        <div class="profile-content-div sb-container">
            <div class="bg-img">             
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="current_user_passport2"></div> 
                        <input type="file" id="profile_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="Test.UpdatePreview(this);"/>
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
                        <input id="staff_id" type="text" class="text_field" readonly="readonly" placeholder="STAFF ID" title="STAFF ID"/>
                        <span>&nbsp;<i class="bi-lock"></i></span>
                    </div>
                </div>

                <div class="profile-segment-div col-4">
                    <div class="segment-title">LAST LOGIN DATE:</div>
                    <div class="text-field-div">
                        <input id="last_login" type="text" class="text_field" readonly="readonly" placeholder="Last Login Date" title="Last Login Date" />
                        <span>&nbsp;<i class="bi-lock"></i></span>
                    </div>
                </div>

                <div class="profile-segment-div col-4">
                    <div class="segment-title">DATE OF REGISTRATION:</div>
                    <div class="text-field-div">
                        <input id="created_time" type="text" readonly="readonly" class="text_field" placeholder="Date Of Registration" title="Date Of Registration"/>
                        <span>&nbsp;<i class="bi-lock"></i></span>
                    </div>
                </div>
            </div>   


            <div class="user-in user-in-bottom">
                <div class="title">ADMINISTRATIVE INFORMATION</div>
                <div class="profile-segment-div col-6">
                    <div class="segment-title">STAFF ROLE:</div>
                    <div class="text-field-div no-border">
                        <select class="text_field text_field2"  id="updt_role_id" style="background:#fff;">                                
                            <option value="" >SELECT ROLE </option>
                            <script>_get_select_role('updt_role_id');</script>
                        </select>
                    </div>
                </div> 

                <div class="profile-segment-div col-7">
                    <div class="segment-title">STAFF STATUS:</div>
                    <div class="text-field-div no-border">
                        <select class="text_field text_field2" id="updt_status_id" style="background:#fff;" >                                                    
                            <option value="">SELECT STATUS </option>
                            <script>_get_select_status('updt_status_id','1,2');</script>
                        </select>
                    </div>
                </div>
                <button class="btn" type="button" id="update_btn" onclick="_update_login_staff_profile();"> UPDATE PROFILE <i class="bi-check"></i></button>     
            </div> 
        </div>  
        
    </div> 
</div>
<script> _upload_pix_();</script>
<script> _get_login_staff_profile()</script>
