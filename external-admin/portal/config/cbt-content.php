<?php if ($page == 'videoPageDetails') { ?>
    <div class="cbt-creation-panel">
        <div class="side-bar">
            <div class="div-in">
                <div class="video-div" id="view_cbt_video">
                    <video src="<?php echo $website_url ?>/admin/a/all-images/body-pix/default.png" id="videoDisplay" name="sub_video" controls="controls" loop="" class="video-slide"></video>
                </div>

                <div class="text-div">
                    <div class="list-div">
                        <div><i class="bi-book"></i> Exam:</div>
                        <span id="class_name">WAEC</span>
                    </div>

                    <div class="list-div">
                        <div><i class="bi-buildings"></i> Department:</div>
                        <span id="department_name">SCIENCE </span>
                    </div>

                    <div class="list-div">
                        <div><i class="bi-book"></i> Subject:</div>
                        <span id="subject_name">CHEMISTRY</span>
                    </div>

                    <div class="list-div">
                        <div><i class="bi-book"></i> Topic:</div>
                        <span id="term_name">CABLES AND CONNECTORS</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="cbt-content-div">
            <div class="title-div">
                <ul>
                    <li class="active-li" title="Question Bank" id="questionBank" onclick="_getActivePagesTab({divid: 'questionBank', page: 'questionBank', url: adminPortalLocalUrl});">Question Bank </li>
                    <li title="Quiz Questions" id="quizQuestion" onclick="_getActivePagesTab({divid: 'quizQuestion', page: 'quizQuestion', url: adminPortalLocalUrl});">Quiz Questions</li>
                    <li title="Load Question Manually" id="loadQuestionManually" onclick="_getActivePagesTab({divid: 'loadQuestionManually', page: 'loadQuestionManually', url: adminPortalLocalUrl});">Load Questions Manually</li>
                    <li title="Load Question Automatically" id="loadQuestionAutomatically" onclick="_getActivePagesTab({divid: 'loadQuestionAutomatically', page: 'loadQuestionAutomatically', url: adminPortalLocalUrl});">Load Questions Automatically</li>
                </ul>

                <div class="btn-div">
                    <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                        <i class="bi bi-x-lg"></i> Close
                    </button>
                </div>
            </div>

            <div id="getPagesDetails">
                <script>
                    _checkAll();
                </script>
                <div class="question-back-div">
                    <div class="top-div">
                        <label>
                            <input type="checkbox" id="parent">
                            <span>All Questions</span>
                        </label>
                        <div>
                            <button class="btn" id="submit_btn" title="Set Questions As Quiz" onclick="_set_questions_as_quiz('<?php echo $ids ?>');"><i class="bi-check2-circle"></i> Set Questions As Quiz</button>
                        </div>
                    </div>

                    <div class="question-body-div">
                        <div class="question-div">
                            <div class="div-in">
                                <div class="check-div">
                                    <label>
                                        <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                        <span>Question 1</span>
                                    </label>
                                    <div class="btn-div">
                                        <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                                        <button class="btn delete-btn" title="Delete Question"><i class="bi-trash"></i></button>
                                    </div>
                                </div>

                                <div class="each-question">
                                    <div class="text-div">
                                        <div>
                                            <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                                        </div>
                                        <div class="options-div">

                                            <div class="each-option">
                                                <div class="letter">A</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option correct-option">
                                                <div class="letter correct-letter">B</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">C</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">D</div>
                                                <div>House</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="question-div">
                            <div class="div-in">
                                <div class="check-div">
                                    <label>
                                        <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                        <span>Question 1</span>
                                    </label>
                                    <div class="btn-div">
                                        <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                                        <button class="btn delete-btn" title="Delete Question"><i class="bi-trash"></i></button>
                                    </div>
                                </div>

                                <div class="each-question">
                                    <div class="text-div">
                                        <div>
                                            <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                                        </div>
                                        <div class="options-div">

                                            <div class="each-option">
                                                <div class="letter">A</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option correct-option">
                                                <div class="letter correct-letter">B</div>

                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">C</div>

                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">D</div>
                                                <div>House</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="question-div">
                            <div class="div-in">
                                <div class="check-div">
                                    <label>
                                        <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                        <span>Question 1</span>
                                    </label>
                                    <div class="btn-div">
                                        <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                                        <button class="btn delete-btn" title="Delete Question"><i class="bi-trash"></i></button>
                                    </div>
                                </div>

                                <div class="each-question">
                                    <div class="text-div">
                                        <div>
                                            <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                                        </div>
                                        <div class="options-div">

                                            <div class="each-option">
                                                <div class="letter">A</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option correct-option">
                                                <div class="letter correct-letter">B</div>

                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">C</div>

                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">D</div>
                                                <div>House</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="question-div">
                            <div class="div-in">
                                <div class="check-div">
                                    <label>
                                        <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                                        <span>Question 1</span>
                                    </label>
                                    <div class="btn-div">
                                        <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                                        <button class="btn delete-btn" title="Delete Question"><i class="bi-trash"></i></button>
                                    </div>
                                </div>

                                <div class="each-question">
                                    <div class="text-div">
                                        <div>
                                            <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                                        </div>
                                        <div class="options-div">

                                            <div class="each-option">
                                                <div class="letter">A</div>
                                                <div>House</div>
                                            </div>

                                            <div class="each-option correct-option">
                                                <div class="letter correct-letter">B</div>

                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">C</div>

                                                <div>House</div>
                                            </div>

                                            <div class="each-option">
                                                <div class="letter">D</div>
                                                <div>House</div>
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

<?php if ($page == 'questionBank') { ?>
    <div class="question-back-div">
        <div class="top-div">
            <label>
                <input type="checkbox" id="parent">
                <span>All Questions</span>
            </label>
            <div>
                <button class="btn" id="submit_btn" title="Set Questions As Quiz" onclick=""><i class="bi-check2-circle"></i> Set Questions As Quiz</button>
            </div>
        </div>

        <div class="question-body-div">
            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                            <button class="btn delete-btn" title="Delete Question"><i class="bi-trash"></i></button>
                        </div>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                            <button class="btn delete-btn" title="Delete Question"><i class="bi-trash"></i></button>
                        </div>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                            <button class="btn delete-btn" title="Delete Question"><i class="bi-trash"></i></button>
                        </div>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" title="Edit Question"><i class="bi-pencil-square"></i> Edit</button>
                            <button class="btn delete-btn" title="Delete Question"><i class="bi-trash"></i></button>
                        </div>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'quizQuestion') { ?>
    <div class="question-back-div">
        <div class="top-div">
            <label>
                <span>Quiz Questions</span> |
                <div class="text"><i class="bi-clock"></i> Quiz Duration:</div>
                <span id="quiz_duration">00:00:00</span>
            </label>
            <div>
                <button class="btn" id="submit_btn" title="Set Questions As Quiz" onclick=""><i class="bi-check2-circle"></i> Activate Quiz</button>
            </div>
        </div>

        <div class="question-body-div">
            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <input type="checkbox" class="child" name="class_id[]" data-value="GEOGRAPHY">
                            <span>Question 1</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <div>
                                <p>______________ is an electronic machine that accept data, process data and provide output.</p>
                            </div>
                            <div class="options-div">

                                <div class="each-option">
                                    <div class="letter">A</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option correct-option">
                                    <div class="letter correct-letter">B</div>
                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">C</div>

                                    <div>House</div>
                                </div>

                                <div class="each-option">
                                    <div class="letter">D</div>
                                    <div>House</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'loadQuestionManually') { ?>
    <script src="js/TextEditor.js" referrerpolicy="origin"></script>

    <div class="question-back-div">
        <div class="top-div">
            <label>
                <?php if (empty($question_id)) {
                    $pageTitle = "Load Questions Manually";
                } else {
                    $pageTitle = "Update This Question";
                } ?>
                <span><?php echo $pageTitle; ?></span>
            </label>
        </div>

        <div class="question-body-div">
            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Set Question</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#question_text', // change this value according to your HTML
                                    plugins: "link, image, table"
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="question_text" title="QUIZ QUESTION" placeholder="QUIZ QUESTION"></textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option A</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_a', // change this value according to your HTML
                                    plugins: "link, image, table"
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_a" title="OPTION A" placeholder="OPTION A"></textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option B</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_b', // change this value according to your HTML
                                    plugins: "link, image, table"
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_b" title="OPTION B" placeholder="OPTION BY"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option C</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_c', // change this value according to your HTML
                                    plugins: "link, image, table"
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_c" title="OPTION C" placeholder="OPTION C"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option D</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_d', // change this value according to your HTML
                                    plugins: "link, image, table"
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_d" title="OPTION D" placeholder="OPTION D"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Option E</span>
                        </label>
                    </div>

                    <div class="each-question">
                        <div class="text-div">
                            <script>
                                tinymce.init({
                                    selector: '#option_e', // change this value according to your HTML
                                    plugins: "link, image, table"
                                });
                            </script>
                            <textarea style="width: 100%;" rows="10" id="option_e" title="OPTION E" placeholder="OPTION E"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Set Correct Option</span>
                        </label>
                    </div>

                    <div class="text_field_container" id="answer_container">
                        <script>
                            textField({
                                id: 'answer',
                                title: 'A, B, C, D, E',
                            });
                        </script>
                    </div>

                    <div class="btn-div">
                        <button class="submit-btn" id="submit_btn" title="Upload Questions" onclick=""><i class="bi-cloud-upload"></i> Upload Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'loadQuestionAutomatically') { ?>
    <div class="question-back-div">
        <div class="top-div">
            <label>
                <span>Load Questions Automatically</span>
            </label>
        </div>

        <div class="question-body-div">
            <div class="question-div">
                <div class="div-in">
                    <div class="check-div">
                        <label>
                            <span>Upload <i>(CSV Format Only)</i></span>
                        </label>
                        <div class="btn-div">
                            <button class="btn" type="button" id="submit_btn" title="Download Question Template" onclick="_download_question_template();"><i class="bi-download"></i> Download Question Template</button>
                        </div>
                    </div>

                    <div class="input-container">
                        <input id="quiz_question_template" name="quiz_question_template" type="file" class="cbt_text_field" placeholder="Choose File (.CSV)" title="Choose File (.CSV)" accept=".csv" />
                    </div>

                    <div class="btn-div">
                        <button class="submit-btn" id="submit_btn" title="Upload Questions" onclick=""><i class="bi-cloud-upload"></i> Upload Questions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>