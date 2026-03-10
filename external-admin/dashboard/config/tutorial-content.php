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
                Kindly select <strong>Department</strong> & <strong>Class</strong> to continue.
            </p>

        </div>
        <div class="caption-body">
            <div class="text_field_container" id="departmentId_container">
                <script>
                    selectField({
                        id: 'departmentId',
                        title: 'Select Department'
                    });
                </script>
            </div>

            <div class="text_field_container" id="classId_container">
                <script>
                    selectField({
                        id: 'classId',
                        title: 'Select Class'
                    });
                </script>
            </div>
            <div class="btn-div">
                <button class="btn" id="proceedPayBtn" onclick="_getActivePage({page:'tutorialPage', divid:'tutorialPage'});">PROCEED <i class="bi-arrow-right"></i></button>
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
                    <span><i class="bi bi-play-circle"></i> <span>SS SCIENCE</span> / <span>SCIENCE</span> / <span> SS 3</span> </span>
                </div>

                <div class="pages-toggle-back-div">
                    <div class="pages-toggle-div">
                        <div class="pages-toggle-title" onclick="_chevronCollapse('view1');" title="Click to videos">
                            <h3>COMPUTER SCIENCE</h3>

                            <div class="btn-back-div">
                                <button class="btn" title="ADD NEW VIDEO" onclick="_getForm({page: 'tutorialReg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD NEW VIDEO</button>
                                <div class="expand-div" id="view1num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>
                            </div>
                        </div>

                        <div class="toggle-expand-div" id="view1answer" style="display: none;">
                            <div class="topics-wrapper">
                                <div class="topics-container">
                                    <div class="image-div">
                                        <img src="<?php echo $websiteUrl ?>/images/cables.jpg" alt="CABLES AND CONNECTORS" />
                                    </div>

                                    <div class="content-div">
                                        <div class="top-content">
                                            <h4>CABLES AND CONNECTORS</h4>
                                            <p>At the end of this lesson, the student should be able to:</p>
                                            <p>1. List network cables.</p>
                                            <p>2. list network connect.</p>
                                        </div>

                                        <div class="bottom-content">
                                            <div class="left-div">
                                                <div>
                                                    Status:
                                                    <span class="status-div ACTIVE">ACTIVE</span>
                                                </div>

                                                <div>
                                                    Duration:
                                                    <span class="duration"><strong>15:30</strong></span>
                                                </div>
                                            </div>

                                            <div class="btn-div">
                                                <button class="btn edit" title="EDIT VIDEO">
                                                    <i class="bi-pencil-square"></i> EDIT
                                                </button>

                                                <button class="btn" title="VIEW CBT">
                                                    <span class="count">10</span> CBT
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="topics-container">
                                    <div class="image-div">
                                        <img src="<?php echo $websiteUrl ?>/images/cables.jpg" alt="CABLES AND CONNECTORS" />
                                    </div>

                                    <div class="content-div">
                                        <div class="top-content">
                                            <h4>CABLES AND CONNECTORS</h4>
                                            <p>At the end of this lesson, the student should be able to:</p>
                                            <p>1. List network cables.</p>
                                            <p>2. list network connect.</p>
                                        </div>

                                        <div class="bottom-content">
                                            <div class="left-div">
                                                <div>
                                                    Status:
                                                    <span class="status-div ACTIVE">ACTIVE</span>
                                                </div>

                                                <div>
                                                    Duration:
                                                    <span class="duration"><strong>15:30</strong></span>
                                                </div>
                                            </div>

                                            <div class="btn-div">
                                                <button class="btn edit" title="EDIT VIDEO">
                                                    <i class="bi-pencil-square"></i> EDIT
                                                </button>

                                                <button class="btn" title="VIEW CBT">
                                                    <span class="count">10</span> CBT
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="topics-container">
                                    <div class="image-div">
                                        <img src="<?php echo $websiteUrl ?>/images/cables.jpg" alt="CABLES AND CONNECTORS" />
                                    </div>

                                    <div class="content-div">
                                        <div class="top-content">
                                            <h4>CABLES AND CONNECTORS</h4>
                                            <p>At the end of this lesson, the student should be able to:</p>
                                            <p>1. List network cables.</p>
                                            <p>2. list network connect.</p>
                                        </div>

                                        <div class="bottom-content">
                                            <div class="left-div">
                                                <div>
                                                    Status:
                                                    <span class="status-div ACTIVE">ACTIVE</span>
                                                </div>

                                                <div>
                                                    Duration:
                                                    <span class="duration"><strong>15:30</strong></span>
                                                </div>
                                            </div>

                                            <div class="btn-div">
                                                <button class="btn edit" title="EDIT VIDEO">
                                                    <i class="bi-pencil-square"></i> EDIT
                                                </button>

                                                <button class="btn" title="VIEW CBT">
                                                    <span class="count">10</span> CBT
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pages-toggle-div">
                        <div class="pages-toggle-title" onclick="_chevronCollapse('view2');" title="Click to view videos">
                            <h3>CHEMISTRY</h3>

                            <div class="btn-back-div">
                                <button class="btn" title="ADD NEW VIDEO" onclick=""><i class="bi-plus-square"></i> ADD NEW VIDEO</button>
                                <div class="expand-div" id="view2num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>
                            </div>
                        </div>

                        <div class="toggle-expand-div" id="view2answer" style="display: none;">
                            <div class="topics-wrapper">
                                <div class="topics-container">
                                    <div class="image-div">
                                        <img src="<?php echo $websiteUrl ?>/images/cables.jpg" alt="CABLES AND CONNECTORS" />
                                    </div>

                                    <div class="content-div">
                                        <div class="top-content">
                                            <h4>CABLES AND CONNECTORS</h4>
                                            <p>At the end of this lesson, the student should be able to:</p>
                                            <p>1. List network cables.</p>
                                            <p>2. list network connect.</p>
                                        </div>

                                        <div class="bottom-content">
                                            <div class="left-div">
                                                <div>
                                                    Status:
                                                    <span class="status-div ACTIVE">ACTIVE</span>
                                                </div>

                                                <div>
                                                    Duration:
                                                    <span class="duration"><strong>15:30</strong></span>
                                                </div>
                                            </div>

                                            <div class="btn-div">
                                                <button class="btn edit" title="EDIT VIDEO">
                                                    <i class="bi-pencil-square"></i> EDIT
                                                </button>

                                                <button class="btn" title="VIEW CBT">
                                                    <span class="count">10</span> CBT
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pages-toggle-div">
                        <div class="pages-toggle-title" onclick="_chevronCollapse('view3');" title="Click to view videos">
                            <h3>COMPUTER SCIENCE</h3>

                            <div class="btn-back-div">
                                <button class="btn" title="ADD NEW VIDEO" onclick=""><i class="bi-plus-square"></i> ADD NEW VIDEO</button>
                                <div class="expand-div" id="view3num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>
                            </div>
                        </div>

                        <div class="toggle-expand-div" id="view3answer" style="display: none;">
                            <div class="topics-wrapper">
                                <div class="topics-container">
                                    <div class="image-div">
                                        <img src="<?php echo $websiteUrl ?>/images/cables.jpg" alt="CABLES AND CONNECTORS" />
                                    </div>

                                    <div class="content-div">
                                        <div class="top-content">
                                            <h4>CABLES AND CONNECTORS</h4>
                                            <p>At the end of this lesson, the student should be able to:</p>
                                            <p>1. List network cables.</p>
                                            <p>2. list network connect.</p>
                                        </div>

                                        <div class="bottom-content">
                                            <div class="left-div">
                                                <div>
                                                    Status:
                                                    <span class="status-div ACTIVE">ACTIVE</span>
                                                </div>

                                                <div>
                                                    Duration:
                                                    <span class="duration"><strong>15:30</strong></span>
                                                </div>
                                            </div>

                                            <div class="btn-div">
                                                <button class="btn edit" title="EDIT VIDEO">
                                                    <i class="bi-pencil-square"></i> EDIT
                                                </button>

                                                <button class="btn" title="VIEW CBT">
                                                    <span class="count">10</span> CBT
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pages-toggle-div">
                        <div class="pages-toggle-title" onclick="_chevronCollapse('view4');" title="Click to view videos">
                            <h3>MATHEMATICS</h3>

                            <div class="btn-back-div">
                                <button class="btn" title="ADD NEW VIDEO" onclick=""><i class="bi-plus-square"></i> ADD NEW VIDEO</button>
                                <div class="expand-div" id="view4num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>
                            </div>
                        </div>

                        <div class="toggle-expand-div" id="view4answer" style="display: none;">
                            <div class="topics-wrapper">
                                <div class="topics-container">
                                    <div class="image-div">
                                        <img src="<?php echo $websiteUrl ?>/images/cables.jpg" alt="CABLES AND CONNECTORS" />
                                    </div>

                                    <div class="content-div">
                                        <div class="top-content">
                                            <h4>CABLES AND CONNECTORS</h4>
                                            <p>At the end of this lesson, the student should be able to:</p>
                                            <p>1. List network cables.</p>
                                            <p>2. list network connect.</p>
                                        </div>

                                        <div class="bottom-content">
                                            <div class="left-div">
                                                <div>
                                                    Status:
                                                    <span class="status-div ACTIVE">ACTIVE</span>
                                                </div>

                                                <div>
                                                    Duration:
                                                    <span class="duration"><strong>15:30</strong></span>
                                                </div>
                                            </div>

                                            <div class="btn-div">
                                                <button class="btn edit" title="EDIT VIDEO">
                                                    <i class="bi-pencil-square"></i> EDIT
                                                </button>

                                                <button class="btn" title="VIEW CBT">
                                                    <span class="count">10</span> CBT
                                                </button>
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
    </div>
<?php } ?>

<?php if ($page == 'tutorialReg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-play-circle"></i></div>
                <h3 id="pageTitle">UPLOAD NEW VIDEO</h3>
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
                            <i class="bi bi-info-circle"></i>
                            <p>Department Info</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="alert alert-success form-alert-div">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Department:</div>
                                        <div>
                                            <span id="userId">SS SIENCE</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Class:</div>
                                        <div>
                                            <span id="fullName">SS 1</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Subject:</div>
                                        <div>
                                            <span id="emailAddress">Computer Science</span>
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
                            <p>Topic</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="topic_container">
                            <script>
                                textField({
                                    id: 'topic',
                                    title: 'Topic',
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
                            <i class="bi-upload"></i>
                            <p>Class Summary</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="page-content-back-div">
                            <textarea class="text_field" style="width:100%;" rows="24" id="summary" title="TYPE EXAM INCENTIVES HERE"></textarea>
                            <div class="issueText" id="issue_incentives"></div>
                        </div>
                    </div>
                </div>
                <script src="js/TextEditor.js" referrerpolicy="origin"></script>
                <script>
                    $(document).ready(function() {
                        tinymce.init({
                            selector: '#summary',
                            plugins: "link image table",
                        });
                    });
                </script>

            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-main-content">
                    <div class="content-title">
                        <label for="videoPicture" style="cursor:pointer;" title="Click To Upload Video Picture">
                            <div class="title">
                                <i class="bi-upload"></i>
                                <p>Click To Upload Video Picture</p>
                            </div>
                        </label>
                    </div>

                    <div class="form-container">
                        <div class="pdf-back-div">
                            <label for="videoPicture">
                                <div class="div-in" id="video_upload_area">
                                    <div class="pix-div" title="Click To Upload Video Picture">
                                        <img id="passportPhotographPreview" src="<?php echo $websiteUrl ?>/images/defaults.png" alt="Default Image">
                                        <input type="file" id="videoPicture" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="passportPhotographPreview.UpdatePreview(this);" />
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
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

                                <input type="file" id="video" name="videoFile" accept="video/*" style="display:none;">
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $("#video").on("change", function(e) {
                                    const file = e.target.files[0];
                                    if (file) {
                                        const fileURL = URL.createObjectURL(file);

                                        $("#videoFile source").attr("src", fileURL);
                                        $("#videoFile").show()[0].load();
                                        $("#videoBackground").hide();
                                    }
                                });

                                $("#videoLegend, #videoBackground, #videoFile").on("click", function() {
                                    $("#video").val(""); // reset to allow reselecting same file
                                    $("#video").trigger("click");
                                });
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
                        <div class="text_field_container" id="duration_container">
                            <script>
                                textField({
                                    id: 'duration',
                                    title: '00:00:00',
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
                                    <input type="file" id="material" name="pdfFile" accept=".pdf" style="display:none;">
                                </label>
                            </div>
                            <div id="file-list"></div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                let $pdfDisplay = $('#pdfDisplay');
                                let $pdfInput = $('#material');
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

                                    // Get number of pages with PDF.js
                                    let reader = new FileReader();
                                    reader.onload = function(e) {
                                        let typedArray = new Uint8Array(e.target.result);

                                        pdfjsLib.getDocument({
                                            data: typedArray
                                        }).promise.then(function(pdf) {
                                            $fileList.append('<br>File Pages: ' + pdf.numPages);
                                        }).catch(function(error) {
                                            console.error("PDF.js error:", error);
                                            $fileList.append('<br>Could not read number of pages.');
                                        });
                                    };
                                    reader.readAsArrayBuffer(file);
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