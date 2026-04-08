<?php if ($page == 'examPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi-journal"></i></div>
            </div>
            <div class="text-div">
                <h3>Exams</h3>
                <p>Upload and update exam details with ease. Manage exam content, make quick edits, and keep all examination information up to date in one place.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" id="searchContent" onkeyup="_filtersExam(this.value);" placeholder="Search Exam Here...">
                <i class="bi bi-search"></i>
            </div>
            <button class="btn" title="ADD NEW EXAM" onclick="sessionStorage.removeItem('useEachExamSession'); _getForm({page: 'examReg', url: adminPortalLocalUrl});">
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
                <div class="exams-back-div" id="examContent">
                    <script>
                        _fetchExamData();
                    </script>

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
                <!-- Pagination -->
                <div id="examContentPaginationControls" class="pagination-div"></div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'examReg') { ?>
    <script>
        useEachExamSession = JSON.parse(sessionStorage.getItem("useEachExamSession"));
        $('#formTitle').html(useEachExamSession?.examId ? 'UPDATE EXAM' : 'EXAM REGISTRATION');
        $('#subTitle, #subTitle2').html(useEachExamSession?.examId ? 'update this exam' : 'create a new exam');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-journal"></i></div>
                <h3 id="formTitle">CREATE NEW EXAM</h3>
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
                <p>You are about to <span id="subTitle"></span>. Please complete the form below with accurate details to successfully <span id="subTitle2"></span>.</p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-journal"></i>
                            <p>Exam Abbreviation</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="examAbbreviation_container">
                            <script>
                                textField({
                                    id: 'examAbbreviation',
                                    title: 'Exam Abbreviation',
                                    value: useEachExamSession?.examAbbreviation ?? ''
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="examName_container">
                            <script>
                                textField({
                                    id: 'examName',
                                    title: 'Exam Name',
                                    value: useEachExamSession?.examName ?? ''
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <label for="examLogo" style="cursor:pointer;" title="Click To Upload Exam Logo">
                            <div class="title">
                                <i class="bi-upload"></i>
                                <p>Click To Upload Exam Logo</p>
                            </div>
                        </label>
                    </div>

                    <div class="form-container">
                        <div class="pdf-back-div">
                            <label for="examLogo">
                                <div class="div-in" id="video_upload_area">
                                    <div class="pix-div" title="Click To Upload Exam Logo">
                                        <img id="examLogoPreview" src="<?php echo $websiteUrl ?>/images/defaults.png" alt="Default Image">
                                        <input type="file" id="examLogo" style="display:none" accept="*/*" onchange="examLogoPixPreview.UpdatePreview(this);" />
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="issue-text" id="issues_examLogo"></div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            const examLogo = useEachExamSession?.examLogo ? examLogoPath + "/" + useEachExamSession.examLogo : "<?php echo $websiteUrl ?>/uploaded_files/examLogo/defaults.png";
                            $("#examLogoPreview").attr("src", examLogo).attr("alt", useEachExamSession?.examName + " Logo");
                        });
                    </script>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-journal"></i>
                            <p>Exam Status</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="statusId_container">
                            <script>
                                selectField({
                                    id: 'statusId',
                                    title: 'Select Status',
                                    fieldValue: useEachExamSession?.statusData?.statusId ?? '',
                                    fieldLabel: useEachExamSession?.statusData?.statusName ?? ''
                                });
                                _getSelectStatusId('statusId', '1,2');
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createAndUpdateExam();"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div>
    </div>
<?php } ?>