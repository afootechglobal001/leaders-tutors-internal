<?php if ($page == 'dashboard') { ?>

    <div class="table-div animated fadeIn" id="search-content">
        <div class="div-in">
            <div class="container-title title2"><i class="bi-bar-chart"></i> LIST OF TUTORIAL SUBJECTS </div><br /> <br />

            <div id="fetch_department_class_subject_details"></div>
            <!-- <div class="quest-faq-div">
                <div class="faq-title-text">
                    <h3>MATHEMATICS</h3>
                    <div class="expand-div" id="faq1num" onclick="_collapse('faq1')" title="Click to View Terms">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>
                </div>

                <div class="faq-answer-div" id="faq1answer" style="display: none;">
                    <button class="btn" title="FIRST TERM" onClick="_getPage('video_page','subjects')"><i class="bi-pencil-square"></i> FIRST TERM &nbsp; <span>5</span>&nbsp;<i class="bi-play-btn-fill"></i></button>
                    <button class="btn" title="SECOND TERM" onClick="_getPage('video_page','subjects')"><i class="bi-pencil-square"></i> SECOND TERM &nbsp; <span>5</span>&nbsp;<i class="bi-play-btn-fill"></i></button>
                    <button class="btn" title="THIRD TERM" onClick="_getPage('video_page','subjects')"><i class="bi-pencil-square"></i> THIRD TERM &nbsp; <span>5</span>&nbsp;<i class="bi-play-btn-fill"></i></button>
                </div>
            </div> -->

            <br>
            <div class="bottom-count-div">
                <span id="current_count">0</span> of <span id="total_count">0</span>
                <button class="top-btn bottom-btn" type="button" onClick="_getPage('tutorial_subjects','subjects')"><i class="bi bi-eye"></i> View More</button>
            </div>
        </div>
    </div>


    <!-- <div class="table-div animated fadeIn" id="search-content">
        <div class="div-in">
            <div class="container-title title2"><i class="bi-bar-chart"></i> STUDENT PERFORMANCE </div>
            <div class="table-div-in statistics-div">
                <div class="chart-div">

                    <div id="chartContainer" style="width:100%; height:300px; margin:auto;"></div>

                    <script>
                        $(document).ready(function() {
                            var chart = new CanvasJS.Chart("chartContainer", {
                                animationEnabled: true,
                                title: {
                                    text: ""
                                },
                                axisX: {
                                    valueFormatString: "DD MMM",
                                    crosshair: {
                                        enabled: true,
                                        snapToDataPoint: true
                                    }
                                },
                                axisY: {
                                    title: "",
                                    includeZero: false,
                                    valueFormatString: "N##0.00",
                                    crosshair: {
                                        enabled: true,
                                        snapToDataPoint: true,
                                        labelFormatter: function(e) {
                                            return "N" + CanvasJS.formatNumber(e.value, "##0.00");
                                        }
                                    }
                                },

                                data: [{
                                    type: "line",
                                    xValueFormatString: "DD MMM",
                                    yValueFormatString: "N##0.00",

                                    dataPoints: [

                                        {
                                            x: new Date(2020, 01, 05),
                                            y: 1000
                                        },
                                        {
                                            x: new Date(2020, 02, 05),
                                            y: 4000
                                        },
                                        {
                                            x: new Date(2020, 03, 05),
                                            y: 2000
                                        },
                                        {
                                            x: new Date(2020, 04, 05),
                                            y: 6000
                                        },
                                        {
                                            x: new Date(2020, 05, 05),
                                            y: 9000
                                        },
                                        {
                                            x: new Date(2020, 06, 05),
                                            y: 5000
                                        }

                                    ]
                                }]

                            });
                            chart.render();
                        })
                    </script>

                </div>




                <div class="chart-div">
                    <div id="chartContainer1" style="width:100%; height:300px; margin:auto;"></div>

                    <script type="text/javascript">
                        var options = {
                            title: {
                                text: "" /*My Performance*/
                            },
                            data: [{
                                type: "pie",
                                startAngle: 45,
                                showInLegend: "False",
                                legendText: "{label}",
                                indexLabel: "{label} ({y})",
                                yValueFormatString: "#,##0.#" % "",
                                dataPoints: [{
                                        label: "Outstanding",
                                        y: 300
                                    },
                                    {
                                        label: "Pending",
                                        y: 200
                                    },
                                    {
                                        label: "Processing",
                                        y: 100
                                    },
                                    {
                                        label: "Ready",
                                        y: 300
                                    },
                                    {
                                        label: "Delivered",
                                        y: 200
                                    },
                                ]
                            }]
                        };
                        $("#chartContainer1").CanvasJSChart(options);
                    </script>
                </div>


            </div>
        </div>
    </div> -->
    <script>
        _getUserLoginDetails('<?php echo $page ?>');
        _getFetchDepartmentClassSubject();
    </script>

<?php } ?>







<?php if ($page == 'tutorial_subjects') { ?>
    <div class="container-div">
        <div class="div-in">
            <div class="container-title title2"><i class="bi-pencil-square"></i>LIST OF TUTORIAL SUBJECTS</div>


            <br clear="all" />
            <div class="fetch animated fadeIn" id="fetch_department_class_subject_details">



            </div>
        </div>
        <br clear="all" />
    </div>


    <script>
        _getFetchDepartmentClassSubject();
    </script>
<?php } ?>




<?php if ($page == 'video_page') { ?>

    <div class="container-div">
        <div class="div-in">
            <div class="container-title title2"><i class="bi-pencil-square"></i>TUTORIAL / <span id="tutorial_subject_name">SUBJECT NAME</span> / <span id="tutorial_term_name">TUTORIAL NAME</span> / VIDEO'S LIST</div>


            <br clear="all" />
            <div class="fetch animated fadeIn" id="fetch_deparment_class_subject_weeks_details">
                <!-- <div class="quest-faq-div">
                <div class="faq-title-text">
                    <h3>WEEK 1</h3>
                    <div class="expand-div" id="faq1num" onclick="_collapse('faq1')" title="Click to View Terms">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>
                </div>

                <div class="faq-answer-div" id="faq1answer" style="display: none;">
                    <div class="topics-content-div">
                        <div class="image-div"><img src="/admin/a/all-images/body-pix/lcm.jpg" alt="'" /></div>
                        <div class="text">
                            <h4>LCM</h4>
                            <p>Unlock the power of least common multiple (LCM) in mathematics with our comprehensive guide. Learn how to find the smallest common multiple of two or more numbers effortlessly.</p>
                            <hr>
                            </hr>
                            <div class="bottom-div">
                                <button class="btn" title="VIEW VIDEOS" onClick="_get_page_with_id();">Take CBT </button> 
                                <button class="btn" title="PLAY VIDEO" onClick="_getForm('subscription_video', '');"><i class="bi bi-play"></i> PLAY VIDEO </button>
                            </div>
                        </div> 
                    </div>


                    <div class="topics-content-div">
                        <div class="image-div"><img src="/admin/a/all-images/body-pix/lcm.jpg" alt="'" /></div>
                        <div class="text">
                            <h4>LCM</h4>
                            <p>Unlock the power of least common multiple (LCM) in mathematics with our comprehensive guide. Learn how to find the smallest common multiple of two or more numbers effortlessly.</p>
                            <hr>
                            </hr>
                            <div class="bottom-div">
                                <button class="btn" title="PLAY VIDEO" onClick="_getForm('subscription_video', '');"><i class="bi bi-play"></i> PLAY VIDEO </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>-->
            </div>

        </div>
        <br clear="all" />
    </div>

<?php } ?>





<?php if ($page == 'terminal_exam') { ?>
    <div class="container-div">
        <div class="div-in">
            <div class="container-title title2"><i class="bi-book"></i> TERMINAL EXAM</div>

            <br clear="all" />
            <div class="fetch animated fadeIn" id="fetch_department_class_subject_details">



            </div>
        </div>
        <br clear="all" />
    </div>


    <script>
        // _getFetchDepartmentClassSubject();
    </script>
<?php } ?>




<?php if ($page == 'external_exam') { ?>
    <div class="container-div">
        <div class="div-in">
            <div class="container-title title2"><i class="bi-book"></i> EXTERNAL EXAM</div>

            <br clear="all" />
            <div class="fetch animated fadeIn" id="fetch_department_class_subject_details">



            </div>
        </div>
        <br clear="all" />
    </div>


    <script>
        // _getFetchDepartmentClassSubject();
    </script>
<?php } ?>




<?php if ($page == 'academic_report') { ?>
    <div class="container-div">
        <div class="div-in">
            <div class="container-title title2"><i class="bi-graph-up-arrow"></i> ACADEMIC REPORT</div>

            <br clear="all" />
            <div class="fetch animated fadeIn" id="fetch_department_class_subject_details">



            </div>
        </div>
        <br clear="all" />
    </div>


    <script>
        // _getFetchDepartmentClassSubject();
    </script>
<?php } ?>








<?php if ($page == 'transactions') { ?>

    <div class="table-div animated fadeIn" id="search-content">
        <div class="div-in">
            <div class="container-title title2"><i class="bi bi-credit-card"></i> TRANSACTIONS HISTORY</div>
            <div class="input-search-div search-div2">
                <button type="button" class="top-btn" onclick=" _fetch_custom_report('<?php echo $page ?>','custom_search','')"><i class="bi-filetype-pdf"></i> Download</button>
            </div>

            <div class="table-div-in">
                <table class="table" cellspacing="0" style="width:100%" id="fetch_all_transaction_history">

                    <!-- <tr class="tb-col">
                            <td>SN</td>
                            <td>TRANSACTION ID</td>
                            <td>AMOUNT</td>
                            <td>PURPOSE</td>
                            <td>TRANSACTION METHOD</td>
                            <td>STATUS</td>
                            <td>DATE</td>
                            <td>ACTION</td>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>TRANS041202405030828137</td>
                            <td><span>₦</span> 2,000.00</td>
                            <td>VIDEO SUBSCRIPTION</td>
                            <td>DIRECT ONLINE PAYMENT</td>
                            <td><div class="status-div SUCCESS">SUCCESS</div></td>
                            <td>2024-04-21 16:32:44</td>
                            <td><button class="btn" onclick="_getForm('transaction_details')"><i class="bi bi-eye"></i> VIEW DETAILS</button></td>
                        </tr>  -->



                </table>
            </div>
            <div class="bottom-count-div">
                <span id="current_trans_count">0</span> of <span id="trans_total_count">0</span>
                <!-- <button class="top-btn bottom-btn" type="button"><i class="bi bi-eye"></i> View More</button> -->
            </div>
        </div>
    </div>

<?php } ?>





<?php if ($page == 'subscription_history') { ?>

    <div class="table-div animated fadeIn" id="search-content">
        <div class="div-in">
            <div class="container-title title2"><i class="bi bi-credit-card"></i> SUBCRITION HISTORY </div>
            <div class="input-search-div search-div2">
                <button type="button" class="top-btn" onclick=" _fetch_custom_report('<?php echo $page ?>','custom_search','')"><i class="bi-filetype-pdf"></i> Download</button>
            </div>
            <!-- <div class="text search-container" onclick="select_search()">
                <span id="srch-text">Custom Search</span> &nbsp; &nbsp; <span class="icon"><i class="fa fa-sort-down (alias)"></i></span>
                <div class="srch-select" id="srch-select">
                    <div class="div-in">
                        <div class="title"> Select Date From: <span>*</span></div>
                        <input id="mobile-datepicker-from" type="date" class="text_field" placeholder="Select Date From" title="Select Date From" />

                        <div class="title"> Select Date To: <span>*</span></div>
                        <input id="mobile-datepicker-to" type="date" class="text_field" placeholder="Select Date To" title="Select Date To" /> <br />
                        <button class="btn" onclick=" _fetch_custom_report2('<?php //echo $page 
                                                                                ?>','custom_search','')"><i class="bi-check"></i> Apply</button>
                        <button class="btn btn2" onclick="close_search()"><i class="bi-x"></i> Close</button>
                    </div>
                </div>
            </div> -->

            <div class="table-div-in">
                <table class="table" cellspacing="0" style="width:100%" id="fetch_all_subscription_history">

                    <!-- <tr class="tb-col">
                    <td>SN</td>
                    <td>SUBCRIPTION ID</td>
                    <td>DEPARTMENT</td>
                    <td>CLASS</td>
                    <td>SUBCRIPTION DATE</td>
                    <td>DUE DATE</td>
                    <td>STATUS</td>
                    <td>ACTION</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>TRANS041202405030828137</td>
                    <td><span>₦</span> 2,000.00</td>
                    <td>VIDEO SUBSCRIPTION</td>
                    <td>DIRECT ONLINE PAYMENT</td>
                    <td><div class="status-div SUCCESS">SUCCESS</div></td>
                    <td>2024-04-21 16:32:44</td>
                    <td><button class="btn" onclick="_getForm('transaction_details')"><i class="bi bi-eye"></i> VIEW DETAILS</button></td>
                </tr>  -->



                </table>
            </div>
            <div class="bottom-count-div">
                <span id="current_sub_count">0</span> of <span id="sub_total_count">0</span>
                <!-- <button class="top-btn bottom-btn" type="button"><i class="bi bi-eye"></i> View More</button> -->
            </div>
        </div>
    </div>

<?php } ?>














<?php if ($page == 'user_profile') { ?>

    <div class="table-div profile-main-div animated fadeIn" id="search-content">
        <div class="div-in">
            <div class="container-title"><i class="bi-box-arrow-in-up-right"></i> SUBSCRIPTION DETAILS </div>

            <div class="profile-container ">
                <div class="profile-grid-details profile-grid-details2">
                    <div class="grid-details">
                        Department:
                        <div class="text" id="user_department_name">Xxx Xxx</div>
                    </div>
                </div>

                <div class="profile-grid-details profile-grid-details2">
                    <div class="grid-details">
                        Class:
                        <div class="text" id="user_class_name">Xxx Xxx</div>
                    </div>
                </div>
            </div>
            <div class="profile-container ">
                <div class="profile-grid-details profile-grid-details2">
                    <div class="grid-details">
                        Subcription Start Date:
                        <div class="text" id="user_subscription_start_date">0000-00-00</div>
                    </div>
                </div>

                <div class="profile-grid-details profile-grid-details2">
                    <div class="grid-details">
                        Subcription End Date:
                        <div class="text" id="user_subscription_end_date">0000-00-00</div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="table-div animated fadeIn" id="search-content">
        <div class="div-in">
            <div class="container-title"><i class="bi bi-gear"></i> SYSTEM DETAILS </div>

            <div class="profile-container">
                <div class="profile-grid-details profile-grid-details2 details2">
                    <div class="grid-details referral-div">
                        Referral Link:
                        <div class="text referral-text" id="user_referral_link">Xxx Xxx</div>
                    </div>
                    <div class="icon-div" onclick="_copyText()" id="copyText"> <i class="bi bi-clipboard"></i> copy </div>
                </div>
            </div>

            <div class="profile-container">
                <!-- <div class="profile-grid-details details2">
                    <div class="grid-details referral-div">
                        Referral Link:
                        <div class="text referral-text" id="user_referral_link">Xxx Xxx</div>
                    </div>
                    <div class="icon-div" onclick="_copyText()" id="copyText"> <i class="bi bi-clipboard"></i> copy </div>
                </div> -->

                <div class="profile-grid-details profile-grid-details2">
                    <div class="grid-details">
                        Status:
                        <div class="text" id="user_status_name">Xxx Xxxx</div>
                    </div>
                </div>

                <div class="profile-grid-details profile-grid-details2">
                    <div class="grid-details">
                        Wallet Ballance:
                        <div class="text">₦ <span id="user_wallet_ballance">0.00</span></div>
                    </div>
                </div>
            </div>

            <div class="profile-container">
                <div class="profile-grid-details">
                    <div class="grid-details">
                        Registration Date:
                        <div class="text" id="user_registration_date">0000-00-00</div>
                    </div>
                </div>


                <div class="profile-grid-details">
                    <div class="grid-details">
                        Profile Updated Date:
                        <div class="text" id="user_profile_updated_date">0000-00-00</div>
                    </div>
                </div>

                <div class="profile-grid-details">
                    <div class="grid-details">
                        Last Login Date:
                        <div class="text" id="user_last_login_date">0.00</div>
                    </div>
                </div>


            </div>

        </div>
    </div>



    <div class="table-div animated fadeIn" id="search-content">
        <div class="div-in">
            <div class="container-title"><i class="bi bi-person"></i> MY PROFILE</div>
            <span id="loading-div" style="margin-left:80px; color:var(--subactive-color); font-size:14px;"></span>
            <br clear="all" />
            <div class="user-account-div">

                <div class="profile-div">
                    <label>
                        <div class="profile-pix" id="profile_pix"><img id="passportimg4" src="<?php echo $website_url ?>/uploaded_files/user_pix/friends.png" /></div>
                        <input type="file" id="passport_pix" accept=".jpg,.png,.jpeg,.PNG,.JPG,.JPEG" onchange="user_profile_pix.UpdatePreview(this);" style="display:none;" />
                    </label>
                </div>


                <div class="profile-div info-div">
                    <div class="title"> FULLNAME: <span>*</span></div>
                    <input id="fullname" type="text" class="text_field" placeholder="FULLNAME" title="FULLNAME" />
                    <div class="title"> EMAIL ADDRESS: <span>*</span></div>
                    <input id="email" type="text" class="text_field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS" />
                    <div class="title"> PHONE NUMBER: <span>*</span> <span style="float:right;font-size:10px;display:none;color:#f00" id="verify_mobile_info">Phone number not accepted!</span></div>
                    <input id="mobile" type="text" onkeypress="_isNumberCheck();" class="text_field" placeholder="080XXXXXXXX" title="PHONE NUMBER" />

                    <button class="action-btn" type="button" id="update_btn" onclick="_updateUserProfile();"><i class="bi-check"></i> UPDATE PROFILE</button>
                </div>




            </div>
        </div>
    </div>


    <script>
        //_uploadUserPix();
        _getUserLoginDetails('<?php echo $page ?>');
    </script>


<?php } ?>





















<script type="text/javascript" src="js/scrollBar.js"></script>
<script type="text/javascript">
    $(".").scrollBox();
</script>

<script src="js/aos.js"></script>
<script>
    AOS.init({
        easing: 'ease-in-out-sine'
    });
</script>