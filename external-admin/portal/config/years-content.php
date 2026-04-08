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
                    <p>Academic Years </p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="alert alert-success top-alert-div animated fadeIn">
                    <span><i class="bi bi-calendar2-plus"></i> <span>DEPARTMENT LIST</span></span>
                </div>

                <div class="pages-toggle-back-div">
                    <div class="pages-toggle-div">
                        <div class="pages-toggle-title" title="Click to view years">
                            <div class="title-back-div">
                                <h3>SCIENCE</h3>
                            </div>

                            <div class="btn-back-div">
                                <button class="btn" title="ADD NEW YEAR" onclick="_getForm({page: 'yearReg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD YEAR</button>
                                <div class="expand-div" id="view1num" onclick="_chevronCollapse('view1');">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                            </div>
                        </div>

                        <div class="toggle-expand-div" id="view1answer" style="display: none;">
                            <div class="pages-toggle-back-div">
                                <div class="pages-toggle-div">
                                    <div class="pages-toggle-title" title="Click to view subjects">
                                        <div class="title-back-div subject-title-div">
                                            <h3>2020</h3>
                                            <div class="bottom-back-div">
                                                <div class="bottom-text">No of Exams <div class="count">10</div></div> |
                                                <div class="bottom-text">No of Subjects <div class="count">10</div></div>
                                            </div>
                                        </div>

                                        <div class="btn-back-div">
                                            <button class="btn" title="EDIT YEAR" onclick="_getForm({page: 'yearReg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> EDIT</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="pages-toggle-div">
                                    <div class="pages-toggle-title" title="Click to view subjects">
                                        <div class="title-back-div subject-title-div">
                                            <h3>2021</h3>
                                            <div class="bottom-back-div">
                                                <div class="bottom-text">No of Exams <div class="count">10</div></div> |
                                                <div class="bottom-text">No of Subjects <div class="count">10</div></div>
                                            </div>
                                        </div>

                                        <div class="btn-back-div">
                                            <button class="btn" title="EDIT YEAR" onclick="_getForm({page: 'yearReg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> EDIT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pages-toggle-div">
                        <div class="pages-toggle-title" title="Click to view years">
                            <div class="title-back-div">
                                <h3>ART</h3>
                            </div>

                            <div class="btn-back-div">
                                <button class="btn" title="ADD NEW YEAR" onclick="_getForm({page: 'yearReg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD YEAR</button>
                                <div class="expand-div" id="view2num" onclick="_chevronCollapse('view2');">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                            </div>
                        </div>

                        <div class="toggle-expand-div" id="view2answer" style="display: none;">
                            <div class="pages-toggle-back-div">
                                <div class="pages-toggle-div">
                                    <div class="pages-toggle-title" title="Click to view subjects">
                                        <div class="title-back-div subject-title-div">
                                            <h3>2020</h3>
                                            <div class="bottom-back-div">
                                                <div class="bottom-text">No of Exams <div class="count">10</div></div> |
                                                <div class="bottom-text">No of Subjects <div class="count">10</div></div>
                                            </div>
                                        </div>

                                        <div class="btn-back-div">
                                            <button class="btn" title="EDIT YEAR" onclick="_getForm({page: 'yearReg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> EDIT</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="pages-toggle-div">
                                    <div class="pages-toggle-title" title="Click to view subjects">
                                        <div class="title-back-div subject-title-div">
                                            <h3>2021</h3>
                                            <div class="bottom-back-div">
                                                <div class="bottom-text">No of Exams <div class="count">10</div></div> |
                                                <div class="bottom-text">No of Subjects <div class="count">10</div></div>
                                            </div>
                                        </div>

                                        <div class="btn-back-div">
                                            <button class="btn" title="EDIT YEAR" onclick="_getForm({page: 'yearReg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> EDIT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'yearReg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-calendar2-plus"></i></div>
                <h3 id="pageTitle">ADD YEAR</h3>
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
                <p>You are about to create a new video<span id="subTitle"></span>. Please complete the form below with accurate details to successfully create a new video<span id="subTitle2"></span>.</p>
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
                        <div class="text_field_container" id="yearId_container">
                            <script>
                                textField({
                                    id: 'yearId',
                                    title: 'Year',
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
                                <div class="fetch-toggle" id="dashboard">
                                    <div class="each-toggle-div">
                                        <span>WAEC</span>
                                        <label for="role_1" class="switch">
                                            <input type="checkbox" class="child" id="role_1" name="rolePermissionId[]" data-value="1">
                                            <span class="slider"></span>
                                            <span class="toggle-label">No</span>
                                        </label>
                                    </div>

                                    <div class="each-toggle-div">
                                        <span>NECO</span>
                                        <label for="role_2" class="switch">
                                            <input type="checkbox" class="child" id="role_2" name="rolePermissionId[]" data-value="2">
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
                                <div class="fetch-toggle" id="dashboard">
                                    <div class="each-toggle-div">
                                        <span>CHEMISTRY</span>
                                        <label for="role_1" class="switch">
                                            <input type="checkbox" class="child" id="role_1" name="rolePermissionId[]" data-value="1">
                                            <span class="slider"></span>
                                            <span class="toggle-label">No</span>
                                        </label>
                                    </div>

                                    <div class="each-toggle-div">
                                        <span>PHYSICS</span>
                                        <label for="role_2" class="switch">
                                            <input type="checkbox" class="child" id="role_2" name="rolePermissionId[]" data-value="2">
                                            <span class="slider"></span>
                                            <span class="toggle-label">No</span>
                                        </label>
                                    </div>

                                    <div class="each-toggle-div">
                                        <span>ENGLISH LANGUAGE</span>
                                        <label for="role_2" class="switch">
                                            <input type="checkbox" class="child" id="role_2" name="rolePermissionId[]" data-value="2">
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
                                });
                            </script>
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