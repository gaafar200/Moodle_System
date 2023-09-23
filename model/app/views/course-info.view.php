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
                                                <input type="text" placeholder="Search..."
                                                    class="search-int form-control" name="search">
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
                                        <div class="blog-image">
                                            <a href="#"><img src="<?= ASSETS ?>img/blog-details/1.jpg" alt="" />
                                            </a>
                                            
                                        </div>

                                        <div class="blog-details blog-sig-details">
                                            <div class="details-blog-dt blog-sig-details-dt courses-info mobile-sm-d-n">
                                                <span><a href="#"><i class="fa fa-user"></i> <b>Course Name:</b> <?= ucwords($courseDetails[0]->name) ?></a></span>
                                                <span><a href="<?= ROOT ?>Professor/profile/<?= $courseDetails[0]->username ?>"><i class="fa fa-comments-o"></i> <b>Professor
                                                            Name:</b> <?= ucfirst($courseDetails[0]->f_name) . " " . ucfirst($courseDetails[0]->l_name) ?></a></span>
                                                <?php if($user->rank == "admin"): ?>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Course Actions
                                                        </button>
                                                        <div  class=" dropdown-menu ">
                                                            <a href="<?= ROOT ?>Course/addStudents/<?= $courseDetails[0]->id ?>"><button  type="button" class="btn btn-custon-rounded-four btn-success style-btn">Add Student</button></a>
                                                            <a href="<?= ROOT ?>Course/removeStudents/<?= $courseDetails[0]->id ?>" ><button  type="button" class="btn btn-custon-rounded-four btn-success style-btn">Remove Student</button></a>
                                                        </div>
                                                    </div>
                                                <?php elseif($user->rank == "lecturer"): ?>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Course Actions
                                                        </button>
                                                        <div  class=" dropdown-menu ">
                                                            <a href="<?= ROOT ?>Announcement/<?= $courseDetails[0]->id ?>"><button  type="button" class="btn btn-custon-rounded-four btn-success style-btn">Announcement Controll</button></a>
                                                            <a href="<?= ROOT ?>Assignment/<?= $courseDetails[0]->id ?>"><button  type="button" class="btn btn-custon-rounded-four btn-success style-btn">Assignment Control</button></a>
                                                            <a href="<?= ROOT ?>Quiz/<?= $courseDetails[0]->id ?>"><button  type="button" class="btn btn-custon-rounded-four btn-success style-btn">Quizes Control</button></a>
                                                            <a href="<?= ROOT ?>Question/<?= $courseDetails[0]->id ?>"><button  type="button" class="btn btn-custon-rounded-four btn-success style-btn">Questions Control</button></a>
                                                        </div>
                                                    </div>    
                                                <?php endif; ?>
                                            </div>
                                            <h1><a class="blog-ht" href="#">Courses Description</a></h1>
                                            <p><?= ucfirst($courseDetails[0]->description) ?></p>
                                                                                                                                    <div class="course-active">
                                                <h4 class="course-active-name">Announcement</h4>
                                            </div>
                                            <div class="course-quiz-list">
                                             <?php if(is_array($courseDetails["annoucement_data"]) && !empty($courseDetails["annoucement_data"])): ?>
                                                <?php foreach ($courseDetails["annoucement_data"] as $announcement): ?>
                                            <div class="course-quiz-list">
                                                <h3><?= $announcement->title ?><h3>
                                                <p><?= $announcement->content ?></p>
                                            </div>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                            <div class="course-active">
                                                <h4 class="course-active-name">Quizzes</h4>
                                            </div>
                                            <div class="course-quiz-list">
                                             <?php if(is_array($courseDetails["quiz_data"]) && !empty($courseDetails["quiz_data"])): ?>
                                                <?php foreach ($courseDetails["quiz_data"] as $quiz): ?>
                                                    <div class="course-quiz-list-quiz">
                                                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><defs><style>.cls-1{fill:#f33;}.cls-2{fill:#fff;}</style></defs><title>48px_sourcefile_20170718_multi</title><circle class="cls-1" cx="24" cy="24.04" r="24"/><path id="path1" class="cls-2" d="M18.49,32H38.63v1.84H18.49Zm-5.89-.15A1.41,1.41,0,1,0,14,33.23,1.4,1.4,0,0,0,12.6,31.82Zm0-1.84a3.22,3.22,0,1,1-3.22,3.24A3.22,3.22,0,0,1,12.6,30Zm5.89-7.16H38.63v1.84H18.49Zm-5.89-.19A1.41,1.41,0,1,0,14,24,1.4,1.4,0,0,0,12.6,22.63Zm0-1.82A3.22,3.22,0,1,1,9.38,24,3.22,3.22,0,0,1,12.6,20.81Zm5.89-7.14H38.63v1.84H18.49Zm-5.89-.21A1.41,1.41,0,1,0,14,14.87,1.4,1.4,0,0,0,12.6,13.46Zm0-1.84a3.22,3.22,0,1,1-3.22,3.23A3.22,3.22,0,0,1,12.6,11.63Z"/></svg>
                                                        <a href="<?= ROOT ?>Quiz/quizDisplay/<?= $courseDetails[0]->id?>/<?= $quiz->id; ?>" class="course-quiz-list-link"><?= $quiz->name ?></a>
                                                    </div>
                                                <?php endforeach; ?>
                                             <?php endif; ?>
                                            </div>
                                                                                        <div class="course-active">
                                                <h4 class="course-active-name">Assignment</h4>
                                            </div>
                                            <div class="course-quiz-list">
                                             <?php if(is_array($courseDetails["assignment_data"]) && !empty($courseDetails["assignment_data"])): ?>
                                                <?php foreach ($courseDetails["assignment_data"] as $assignment): ?>
                                                    <div class="course-quiz-list-quiz">
                                                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48"><defs><style>.cls-1{fill:#06c;}.cls-2{fill:#fff;}</style></defs><title>48px_sourcefile_20170718_multi</title><circle class="cls-1" cx="24" cy="24" r="24"/><path id="path1" class="cls-2" d="M33.53,27.56l1.29,1.29-5.89,5.89-3.47-3.47L26.76,30l2.18,2.18Zm-3.38-2.81a6.39,6.39,0,1,0,6.39,6.39A6.4,6.4,0,0,0,30.15,24.75ZM24.68,13.24v3.28H28l-.39-.39ZM13.71,12V33h8.42l0-.17a8.08,8.08,0,0,1-.17-1.65A8.22,8.22,0,0,1,29.1,23l.15,0V18.36H23.78a.92.92,0,0,1-.92-.92V12Zm10-1.84a.64.64,0,0,1,.26,0h0l0,0,0,0h0l.11.06h0l0,0,0,0,0,0,.06.06h0l4.91,4.91,1.48,1.48h0l0,0h0l0,0,0,0,0,0,0,0v0h0l0,0,0,0,0,0,0,0h0v.11h0l0,0v5.76l.11,0A8.23,8.23,0,1,1,22.8,35l-.13-.26H12.79a.92.92,0,0,1-.92-.92V11a.92.92,0,0,1,.92-.92Z"/></svg>
                                                        <a href="<?= ROOT ?>StudentAssignments/assignmentDisplay/<?= $courseDetails[0]->id?>/<?= $assignment->id; ?>" class="course-quiz-list-link"><?= $assignment->name ?></a>
                                                    </div>
                                                <?php endforeach; ?>
                                             <?php endif; ?>
                                            </div>
                                                                                        </div>

                                        </div>
                                        <div>
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
