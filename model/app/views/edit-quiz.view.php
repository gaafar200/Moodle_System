<?php $this->view("include/header", ["pageName" => $pageName]); ?>
<?php $this->view("include/sidebar"); ?>
<?php $this->view("include/upbar", ["user" => $user]); ?>

    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                    <ul class="collapse dropdown-header-top">
                                        <li><a href="index.html">Dashboard</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demoevent" href="#">Professors <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
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
                                <li><a data-toggle="collapse" data-target="#demopro" href="#">Students <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
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
                                <li><a data-toggle="collapse" data-target="#democrou" href="#">Courses <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
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
                                <li><a data-toggle="collapse" data-target="#demo" href="#">Mailbox <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                    <ul id="demo" class="collapse dropdown-header-top">
                                        <li><a href="mailbox.html">Inbox</a>
                                        </li>
                                        <li><a href="mailbox-view.html">View Mail</a>
                                        </li>
                                        <li><a href="mailbox-compose.html">Compose Mail</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
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
    </div>
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">
                    <form action="" method="POST" class=" needsclick add-professors" id="demo1-upload">
                        <div class="row" style="margin-top:100px ;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="quiz-name">Quiz Name</label>
                                    <input required name="quiz_name" value="<?= displayQuizName($quiz_date) ?>" type="text" id="quiz-name" class="form-control" placeholder="Quiz Name">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input required name="date" value="<?= displayQuizDate($quiz_date) ?>" type="date" class="form-control" placeholder="Date">
                                </div>
                                <div class="form-group">
                                    <label for="start-time">Start Time</label>
                                    <input required name="start_time" value="<?= displayQuizStartTime($quiz_date) ?>" type="time" id="start-time" class="form-control" placeholder="Start Time">
                                </div>
                                <div class="form-group">
                                    <label for="end-time">End Time</label>
                                    <input required name="end_time" value="<?= displayQuizEndTime($quiz_date) ?>" type="time" id="end-time" class="form-control" placeholder="End Time">
                                </div>
                                <div class="form-group">
                                    <label for="end-time">Number Of Questions</label>
                                    <input required name="number_of_questions" value="<?= displayQuizNumberOfQuestions($quiz_date) ?>" type="number" id="number-of-questions" class="form-control" placeholder="Number Of Questions">
                                </div>
                                <div class="form-group">
                                    <label for="final-mark">Quiz Time</label>
                                    <input required name="time" value="<?= displayQuizTime($quiz_date) ?>" type="number"  id="final-mark" class="form-control" placeholder="Enter the Number of minutes for the quiz">
                                </div>
                                <div class="form-group">
                                    <label for="final-mark">Mark Value</label>
                                    <input required name="mark_value" value="<?= displayQuizMark($quiz_date) ?>" type="number" id="final-mark" class="form-control" placeholder="Enter the Final Mark Of the Quiz">
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="number-of-attempts">Number Of
                                        Attempts</label>
                                    <input required name="max_attempts" value="<?= displayQuizMaxAttempts($quiz_date) ?>" type="number" id="number-of-attempts" class="form-control" placeholder="Number Of Attempts">
                                </div>
                                <div class="form-group">
                                    <label for="move-between-questions">Move Between
                                        Questions</label>
                                    <select required name="is_recursive" id="move-between-questions" class="form-control">
                                        <option value="none" selected="" disabled="">
                                            Move between questions</option>
                                        <option value="no" <?= checkQuizMoveBetweenQuestions($quiz_date,"no") ?>>No</option>
                                        <option value="yes" <?= checkQuizMoveBetweenQuestions($quiz_date,"yes")?> >Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="auto-correct">Auto Correct</label>
                                    <select  required name="is_auto_correct" class="form-control" id="auto-correct">
                                        <option value="no" disabled selected="">
                                            Auto Correct</option>
                                        <option value="no"  <?= checkQuizAutoCorrect($quiz_date,"no") ?>>No</option>
                                        <option <?= checkCanEditCorrection($quiz_id) ?> value="yes" <?= checkQuizAutoCorrect($quiz_date,"yes") ?>>Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="auto-correct">Are Questions Shuffled</label>
                                    <select required name="is_shuffled" class="form-control" id="auto-correct">
                                        <option value="none" selected="" disabled="">
                                            Are Questions Shuffled</option>
                                        <option value="no" <?= checkQuizShuffled($quiz_date,"no") ?>>No</option>
                                        <option value="yes" <?= checkQuizShuffled($quiz_date,"yes")?>>Yes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="auto-correct">Are Marks Disclosed</label>
                                    <select required name="is_disclosed" class="form-control" id="auto-correct">
                                        <option value="none" selected="" disabled="">
                                            Are Marks Disclosed</option>
                                        <option value="no" <?= checkQuizDisclosed($quiz_date,"no") ?>>No</option>
                                        <option value="yes" <?= checkQuizDisclosed($quiz_date,"yes")  ?>>Yes</option>
                                    </select>
                                </div>
                                <div class="form-group res-mg-t-15">
                                    <label for="description-quiz">Description</label>
                                    <textarea required name="description" id="description-quiz" placeholder="Description"><?= DisplayQuizDescription($quiz_date) ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Edit Quiz</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php $this->view("include/footer"); ?>