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




        <div class="blog-details-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="blog-details-inner">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="latest-blog-single blog-single-full-view">
                                    <div class="quiz-wrapper">
                                        <div class="course-name-wrapper">
                                            <h4 class="course-name"><?= ucwords($course_name) ?></h4>
                                        </div>
                                        <div class="quiz-details-wrapper">
                                            <div class="quiz-details-one">
                                            <span class="quiz-details-one-name"><?= $assignmentDetails[0]->name ?></span>
                                            <p class="quiz-details-one-description"><?= $assignmentDetails[0]->description ?></p>
                                            </div>

                                        <div class="quiz-details-three">
                                                <span class="quiz-details-three-summary">
                                                    Submission status
                                                </span>
                                                <table class="assignment-details">
                                                    <tr>
                                                        <td class="assignment-label">Attempt number</td>
                                                        <td>This is attempt <?= diplayAttemptNumber($studnetAssignmentDetails) ?> (<?= $assignmentDetails[0]->max_attempts ?> attempts allowed)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="assignment-label">Submission status</td>
                                                        <?php $filename = getFileNameFromPath($assignmentDetails[0]->assignment_material) ?>
                                                        <td><a href="<?= ROOT ?>StudentAssignments/download/<?= $filename ?>/<?= displayAssignmentSubmision($last_attempt) ?>"><?= displayAssignmentSubmision($last_attempt) ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="assignment-label">Grading status</td>
                                                        <td><?= displayGradeInfo($last_attempt) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="assignment-label">Due date</td>
                                                        <td><?= displayAssignmentDeadLine($assignmentDetails[0]->deadline) ?>, 12:00 AM</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="assignment-label">Time remaining</td>
                                                        <td><?= displayAssignmentRemainingTime($assignmentDetails[0]->deadline) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="assignment-label">Last modified</td>
                                                        <td>-</td>
                                                    </tr>
                                                </table>
                                                </div>

                                                <div class="quiz-details-four">
                                                    <?php 
                                                        $assignment = new Assignments();
                                                        if($assignment->canAddAssignment($user) && $studnetAssignmentDetails[0]->last_attempt < $assignmentDetails[0]->max_attempts):
                                                    ?>    
                                                        <a href="<?= ROOT ?>StudentAssignments/add/<?= $assignmentDetails[0]->id ?>/<?= $course_id ?>"><button class="quiz-details-four-attempt">Add submission</button></a>
                                                    <?php endif; ?>    
                                                <a href="<?= ROOT ?>course/info/<?= $course_id ?>"><button class="quiz-details-four-back">Back to the course</button></a>
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

</div>
<?php $this->view("include/footer"); ?>