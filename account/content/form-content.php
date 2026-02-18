<?php if ($page == 'logout_modal_alert') { ?>
    <div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
            <div class="img"><img src="<?php echo $website_url ?>/account/all-images/images/warning.gif" /></div>
            <h2>Are you sure to log-out?</h2>
            Please, confirm your log-out action.
            <div class="btn-div">
                <button class="btn yes-btn" onclick="_logOut();">YES</button>
                <button class="btn no-btn" onclick="_alertClose('');">NO</button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'load_user_wallet') { ?>
    <div class="caption-div caption-success-div animated zoomIn">
        <div class="title-div"><i class="bi-credit-card"></i> Load Wallet <div class="close" onclick="_alertClose('')"><i class="bi-x"></i></div>
        </div>
        <div class="div-in animated fadeInRight" style="text-align: left;">
            <div class="alert alert-success">Hi <span id="user_wallet_name"><strong>Xxxx Xxxx</strong></span>, Kindly enter the amount to load your wallet.</div>
            <div class="title">Enter Amount (₦):<span>*</span> <span style="float:right;font-size:10px;padding-top:7px;display:none;color:#f00" id="amount_info">Amount not accepted!</span></div>
            <input class="text_field" id="wallet_amount" onkeypress="_isNumberCheck();" placeholder="0.00" title="Amount" type="tel" onkeypress="return isNumber(event)" />
            <button class="btn" type="button" id="load_wallet_btn" title="LOAD WALLET" onclick="_loadWallet('<?php echo $page ?>')"><i class="bi-credit-card"></i> LOAD WALLET</button>
        </div>
        <br clear="all" />
    </div>
    <script>
        _getUserLoginDetails('<?php echo $page ?>');
    </script>
<?php } ?>



<?php if ($page == 'user_subcription') { ?>
    <div class="caption-div subcription-caption-div animated zoomIn">
        <div class="title-div"><i class="bi bi-send-check-fill"></i> Subcription <div class="close" onclick="_alertClose('')"><i class="bi-x"></i></div>
        </div>
        <div class="div-in animated fadeInRight">
            <div class="alert alert-success">Hi <span><strong id="user_subscription_name">Xxxx</strong></span>, you are about to subscribe for a new <span>tutorial session</span>. Subscription fee is <strong>₦<span id="subscription_amount"> 0.00</span></strong></div>

            <div class="title">SELECT DEPARTMENT: <span>*</span></div>
            <select id="sub_department_id" class="text_field selectinput" title="SELECT DEPARTMENT" onChange="_getSelectDepartmentClass('sub_department_id', 'sub_class_id')">
                <option value="">SELECT DEPARTMENT</option>
            </select>

            <div class="title">SELECT CLASS: <span>*</span></div>
            <select id="sub_class_id" class="text_field selectinput" title="SELECT PAYMENT METHOD">
                <option value="">SELECT CLASS</option>
            </select>

            <div class="title">SELECT PAYMENT METHOD: <span>*</span></div>
            <select id="sub_payment_method_id" class="text_field selectinput" title="SELECT PAYMENT METHOD">
                <option value="">SELECT PAYMENT METHOD</option>
            </select>

            <button class="btn" type="button" id="submit_btn" title="MAKE PAYMENT" onclick="_userSubscriptionPayment()"><i class="bi-credit-card"></i> MAKE PAYMENT</button>
        </div>
        <br clear="all" />
    </div>
    <script>
        _getUserLoginDetails('<?php echo $page ?>');
    </script>
<?php } ?>





<?php if ($page == 'user_subcription_success') { ?>
    <div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
            <div class="img"><img src="<?php echo $website_url ?>/account/all-images/images/success.gif" /></div>
            <h2>SUBCRIPTION SUCCESSFUL</h2>
            Hi <span id="user_subscription_name"></span>, you have successfully subscribe for a new tutorial session. <br>
            Department: <span id="user_sub_department_name"></span>, Class: <span id="user_sub_class_name"></span>
            <button class="btn" onclick="_alertClose('')" type="button"><i class="bi-check"></i> Done </button>
        </div>
    </div>
    <script>
        _getUserLoginDetails('<?php echo $page ?>');
    </script>
<?php } ?>


<?php if ($page == 'load_user_wallet_success') { ?>
    <div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
            <div class="img"><img src="<?php echo $website_url ?>/account/all-images/images/success.gif" /></div>
            <h2>TRANSACTION SUCCESSFUL</h2>
            Hi <span id="user_load_wallet_name"></span>, you have successfully fund your wallet.
            <button class="btn" onclick="_alertClose('')" type="button"><i class="bi-check"></i> Done </button>
        </div>
    </div>
    <script>
        _getUserLoginDetails('<?php echo $page ?>');
    </script>
<?php } ?>






<?php if ($page == 'tutorial_video') { ?>
    <div class="page-creation-panel">
        <div class="title-div">
            <div class="div-in"><i class="bi-camera-video"></i> TUTORIAL VIDEO <button class="close-btn" id="pauseButton" onclick="_alertClose2()"><i class="bi-x-lg"></i></button></div>
        </div>
        <div id="video_subscription_detail_page">
            <iframe src="<?php echo $website_url ?>/account/materials/?page=<?php echo $page ?>&tutorial_id=<?php echo $ids ?>" type="text/html" style="width:100%; height:100%;" frameborder="0"></iframe>
        </div>
    </div>
<?php } ?>


<?php if ($page == 'tutorial_note') { ?>
    <div class="page-creation-panel">
        <div class="title-div">
            <div class="div-in"><i class="bi-pencil-square"></i> TUTORIAL NOTE <button class="close-btn" id="pauseButton" onclick="_alertClose2()"><i class="bi-x-lg"></i></button></div>
        </div>
        <div class="page-content-div ">
            <div class="content-side-div">
                <div class="div-in">

                    <div id="ajax_loader"></div>

                    <div id="fetch_tutorial_details">

                        <div id="tutorial_details">
                            <iframe id="pdfFile" src="" width="100%" height="450px" style="display: none;"></iframe>
                            <!--<embed id="pdfFile" src="" type="application/pdf" width="100%" height="450px" style="display: none;">-->
                        </div>


                        <div class="video-details-div">

                            <div class="inner-topic-details-div">
                                <div class="icons-div">
                                    <i class="bi-house-fill"></i>
                                </div>

                                <div class="text-div">
                                    Class
                                    <h3 id="tutorial_class">Xxxx Xxxx</h3>
                                </div>
                            </div>

                            <div class="inner-topic-details-div">
                                <div class="icons-div">
                                    <i class="bi-pencil-square"></i>
                                </div>
                                <div class="text-div">
                                    Subject
                                    <h3 id="tutorial_subject">Xxxx Xxxx</h3>
                                </div>
                            </div>

                            <div class="inner-topic-details-div">
                                <div class="icons-div">
                                    <i class="bi-calendar-range"></i>
                                </div>

                                <div class="text-div">
                                    Term
                                    <h3 id="tutorial_term">Xxxx Xxxx</h3>
                                </div>
                            </div>

                            <div class="inner-topic-details-div">
                                <div class="icons-div">
                                    <i class="bi-calendar-week"></i>
                                </div>

                                <div class="text-div">
                                    Week
                                    <h3 id="tutorial_week">Xxxx Xxxx</h3>
                                </div>
                            </div>

                        </div>

                        <br clear="all" />
                    </div>

                </div>
                <br clear="all" />
                <br clear="all" />
            </div>
        </div>
    </div>
    </div>
    <script>
        _getTutorialVideosDetails('<?php echo $page ?>', '<?php echo $ids ?>');
        // _disabledInspect();
    </script>

<?php } ?>






<?php if ($page == 'cbt_summary_details') { ?>
    <div class="page-creation-panel">
        <div class="title-div">
            <div class="div-in"><i class="bi-tv"></i> <span id="cbt-header-title">CBT</span> <button class="close-btn" onclick="_alertClose()"><i class="bi-x-lg"></i></button></div>
        </div>
        <div class="page-content-div">

            <div id="cbt-details-id">
                <div class="content-side-div">
                    <div class="div-in">

                        <div id="ajax_loader"></div>

                        <div class="cbt-alert-container">
                            <div class="div-in">
                                <div class="alert">
                                    Hi <strong id="cbt_user_name">Xxxx Xxxx</strong>, Below is the quiz details for <span id="cbt_topic">Xxxx</span>
                                </div>
                            </div>

                            <div class="video-details-div">
                                <div class="inner-topic-details-div">
                                    <div class="icons-div">
                                        <i class="bi-house-fill"></i>
                                    </div>

                                    <div class="text-div">
                                        Class
                                        <h3 id="cbt_tutorial_class">Xxxx Xxxx</h3>
                                    </div>
                                </div>

                                <div class="inner-topic-details-div">
                                    <div class="icons-div">
                                        <i class="bi-pencil-square"></i>
                                    </div>
                                    <div class="text-div">
                                        Subject
                                        <h3 id="cbt_tutorial_subject">Xxxx Xxxx</h3>
                                    </div>
                                </div>

                                <div class="inner-topic-details-div">
                                    <div class="icons-div">
                                        <i class="bi-calendar-range"></i>
                                    </div>

                                    <div class="text-div">
                                        Term
                                        <h3 id="cbt_tutorial_term">Xxxx Xxxx</h3>
                                    </div>
                                </div>

                                <div class="inner-topic-details-div">
                                    <div class="icons-div">
                                        <i class="bi-calendar-week"></i>
                                    </div>

                                    <div class="text-div">
                                        Week
                                        <h3 id="cbt_tutorial_week">Xxxx Xxxx</h3>
                                    </div>
                                </div>

                                <div class="inner-topic-details-div">
                                    <div class="icons-div">
                                        <i class="bi-question-octagon-fill"></i>
                                    </div>

                                    <div class="text-div">
                                        No of Question
                                        <h3 id="cbt_tutorial_no_of_question">0</h3>
                                    </div>
                                </div>

                                <div class="inner-topic-details-div">
                                    <div class="icons-div">
                                        <i class="bi-calendar-week"></i>
                                    </div>

                                    <div class="text-div">
                                        Available Time
                                        <h3 id="cbt_tutorial_available_time">00:00:00</h3>
                                    </div>
                                </div>

                                <div class="inner-topic-details-div start-quiz-div" id="quizBtnIDContainer">
                                    <button class="quizbtn" id="quizbtn"> LOADING... </button>
                                    <!-- <button class="quizbtn" id="quizbtn" title="Start Quiz" onclick="_getPageCbt('cbt_quiz', '1')"> <i class="bi-skip-start-btn-fill"> </i>START QUIZ</button> -->
                                </div>


                            </div>
                        </div>

                        <br clear="all" />

                    </div>
                    <br clear="all" />
                    <br clear="all" />
                </div>
            </div>
        </div>
    </div>
    <script>
        // _disabledInspect();
    </script>

<?php } ?>



<?php if ($page == 'cbt_details') { ?>
    <div id="cbt-details-id">

        <div class="cbt-alert-container animated fadeDown">
            <div class="div-in">
                <div class="alert">
                    Hi <strong>Afolabi Abayomi</strong>, Below is the quiz details for <span>MATHEMATICS</span>
                </div>
            </div>

            <div class="video-details-div cbt-details">
                <div class="inner-topic-details-div">
                    <div class="icons-div">
                        <i class="bi-house-fill"></i>
                    </div>

                    <div class="text-div">
                        Class
                        <h3 id="tutorial_class">JSS 1</h3>
                    </div>
                </div>

                <div class="inner-topic-details-div">
                    <div class="icons-div">
                        <i class="bi-pencil-square"></i>
                    </div>
                    <div class="text-div">
                        Subject
                        <h3 id="tutorial_subject">MATHEMATICS</h3>
                    </div>
                </div>

                <div class="inner-topic-details-div">
                    <div class="icons-div">
                        <i class="bi-calendar-range"></i>
                    </div>

                    <div class="text-div">
                        Term
                        <h3 id="tutorial_term">FIRST TERM</h3>
                    </div>
                </div>

                <div class="inner-topic-details-div">
                    <div class="icons-div">
                        <i class="bi-calendar-week"></i>
                    </div>

                    <div class="text-div">
                        Week
                        <h3 id="tutorial_week">WEEK ONE</h3>
                    </div>
                </div>

                <div class="inner-topic-details-div">
                    <div class="icons-div">
                        <i class="bi-question-octagon-fill"></i>
                    </div>

                    <div class="text-div">
                        No of Question
                        <h3 id="tutorial_week">100</h3>
                    </div>
                </div>

                <div class="inner-topic-details-div">
                    <div class="icons-div">
                        <i class="bi-calendar-week"></i>
                    </div>

                    <div class="text-div">
                        Quiz Duration
                        <h3 id="tutorial_week">02:00:00</h3>
                    </div>
                </div>

                <div class="inner-topic-details-div start-quiz-div">
                    <button class="quizbtn" title="Start Quiz"> <i class="bi-skip-start-btn-fill"> </i>START QUIZ</button>
                </div>


            </div>
        </div>
    </div>


    <script>
        // _disabledInspect();
    </script>

<?php } ?>



<?php if ($page == 'cbt_quiz') { ?>

    <div class="cbt-header animated fadeIn">
        <div class="cbt-header-in">

            <div class="cbt-header-grid" id="class">
                <div class="grid-in">
                    <span>Class:</span>
                    <div class="detail" id="cbt_tutorial_class">Xxxx Xxxx</div>
                </div>
            </div>

            <div class="cbt-header-grid" id="subject">
                <div class="grid-in">
                    <span>Subject:</span>
                    <div class="detail" id="cbt_tutorial_subject">Xxxx Xxxx</div>
                </div>
            </div>

            <div class="cbt-header-grid" id="term">
                <div class="grid-in">
                    <span>Term:</span>
                    <div class="detail" id="cbt_tutorial_term">Xxxx Xxxx</div>
                </div>
            </div>

            <div class="cbt-header-grid" id="week">
                <div class="grid-in">
                    <span>Week:</span>
                    <div class="detail" id="cbt_tutorial_week">Xxxx Xxxx</div>
                </div>
            </div>
            <div class="cbt-header-grid" id="topic">
                <div class="grid-in">
                    <span>Topic:</span>
                    <div class="detail" id="cbt_topic">Xxxx Xxxx</div>
                </div>
            </div>


            <div class="cbt-header-grid time-count-down" id="time-remaining">
                <div class="grid-in ">
                    <span>Time Remaining:</span>
                    <div class="detail time" id="detailTime">00:00:00</div>
                </div>
            </div>

        </div>
    </div>

    <div class="content-side-div cbt-quiz-content-div animated fadeIn">
        <div class="div-in">

            <div class="cbt-alert-container">

                <div id="question-loader"></div>

                <div class="question-container-div animated fadeIn" id="question-container-div">

                    <div class="question-div" id="questionID"></div>
                    <div class="question-div-in">

                        <!-- Question with image or no image -->

                        <div class="question">
                            <div class="question-image-div" id="imageContainerId">
                                <!-- <img src="<?php //echo $website_url  
                                                ?>/account/all-images/images/laptop.jpg" alt=""> -->
                            </div>

                            <div class="text-container text-with-img" id="optionsContainerId">
                                <div class="text-div" id="questionTextId">
                                    <!-- _______ is a name of anything, animal place or thing  -->
                                </div>
                                <!-- <label>
                                    <div class="question-option-div">
                                        <div class="option-container-div">
                                            <input type="radio" class="checkfield" name="option" />
                                            <div class="option-div">A</div>
                                            Noun
                                        </div>
                                    </div>
                                </label> -->
                            </div>
                        </div>



                        <!-- option with image -->
                        <!-- <div class="question">
                            <div class="question-image-div" id="imageContainerId">
                                <img src="<?php //echo $website_url  
                                            ?>/account/all-images/images/laptop.jpg" alt="">
                            </div>

                            <div class="text-container text-with-img" id="optionsContainerId">
                                <div class="text-div" id="questionTextId">
                                   Wich following is a car 
                                </div>
                                <label>
                                    <div class="question-option-div">
                                        <div class="option-container-div">
                                            <input type="radio" class="checkfield" name="option" />
                                            <div class="option-div">A</div>
                                            <div class="option-image-div">
                                                <img src="<?php echo $website_url  ?>/account/all-images/images/laptop.jpg" alt="">

                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label>
                                    <div class="question-option-div">
                                        <div class="option-container-div">
                                            <input type="radio" class="checkfield" name="option" />
                                            <div class="option-div">A</div>
                                            <div class="option-image-div">
                                                <img src="<?php echo $website_url  ?>/account/all-images/images/laptop.jpg" alt="">

                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div> -->


                    </div>

                </div>



                <div class="question-bottom-div">
                    <div class="mobile-cbt-num-btns-container">
                        <div class="mobile-question-num-div" id="mobileNumButtonContainerId">
                            <!-- <button class="num-btn" id="numBtnId">1</button> -->
                        </div>
                    </div>

                    <div class="div-in">
                        <button class="prev-btn" id="prevButton" title="Previous"><i class="bi bi-arrow-left"></i> Previous</button>
                        <div class="question-num-div" id="numButtonContainerId">
                            <!-- <button class="num-btn" id="numBtnId">1</button> -->
                        </div>
                        <button class="mobile-cbt-num-menu" id="numMenu" onclick="_toggleCbtQuestionNumbers('numMenu')"> <i class="bi bi-three-dots"></i></button>


                        <button class="prev-btn next-btn" id="nextBtn" title="Next">Next <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <br clear="all" />

        </div>
        <br clear="all" />
        <br clear="all" />
    </div>


<?php } ?>






<?php if ($page == 'cbt_statistics') { ?>
    <div class="content-side-div cbt-quiz-content-div animated fadeIn">
        <div class="div-in ">

            <div class="cbt-alert-container statistics-container-div">
                <div class="div-in statistics-div-in">
                    <div class="top-text-div">Classwork Statistics
                    </div>

                    <div id="fetch-all-cbt-statistics-details"></div>

                    <!-- <div class="quest-faq-div cbt-statistic-container" id="cbt-statistic-container-faq1">
                        <div class="faq-title-text">
                            <h3 class="item-no">ITEM 1 <button class="btn" type="button" id="" onclick="_getPageCbt('cbt_correction_quiz', '')"> View Correction</button></h3>
                            <div class="expand-div" id="faq1num" onclick="_collapseCbt('faq1')" title="Click to View Terms">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                        </div>

                        <div class="faq-answer-div cbt-statistic-div-in" id="faq1answer" style="display: none;">
                            <div class="statistics-count-div">
                                <div class="text-div">Total Number of Questions</div>
                                <div class="count-div" id="total_number_of_question">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Questions Attempted</div>
                                <div class="count-div" id="questions_attempted">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Questions Not Attempted</div>
                                <div class="count-div" id="questions_not_attempted">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Question Passed</div>
                                <div class="count-div" id="questions_passed">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Question Failed</div>
                                <div class="count-div" id="questions_failed">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Time Allowed</div>
                                <div class="count-div" id="time_allowed">00:00:00</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Time Taken</div>
                                <div class="count-div" id="time_taken">00:00:00</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Percentage</div>
                                <div class="count-div"><span id="percentage">0</span>%</div>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="quest-faq-div cbt-statistic-container" id="cbt-statistic-container-faq2">
                        <div class="faq-title-text">
                            <div class="cbt-statistic-title-div">
                                Subject: <div class="detail-div">BASIC SCIENCE</div>
                                Topic: <div class="detail-div">INTRODUCTION TO COMPUTING</div>
                            </div>
                            <div class="expand-div" id="faq2num" onclick="_collapseCbt('faq2')" title="Click to View Terms">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                        </div>

                        <div class="faq-answer-div cbt-statistic-div-in" id="faq2answer" style="display: none;">
                            <div class="statistics-count-div">
                                <div class="text-div">Total Number of Questions</div>
                                <div class="count-div">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Total Number Attempted</div>
                                <div class="count-div">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Total Number Passed</div>
                                <div class="count-div">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Total Number Failed</div>
                                <div class="count-div">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Questions Not Attempted</div>
                                <div class="count-div">0</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Time Taken</div>
                                <div class="count-div">00:05:00</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Time Allow</div>
                                <div class="count-div">00:05:00</div>
                            </div>
                            <div class="statistics-count-div">
                                <div class="text-div">Percentage</div>
                                <div class="count-div"><span>0</span>%</div>
                            </div>
                        </div>
                    </div> -->


                    <!-- <div class="chart-div">
                        <div id="chartContainer1" style="width:100%; height:300px; margin:20px auto 0px auto;"></div>

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
                    </div> -->
                </div>
            </div>
        </div>
    </div>



<?php } ?>









<?php if ($page == 'cbt_correction_quiz') { ?>

    <div class="cbt-header animated fadeIn" id="cbt-header-correction">
        <div class="cbt-header-in">

        <div class="cbt-header-grid" id="class">
                <div class="grid-in">
                    <span>Class:</span>
                    <div class="detail" id="cbt_tutorial_class">Xxxx Xxxx</div>
                </div>
            </div>

            <div class="cbt-header-grid" id="subject">
                <div class="grid-in">
                    <span>Subject:</span>
                    <div class="detail" id="cbt_tutorial_subject">Xxxx Xxxx</div>
                </div>
            </div>

            <div class="cbt-header-grid" id="term">
                <div class="grid-in">
                    <span>Term:</span>
                    <div class="detail" id="cbt_tutorial_term">Xxxx Xxxx</div>
                </div>
            </div>

            <div class="cbt-header-grid" id="week">
                <div class="grid-in">
                    <span>Week:</span>
                    <div class="detail" id="cbt_tutorial_week">Xxxx Xxxx</div>
                </div>
            </div>
            <div class="cbt-header-grid" id="topic">
                <div class="grid-in">
                    <span>Topic:</span>
                    <div class="detail" id="cbt_topic">Xxxx Xxxx</div>
                </div>
            </div>

        </div>
    </div>

    <div class="content-side-div cbt-quiz-content-div animated fadeIn">
        <div class="div-in">

            <div class="cbt-alert-container">
                <div class="alert" style="background-color: var(--white-color);">Hi <strong id="user_fullname"></strong>, Kindly note that color <strong style="color: rgba(46,204,113,.4);">GREEN</strong> is correct answer While color <strong style="color: rgba(231,107,46,.4);">ORANGE</strong> is wrong answer.</div>

                <div id="fetch-all-cbt-correction-details"></div>

                <div class="question-container-div animated fadeIn" id="question-container-div">

                    <div class="question-div" id="questionID"></div>
                    <div class="question-div-in">

                        <!-- Question with image or no image -->

                        <div class="question">
                            <div class="question-image-div" id="imageContainerId">
                                <!-- <img src="<?php //echo $website_url  
                                                ?>/account/all-images/images/laptop.jpg" alt=""> -->
                            </div>

                            <div class="text-container text-with-img" id="optionsContainerId">
                                <div class="text-div" id="questionTextId">
                                    <!-- _______ is a name of anything, animal place or thing  -->
                                </div>
                                <!-- <label>
                                <div class="question-option-div">
                                    <div class="option-container-div">
                                        <input type="radio" class="checkfield" name="option" />
                                        <div class="option-div">A</div>
                                        Noun
                                    </div>
                                </div>
                            </label> -->
                            </div>
                        </div>



                        <!-- option with image -->
                        <!-- <div class="question">
                        <div class="question-image-div" id="imageContainerId">
                            <img src="<?php //echo $website_url  
                                        ?>/account/all-images/images/laptop.jpg" alt="">
                        </div>

                        <div class="text-container text-with-img" id="optionsContainerId">
                            <div class="text-div" id="questionTextId">
                               Wich following is a car 
                            </div>
                            <label>
                                <div class="question-option-div">
                                    <div class="option-container-div">
                                        <input type="radio" class="checkfield" name="option" />
                                        <div class="option-div">A</div>
                                        <div class="option-image-div">
                                            <img src="<?php echo $website_url  ?>/account/all-images/images/laptop.jpg" alt="">

                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label>
                                <div class="question-option-div">
                                    <div class="option-container-div">
                                        <input type="radio" class="checkfield" name="option" />
                                        <div class="option-div">A</div>
                                        <div class="option-image-div">
                                            <img src="<?php echo $website_url  ?>/account/all-images/images/laptop.jpg" alt="">

                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div> -->


                    </div>

                </div>

                <div class="question-bottom-div">
                    <div class="mobile-cbt-num-btns-container">
                        <div class="mobile-question-num-div" id="mobileNumButtonContainerId">
                            <!-- <button class="num-btn" id="numBtnId">1</button> -->
                        </div>
                    </div>

                    <div class="div-in">
                        <button class="prev-btn" id="prevButton" title="Previous"><i class="bi bi-arrow-left"></i> Previous</button>
                        <div class="question-num-div" id="numButtonContainerId">
                            <!-- <button class="num-btn" id="numBtnId">1</button> -->
                        </div>
                        <button class="mobile-cbt-num-menu" id="numMenu" onclick="_toggleCbtQuestionNumbers('numMenu')"> <i class="bi bi-three-dots"></i></button>


                        <button class="prev-btn next-btn" id="nextBtn" title="Next">Next <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <br clear="all" />

        </div>
        <br clear="all" />
        <br clear="all" />
    </div>


<?php } ?>






<?php if ($page == 'app_settings') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="back_icon" style="display:none; cursor:pointer;"><i class="bi-arrow-left" style="cursor:pointer;" onclick="_prevPage('account_settings_id');"></i> &nbsp;&nbsp;</span>
                <span id="panel-title"><span id="header_icon"> <i class="bi-gear"></i> </span id="app_text"> APP SETTINGS</span>
                <div class="close" title="Close" onclick="_alertClose('');"><i class="bi-x"></i></div>
            </div>
        </div>

        <div class="container-back-div ">
            <div class="inner-div">
                <!-- <div class="setting_detail" id="account_settings_id">

                    <div class="settings-div" onclick="_nextPage('channge_password','back_icon','password');">
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

                </div> -->

                <!-- <div class="setting_detail" id="channge_password"> -->
                <div class="setting_detail" id="account_settings_id">
                    <div class="alert">Fill all fields to change your <span>PASSWORD</span> </div>
                    <div class="title"> OLD PASSWORD: <span>*</span></div>
                    <div class="password-container">
                        <input id="old_password" type="password" onkeyup="_showPasswordVisibility('old_password','toggle_old_pass')" class="text_field" placeholder="OLD PASSWORD" title="OLD PASSWORD" />
                        <div id="toggle_old_pass" onclick="_togglePasswordVisibility('old_password','toggle_old_pass')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>
                    <div class="pswd_info"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>

                    <div class="title"> NEW PASSWORD: <span>*</span></div>
                    <div class="password-container">
                        <input id="new_password" type="password" class="text_field" onkeyup="_showPasswordVisibility('new_password','toggle_new_pass')" placeholder="NEW PASSWORD" title="NEW PASSWORD" />
                        <div id="toggle_new_pass" onclick="_togglePasswordVisibility('new_password','toggle_new_pass')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>

                    <div class="title"> CONFIRMED PASSWORD: <span>*</span> <span id="message">Password Not Match!</span></div>
                    <div class="password-container">
                        <input id="comfirmed_password" type="password" onkeyup="_checkPasswordMatch('comfirmed_password','toggle_com_pass')" class="text_field" placeholder="CONFIRMED PASSWORD" title=" CONFIRMED PASSWORD" />
                        <div id="toggle_com_pass" onclick="_togglePasswordVisibility('comfirmed_password','toggle_com_pass')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>


                    <button class="action-btn" type="button" title="UPDATE" id="update_btn" onclick="_updatePassword();"> <i class="bi-check"></i> UPDATE PASSWORD </button>

                </div>

            </div>
        </div>
    </div>
<?php } ?>










<?php if ($page == 'transaction_form_details') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi bi-credit-card"></i> TRANSACTIONS</span>
                <div class="close" title="Close" onclick="_alertClose('');"><i class="bi-x"></i></div>
            </div>
        </div>

        <div class="container-back-div ">
            <div class="inner-div">

                <div id="View_transaction_details">
                    <div class="alert alert-success">
                        <span>TRANSACTION DETAILS</span>
                        <div class="trans-statistics">Transaction ID: <div class="value" id="transaction_id">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Email: <div class="value" id="trans_email">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Payment Purpose: <div class="value" id="transaction_purpose">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Payment Method: <div class="value" id="payment_method">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Wallet Balance Before: <div class="value" id="wallet_balance_before">₦0.00</div><br clear="all" /></div>
                        <div class="trans-statistics">Transaction Amount: <div class="value" id="transaction_amount">₦0.00</div><br clear="all" /></div>
                        <div class="trans-statistics">Wallet Balance After: <div class="value" id="wallet_balance_after">₦0.00</div><br clear="all" /></div>
                        <div class="trans-statistics">Transaction Status: <div class="value" id="transaction_status">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Date: <div class="value" id="date">Xxxx</div><br clear="all" /></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php } ?>





<?php if ($page == 'subcription_form_details') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="fly-title-div">
            <div class="in">
                <span id="panel-title"><i class="bi bi-credit-card"></i> SUBCRIPTION</span>
                <div class="close" title="Close" onclick="_alertClose('');"><i class="bi-x"></i></div>
            </div>
        </div>

        <div class="container-back-div ">
            <div class="inner-div">

                <div id="View_transaction_details">
                    <div class="alert alert-success">
                        <span>SUBCRIPTION DETAILS</span>
                        <div class="trans-statistics">Subscription ID: <div class="value" id="subscription_id">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Email: <div class="value" id="sub_email">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Department: <div class="value" id="department">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Class: <div class="value" id="class">Xxxx</div><br clear="all" /></div>
                        <div class="trans-statistics">Subscription Date: <div class="value" id="subcription_date">0000-00-00 00:00:00</div><br clear="all" /></div>
                        <div class="trans-statistics">Due Date: <div class="value" id="due_date">0000-00-00 00:00:00</div><br clear="all" /></div>
                        <div class="trans-statistics">Subscription Status: <div class="value" id="subcription_status">Xxxx</div><br clear="all" /></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php } ?>


<script type="text/javascript" src="../js/scrollBar.js"></script>
<script type="text/javascript">
    $(".").scrollBox();
</script>