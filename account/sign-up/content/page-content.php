<script type="text/javascript" src="js/scrollBar.js"></script>
<script type="text/javascript">
    $(".sb-container").scrollBox();
</script>

<?php if ($page == 'signup') { ?>

    <div class="fill-form-div animated fadeIn" id="nextPage1">
        <div class="alert alert-success">
            Welcome 👋, Unlock endless learning and access wide range of topics.
        </div>
        <div class="title-div"> FULLNAME: <span>*</span></div>
        <input type="text" class="text-field" id="reg_fullname" placeholder="ENTER YOUR FULLNAME" />

        <div class="title-div"> EMAIL ADDRESS: <span>*</span></div>
        <input type="text" class="text-field" id="reg_email" placeholder="ENTER YOUR EMAIL ADDRESS" />

        <div class="title-div"> MOBILE NUMBER: <span>*</span> <em id="mobile_info" style="color: var(--active-color)">Mobile number not accepted</em></div>
        <input type="tel" class="text-field" id="reg_mobile_no" onkeypress="_isNumberCheck('reg_mobile_no', 'mobile_info')" placeholder="080XXXXXXXX" />

        <button class="btn next-btn" type="button" id="next_id1" title="NEXT" onclick="_userSignUp('nextPage2');">NEXT <i class="bi-arrow-right"></i></button>
    </div>

    <div class="fill-form-div animated fadeIn" id="nextPage2">
        <div class="profile-div">
            <div class="icon-div"><i class="bi-person-circle"></i></div>
            <div class="details-div">
                <span id="reg_fullname_info">Xxxx Xxxx</span><br>
                <span id="reg_email_info">Xxxx Xxxx</span>
            </div>
        </div>

        <div class="title-div"> SELECT DEPARTMENT: <span>*</span></div>
        <select id="reg_department_id" class="text-field select_field" title="SELECT DEPARTMENT" onChange="_getSelectDepartmentClass('reg_department_id', 'reg_class_id')">
            <option value="" selected="selected">SELECT DEPARTMENT</option>
        </select>

        <div class="title-div"> SELECT CLASS: <span>*</span></div>
        <select id="reg_class_id" class="text-field select_field" title="SELECT CLASS">
            <option value="" selected="selected">SELECT CLASS</option>
        </select>

        <button class="btn next-btn" type="button" id="next_id2" title="NEXT" onclick="_userSignUp('nextPage3');">NEXT <i class="bi-arrow-right"></i></button>
        <button class="btn prev-btn" type="button" id="prev_id1" title="GO BACK" onclick="_prevPage('nextPage1');"><i class="bi-arrow-left"></i> GO BACK</button>
    </div>


    <div class="fill-form-div animated fadeIn" id="nextPage3">
        <div class="profile-div">
            <div class="icon-div"><i class="bi-person-circle"></i></div>
            <div class="details-div">
                <span id="reg_fullname_info1">Xxxx Xxxx</span><br>
                <span id="reg_email_info1">Xxxx Xxxx</span>
            </div>
        </div>

        <div class="title-div"> CREATE PASSWORD: <span>*</span></div>
        <div class="password-container">
            <input id="reg_create_password" type="password" class="text-field" onkeyup="_showPasswordVisibility('reg_create_password','tog_reg_create_password')" placeholder="NEW PASSWORD" title="NEW PASSWORD" />
            <div id="tog_reg_create_password" onclick="_togglePasswordVisibility('reg_create_password','tog_reg_create_password')">
                <i class="bi-eye-slash password-toggle"></i>
            </div>
        </div>

        <div class="title-div"> CONFIRMED PASSWORD: <span>*</span> <span id="message">Password Not Match!</span></div>
        <div class="password-container">
            <input id="reg_confirmed_password" type="password" class="text-field" onkeyup="_checkPasswordMatch('reg_confirmed_password','tog_reg_confirmed_password')" placeholder="CONFIRMED PASSWORD" title=" CONFIRMED PASSWORD" />
            <div id="tog_reg_confirmed_password" onclick="_togglePasswordVisibility('reg_confirmed_password','tog_reg_confirmed_password')">
                <i class="bi-eye-slash password-toggle"></i>
            </div>
        </div>

        <div class="ref" id="hidden-referral-code">
            <div class="title-div"> REFERRAL-CODE ( <em>Optional</em> )</div>
            <input type="tel" class="text-field" id="agent_referral_code" placeholder="ENTER YOUR REFERRAL-CODE" />
        </div>
               
        <div class="alert" style="font-size: 12px">
            <i class="bi-pencil-square"></i> Note: You will make payment of <strong style="color:var(--main-color)">₦<span id="subcription_amount" style="color:var(--main-color)">0.00</span></strong> to complete your registration
        </div>

        <button class="btn next-btn" type="button" id="submit_btn" title="SUBMIT" onclick="_userSignUp('signUp');"><i class="bi bi-credit-card"></i> PROCEED</button>
        <button class="btn prev-btn" type="button" id="prev_id2" title="GO BACK" onclick="_prevPage('nextPage2');"><i class="bi-arrow-left"></i> Go Back</button>
    </div>
    





    <script>
        var search_content = ['Enter your email address', 'e.g afootechglobal@gmail.com', 'leaderstutors@gmail.com', 'info@pec.com.ng'];
        _placeHolder(reg_email, search_content);
        _inputSession();
        _getSelectDepartment('reg_department_id', '');
        _getSubscriptionAmount();
        _hiddenField();
    </script>

<?php } ?>