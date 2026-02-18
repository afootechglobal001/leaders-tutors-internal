
<?php if ($page == 'signUp') { ?>
    <div class="inner-form" id="nextPage1">
        <div class="alert alert-success">
            Kindly, provide your <span>Company Information</span> to proceed with your registration.
        </div> 

        <div class="text_field_back_container">                   
            <div class="text_field_container">
                <input class="text_field" type="text" id="company_name" placeholder=""/>
                <div class="placeholder">Company Name:</div>
            </div>
            <div class="text_field_container">
                <input class="text_field" type="text" id="company_address" placeholder=""/>
                <div class="placeholder">Company Address:</div>
            </div>

            <div class="text_field_container">
                <input class="text_field" type="tel" id="company_phone" placeholder="" onkeypress="isNumber_Check(event)"/>
                <div class="placeholder">Company Mobile:</div>
            </div>

            <div class="text_field_container">
                <input class="text_field" type="text" id="company_email" placeholder=""/>
                <div class="placeholder">Company Email Address:</div>
            </div>
        </div>
        
        <div class="btn-div">
            <button class="btn next-btn" type="button" title="NEXT" onclick="_userSignUpCheck('nextPage2');">NEXT <i class="bi-arrow-right"></i></button>
        </div>
    </div>
   

    <div class="inner-form" id="nextPage2" style="display:none">
        <div class="alert alert-success">
            Kindly, select and upload your <span>Company Logo</span> to proceed with your registration.
        </div> 

        <div class="alert alert-success">
            <div class="title">COMPANY LOGO: <em>(JPG, PNG FORMAT ONLY)</em><span>*</span></div>
            <div class="pix-div">
                <label>
                    <img id="agent_pix" src="<?php echo $website_url?>/agent/all-images/images/sample.jpg" alt="Default Image">
                    <input type="file" id="company_logo" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="agent_pix_preview.UpdatePreview(this);" />
                </label>
            </div>
        </div>

        <div class="btn-div">
            <button class="btn previous-btn" type="button" title="GO BACK" onclick="_prevPage('nextPage1');"><i class="bi-arrow-left"></i> BACK </button>
            <button class="btn" type="button" title="NEXT" onclick="_userSignUpCheck('nextPage3');">NEXT <i class="bi-arrow-right"></i></button>
        </div>
    </div>

    <div class="inner-form" id="nextPage3" style="display:none">
        <div class="alert alert-success">
            Kindly, provide your <span>Company Contact Person Information</span> to complete your registration.
        </div> 

        <div class="text_field_back_container">                   
            <div class="text_field_container">
                <input class="text_field" type="text" id="contact_name" placeholder=""/>
                <div class="placeholder">Full Name:</div>
            </div>
            <div class="text_field_container">
                <input class="text_field" type="text" id="contact_email" placeholder=""/>
                <div class="placeholder">Email:</div>
            </div>

            <div class="text_field_container">
                <input class="text_field" type="tel" id="contact_phone" placeholder="" onkeypress="isNumber_Check(event)"/>
                <div class="placeholder">Mobile Number:</div>
            </div>

            <div class="text_field_container">
                <select id="contact_role_id" class="text_field" placeholder="">
                    <option value="">-Select here</option>
                    <script>_getSelectRole('contact_role_id');</script>
                </select>
                <div class="placeholder">--Select Role--</div>
            </div>
        </div>
        
        <div class="btn-div">
            <button class="btn previous-btn" type="button" title="GO BACK" onclick="_prevPage('nextPage2');"><i class="bi-arrow-left"></i> BACK </button>
            <button class="btn" type="button" title="PROCEED" id="proceed_btn" onclick="_userSignUpCheck('signUp');">PROCEED <i class="bi-arrow-right"></i></button>
        </div>
    </div>
<?php } ?>
