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
    <div class="container-fluid ">
        <div class="row " style="margin-top:100px ;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">
                    <form action="" method="POST" class="dropzone-custom needsclick add-professors" id="demo1-upload">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="quiz-name">Quiz Name</label>
                                    <input required value="<?= DisplaySetQuizName($old_data) ?>" name="quiz_name" type="text" id="quiz-name" class="form-control" placeholder="Quiz Name">
                                    <?php if (isset($errors) && isset($errors["quiz_name"])): ?>
                                        <em for="quiz_name" class="invalid"><?= ucfirst($errors["quiz_name"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input required value="<?= displayQuizSetDate($old_data) ?>" name="date" type="date" class="form-control" placeholder="Date">
                                    <?php if (isset($errors) && isset($errors["date"])): ?>
                                        <em for="date" class="invalid"><?= ucfirst($errors["date"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="start-time">Start Time</label>
                                    <input required value="<?= displaySetQuizStartTime($old_data) ?>" name="start_time" type="time" id="start-time" class="form-control" placeholder="Start Time">
                                    <?php if (isset($errors) && isset($errors["start_time"])): ?>
                                        <em for="start_time" class="invalid"><?= ucfirst($errors["start_time"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="end-time">End Time</label>
                                    <input required value="<?= displaySetQuizEndTime($old_data) ?>" name="end_time" type="time" id="end-time" class="form-control" placeholder="End Time">
                                    <?php if (isset($errors) && isset($errors["end_time"])): ?>
                                        <em for="end_time" class="invalid"><?= ucfirst($errors["end_time"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="end-time">Number Of Questions</label>
                                    <input required value="<?= displaySetQuizNumberOfQuestions($old_data) ?>" name="number_of_questions" type="number" id="number-of-questions" class="form-control" placeholder="Number Of Questions">
                                    <?php if (isset($errors) && isset($errors["number_of_questions"])): ?>
                                        <em for="number_of_questions" class="invalid"><?= ucfirst($errors["number_of_questions"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="final-mark">Quiz Time</label>
                                    <input required value="<?= displaySetQuizTime($old_data) ?>" name="time" type="number" id="final-mark" class="form-control" placeholder="Enter the Number of minutes for the quiz">
                                    <?php if (isset($errors) && isset($errors["time"])): ?>
                                        <em for="time" class="invalid"><?= ucfirst($errors["time"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="final-mark">Mark Value</label>
                                    <input required value="<?= displaySetMarkValue($old_data) ?>" name="mark_value" type="number" id="final-mark" class="form-control" placeholder="Enter the Final Mark Of the Quiz">
                                    <?php if (isset($errors) && isset($errors["time"])): ?>
                                        <em for="time" class="invalid"><?= ucfirst($errors["time"]) ?></em>
                                    <?php endif; ?> 
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="number-of-attempts">Number Of
                                        Attempts</label>
                                    <input required value="<?= displaySetQuizNumberOfAttempts($old_data) ?>" name="max_attempts" type="number" id="number-of-attempts" class="form-control" placeholder="Number Of Attempts">
                                    <?php if (isset($errors) && isset($errors["max_attempts"])): ?>
                                        <em for="max_attempts" class="invalid"><?= ucfirst($errors["max_attempts"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="move-between-questions">Move Between
                                        Questions</label>
                                    <select required name="is_recursive" id="move-between-questions" class="form-control">
                                        <option value="none" selected="" disabled="">
                                            Move between questions</option>
                                        <option value="no" <?= checkQuizMultibleChoiceValue($old_data, "is_auto_correct", "no") ?> >No</option>
                                        <option value="yes" <?= checkQuizMultibleChoiceValue($old_data, "is_auto_correct", "yes") ?> >Yes</option>
                                    </select>
                                    <?php if (isset($errors) && isset($errors["is_recursive"])): ?>
                                        <em for="is_recursive" class="invalid"><?= ucfirst($errors["is_recursive"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="auto-correct">Auto Correct</label>
                                    <select required name="is_auto_correct" class="form-control" id="auto-correct">
                                        <option value="none" selected="" disabled="">
                                            Auto Correct</option>
                                        <option value="no" <?= checkQuizMultibleChoiceValue($old_data, "is_auto_correct", "no") ?>>No</option>
                                        <option value="yes" <?= checkQuizMultibleChoiceValue($old_data, "is_auto_correct", "yes") ?> >Yes</option>
                                    </select>
                                    <?php if (isset($errors) && isset($errors["is_quto_correct"])): ?>
                                        <em for="is_quto_correct" class="invalid"><?= ucfirst($errors["is_quto_correct"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="auto-correct">Are Questions Shuffled</label>
                                    <select required name="is_shuffled" class="form-control" id="auto-correct">
                                        <option value="none" selected="" disabled="">
                                            Are Questions Shuffled</option>
                                        <option <?= checkQuizMultibleChoiceValue($old_data, "is_shuffled", "no") ?>  value="no">No</option>
                                        <option <?= checkQuizMultibleChoiceValue($old_data, "is_shuffled", "yes") ?>  value="yes">Yes</option>
                                    </select>
                                    <?php if (isset($errors) && isset($errors["is_shuffled"])): ?>
                                        <em for="is_shuffled" class="invalid"><?= ucfirst($errors["is_shuffled"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group">
                                    <label for="auto-correct">Are Marks Disclosed</label>
                                    <select required name="is_disclosed" class="form-control" id="auto-correct">
                                        <option  value="none" selected="" disabled="">
                                            Are Marks Disclosed</option>
                                        <option <?= checkQuizMultibleChoiceValue($old_data, "is_disclosed", "no") ?> value="no">No</option>
                                        <option <?= checkQuizMultibleChoiceValue($old_data, "is_disclosed", "yes") ?> value="yes">Yes</option>
                                    </select>
                                    <?php if (isset($errors) && isset($errors["is_disclosed"])): ?>
                                        <em for="is_disclosed" class="invalid"><?= ucfirst($errors["is_disclosed"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group res-mg-t-15">
                                    <label for="description-quiz">Description</label>
                                    <textarea required name="description" id="description-quiz" placeholder="Description"><?= displaySetDescription($old_data) ?></textarea>
                                    <?php if (isset($errors) && isset($errors["description"])): ?>
                                        <em for="description" class="invalid"><?= ucfirst($errors["description"]) ?></em>
                                    <?php endif; ?> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Set Quiz</button>
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