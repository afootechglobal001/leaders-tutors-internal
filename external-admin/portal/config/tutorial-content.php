<?php if ($page == 'proceedTutorialForm') { ?>
    <div class="caption-div animated fadeIn">
        <div class="caption-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-play-circle"></i></div>
                <h3>Tutorial</h3>
            </div>
            <div class="btn-div">
                <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>
        <!-- /////////// Title ////////////////////////////// -->
        <div class="caption-notification">
            <p>
                Hi, You are about to view <strong>Tutorial</strong> Videos.
                Kindly select <strong>Department</strong> & <strong>Exam</strong> to continue.
            </p>

        </div>
        <div class="caption-body">
            <div class="text_field_container" id="departmentId_container">
                <script>
                    selectField({
                        id: 'departmentId',
                        title: 'Select Department'
                    });
                    _getSelectDepartment('departmentId');
                </script>
            </div>

            <div class="text_field_container" id="examId_container">
                <script>
                    selectField({
                        id: 'examId',
                        title: 'Select Exam'
                    });
                    _getSelectTutorialExam('examId');
                </script>
            </div>
            <div class="btn-div">
                <button class="btn" id="proceedBtn" onclick="_proceedFetchTutorialByDepartmentAndExam();">PROCEED <i class="bi-arrow-right"></i></button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'tutorialPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-play-circle"></i></div>
            </div>
            <div class="text-div">
                <h3>Tutorial Videos</h3>
                <p>Manage student records, track academic progress, Easily access student profiles, monitor performance, and organize essential information in one place.</p>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-play-circle"></i>
                    <p>Tutorial Videos </p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="alert alert-success top-alert-div animated fadeIn">
                    <span><i class="bi bi-play-circle"></i> <span id="departmentName"></span>
                        / <span id="examAbbreviation"></span></span>
                </div>

                <!-- Department Year Toggle container -->
                <div class="pages-toggle-back-div" id="fetchTutorialDepartmentExamContent">
                    <script>
                        _fetchTutorialByDepartmentAndExamData();
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'tutorialReg') { ?>
    <script>
        selectedTutorialSession = JSON.parse(sessionStorage.getItem("selectedTutorialSession"));
    </script>

    <script>
        useEachTutorialSession = JSON.parse(sessionStorage.getItem("useEachTutorialSession"));
        $('#formTitle').html(useEachTutorialSession?.tutorialId ? 'UPDATE TUTORIAL' : 'TUTORIAL REGISTRATION');
        $('#subTitle, #subTitle2').html(useEachTutorialSession?.tutorialId ? 'update this tutorial' : 'create a new tutorial');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-play-circle"></i></div>
                <h3 id="formTitle">UPLOAD NEW VIDEO</h3>
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
                            <i class="bi bi-info-circle"></i>
                            <p>Department Info</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="alert alert-success form-alert-div">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Year:</div>
                                        <div>
                                            <span id="year">
                                                <script>
                                                    $("#year").html(selectedTutorialSession?.yearValue);
                                                </script>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Exam:</div>
                                        <div>
                                            <span id="examAbbreviation">
                                                <script>
                                                    $("#examAbbreviation").html(selectedTutorialSession?.examAbbreviation);
                                                </script>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Department:</div>
                                        <div>
                                            <span id="formDepartmentName">
                                                <script>
                                                    $("#formDepartmentName").html(selectedTutorialSession?.departmentName);
                                                </script>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Subject:</div>
                                        <div>
                                            <span id="subjectName">
                                                <script>
                                                    $("#subjectName").html(selectedTutorialSession?.subjectName);
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
                            <p>Title</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="tutorialTitle_container">
                            <script>
                                textField({
                                    id: 'tutorialTitle',
                                    title: 'Tutorial Title',
                                    value: useEachTutorialSession?.tutorialTitle ?? ''
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
                            <i class="bi-play-circle"></i>
                            <p>Class Summary</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="page-content-back-div">
                            <textarea class="text_field" style="width:100%;" rows="24" id="tutorialDescription" title="TYPE TUTORIAL DESCRIPTION HERE"></textarea>
                            <div class="issueText" id="issue_tutorialDescription"></div>
                        </div>
                    </div>
                </div>
                <script src="js/TextEditor.js" referrerpolicy="origin"></script>
                <script>
                    $(document).ready(function() {
                        tinymce.init({
                            selector: '#tutorialDescription',
                            plugins: "link image table",
                            setup: function(editor) {
                                editor.on('init', function() {
                                    setTimeout(function() {
                                        editor.setContent(useEachTutorialSession?.tutorialDescription ?? '');
                                    }, 300);
                                });
                            }
                        });
                    });
                </script>

            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <label for="tutorialPicture" style="cursor:pointer;" title="Click To Upload Tutorial Picture">
                            <div class="title">
                                <i class="bi-upload"></i>
                                <p>Click To Upload Tutorial Picture</p>
                            </div>
                        </label>
                    </div>

                    <div class="form-container">
                        <div class="pdf-back-div">
                            <label for="tutorialPicture">
                                <div class="div-in" id="video_upload_area">
                                    <div class="pix-div" title="Click To Upload Tutorial Picture">
                                        <img id="tutorialPicturePreview" src="<?php echo $websiteUrl ?>/images/defaults.png" alt="Default Image">
                                        <input type="file" id="tutorialPicture" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="tutorialPicturePreview.UpdatePreview(this);" />
                                    </div>
                                </div>
                            </label>
                            <div class="issue-text" id="issues_tutorialPicture"></div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            const tutorialPicture = useEachTutorialSession?.tutorialPicture ? tutorialPixPath + useEachTutorialSession.tutorialPicture + '?t=' + new Date().getTime(): "<?php echo $websiteUrl ?>/images/defaults.png";
                            $("#tutorialPicturePreview").attr("src", tutorialPicture).attr("alt", useEachTutorialSession?.tutorialTitle + " Picture");
                        });
                    </script>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <legend id="videoDisplay" style="cursor:pointer;" title="Click To Upload Video">
                            <div class="title">
                                <i class="bi-upload"></i>
                                <p>Click To Upload Video</p>
                            </div>
                        </legend>
                    </div>

                    <div class="form-container">
                        <div class="pdf-back-div">
                            <div class="div-in" id="video_upload_area">
                                <div id="videoDisplay" class="video-container">
                                    <video id="videoFile" class="video" controls style="display:none;" controlsList="nodownload">
                                        <source src="" type="video/mp4">
                                    </video>

                                    <div id="videoBackground" class="background-text" style="cursor:pointer;">
                                        <img src="<?php echo $websiteUrl ?>/images/defaults.png" alt="Default Image">
                                    </div>
                                </div>

                                <input type="file" id="tutorialVideo" name="videoFile" accept="video/*" style="display:none;">
                            </div>
                            <div class="issue-text" id="issues_tutorialVideo"></div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $("#tutorialVideo").on("change", function(e) {
                                    const file = e.target.files[0];
                                    if (file) {
                                        const fileURL = URL.createObjectURL(file);

                                        $("#videoFile source").attr("src", fileURL);
                                        $("#videoFile").show()[0].load();
                                        $("#videoBackground").hide();
                                    }
                                });

                                $("#videoLegend, #videoBackground, #videoFile").on("click", function() {
                                    $("#tutorialVideo").val(""); // reset to allow reselecting same file
                                    $("#tutorialVideo").trigger("click");
                                });


                                if (useEachTutorialSession?.tutorialVideo) {
                                    const videoUrl = `${tutorialVideoPath}${useEachTutorialSession.tutorialVideo + '?t=' + new Date().getTime()}`;

                                    $("#videoFile source").attr("src", videoUrl);
                                    $("#videoFile").show()[0].load();
                                    $("#videoBackground").hide();
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-play-circle"></i>
                            <p>Video Duration</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="tutorialDuration_container">
                            <script>
                                textField({
                                    id: 'tutorialDuration',
                                    title: '00:00:00',
                                    value: useEachTutorialSession?.tutorialDuration ?? ''
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <legend id="pdfLegend" style="cursor:pointer;" title="Click To Upload Passport Photograph">
                            <div class="title">
                                <i class="bi-upload"></i>
                                <p>Click To Upload Class Material</p>
                            </div>
                        </legend>
                    </div>

                    <div class="form-container">
                        <div class="pdf-back-div">
                            <div class="div-in" id="pdf_upload_area">
                                <label>
                                    <div id="pdfDisplay" class="pdf-container background-display">
                                        <embed id="pdfFile" type="application/pdf" width="100%" height="350px" style="display:none;">
                                        <div id="pdfBackground" class="background-text" style="cursor:pointer;">
                                            <img src="<?php echo $websiteUrl ?>/images/defaults.png" alt="Default Image">
                                        </div>
                                    </div>
                                    <input type="file" id="tutorialMaterial" name="pdfFile" accept=".pdf" style="display:none;">
                                </label>
                            </div>
                            <div id="file-list"></div>
                            <div class="issue-text" id="issues_tutorialMaterial"></div>
                        </div>


                        <script>
                            $(document).ready(function() {
                                let $pdfDisplay = $('#pdfDisplay');
                                let $pdfInput = $('#tutorialMaterial');
                                let $pdfEmbed = $('#pdfFile');
                                let $fileList = $('#file-list');

                                function showPdf(file) {
                                    if (!file) return;

                                    // Show preview
                                    let fileUrl = URL.createObjectURL(file);
                                    $pdfDisplay.removeClass('background-display').addClass('embed-display');
                                    $pdfEmbed.show().attr('src', fileUrl);
                                    $('#pdfBackground').hide();

                                    // File size
                                    let sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                                    $fileList.html('File size: ' + sizeInMB + 'MB');
                                }

                                // Click legend to open file input
                                $('#pdfLegend').click(function() {
                                    $pdfInput.click();
                                });

                                // On file select
                                $pdfInput.on('change', function() {
                                    showPdf(this.files[0]);
                                });

                                // Drag & Drop
                                $pdfDisplay.on('dragover', function(e) {
                                    e.preventDefault();
                                    $(this).addClass('drag-over');
                                }).on('dragleave', function() {
                                    $(this).removeClass('drag-over');
                                }).on('drop', function(e) {
                                    e.preventDefault();
                                    $(this).removeClass('drag-over');
                                    let file = e.originalEvent.dataTransfer.files[0];
                                    $pdfInput[0].files = e.originalEvent.dataTransfer.files;
                                    showPdf(file);
                                });

                                // If editing existing, show current PDF
                                let material = useEachTutorialSession?.tutorialMaterial;
                                const existingPdf = material;
                                if (existingPdf) {
                                    let existingPdfUrl = tutorialMaterialPath + existingPdf + '?t=' + new Date().getTime();
                                    $pdfDisplay.removeClass('background-display').addClass('embed-display');
                                    $pdfEmbed.show().attr('src', existingPdfUrl);
                                    $('#pdfBackground').hide();
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-play-circle"></i>
                            <p>Video Status</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="statusId_container">
                            <script>
                                selectField({
                                    id: 'statusId',
                                    title: 'Select Status',
                                    fieldValue: useEachTutorialSession?.statusData?.statusId ?? '',
                                    fieldLabel: useEachTutorialSession?.statusData?.statusName ?? ''
                                });
                                _getSelectStatusId('statusId', '1,2');
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success" id="validate-progress-alert">
                    <span>VALIDATING AND PREPARING FILES...</span><br>
                    Please DO NOT close this panel as the process takes some time.
                    <div class="validate-ajax-progress">0%</div>
                </div>

                <div class="alert alert-success" id="progress-alert">
                    <span>UPLOADING FILES IN PROGRESS...</span><br>
                    Please DO NOT close this panel as the process takes some time.
                    <div class="ajax-progress">0%</div>
                </div>

                <div class="btn-div">
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createAndUpdateTutorialVideos();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>