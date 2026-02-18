
<?php if ($page=='dashboard'){?>
        <div class="statistics-back-div">
            <span id="adminstrator_link"></span>
            
            <div class="statistics-div bg4"  onClick="_get_page('all_subject', 'subject')" id="subject">
                <div class="inner-div">
                Subject <br>
                    <span class="number" id="total_active_subjects_count">0</span>
                </div>
            </div>
           
            <div class="statistics-div bg1"  onClick="_get_page('all_class', 'class')" id="class">
                <div class="inner-div">                    
                Classes <br>
                    <span class="number" id="total_active_classes_count">0</span>
                </div>
            </div>

            <div class="statistics-div bg1" onClick="_get_page('all_department', 'department')" id="department">
                <div class="inner-div">                    
                Classification <br>
                    <span class="number" id="total_active_departments_count">0</span>
                </div>
            </div>

            <div class="statistics-div bg3" onClick="_get_form('select_class_form', 'tutor')" id="tutor">
                <div class="inner-div">
                    Tutorial <br>
                    <span class="number" id="total_active_exam">0</span>
                </div>
            </div>

            <span id="agents_link"></span>

            <span id="users_link"></span>

            <div class="statistics-div round">
                <div class="inner-div text-centre">
                    View All Activities
                    <div class="icon-div">
                        <i class="bi-arrow-up-right"> </i>
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
<script>_get_dashboard_count();</script>
<script>_get_staff_login();</script>
<?php }?>


<?php if ($page=='system_alert'){ ?> 
    <div class="search-div">
        <!--------------------------------all search select------------------------->
        <input id="search_keywords" onkeyup="_fetch_alerts_by_keywords();" type="text" class="text_field full" placeholder="Type here to search..." title="Type here to search" />
    </div>

    <div class="chart-div-notifications">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Notification for</div> 
        <div class="text" onclick="select_search()">
            <span id="srch-text">Last 30 Days</span>&nbsp;<i class="bi-caret-down-fill"></i>
            <div class="srch-select">
            <div id="srch-today" onclick="get_alert_report('srch-today', 'view_today_search');">Today</div>
            <div id="srch-week" onclick="get_alert_report('srch-week', 'view_thisweek_search');">This Week</div>
            <div id="srch-7" onclick="get_alert_report('srch-7', 'view_7days_search');">Last 7 Days</div>
            <div id="srch-month" onclick="get_alert_report('srch-month', 'view_thismonth_search');">This Month</div>
            <div id="srch-30" onclick="get_alert_report('srch-30', 'view_30days_search');">Last 30 Days</div>
            <div id="srch-90" onclick="get_alert_report('srch-90', 'view_90days_search');">Last 90 Days</div>
            <div id="srch-year" onclick="get_alert_report('srch-year', 'view_thisyear_search');">This Year</div>
            <div id="srch-1year" onclick="get_alert_report('srch-1year', 'view_1year_search');">Last 1 Year</div>
            <div onclick="srch_custom('Custom Search')">Custom Search</div>
        </div>
        <br clear="all" />
    </div> 

    <div class="text">
        <div class="custom-srch-div">
            <input id="datepicker-from" type="date" class="srchtxt" placeholder="From" title="Select Date From" />
            <input id="datepicker-to" type="date" class="srchtxt" placeholder="To" title="Select Date To"/>
            <button type="button" class="btn" onclick="_get_custom_alert_report('','','custom_search')">Apply</button>
        </div>
    </div>

    <div class="system-alert-div"></div>
    </div>
   

    <div class="alert alert-success not-alert"> <span><i class="bi-bell"></i></span> Notification Between <span id="date_from">xxxx</span> - <span id="date_to">xxxx</span></div>

    <div class="alert-dashboard-div notf-alert-div animated ZoomIn">

        <div class="fetch-div animated fadeIn">			
            <div class="fetch" id="fetch_system_alert">
                <script> alert_bell();</script>
            </div>
        </div> 
        <!-- <div class="system-alert" id="<?php //echo $alert_id; ?>" onClick="_get_form_with_id('alert-read')">
            <div class="alert-name"><i class="bi-person"></i> Afolabi Taiwo <span id="<?php //echo $alert_id; ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: EMMANUEL SAMUEL profile was updated successfully...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div> -->
    </div>
    
    <div class="bottom-btn-div">
        <button id="fetch_previous_alerts" title="Older" class="btn" onclick="_fetch_previous_alerts()"><i class="bi-chevron-left"></i></button>
        <div><span id="view_from">0</span>-<span id="view_to">0</span> of <span id="all_record_count">0</span></div>
        <button id="fetch_next_alerts" title="Newer" class="btn" onclick="_fetch_next_alerts()"><i class="bi-chevron-right"></i></button>
    </div>



    <br clear="all"/>
<?php }?>
 

<?php if ($page=='view_staff'){?>
    <div class="search-div">
        <!--------------------------------network search select------------------------->
        <select id="status_id" class="text_field select" onchange="_get_fetch_all_staff();">
            <option value=""> SELECT STATUS</option>
            <script>_get_select_status('status_id','1,2');</script>
        </select>
        <!--------------------------------all search select------------------------->
        <input id="search_keywords" onkeyup="_get_fetch_all_staff();" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
    </div>
    
    <div class="alert alert-success"> <span><i class="bi-people-fill"></i></span> ADMINISTRATOR'S LIST <button class="btn" onClick="_get_form('staff_reg')"><i class="bi-plus-square"></i> CREATE A NEW ADMIN</button></div>
       
        <div class="fetch-div animated fadeIn">			
            <div class="fetch" id="fetch">
                <script> _get_fetch_all_staff();</script>
            </div>
        </div> 
        <br clear="all" />

     <script>
        superplaceholder({el: search_keywords,
            sentences: ['Type here to search...', 'Staff ID e.g STF000765976964','Mobile number e.g 09021947874','E-mail e.g afootechglobal@gmail.com'],
            options: {
            letterDelay: 80,
            loop: true,
            startOnFocus: false
        }
    });
    </script>

<?php } ?>


<?php if ($page=='all_subject'){ ?>
    <div class="search-div">
        <!--------------------------------network search select------------------------->
        <select id="status_id"  class="text_field select" onchange="_get_fetch_all_subject('fetch_all_subjects')">
            <option value="">ALL SUBJECT STATUS</option>  
            <script>_get_select_status('status_id','1,2');</script>  
        </select>
        <!--------------------------------all search select------------------------->
        <input id="search_keywords" onkeyup="_get_fetch_all_subject('fetch_all_subjects');" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
    </div>
        <div class="alert alert-success"> <span><i class="bi-book"></i></span> SUBJECT'S LIST <button class="btn" onClick="_get_form('add_and_update_subject')"><i class="bi-plus-square"></i> ADD NEW SUBJECT</button></div>
        
        <div class="fetch-div animated fadeIn">			
            <div class="fetch" id="fetch_all_subjects">
                <script> _get_fetch_all_subject('fetch_all_subjects');</script>
            </div>
        </div> 
        <br clear="all" />

     <script>
        superplaceholder({el: search_keywords,
            sentences: ['Type here to search...', 'Subject ID e.g SUB00000','Subject Name e.g Maths, English, Physics'],
            options: {
            letterDelay: 80,
            loop: true,
            startOnFocus: false
        }
    });
    </script>
<?php } ?>


<?php if ($page=='all_class'){ ?>
    <div class="search-div">
        <!--------------------------------network search select------------------------->
        <select id="status_id"  class="text_field select" onchange="_get_fetch_all_classes('fetch_classes');">
            <option value="">ALL CLASS STATUS</option>  
            <script>_get_select_status('status_id','1,2');</script>  
        </select>
        <!--------------------------------all search select------------------------->
        <input id="search_keywords" onkeyup="_get_fetch_all_classes('fetch_classes');" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
    </div>
        <div class="alert alert-success"> <span><i class="bi-book"></i></span> CLASSES LIST <button class="btn" onClick="_get_form('add_classes')"><i class="bi-plus-square"></i> ADD NEW CLASS</button></div>
        
        <div class="fetch-div animated fadeIn">			
            <div class="fetch" id="fetch_classes">
                <script> _get_fetch_all_classes('fetch_classes');</script>
            </div>
        </div> 
        <br clear="all" />

     <script>
        superplaceholder({el: search_keywords,
            sentences: ['Type here to search...', 'Class ID e.g CLS00000','Class Name e.g Basic-one, Basic-two, Basic-three'],
            options: {
            letterDelay: 80,
            loop: true,
            startOnFocus: false
        }
    });
    </script>
<?php } ?>


<?php if ($page=='all_department'){?>
    <div class="search-div">
        <!--------------------------------network search select------------------------->
        <select id="status_id" class="text_field select" onchange=" _get_fetch_all_department();">
            <option value=""> All CLASSIFICATION STATUS</option>
            <script>_get_select_status('status_id','1,2');</script>
        </select>
        <!--------------------------------all search select------------------------->
        <input id="search_keywords" onkeyup=" _get_fetch_all_department();" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
    </div>
    
    <div class="alert alert-success"> <span><i class="bi-easel"></i></span> CLASSIFICATION'S LIST <button class="btn" onClick="_get_form('dept_reg')"><i class="bi-plus-square"></i> CREATE A NEW CLASSIFICATION</button></div>
       
        <div class="fetch-div animated fadeIn">	 
            <div class="fetch" id="fetch_all_department">
                <script> _get_fetch_all_department();</script>
            </div>
        </div> 
        <!-- <div class="record-content-div">
            <div class="div-in">
                <div class="image-div">
                    <img src="<?php //echo $website_url?>/uploaded_files/exam_pix/ssce.png" alt="topics"/>
                </div>

                <div class="text-div">
                    <h2>WAEC</h2>
                    <p>(WAEC) is an examination board established by law to determine the examinations required in West African countries.</p>
                    <div class="count-div">
                        <div class="count-in"><i class="bi-book"></i> TOPICS: <span id="">100</span> &nbsp;|&nbsp; <i class="bi-book"></i> SUB-TOPICS: <span id="">100</span> &nbsp;|&nbsp; <i class="bi-book"></i> STATUS: <span class="ACTIVE" id="" >ACTIVE</span></div>
                        <button class="btn" title="EDIT"><i class="bi-pencil-square"></i> EDIT</button>
                        <button class="btn btn2" title="EDIT" onClick="_get_page('subject', 'exam')"><i class="bi-pencil-square"></i> VIEW SUBJECT</button>
                    </div>
                </div>
            </div> 
        </div> -->
   
     <script>
        superplaceholder({el: search_keywords,
            sentences: ['Type here to search...', 'Department ID e.g DPT000765976964','Department Name e.g Basic, Junior, Senior'],
            options: {
            letterDelay: 80,
            loop: true,
            startOnFocus: false
        }
    });
    </script>

<?php } ?>


<?php if ($page=='all_class_dept'){?>
    <div class="alert alert-success"> <span><i class="bi-book"></i></span> <span onClick="_get_page('all_department');" title="click to back">DEPARTMENT / </span> <span id="dpt1_name">xxx</span> / CLASS LIST <button class="btn" onClick="_get_form_with_id('add_class_dept','<?php echo $ids?>')"><i class="bi-plus-square"></i> ADD A NEW CLASS</button></div>
       
        <div class="fetch-div animated fadeIn">	 
            <div class="fetch" id="fetch_all_class_dept">
                <script> _get_fetch_all_class_dept('<?php echo $ids?>');</script>
            </div>
        </div> 
        <!-- <div class="record-content-div">
            <div class="div-in">
                <div class="image-div">
                    <img src="<?php //echo $website_url?>/uploaded_files/exam_pix/ssce.png" alt="topics"/>
                </div>

                <div class="text-div">
                    <h2>WAEC</h2>
                    <p>(WAEC) is an examination board established by law to determine the examinations required in West African countries.</p>
                    <div class="count-div">
                        <div class="count-in"><i class="bi-book"></i> TOPICS: <span id="">100</span> &nbsp;|&nbsp; <i class="bi-book"></i> SUB-TOPICS: <span id="">100</span> &nbsp;|&nbsp; <i class="bi-book"></i> STATUS: <span class="ACTIVE" id="" >ACTIVE</span></div>
                        <button class="btn" title="EDIT"><i class="bi-pencil-square"></i> EDIT</button>
                        <button class="btn btn2" title="EDIT" onClick="_get_page('subject', 'exam')"><i class="bi-pencil-square"></i> VIEW SUBJECT</button>
                    </div>
                </div>
            </div> 
        </div> -->
<?php } ?>


<?php if ($page=='all_subj_class'){?>
    <div class="alert alert-success"> <span><i class="bi-book"></i></span> DEPARTMENT / <span id="sub_department_name" onClick="_get_page_with_id('all_class_dept','<?php echo $department_id?>');" title="click to back">xxxx</span> / <span id="sub_class_name">xxxx</span> / SUBJECT LIST <button class="btn" onClick="_get_subject_form_with_id('add_subject_class','<?php echo $department_id?>','<?php echo $class_id?>')"><i class="bi-plus-square"></i> ADD A NEW SUBJECT</button></div>
       
        <div class="fetch-div animated fadeIn">	 
            <div class="fetch" id="fetch_all_class_subject">
                <script> _get_fetch_all_class_subject('<?php echo $department_id?>','<?php echo $class_id?>');</script>
            </div>
        </div> 
        <!-- <div class="record-content-div">
            <div class="div-in">
                <div class="image-div">
                    <img src="<?php //echo $website_url?>/uploaded_files/exam_pix/ssce.png" alt="topics"/>
                </div>

                <div class="text-div">
                    <h2>WAEC</h2>
                    <p>(WAEC) is an examination board established by law to determine the examinations required in West African countries.</p>
                    <div class="count-div">
                        <div class="count-in"><i class="bi-book"></i> TOPICS: <span id="">100</span> &nbsp;|&nbsp; <i class="bi-book"></i> SUB-TOPICS: <span id="">100</span> &nbsp;|&nbsp; <i class="bi-book"></i> STATUS: <span class="ACTIVE" id="" >ACTIVE</span></div>
                        <button class="btn" title="EDIT"><i class="bi-pencil-square"></i> EDIT</button>
                        <button class="btn btn2" title="EDIT" onClick="_get_page('subject', 'exam')"><i class="bi-pencil-square"></i> VIEW SUBJECT</button>
                    </div>
                </div>
            </div> 
        </div> -->
<?php } ?>


<?php if ($page=='tutorial'){ ?>
    <div class="alert alert-success"> <span><i class="bi-pencil-square"></i></span> <span>TUTORIAL</span> / <span id="tut_department_name">xxxx</span> / <span id="tut_class_name">xxxx</span></div>

        <div class="faq-back-div">

            <div class="fetch" id="fetch_department_class_subject">
                <script> _get_fetch_department_class_subject('<?php echo $department_id?>','<?php echo $class_id?>');</script>
            </div>

            <!-- <div class="quest-faq-div">
                <div class="faq-title-text">
                    <h3>MATHEMATICS  <button class="btn-2" title="ADD NEW VIDEO" onClick="_get_form_with_id('video_reg');"><i class="bi-plus-square"></i> ADD NEW VIDEO</button> </h3>
                    <div class="expand-div" id="faq1num" onclick="_collapse('faq1')" title="Click to View Terms">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
                </div>
            
                <div class="faq-answer-div" id="faq1answer" style="display: none;">  
                    <button class="btn" title="FIRST TERM" onClick="_get_form_with_id('select_class_form')"><i class="bi-pencil-square"></i> FIRST TERM &nbsp; <span>5</span>&nbsp;<i class="bi-play-btn-fill"></i></button>
                    <button class="btn" title="SECOND TERM" onClick="_get_form_with_id('select_class_form')"><i class="bi-pencil-square"></i> SECOND TERM &nbsp; <span>5</span>&nbsp;<i class="bi-play-btn-fill"></i></button>
                    <button class="btn" title="THIRD TERM" onClick="_get_form_with_id('select_class_form')"><i class="bi-pencil-square"></i> THIRD TERM &nbsp;  <span>5</span>&nbsp;<i class="bi-play-btn-fill"></i></button>
                </div>
            </div> -->
        </div>
<?php } ?>


<?php if ($page=='video_page'){ ?>
    <div class="alert alert-success"> <i class="bi-book"></i></span> TUTORIAL / <span id="tutorial_department_name">xxxx</span> / <span id="tutorial_class_name">xxxx</span> / <span id="tutorial_subject_name">xxxx</span> /  <span id="tutorial_term_name">xxxx</span> / VIDEO'S LIST</div>
    <div class="faq-back-div">
        <div class="fetch" id="fetch_tutorial_video_page">
            <script> _fetch_tutorial_video_page('<?php echo $department_id?>','<?php echo $class_id?>','<?php echo $subject_id?>','<?php echo $term_id?>');</script>
        </div>
        <!-- <div class="quest-faq-div">
            <div class="faq-title-text v-faq-text" onclick="_collapse('faq1')">
                <h3>WEEK 1 </h3>
                <div class="expand-div" id="faq1num">&nbsp;<i class="bi-plus"></i>&nbsp;</div> 
            </div>
            <div class="faq-answer-div">
                <span>Status: &nbsp;<span class="status-div">ACTIVE</span></span>&nbsp; &nbsp; 
                <span>Videos: &nbsp;<span class="count-div">10</span></span>                         
            </div>

            <div class="faq-answer-div" id="faq1answer" style="display: none;">  
                <div class="topics-content-div">
                    <div class="image-div"><img src="<?php //echo $website_url?>/admin/a/all-images/body-pix/lcm.jpg" alt="'"/>
                    </div>

                    <div class="text">
                        <h4>LCM</h4>
                        <p>Unlock the power of least common multiple (LCM) in mathematics with our comprehensive guide. Learn how to find the smallest common multiple of two or more numbers effortlessly.</p>
                        <hr></hr>
                        <div class="bottom-div">
                            <button class="btn edit" title="EDIT SUB-TOPIC" onClick="_get_form_with_id();"><i class="bi-pencil-square"></i> EDIT</button>
                            <button class="btn" title="VIEW VIDEOS" onClick="_get_page_with_id();"> <span class="count">0</span> CBT </button>
                        </div>
                    </div>
                    
                </div>

                <div class="topics-content-div">
                    <div class="image-div"><img src="<?php //echo $website_url?>/admin/a/all-images/body-pix/lcm.jpg" alt="'"/>
                    </div>

                    <div class="text">
                        <h4>HCM</h4>
                        <p>Unlock the power of least common multiple (LCM) in mathematics with our comprehensive guide. Learn how to find the smallest common multiple of two or more numbers effortlessly.</p>
                        <hr></hr>
                        <div class="bottom-div">
                            <button class="btn edit" title="EDIT SUB-TOPIC" onClick="_get_form_with_id();"><i class="bi-pencil-square"></i> EDIT</button>
                            <button class="btn" title="VIEW VIDEOS" onClick="_get_page_with_id();"> <span class="count">0</span> CBT </button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> -->
    </div>
<?php } ?>

<?php if ($page=='active_agents'){ ?>
    <div class="search-div">
        <!--------------------------------network search select------------------------->
        <select id="status_id"  class="text_field select" onchange="_get_fetch_all_agent();">
            <option value="">ALL AGENT STATUS</option>
            <script>_get_select_status('status_id','1,2');</script>
        </select>
        <!--------------------------------all search select------------------------->
        <input id="search_keywords" onkeyup="_get_fetch_all_agent();" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
    </div>

    <div class="alert alert-success"> <span><i class="bi-people-fill"></i></span> AGENT'S LIST <button class="btn" onClick="_get_form('agent_reg')"><i class="bi-plus-square"></i> ADD A NEW AGENT</button></div>
        
    <div class="agent-content-div">
        <div class="dashboard-content">
            <div class="list" id="fetch_all_agent">
                <script>_get_fetch_all_agent();</script>

                <!-- <div class="student-profile">
                    <div class="details">
                        <div class="pix"><img src="<?php //echo $website_url?>/admin/a/all-images/images/MTN-Logo.PNG" alt="Profile Picture"/></div>
                        <div class="text">
                            <h3>MTN NG</h3>
                            <div class="info">
                                <div>
                                    <p>Email: <span>customercare.ng@mtn.com</span></p>
                                    <p>Phone: <span>08060881905</span></p>
                                </div>                               
                                <button class="status-btn active">ACTIVE</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn" onClick="_get_form_with_id('agent_profile')">VIEW DETAILS</button>
                </div> -->  
            </div>
        </div>
    </div>

    <script>
        superplaceholder({el: search_keywords,
            sentences: ['Type here to search...', 'COMPANY ID e.g COM000765976964','Mobile number e.g 09021947874','E-mail e.g afootechglobal@gmail.com'],
            options: {
            letterDelay: 80,
            loop: true,
            startOnFocus: false
        }
        });
    </script>
<?php } ?>


<?php if ($page=='active_users'){ ?>
    <div class="search-div">
        <!--------------------------------network search select------------------------->
        <select id="status_id"  class="text_field select" onchange="_get_fetch_all_user()">
            <option value="">ALL USER STATUS</option>
            <script>_get_select_status('status_id','1,2');</script>
        </select>
        <!--------------------------------all search select------------------------->
        <input id="search_txt" onkeyup="_get_fetch_all_user();" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
    </div>

    <div class="alert alert-success"> <span><i class="bi-people-fill"></i></span> USER'S LIST</div>
        
        <div class="fetch-div animated fadeIn">			
            <div class="user-div animated fadeIn" title="Click to view User Profile" onclick="_get_form_with_id('user_details')">
                <div class="pix-div"><img src="<?php echo $website_url?>/admin/a/all-images/images/avatar.jpg" alt="Profile Image"></div>
                <div class="detail">
                    <div class="name-div"><div class="name">Paul Emmanuel</div><hr /><br/></div>
                    <div class="text">ID: <span>USER1023049</span></div>
                    <div class="text"><span>08060881905</span></div>
                    <div class="status-div ' + status_name + '">ACTIVE</div>
                </div>
            </div>
        </div> 
        <br clear="all" />
        
     <script>
        superplaceholder({el: search_txt,
            sentences: ['Type here to search...', 'User ID e.g STF000765976964','Mobile number e.g 09021947874','E-mail e.g afootechglobal@gmail.com'],
            options: {
            letterDelay: 80,
            loop: true,
            startOnFocus: false
        }
    });
    </script>
<?php } ?>


<?php if ($page=='faqs'){ ?>
    <div class="search-div">
        <!--------------------------------network search select------------------------->
        <select id="status_id"  class="text_field select" onchange="">
            <option value="" selected="selected">ALL FAQ STATUS</option>   
            <script>_get_select_status('status_id','1,2');</script>
        </select>
        <!--------------------------------all search select------------------------->
        <input id="search_txt" onkeyup="" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
    </div>

    <div class="alert alert-success"> <span><i class="bi-newspaper"></i></span> FAQ's LIST <button class="btn" onClick="_get_form('faqs_reg')"><i class="bi-plus-square"></i> ADD NEW FAQ</button></div>
                    
        <div class="main-faq-back-div">        
            <div class="main-faq-div">
                <div class="main-faq-title-back-div">
                    <div class="main-faqs-title-div">
                        <span>1</span>
                    </div>

                    <div class="main-faq-title" onclick="_collapse('faq244')" style="cursor:pointer;">
                        <span><i class="bi-pencil-square"></i> Who we are</span>
                        <div class="expand-div" id="faq244num">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                    </div>
                </div>
               
                <div class="faq-answer-div faq-answer-div2" id="faq244answer" style="display: none;">  
                    <p>Euclidean geometry is a study of geometric properties and relationships in two and three-dimensional space.</p>
                    <p>Euclidean geometry is a study of geometric properties and relationships in two and three-dimensional space.</p>
                </div>                           
            </div> 

            <div class="main-faq-div">
                <div class="main-faq-title-back-div">
                    <div class="main-faqs-title-div">
                        <span>2</span>
                    </div>

                    <div class="main-faq-title" onclick="_collapse('faq245')" style="cursor:pointer;">
                        <span><i class="bi-pencil-square"></i> Who we are</span>
                        <div class="expand-div" id="faq245num">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                    </div>
                </div>
               
                <div class="faq-answer-div faq-answer-div2" id="faq245answer" style="display: none;">  
                    <p>Euclidean geometry is a study of geometric properties and relationships in two and three-dimensional space.</p>
                    <p>Euclidean geometry is a study of geometric properties and relationships in two and three-dimensional space.</p>
                </div>                           
            </div> 

            <div class="main-faq-div">
                <div class="main-faq-title-back-div">
                    <div class="main-faqs-title-div">
                        <span>3</span>
                    </div>

                    <div class="main-faq-title" onclick="_collapse('faq246')" style="cursor:pointer;">
                        <span><i class="bi-pencil-square"></i> Who we are</span>
                        <div class="expand-div" id="faq246num">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                    </div>
                </div>
               
                <div class="faq-answer-div faq-answer-div2" id="faq246answer" style="display: none;">  
                    <p>Euclidean geometry is a study of geometric properties and relationships in two and three-dimensional space.</p>
                    <p>Euclidean geometry is a study of geometric properties and relationships in two and three-dimensional space.</p>
                </div>                           
            </div> 
        </div>
     <script>
        superplaceholder({el: search_txt,
            sentences: ['Type here to search...', 'Top ID e.g TOP00000','Top Name e.g Statistic, Geometry'],
            options: {
            letterDelay: 80,
            loop: true,
            startOnFocus: false
        }
    });
    </script>   
<?php } ?>


<?php if ($page=='blogs'){ ?>
    <div class="search-div">
        <!--------------------------------network search select------------------------->
        <select id="status_id"  class="text_field select" onchange="">
            <option value="" selected="selected">ALL BLOG STATUS</option>   
            <script>_get_select_status('status_id','1,2');</script>
        </select>
        <!--------------------------------all search select------------------------->
        <input id="search_txt" onkeyup="" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
    </div>
    <div class="alert alert-success"> <span><i class="bi-newspaper"></i></span> BLOG's LIST <button class="btn" onClick="_get_form('blog_form')"><i class="bi-plus-square"></i> ADD NEW BLOG</button></div>
                    
        <div class="blog-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="_get_form_with_id('update_blog_form')">EDIT</button>
                <button class="btn" onclick="_get_form_with_id('blog_seo_page_details')">EDIT PAGE DETAILS</button>
                <br clear="all">
            </div>

            <div class="status-div">ACTIVATED</div>
            <div class="img-div"><img src="<?php echo $website_url?>/admin/a/all-images/body-pix/blog1.jpg" alt="Blog Name"></div>
            <div class="text-div">
                <div class="text-in">
                    <div class="text"><span>ANOUNCEMENT</span> </div>
                </div>
                <h2>7 Excellent Tips To Pass Waec In One Sitting</h2>
                <div class="text-in">
                    <div class="text">UPDATED ON: <span>24 Feb 2024</span> </div>
                    <div class="text"><span>0</span> VIEWS</div>
                </div>
                <br>
            </div>
        </div>


        <div class="blog-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="_get_form_with_id('update_blog_form');">EDIT</button>
                <button class="btn" onclick="_get_form_with_id('blog_seo_page_details')">EDIT PAGE DETAILS</button>
                <br clear="all">
            </div>

            <div class="status-div">ACTIVATED</div>
            <div class="img-div"><img src="<?php echo $website_url?>/admin/a/all-images/body-pix/blog1.jpg" alt="Blog Name"></div>
            <div class="text-div">
                <div class="text-in">
                    <div class="text"><span>ANOUNCEMENT</span> </div>
                </div>
                <h2>7 Excellent Tips To Pass Waec In One Sitting</h2>
                <div class="text-in">
                    <div class="text">UPDATED ON: <span>24 Feb 2024</span> </div>
                    <div class="text"><span>0</span> VIEWS</div>
                </div>
                <br>
            </div>
        </div>


        <div class="blog-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="_get_form_with_id('update_blog_form')">EDIT</button>
                <button class="btn" onclick="_get_form_with_id('blog_seo_page_details')">EDIT PAGE DETAILS</button>
                <br clear="all">
            </div>

            <div class="status-div">ACTIVATED</div>
            <div class="img-div"><img src="<?php echo $website_url?>/admin/a/all-images/body-pix/blog1.jpg" alt="Blog Name"></div>
            <div class="text-div">
                <div class="text-in">
                    <div class="text"><span>ANOUNCEMENT</span> </div>
                </div>
                <h2>7 Excellent Tips To Pass Waec In One Sitting</h2>
                <div class="text-in">
                    <div class="text">UPDATED ON: <span>24 Feb 2024</span> </div>
                    <div class="text"><span>0</span> VIEWS</div>
                </div>
                <br>
            </div>
        </div>
     <script>
        superplaceholder({el: search_txt,
            sentences: ['Type here to search...', 'Top ID e.g TOP00000','Top Name e.g Statistic, Geometry'],
            options: {
            letterDelay: 80,
            loop: true,
            startOnFocus: false
        }
    });
    </script>
<?php } ?>













































































