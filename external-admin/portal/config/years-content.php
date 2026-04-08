<?php if ($page == 'yearPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-calendar2-plus"></i></div>
            </div>
            <div class="text-div">
                <h3>Years Management</h3>
                <p>Manage academic years, track progress, and organize essential information in one place.</p>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-calendar2-plus"></i>
                    <p>Academic Years</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="alert alert-success top-alert-div animated fadeIn">
                    <span><i class="bi bi-calendar2-plus"></i> <span>DEPARTMENT LIST</span></span>
                </div>

                <div class="pages-toggle-back-div" id="departmentByYearContent">
                    <script>_fetchYearByDepartmentData();</script>

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'yearReg') { ?>
    <script>
        useEachDepartmentSession = JSON.parse(sessionStorage.getItem("useEachDepartmentSession"));
    </script>

    <script>
        useSingleYearSession = JSON.parse(sessionStorage.getItem("useSingleYearSession"));
        $('#yearPageTitle').html(useSingleYearSession?.yearId ? 'UPDATE YEAR' : 'ADD YEAR');
        $('#yearSubTitle, #yearSubTitle2').html(useSingleYearSession?.yearId ? 'update this year' : 'create new year');
    </script>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-calendar2-plus"></i></div>
                <h3 id="yearPageTitle">ADD YEAR</h3>
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
                <p>You are about to add a new year<span id="yearSubTitle"></span>. Please complete the form below with accurate details to successfully create a new year<span id="yearSubTitle2"></span>.</p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-info-circle"></i>
                            <p>Department Info</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="alert alert-success form-alert-div">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Department Name:</div>
                                        <div>
                                            <span id="departmentName"><script>
                                                    $("#departmentName").html(useEachDepartmentSession?.departmentName);
                                                </script>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-play-circle"></i>
                            <p>Year</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="yearValue_container">
                            <script>
                                textField({
                                    id: 'yearValue',
                                    title: 'Year',
                                    onKeyPressFunction: 'isNumberCheck(event);',
                                    value: useSingleYearSession?.yearValue ?? '',
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-journal"></i>
                            <p>Exams</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="permission-form-back-div">
                            <div class="title-div">
                                
                                <p>Use the toggles below to assign registered exams to their respective year. Switching to "Yes" activates the exam for year use.</p>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Registered Exams</div>
                                <div class="fetch-toggle" id="examToggle">
                                    <script>
                                        _fetchExternalExamToggle();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-journal"></i>
                            <p>Subjects</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="permission-form-back-div">
                            <div class="title-div">
                                
                                <p>Use the toggles below to assign registered subjects to their respective year. Switching to "Yes" activates the subjects for year use.</p>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Registered Subjects</div>
                                <div class="fetch-toggle" id="subjectToggle">
                                    <script>
                                        _fetchExternalSubjectToggle();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-play-circle"></i>
                            <p>Year Status</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="statusId_container">
                            <script>
                                selectField({
                                    id: 'statusId',
                                    title: 'Select Status',
                                    fieldValue: useSingleYearSession?.statusData?.statusId ?? '',
                                    fieldLabel: useSingleYearSession?.statusData?.statusName ?? ''
                                });
                                _getSelectStatusId('statusId', '1,2');
                            </script>
                        </div>
                    </div>
                </div>

                <div class="btn-div">
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createAndUpdateYear();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>