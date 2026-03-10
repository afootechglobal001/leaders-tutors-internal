<?php if ($page == 'examPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi-journal"></i></div>
            </div>
            <div class="text-div">
                <h3>Exams</h3>
                <p>Upload and organize e-books for easy access anytime. Provide students and staff with valuable study materials and resources in a well-structured digital library.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" id="searchContent" onkeyup="_filterEbooks(this.value);" placeholder="Search Exam Here...">
                <i class="bi bi-search"></i>
            </div>
            <button class="btn" title="ADD NEW EXAM" onclick="_getForm({page: 'examReg', url: adminPortalLocalUrl});">
                <i class="bi-plus-square"></i> ADD NEW EXAM
            </button>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi-journal"></i>
                    <p>Exams</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="exams-back-div" id="">
                    <div class="exam-div">
                        <div class="exam-image">
                            <img src="<?php echo $websiteUrl ?>/images/waec.jpg" alt="WAEC EXAM" />
                        </div>
                        <div class="exam-status ACTIVE">ACTIVE</div>
                        <div class="exam-info">
                            <h3>WAEC</h3>
                            <p>West African Examination Council</p>
                            <div class="exam-time">
                                <p><i class="bi bi-calendar"></i> Updated on:
                                    <strong>01 Mar 2026</strong>
                                </p>
                            </div>
                        </div>
                        <button class="btn" title="View Details" onclick="">
                            <i class="bi bi-eye"></i> View Details
                        </button>
                    </div>

                    <div class="exam-div">
                        <div class="exam-image">
                            <img src="<?php echo $websiteUrl ?>/images/neco.png" alt="NECO EXAM" />
                        </div>
                        <div class="exam-status ACTIVE">ACTIVE</div>
                        <div class="exam-info">
                            <h3>NECO</h3>
                            <p>National Examinations Council</p>
                            <div class="exam-time">
                                <p><i class="bi bi-calendar"></i> Updated on:
                                    <strong>01 Mar 2026</strong>
                                </p>
                            </div>
                        </div>
                        <button class="btn" title="View Details" onclick="">
                            <i class="bi bi-eye"></i> View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'examReg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-journal"></i></div>
                <h3>CREATE NEW EXAM</h3>
            </div>
            <div class="btn-div">
                <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <!-- /////////// Title ////////////////////////////// -->
        <div class="container-back-div">
            <div class="form-notification">
                <p>You are about to create a new exam. Please complete the form below with accurate details to successfully create new exam.</p>
            </div>

            <div class="main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-journal"></i>
                            <p>Exam</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="examAbbr_container">
                            <script>
                                textField({
                                    id: 'examAbbr',
                                    title: 'Exam Abbreviation'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="examName_container">
                            <script>
                                textField({
                                    id: 'examName',
                                    title: 'Exam Name'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="departmentId_container">
                            <script>
                                selectField({
                                    id: 'departmentId',
                                    title: 'Select Department'
                                });
                            </script>
                        </div>

                        <div class="permission-form-back-div">
                            <div class="title-div">
                                <h4>Subjects</h4>
                                <p>Use the toggles below to assign registered subjects to their respective exams. Switching to "Yes" activates the subject for exam use.</p>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Registered Subjects</div>
                                <div class="fetch-toggle" id="dashboard">
                                    <div class="each-toggle-div">
                                        <span>Mathematics</span>
                                        <label for="role_1" class="switch">
                                            <input type="checkbox" class="child" id="role_1" name="rolePermissionId[]" data-value="1">
                                            <span class="slider"></span>
                                            <span class="toggle-label">No</span>
                                        </label>
                                    </div>

                                    <div class="each-toggle-div">
                                        <span>English</span>
                                        <label for="role_2" class="switch">
                                            <input type="checkbox" class="child" id="role_2" name="rolePermissionId[]" data-value="2">
                                            <span class="slider"></span>
                                            <span class="toggle-label">No</span>
                                        </label>
                                    </div>

                                    <div class="each-toggle-div">
                                        <span>Chemistry</span>
                                        <label for="role_3" class="switch">
                                            <input type="checkbox" class="child" id="role_3" name="rolePermissionId[]" data-value="3">
                                            <span class="slider"></span>
                                            <span class="toggle-label">No</span>
                                        </label>
                                    </div>

                                    <div class="each-toggle-div">
                                        <span>Physics</span>
                                        <label for="role_4" class="switch">
                                            <input type="checkbox" class="child" id="role_4" name="rolePermissionId[]" data-value="4">
                                            <span class="slider"></span>
                                            <span class="toggle-label">No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <script>
                               _toggleCheck();
                            </script>
                        </div>

                        <div class="text_field_container" id="statusId_container">
                            <script>
                                selectField({
                                    id: 'statusId',
                                    title: 'Select Status'
                                });
                                // _getSelectStatusId('statusId', '1,2');
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="SUBMIT" id="submitBtn" onclick=""> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div>
    </div>
    </div>
<?php } ?>