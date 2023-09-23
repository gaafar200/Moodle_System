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
<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list single-page-breadcome" style="margin-top:  10vh;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <form role="search" class="sr-input-func">
                                    <input type="text" placeholder="Search..." class="search-int form-control" name="search">
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
                <div class="blog-details-inner">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="latest-blog-single blog-single-full-view">
                                <div class="top-btn">
                                    <h4> Quizes List </h4>
                                    <a href="<?= ROOT ?>Quiz/set/<?= $course_id ?>"><button type="button" class="btn btn-custon-rounded-four btn-success btnWidth">Set Quiz</button></a>
                                </div>
                                <div class="table-flex">

                                    <div class="tabel-thead">
                                        <div class="td-id"> ID </div>
                                        <div class="td"> Quiz Name </div>
                                        <div class="td-flex">Quiz Date</div>
                                        <div class="td-flex">Quiz Time</div>
                                        <div class="td-flex">Quiz Mark</div>
                                        <div class="td-last justify-content-center">Actions</div>
                                    </div>

                                    <!-- ------- Here goes the loop -----  -->
                                    <?php if ($quizes_data) :
                                        $count = 1;
                                    ?>
                                        <?php foreach ($quizes_data as $quiz) : ?>
                                            <form method="POST">
                                                <div class="table-tbody mt-2">
                                                    <div class="td-id">
                                                        <span><?= $count++ ?></span>
                                                    </div>
                                                    <div class="td"><?= $quiz->name ?></div>
                                                    <div class="td-flex"><?= $quiz->date ?></div>
                                                    <div class="td-flex"><?= $quiz->time ?></div>
                                                    <div class="td-flex"><?= $quiz->mark ?></div>
                                                    <div class="td-last quiz-list-btns  ">
                                                        <a href="<?= ROOT ?>QuizQuestions/<?= $course_id ?>/<?= $quiz->id ?>"><button type="button" class="btn btn-success">Questions</button></a>
                                                        <a href="<?= ROOT ?>Quiz/edit/<?= $quiz->id ?>/<?= $course_id ?>"><button type="button" class="btn btn-success">Edit</button></a>
                                                        <a href="<?= ROOT ?>StudentQuizes/marks/<?= $quiz->id ?>/<?= $course_id ?>"><button type="button" class="btn btn-success">Marks</button></a>
                                                        <?php if ($quiz->status != "ready") : ?>
                                                            <a href="<?= ROOT ?>Quiz/activate/<?= $quiz->id ?>/<?= $course_id ?>"><button <?= isActiveButtonActive($quiz->status) ?> type="button" class="btn btn-success">Activate</button></a>
                                                        <?php else : ?>
                                                            <a href="<?= ROOT ?>Quiz/deactivate/<?= $quiz->id ?>/<?= $course_id ?>"><button type="button" class="btn btn-danger">Deactivate</button></a>
                                                        <?php endif; ?>
                                                        <form method="POST">
                                                            <input type="hidden" name="quiz_id" value="<?= $quiz->id ?>">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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




