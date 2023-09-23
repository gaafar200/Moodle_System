<?php $this->view("include/header",["pageName"=>$pageName]); ?>
<?php $this->view("include/sidebar"); ?>
<?php $this->view("include/upbar",["user"=>$user]); ?>
<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul class="collapse dropdown-header-top">
                                    <li><a href="index.html">Dashboard</a></li>
                                </ul>
                            </li>

                            <li><a data-toggle="collapse" data-target="#demoevent" href="#">Professors <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="demoevent" class="collapse dropdown-header-top">
                                    <li><a href="all-professors.html">All Professors</a>
                                    </li>
                                    <li><a href="add-professor.html">Add Professor</a>
                                    </li>
                                    <li><a href="edit-professor.html">Edit Professor</a>
                                    </li>
                                    <li><a href="professor-profile.html">Professor Profile</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#demopro" href="#">Students <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="demopro" class="collapse dropdown-header-top">
                                    <li><a href="all-students.html">All Students</a>
                                    </li>
                                    <li><a href="add-student.html">Add Student</a>
                                    </li>
                                    <li><a href="edit-student.html">Edit Student</a>
                                    </li>
                                    <li><a href="student-profile.html">Student Profile</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#democrou" href="#">Courses <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="democrou" class="collapse dropdown-header-top">
                                    <li><a href="all-courses.html">All Courses</a>
                                    </li>
                                    <li><a href="add-course.html">Add Course</a>
                                    </li>
                                    <li><a href="edit-course.html">Edit Course</a>
                                    </li>
                                    <li><a href="course-info.html">Courses Info</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#demo" href="#">Mailbox <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="demo" class="collapse dropdown-header-top">
                                    <li><a href="mailbox.html">Inbox</a>
                                    </li>
                                    <li><a href="mailbox-view.html">View Mail</a>
                                    </li>
                                    <li><a href="mailbox-compose.html">Compose Mail</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="Pagemob" class="collapse dropdown-header-top">
                                    <li><a href="login.html">Login</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->
<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list single-page-breadcome" style="margin-top:  10vh;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <form role="search" class="sr-input-func">
                                    <input type="text" placeholder="Search..." class="search-int form-control"
                                        name="search">
                                    <a><button type="submit" class="pro-5"><i class="fa fa-search"></i></button></a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Course Info</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="blog-details-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-details-inner change-background">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            

                            <div class="latest-blog-single blog-single-full-view">
                                    <div class="questions-page-wrapper">
        <div class="course-name-wrapper">
            <h4 class=course-name>Digital Electronics</h4>
        </div>
        <div class="questions-page-container">
            <form class="form-questions" method="POST">
                <div class="questions-page-questions">
                    <?php $count = 1 ?>
                    <?php foreach ($student_quiz_details["quiz_questions"] as $studentquestion): ?>
                    <div class="questions-page-question-wrapper">
                        <div class="questions-page-question-details">
                            <span class="questions-page-question-details-number">Question <span><?= $count++ ?></span></span>
                            <span class="questions-page-question-details-mark"><span><?= $studentquestion->mark_value ?></span> mark</span>
                        </div>
                        <div class="questions-page-question-container">
                            <?php if($studentquestion->photo): ?>
                                <img class="questions-page-question-container-img"
                                    src="<?= $studentquestion->photo ?>"
                                    alt="">
                            <?php endif; ?>
                            <span class="questions-page-question"><?= $studentquestion->question ?></span>
                                <?php if($studentquestion->question_type == "multiableChoice" || $studentquestion->question_type == "trueOrFalse" ): ?>
                                <span class="questions-page-question-select">Select one:</span>
                                <div class="questions-page-question-choices">
                                    <?php $choice_count = 1 ?>
                                    <?php foreach ($studentquestion->choices as $choice): ?>
                                        <div onclick="document.getElementById('<?=   $studentquestion->id . 'choice-' . $choice_count ?>').click()" class="questions-page-question-choice-one">
                                            <input <?= checkQuestionSelected($choice) ?> type="radio" id="<?= $studentquestion->id ?>choice-<?= $choice_count++ ?>">
                                            <label  for="<?= $studentquestion->id ?>choice-<?= $choice_count++ ?>"><?= $choice->choice ?></label>
                                        </div>
                                    <?php endforeach;  ?>
                            </div>
                            <?php elseif ($studentquestion->question_type == "essayQuestion"): ?>
                                    <div class="course-quiz-list-quiz">
                                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 48 48"><defs><style>.cls-1,.cls-4{fill:#da251c;}.cls-2{fill:#fff;}.cls-3{fill:none;}.cls-4{isolation:isolate;font-size:6.75px;font-family:ArialRoundedMTBold, Arial Rounded MT Bold;}</style></defs><title>48px_sourcefile_20170718_multi</title><circle class="cls-1" cx="24.11" cy="24" r="24"/><path id="path1" class="cls-2" d="M23.34,32.91c.58,0,.94.28.94.79s-.39.84-1,.84a1.34,1.34,0,0,1-.41,0V32.93ZM15,11.59v18.6H33.17v-13H27.43V11.59ZM13,9.38H28.61l6.66,6.51V38.63H13Z"/><rect class="cls-3" x="16.82" y="31.93" width="26.06" height="8.81"/><text class="cls-4" transform="translate(16.82 36.84)">PDF</text><path id="path1-2" data-name="path1" class="cls-2" d="M19.76,24.07a3.64,3.64,0,0,0-1.65,1.2c0-.06-.09.11-.09.11l.09-.11a.78.78,0,0,1-.06.17c-.15.38.3.38.3.38C19.61,25.61,19.76,24.07,19.76,24.07ZM27,22.78a3.34,3.34,0,0,0-.37,0,3.13,3.13,0,0,0,2.59.9c.51-.08-.26-.54-.26-.54A5,5,0,0,0,27,22.78Zm-4.58-3.17a11.48,11.48,0,0,1-1.09,3.26l3.36-.54A14.24,14.24,0,0,1,22.41,19.61ZM22.48,15h0c-.06,0-.09.06-.13.15a5.69,5.69,0,0,0,.26,2.47,4.17,4.17,0,0,0,.09-2.16S22.61,15,22.48,15Zm-.43-1c.36,0,.67.73.67.73a4.16,4.16,0,0,1,.06,3.77,9,9,0,0,0,3,3.84,9,9,0,0,1,3.34.41c1.11.62.73,1.22.73,1.22-1.16,1.39-4.57-.79-4.57-.79l-4.39.79a4.19,4.19,0,0,1-2.76,2.89c-1,.15-.88-1-.88-1A4.15,4.15,0,0,1,20,23.53c.79-.9,2.06-5.12,2.06-5.12-1.29-3.11-.37-4.16-.37-4.16C21.83,14,21.94,14,22.05,13.93Z"/></svg>
                                        <?php $filename = getFileNameFromPath($studentquestion->answer[0]->File) ?>
                                        <a  href="<?= ROOT ?>StudentQuizes/download/<?= $filename  ?>/<?= $studentquestion->answer[0]->name  ?>" class="course-quiz-list-link"><?= $studentquestion->answer[0]->name ?></a>
                                    </div>
                            <?php endif; ?>
                            <div class="form-group" style='color:blue ;font-weight: bold; font-size: 1.6rem;'>
                                    <label for="mark1">Mark</label>
                                    <input id ='mark1' required name="<?= $studentquestion->student_quiz_question ?>" value="<?= getCurrentMarkOfAQuestion($studentquestion->question_type,$studentquestion->is_solved,$studentquestion->grade) ?>" type="number" class="form-control" placeholder="Mark" style="font-size: 1rem;">
                            </div>
                            <?php if (isset($errors) && isset($errors[$studentquestion->student_quiz_question])): ?>
                                    <em for="<?= $studentquestion->student_quiz_question ?>" class="invalid"><?= ucfirst($errors[$studentquestion->student_quiz_question]) ?></em>
                                <?php endif; ?>  

                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="questions-page-move-next">
                        Finish Manual Mark
                    </button>
                </div>
            </form>
            <div class="quiz-navigation">
                <span class="quiz-navigation-title">Quiz navigation</span>
                <img src="<?= $student_quiz_details["student_data"][0]->photo ?>"
                    alt="">
                <span class="quiz-navigation-name"><?= $student_quiz_details["student_data"][0]->f_name . " "  . $student_quiz_details["student_data"][0]->l_name ?></span>
                <div class="quiz-navigation-questions">
                    <?php for($i = 1; $i <= sizeof($student_quiz_details["quiz_questions"]);$i++): ?>
                    <span class="quiz-navigation-questions-number">
                        <a href=""><?= $i ?></a>
                    </span>
                    <?php endfor; ?>
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
</div>
</div>

<?php $this->view("include/footer"); ?>