<?php $this->view("include/header",["pageName"=>$pageName]); ?>
<?php  $this->view("include/sidebar");?>
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
                            <div class="breadcome-list" style="margin-top:  10vh;">
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
                                            <li><span class="bread-blod">All Courses</span>
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
        <div class="courses-area">
             <div id="id01" class="modal-delete">
                        <span class="close-delete" title="Close Modal">×</span>
                        <form class="modal-content" action="/action_page.php">
                            <div class="container-delete">
                            <h1>Delete Course</h1>
                            <p>Are you sure you want to delete course?</p>

                            <div class="clearfix">
                                <button class="btn-delete cancelbtn" type="button" >Cancel</button>
                                <a  href="">
                                     <button class="btn-delete deletebtn" type="button">Delete</button>
                                </a>

                            </div>
                            </div>
                        </form>
                </div>
            <div class="container-fluid">
                <div class="row">
                    <?php if(isset($coursesData) && is_array($coursesData)): ?>
                    <?php foreach ($coursesData as $course): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 center pro-1">
                            <div class="courses-inner res-mg-b-30 pro-2">
                                <div class="courses-title pro-2">
                                    <a href="<?= ROOT ?>Course/info/<?= $course->id ?>"><img  class="img-rounded m-b pro-3" src="<?= $course->photo ?>" alt=""></a>
                                    <h2><?= $course->name ?></h2>
                                </div>
                                <div class="course-des pro-2">
                                    <p><span><i class="fa fa-clock"></i></span> <b>Professor:</b> <?= $course->f_name . " " . $course->l_name ?></p>
                                    <p><span><i class="fa fa-clock"></i></span> <b>Students:</b> <?= $course->students ?></p>
                                </div>
                                <div class="btn1Courses">
                                    <a href="<?= ROOT ?>Course/info/<?= $course->id ?>"> <button  type="button" class="btn btn-custon-rounded-four btn-primary btnWidth">Read More</button></a>
                                    <?php if(checkAuthorization("technical")): ?>
                                        <a href="<?= ROOT ?>Course/delete/<?= $course->id ?>"><button  type="button" id="001" value="<?= $course->id ?>" class="btn btn-custon-rounded-four btn-danger btnWidth">Delete</button></a>
                                    <?php endif; ?>
                                    </div>
                                    <?php if(checkAuthorization("technical")): ?>
                                        <div class="btn1Courses">

                                            <a href="<?= ROOT ?>Course/edit/<?= $course->id ?>"><button type="button" class="btn btn-custon-rounded-four btn-success btnWidth">Edit</button></a>

                                        </div>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="container-fluid">
                            <h3 style="margin-left: auto">No Courses To display</h3>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <script>

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php $this->view("include/footer"); ?>

