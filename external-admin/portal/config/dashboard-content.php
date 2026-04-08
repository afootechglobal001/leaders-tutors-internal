<?php if ($page == 'dashboard') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-speedometer2"></i></div>
            </div>
            <div class="text-div">
                <h2>Welcome Back, <span id="DashFullname">
                        <script>
                            $("#DashFullname").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullname));
                        </script>
                    </span>!</h2>
                <p>Welcome to your dashboard, where you can oversee all your activities, tasks, progress, and updates—helping you stay organized and on track</p>
            </div>
        </div>

        <div class="dashboard-right-wrapper">
            <div>
                <p><span><i class="bi-clock"></i> Last Login Date </span></p>
            </div>
            <div><strong id="lastLoginTime">
                    <script>
                        $("#lastLoginTime").html(staffLoginData.last_login_time);
                    </script>
                </strong></div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="dashboard-wrapper">
            <div class="statistics-back-div">
                <div class="statistics-div" id="branch" title="Branches" onclick="_getActivePage({page:'examPage', divid:'examPage'});">
                    <div class="statistics-inner-div">
                        <div class="statistics-text">
                            <p>Exams</p>
                            <span>Statistics of Exams</span>
                            <h2 id="totalActiveBranchCount">10</h2>
                        </div>
                        <div class="statistics-icon pending"><i class="bi-journal-check"></i></div>
                    </div>
                </div>

                <div class="statistics-div" onclick="" id="staff" title="Administrators">
                    <div class="statistics-inner-div">
                        <div class="statistics-text">
                            <p>Tutorials</p>
                            <span>Statistics of Tutorials</span>
                            <h2 id="totalActiveStaffCount">100</h2>
                        </div>
                        <div class="statistics-icon upcoming"><i class="bi-play-circle"></i></div>
                    </div>
                </div>

                <div class="statistics-div" id="students" title="Customers">
                    <div class="statistics-inner-div">
                        <div class="statistics-text">
                            <p>Students</p>
                            <span>Statistics of Students</span>
                            <h2 id="totalActiveCustomerCount">30</h2>
                        </div>
                        <div class="statistics-icon completed"><i class="bi-people"></i></div>
                    </div>
                </div>

                <div class="statistics-div" onclick="" id="gallery" title="Gallery">
                    <div class="statistics-inner-div">
                        <div class="statistics-text">
                            <p>Subscriptions</p>
                            <span>Statistics of Subscriptions</span>
                            <h2 id="totalActiveGalleryCount">20</h2>
                        </div>
                        <div class="statistics-icon pending"><i class="bi-credit-card"></i></div>
                    </div>
                </div>
            </div>

            <div class="dashboard-statistics-wrapper">
                <div class="left-contaioner">
                    <div class="chart-back-div">
                        <div class="chart-div-notifications top-border-radius">
                            <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for </div>

                            <div class="text text-right" onclick="select_search()">
                                <span id="srch-text">Last 30 Days</span>
                                <div class="icon-div"><i class="bi-caret-down"></i></div>

                                <div class="srch-select alert-srch-select">
                                    <div id="srch-today" onclick="_fetchRevenueFiltering('srch-today', 'Today');">Today
                                    </div>
                                    <div id="srch-week" onclick="_fetchRevenueFiltering('srch-week', 'This Week');">This
                                        Week</div>
                                    <div id="srch-7" onclick="_fetchRevenueFiltering('srch-7', 'Last 7 Days');">Last 7 Days
                                    </div>
                                    <div id="srch-month" onclick="_fetchRevenueFiltering('srch-month', 'This Month');">This
                                        Month</div>
                                    <div id="srch-30" onclick="_fetchRevenueFiltering('srch-30', 'Last 30 Days');">Last 30 Days
                                    </div>
                                    <div id="srch-90" onclick="_fetchRevenueFiltering('srch-90', 'Last 90 Days');">Last 90 Days
                                    </div>
                                    <div id="srch-year" onclick="_fetchRevenueFiltering('srch-year', 'This Year');">This
                                        Year</div>
                                    <div id="srch-1year" onclick="_fetchRevenueFiltering('srch-1year', 'Last 1 Year');">Last 1
                                        Year</div>
                                    <div onclick="srch_custom('Custom Search')">Custom Search</div>
                                </div>
                            </div>

                            <div class="text">
                                <div class="custom-srch-div">
                                    <div class="custom-srch-div-in">
                                        <div class="text_field_container dash_field_container">
                                            <input class="text_field bar_cust_text_field" type="text" id="datepickers-from"
                                                placeholder="" />
                                            <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From
                                            </div>
                                            <div class="issueText" id="issue_from"></div>
                                        </div>

                                        <div class="text_field_container dash_field_container">
                                            <input class="text_field bar_cust_text_field" type="text" id="datepickers-to"
                                                placeholder="" />
                                            <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To </div>
                                            <div class="issueText" id="issue_to"></div>
                                        </div>
                                        <button type="button" class="btn" id="applyCustomSearchBtn"
                                            onclick="_fetchCustomRevenueFiltering();">Apply</button>
                                    </div>
                                </div>
                            </div>


                            <script language="javascript">
                                $('#datepickers-from').datetimepicker({
                                    lang: 'en',
                                    timepicker: false,
                                    format: 'Y-m-d',
                                    formatDate: 'Y-M-d',
                                });

                                $('#datepickers-to').datetimepicker({
                                    lang: 'en',
                                    timepicker: false,
                                    format: 'Y-m-d',
                                    formatDate: 'Y-M-d',
                                });
                            </script>
                        </div>

                        <div class="trending-back-div">
                            <div class="revenue-div">
                                <p>Revenue from <span id="dateFrom">February 08 2026</span> - <span id="dateTo">March 09 2026</span></p>
                                <div class="fund-div">
                                    <h3>
                                        <p id="totalIncome"><s>N</s> 500,000.00</p><span>Income</span>
                                    </h3>
                                    <h3>
                                        <p id="totalWalletBalance"><s>N</s> 200,000.00</p><span>Wallet</span>
                                    </h3>
                                </div>
                            </div>

                            <div id="chartContainer" style="width:100%; height:400px; margin:auto;"></div>
                            <script>
                                $(document).ready(function() {

                                    var chart = new CanvasJS.Chart("chartContainer", {
                                        animationEnabled: true,
                                        theme: "light1",
                                        axisX: {
                                            interval: 1,
                                            intervalType: "day",
                                            valueFormatString: "DD MMM"
                                        },
                                        axisY: {
                                            suffix: "₦",
                                            includeZero: true
                                        },
                                        toolTip: {
                                            shared: true
                                        },
                                        legend: {
                                            reversed: true,
                                            verticalAlign: "top",
                                            horizontalAlign: "left"
                                        },
                                        data: [{
                                                type: "stackedColumn",
                                                name: "Income",
                                                showInLegend: true,
                                                xValueFormatString: "DD MMM, YYYY",
                                                yValueFormatString: "₦#,##0",
                                                color: "#F38120",
                                                dataPoints: [{
                                                        x: new Date(2025, 0, 1),
                                                        y: 250000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 2),
                                                        y: 180000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 3),
                                                        y: 100000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 4),
                                                        y: 300000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 5),
                                                        y: 120000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 6),
                                                        y: 150000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 7),
                                                        y: 275000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 8),
                                                        y: 160000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 9),
                                                        y: 350000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 10),
                                                        y: 380000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 11),
                                                        y: 0
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 12),
                                                        y: 100000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 13),
                                                        y: 0
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 14),
                                                        y: 180000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 15),
                                                        y: 270000
                                                    }
                                                ]
                                            },
                                            {
                                                type: "stackedColumn",
                                                name: "Wallet",
                                                showInLegend: true,
                                                xValueFormatString: "DD MMM, YYYY",
                                                yValueFormatString: "₦#,##0",
                                                color: "#FCBB23",
                                                dataPoints: [{
                                                        x: new Date(2025, 0, 1),
                                                        y: 180000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 2),
                                                        y: 50000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 3),
                                                        y: 80000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 4),
                                                        y: 0
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 5),
                                                        y: 150000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 6),
                                                        y: 40000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 7),
                                                        y: 300000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 8),
                                                        y: 200000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 9),
                                                        y: 0
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 10),
                                                        y: 120000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 11),
                                                        y: 90000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 12),
                                                        y: 200000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 13),
                                                        y: 0
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 14),
                                                        y: 280000
                                                    },
                                                    {
                                                        x: new Date(2025, 0, 15),
                                                        y: 50000
                                                    }
                                                ]
                                            }
                                        ]
                                    });
                                    chart.render();

                                    function toogleDataSeries(e) {
                                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                            e.dataSeries.visible = false;
                                        } else {
                                            e.dataSeries.visible = true;
                                        }
                                        chart.render();
                                    }
                                })
                            </script>
                        </div>
                    </div>

                    <div class="main-content-div dash-main-content-div">
                        <div class="tables-content-div">
                            <div class="content-title">
                                <div class="title">
                                    <i class="bi-credit-card"></i>
                                    <p>Recent Subscriptions</p>
                                </div>
                            </div>

                            <div class="inner-table-content">
                                <div class="table-div animated fadeIn">
                                    <table class="table" cellspacing="0" style="width:100%" id="fetchAllSubscriptions">
                                        <thead>
                                            <tr class="tb-col">
                                                <th>sn</th>
                                                <th>Subscription Id</th>
                                                <th>Student</th>
                                                <th>Department</th>
                                                <th>Class</th>
                                                <th>Tutorial</th>
                                                <th>Amount Paid</th>
                                                <th>Start Date</th>
                                                <th>Expiry Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr class="tb-row">
                                                <td>1</td>
                                                <td>SUB02020251029115106</td>

                                                <td class="clickable-td" title="Click to view student profile">
                                                    <div class="text-back-div">
                                                        <div class="image-div">
                                                            <img src="<?php echo $websiteUrl ?>/images/avatar.jpg" />
                                                        </div>

                                                        <div class="text-div">
                                                            <div class="first-class">JOHNSON AGIDA</div>
                                                            <div class="second-class">STU202403001</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Science</td>
                                                <td>SS 3</td>
                                                <td>Mathematics Tutorial</td>
                                                <td><s>N</s>1,000.00</td>
                                                <td>2026-03-01</td>
                                                <td>2026-06-01</td>
                                                <td>
                                                    <div class="status-div ACTIVE">ACTIVE</div>
                                                </td>
                                                <td>
                                                    <button class="btn view-btn" title="View subscription">
                                                        VIEW
                                                    </button>
                                                </td>
                                            </tr>


                                            <tr class="tb-row">
                                                <td>2</td>
                                                <td>SUB02020251029115106</td>

                                                <td class="clickable-td">
                                                    <div class="text-back-div">
                                                        <div class="image-div">
                                                            <img src="<?php echo $websiteUrl ?>/images/avatar.jpg" />
                                                        </div>

                                                        <div class="text-div">
                                                            <div class="first-class">CLEMENT SMITH</div>
                                                            <div class="second-class">STU202403002</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Science</td>
                                                <td>SS 3</td>
                                                <td>Mathematics Tutorial</td>
                                                <td><s>N</s>1,000.00</td>
                                                <td>2026-03-01</td>
                                                <td>2026-06-01</td>
                                                <td>
                                                    <div class="status-div ACTIVE">ACTIVE</div>
                                                </td>
                                                <td>
                                                    <button class="btn view-btn" title="View subscription">
                                                        VIEW
                                                    </button>
                                                </td>
                                            </tr>


                                            <tr class="tb-row">
                                                <td>3</td>
                                                <td>SUB02020251029115106</td>

                                                <td class="clickable-td">
                                                    <div class="text-back-div">
                                                        <div class="image-div">
                                                            <img src="<?php echo $websiteUrl ?>/images/avatar.jpg" />
                                                        </div>

                                                        <div class="text-div">
                                                            <div class="first-class">YAKUBU EZEKIEL</div>
                                                            <div class="second-class">STU202403003</div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>Science</td>
                                                <td>SS 3</td>
                                                <td>Mathematics Tutorial</td>
                                                <td><s>N</s>1,000.00</td>
                                                <td>2026-03-01</td>
                                                <td>2026-06-01</td>
                                                <td>
                                                    <div class="status-div ACTIVE">ACTIVE</div>
                                                </td>
                                                <td>
                                                    <button class="btn view-btn" title="View subscription">
                                                        VIEW
                                                    </button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'logoutConfirmForm') { ?>
    <div class="caption-success-div animated zoomIn">
        <div class="div-in">
            <div class="img"><img src="<?php echo $websiteUrl ?>/all-images/images/warning.gif" /></div>
            <h2>Are you sure to log-out?</h2>
            Please, confirm your log-out action.
            <div class="btn-div">
                <button class="btn" onclick="_logOut();">YES</button>
                <button class="btn no-btn" onclick="_alertClose(<?php echo $modalLayer ?>);">NO</button>
            </div>
        </div>
    </div>
<?php } ?>