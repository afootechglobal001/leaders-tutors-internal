<?php if ($page == 'studentPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi-journal"></i></div>
            </div>
            <div class="text-div">
                <h3>Students</h3>
                <p>Manage student records, track academic progress, Easily access student profiles, monitor performance, and organize essential information in one place.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" id="searchContent" onkeyup="_filterEbooks(this.value);" placeholder="Search Students Here...">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi-credit-card"></i>
                    <p>Subscriptions</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%" id="fetchAllSubscriptions">
                        <thead>
                            <tr class="tb-col">
                                <th>sn</th>
                                <th>Student Id</th>
                                <th>Student Info</th>
                                <th>Department</th>
                                <th>Class</th>
                                <th>Last Login</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr class="tb-row">
                                <td>1</td>
                                <td>STU02020251029115106</td>

                                <td class="clickable-td" title="Click to view student profile">
                                    <div class="text-back-div">
                                        <div class="image-div">
                                            <img src="<?php echo $websiteUrl ?>/images/avatar.jpg" />
                                        </div>

                                        <div class="text-div">
                                            <div class="first-class">JOHNSON AGIDA</div>
                                            <div class="second-class">STU02020251029115106</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Science</td>
                                <td>SS 3</td>
                                <td>2026-03-09 12:37:21</td>
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
                                <td>STU02020251029115106</td>

                                <td class="clickable-td">
                                    <div class="text-back-div">
                                        <div class="image-div">
                                            <img src="<?php echo $websiteUrl ?>/images/avatar.jpg" />
                                        </div>

                                        <div class="text-div">
                                            <div class="first-class">CLEMENT SMITH</div>
                                            <div class="second-class">STU02020251029115106</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Science</td>
                                <td>SS 3</td>
                                <td>2026-03-09 12:37:21</td>
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
                                <td>STU02020251029115106</td>

                                <td class="clickable-td">
                                    <div class="text-back-div">
                                        <div class="image-div">
                                            <img src="<?php echo $websiteUrl ?>/images/avatar.jpg" />
                                        </div>

                                        <div class="text-div">
                                            <div class="first-class">YAKUBU EZEKIEL</div>
                                            <div class="second-class">STU02020251029115106</div>
                                        </div>
                                    </div>
                                </td>

                                <td>Science</td>
                                <td>SS 3</td>
                                <td>2026-03-09 12:37:21</td>
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
<?php } ?>