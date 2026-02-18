
<?php if ($page=='agent_profile'){?>
    <div class="agent-profile-div animated fadeIn">
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
                            <div class="img-div"><img src="all-images/body-pix/afootech.jpg" id="agent_logo" alt="Agent Profile"/></div> 
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
                            <div class="left">
                                <h3><i class="bi-credit-card"></i> COMMISSION WALLET</h3>
                                <div class="text-div">
                                    <div class="amount" id="wallet_balance">xxxx</div>
                                    <div class="txt">TOTAL AMOUNT RECEIVED</div>
                                </div>
                            </div>

                            <!-- <div class="right">
                                <button class="btn" title="Wallet Withdrawal" onclick="">Wallet Withdrawal</button>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="agent-btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Dashboard" id="dashboard_details" onclick="_get_agent_page_contents('dashboard_details','<?php echo $ids?>');">Dashboard</li>
                        <span id="adminstrator_link"></span>
                        <li class="referees" title="Referees" id="referees_details" onclick="_get_agent_page_contents('referees_details','<?php echo $ids?>');">Referees</li>
                        <li class="transaction">Transaction History</li>
                        <li id="dotted"><i class="bi-three-dots-vertical"></i>
                            <div class="expand-div">
                                <div class="expnad-div-in">
                                    <ul class="ul-expand">
                                        <li onclick="_get_agent_page_contents('referees_details','<?php echo $ids?>');"><i class="bi-people-fill"></i>Referees</li>
                                        <li><i class="bi-credit-card"></i>Transaction History</li>
                                    </ul>
                                </div>
                            </div>
                        </li>
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
    <script>_fetchEachCompanyInfo('<?php echo $ids?>');</script>
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
    <script>_fetchEachCompanyInfo('<?php echo $ids?>');</script>
<?php } ?>

<?php if ($page=='contact_person_details'){?>
    <div class="company-back-div-in">     
        <div class="dashboard-content">
            <div class="btn-div">
                <div class="alert alert-success agent-alert"> <span><i class="bi-people-fill"></i> COMPANY CONTACT PERSONS </span><button class="btn" title="Add New Staff" onclick="_get_secondary_form_with_id('contact_person_reg_form','<?php echo $ids?>');"><i class="bi-pencil-square"></i> ADD NEW STAFF</button></div>
            </div>

            <div class="list" id="fetch_all_contact_person">  
                <script>_fetchAllContactPerson('<?php echo $ids?>');</script>           
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

<?php if ($page=='referees_details'){?>
    <div class="company-back-div-in">     
        <div class="dashboard-content refrees-dashboard-content">
           <div class="top-back-div">
                <div class="alert alert-success refrees-alert"> <span><i class="bi-people-fill"></i> COMPANY REFEREES LIST </span></div>
                <div class="search-div">
                    <!--------------------------------network search select------------------------->
                    <select id="status_id" class="text_field select" onchange="">
                        <option value=""> SELECT STATUS</option>
                    </select>
                    <!--------------------------------all search select------------------------->
                    <input id="search_keywords" onkeyup="" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
                </div>
            </div>
            
            <div class="table-div animated fadeIn">
                <div class="div-in">
                    <table class="table" cellspacing="0" style="width:100%">
                        <tr class="tb-col">
                            <td>SN</td>
                            <td>NAME</td>
                            <td>EMAIL</td>   
                            <td>DEPARTMENT</td>
                            <td>CLASS</td>
                            <td>STATUS</td>                       
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Ikong Paul Emmanuel</td>
                            <td>paulmmanuel107@gmail.com</td>
                            <td>Basic School</td>
                            <td>Basic 1</td>
                            <td><div class="status-div ACTIVES">ACTIVE</div></td>                          
                        </tr> 

                        <tr>
                            <td>2</td>
                            <td>Yakubu Ezekiel</td>
                            <td>yakubu100@gmail.com</td>
                            <td>Junior School</td>
                            <td>JSS 1</td>
                            <td><div class="status-div ACTIVES">ACTIVE</div></td>                          
                        </tr> 

                        <tr>
                            <td>3</td>
                            <td>Godwin Elizabeth</td>
                            <td>elizabeth207@gmail.com</td>
                            <td>Senior School</td>
                            <td>SSS 1</td>
                            <td><div class="status-div SUSPEND">SUSPEND</div></td>                          
                        </tr> 

                        <tr>
                            <td>4</td>
                            <td>Paul Emmanuel</td>
                            <td>seunemmanuel107@gmail.com</td>
                            <td>elizabeth207@gmail.com</td>
                            <td>Senior School</td>
                            <td><div class="status-div ACTIVES">ACTIVE</div></td>                          
                        </tr> 
                    </table>
                    <div class="bottom-btn-div">
                        <button id="fetch_previous_alerts" title="Older" class="btn" onclick="_fetch_previous_alerts()"><i class="bi-chevron-left"></i></button>
                        <div><span id="view_from">0</span>-<span id="view_to">0</span> of <span id="all_record_count">0</span></div>
                        <button id="fetch_next_alerts" title="Newer" class="btn" onclick="_fetch_next_alerts()"><i class="bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
         </div>   
    </div> 
<?php } ?>

<?php if ($page=='update_agent_form'){ ?>
    <div class="slide-form-div agent-upt-slide-form animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE AN AGENT</span>
                <div class="close" title="Close" onclick="_alert_secondary_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div class="alert">Kindly fill the form below to <span>UPDATE AN AGENT</span></div>

                <div class="alert alert-success">
                    <div class="alert-title">COMPANY DETAILS</div>   
                    
                    <div class="alert-list-back-div">
                        <div class="alert-list-div">
                            <div>COMPANY NAME:</div>
                            <div class="input-div" id="cont_company_name">xxxx</div>
                        </div>
                        <div class="alert-list-div">
                            <div>COMPANY ADDRESS:</div>
                            <div class="input-div" id="cont_company_address">xxxx</div>
                        </div>
                        <div class="alert-list-div">
                            <div>COMPANY MOBILE:</div>
                            <div class="input-div" id="cont_company_phone">xxxx</div>
                        </div>
                        <div class="alert-list-div">
                            <div>COMPANY EMAIL:</div>
                            <div class="input-div" id="cont_company_email">xxxx</div>
                        </div>

                        <div class="alert-list-div">
                            <div>COMPANY STATUS:</div>
                            <div class="input-div" id="cont_status_name"></div>
                        </div>
                    </div>                 
                </div>    
                
                <div class="alert alert-success">
                    <div class="alert-title">UPDATE COMPANY DETAILS</div>   
                    <div class="text_field_container">
                        <input class="text_field" type="text" id="company_referral_code" placeholder=""/>
                        <div class="placeholder">Company Referral Code:</div>
                    </div>

                    <div class="title">COMPANY LOGO: <i>(JPG, PNG FORMAT ONLY)</i><span>*</span></div>
                    <div class="pix-div">
                        <label>
                           <img id="agent_pix" src="all-images/images/sample.jpg" alt="Default Image">
                            <input type="file" id="company_logo" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="agent_pix_preview.UpdatePreview(this);" />
                        </label>
                    </div> 
                </div>
                <button class="btn" type="button" title="SUBMIT" id="submit_btn" onclick="_updateAgent('<?php echo $ids?>');"> <i class="bi-check"></i> UPDATE PROFILE </button>             
            </div>
        </div>  
    </div>
    <script>_fetchEachCompanyInfo('<?php echo $ids?>');</script>
<?php } ?>

<?php if ($page=='update_agent_pending_form'){ ?>
    <div class="slide-form-div agent-upt-slide-form animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE AN AGENT</span>
                <div class="close" title="Close" onclick="_alert_secondary_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div class="alert">Kindly fill the form below to <span>UPDATE AN AGENT</span></div>

                <div class="alert alert-success">
                    <div class="alert-title">COMPANY DETAILS</div>   
                    <div class="text_field_container">
                        <input class="text_field" type="text" id="company_name" placeholder=""/>
                        <div class="placeholder">Company Name:</div>
                    </div>

                    <div class="text_field_container">
                        <input class="text_field" type="text" id="company_address" placeholder=""/>
                        <div class="placeholder">Company Address:</div>
                    </div>

                    <div class="text_field_container">
                        <input class="text_field" type="text" id="company_phone" placeholder=""/>
                        <div class="placeholder">Company Mobile:</div>
                    </div>

                    <div class="text_field_container">
                        <input class="text_field" type="text" id="company_email" placeholder=""/>
                        <div class="placeholder">Company Email:</div>
                    </div>

                    <div class="alert-list-back-div">
                        <div class="alert-list-div">       
                            <div>COMPANY REFERRAL CODE</div>
                            <div class="input-div" id="cont_company_referral_code">xxxx</div>                          
                        </div> 
                    </div>

                    <div class="alert-list-back-div">
                        <div class="alert-list-div">       
                            <div>COMPANY STATUS</div>
                            <div class="input-div" id="company_status_id">xxxx</div>                          
                        </div> 
                    </div> 

                    <div class="title">COMPANY LOGO: <i>(JPG, PNG FORMAT ONLY)</i><span>*</span></div>
                    <div class="pix-div">
                        <label>
                           <img id="agent_pix" src="all-images/images/sample.jpg" alt="Default Image">
                            <input type="file" id="company_logo" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="agent_pix_preview.UpdatePreview(this);" />
                        </label>
                    </div> 
    
                    <button class="btn" type="button" title="SUBMIT" id="update_btn" onclick="_updatePendingAgent('<?php echo $ids?>');"> <i class="bi-check"></i> UPDATE PROFILE </button>             
                    <br clear="all"/>  
                    <br clear="all"/>  
                </div>              
            </div>
        </div>  
    </div>
    <script>_fetchEachCompanyInfo('<?php echo $ids?>');</script>
<?php } ?>

<?php if ($page=='contact_person_reg_form'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW STAFF</span>
                <div class="close" title="Close" onclick="_alert_secondary_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div class="alert">Kindly fill the form below to <span>ADD A NEW STAFF</span></div>

                <div class="alert alert-success">
                    <div class="alert-title">CONTACT PERSON</div>
                    <div class="text_field_container">
                        <input class="text_field" type="text" id="contact_name" placeholder=""/>
                        <div class="placeholder">Full Name:</div>
                    </div>
                    
                    <div class="text_field_container">
                        <input class="text_field" type="text" id="contact_email" placeholder=""/>
                        <div class="placeholder">Email Address:</div>
                    </div>

                    <div class="text_field_container">
                        <input class="text_field" type="tel" id="contact_phone" placeholder=""/>
                        <div class="placeholder">Phone Number:</div>
                    </div>

                    <div class="text_field_container">
                        <select id="contact_role_id" class="text_field" placeholder="">
                            <option value="">-Select here</option>
                            <script>_getSelectRole('contact_role_id');</script>
                        </select>
                        <div class="placeholder">--Select Role--</div>
                    </div>

                    <div class="text_field_container">
                        <select id="contact_status_id" class="text_field" placeholder="">
                            <option value="">-Select here</option>
                            <script>_getSelectStataus('contact_status_id','1,2');</script>
                        </select>
                        <div class="placeholder">--Select Status--</div>
                    </div>
                </div>                         
                <button class="btn" type="button" title="SUBMIT" id="submit_btn" onclick="_addContactPerson('<?php echo $ids?>');"> <i class="bi-check"></i> SUBMIT </button>             
            </div>
        </div>  
    </div>
<?php } ?>

<?php if ($page=='update_contact_person_form'){ ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE STAFF PROFILE</span>
                <div class="close" title="Close" onclick="_alert_secondary_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div class="alert">Kindly fill the form below to <span>UPDATE STAFF PROFILE</span></div>

                <div class="alert alert-success">
                    <div class="alert-title">CONTACT PERSON</div>
                    <div class="text_field_container">
                        <input class="text_field" type="text" id="contact_name" placeholder=""/>
                        <div class="placeholder">Full Name:</div>
                    </div>
                    
                    <div class="text_field_container">
                        <input class="text_field" type="text" id="contact_email" placeholder=""/>
                        <div class="placeholder">Email Address:</div>
                    </div>

                    <div class="text_field_container">
                        <input class="text_field" type="tel" id="contact_phone" placeholder=""/>
                        <div class="placeholder">Phone Number:</div>
                    </div>

                    <div class="text_field_container">
                        <select id="contact_role_id" class="text_field" placeholder="">
                            <option value="">-Select here</option>
                            <script>_getSelectRole('contact_role_id');</script>
                        </select>
                        <div class="placeholder">--Select Role--</div>
                    </div>

                    <div class="text_field_container">
                        <select id="contact_status_id" class="text_field" placeholder="">
                            <option value="">-Select here</option>
                            <script>_getSelectStataus('contact_status_id','1,2');</script>
                        </select>
                        <div class="placeholder">--Select Status--</div>
                    </div>
                </div>  
                <div id="showUpdateButton"></div>                       
                <!-- <button class="btn" type="button" title="SUBMIT" id="submit_btn" onclick=""> <i class="bi-check"></i> UPDATE PROFILE </button>              -->
            </div>
        </div>  
    </div>
    <script>_fetchEachContactPersonInfo('<?php echo $company_id?>', '<?php echo $staff_id?>');</script>
<?php } ?>

<?php if ($page=='agent_approve_profile'){?>
    <div class="agent-profile-div animated fadeIn">
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
                            <div class="img-div"><img src="all-images/body-pix/afootech.jpg" id="agent_logo" alt="Agent Profile"/></div> 
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
                            <div class="bottom-div">
                                <div class="title"><i>Kindly approve or decline this company's invitation.</i></div>
                                <div class="btn-div" id="approve_decline_btn_container">
                                <button class="btn" type="button" title="Approve invitation" onclick="_approveDeclineAgentInvitation('approve','<?php echo $ids?>');"><i class="bi-check2-circle"></i> APPROVE </button>
                                <button class="btn deactivate-btn" type="button" title="Decline invitation" onclick="_approveDeclineAgentInvitation('decline','<?php echo $ids?>');"><i class="bi-exclamation-octagon"></i> DECLINE</button>
                                </div>
                            </div>                        
                        </div>      
                    </div>   
                </div>
            </div>
       
            <div class="company-back-details">              
                <div class="company-back-div-in">
                    <div class="company-detail">
                        <div class="div-in">
                            <div class="title-div"><span><i class="bi-person-check-fill"></i> COMPANY DETAILS</span></div>
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
                                    </div>                               
                                </div>
                                <div class="detail-list">
                                    <div class="title">COMPANY STATUS:</div>
                                    <span id="status_name_detail">xxxx</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bottom-div">
                        <div class="title"><i>Kindly approve or decline this company's invitation.</i></div>
                        <div class="btn-div" id="approve_decline_btn_container_1">
                        <button class="btn" type="button" title="Approve invitation" onclick="_approveDeclineAgentInvitation('approve','<?php echo $ids?>');"><i class="bi-check2-circle"></i> APPROVE </button>
                        <button class="btn deactivate-btn" type="button" title="Decline invitation" onclick="_approveDeclineAgentInvitation('decline','<?php echo $ids?>');"><i class="bi-exclamation-octagon"></i> DECLINE</button>
                        </div>
                    </div>
                </div>                   
            </div> 
        </div>     
    </div> 
    <script>_fetchEachCompanyInfo('<?php echo $ids?>');</script>
<?php } ?>

<?php if ($page=='agent_pending_profile'){?>
    <div class="agent-profile-div animated fadeIn">
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
                            <div class="img-div"><img src="all-images/body-pix/afootech.jpg" id="agent_logo" alt="Agent Profile"/></div> 
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
                    </div>
                </div>
            </div>

            <div class="agent-btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Dashboard" id="dashboard_details" onclick="_get_agent_page_contents('dashboard_details','<?php echo $ids?>');">Dashboard</li>                      
                    </ul>
                </div>
            </div>

            <div class="company-back-details">              
                <div class="company-back-div-in">
                    <div class="company-detail">
                        <div class="div-in">
                            <div class="title-div"><span><i class="bi-person-check-fill"></i> COMPANY DETAILS</span> <button class="btn" title="Edit Company Profile" onclick="_get_secondary_form_with_id('update_agent_pending_form','<?php echo $ids?>');"><i class="bi-pencil-square"></i> EDIT PROFILE</button></div>
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
                                    </div>                               
                                </div>
                                <div class="detail-list">
                                    <div class="title">COMPANY STATUS:</div>
                                    <span id="status_name_detail">xxxx</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                   
            </div> 
        </div>     
    </div> 
    <script>_fetchEachCompanyInfo('<?php echo $ids?>');</script>
<?php } ?>


<?php if ($page=='logout_confirm_form'){?>
	<div class="caption-success-div animated zoomIn">
        <div class="div-in">
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




