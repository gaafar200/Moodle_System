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
        </div>
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st" style="margin-top:100px ;">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Edit Basic Information</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form  class="dropzone dropzone-custom needsclick add-professors" method="POST" enctype="multipart/form-data"
                                                        id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input name="firstname" type="text"
                                                                        class="form-control" placeholder="First Name" value="<?= displayFirstName($studData) ?>" >
                                                                    <?php if (isset($errors) && isset($errors["name"])): ?>
                                                                        <em for="firstname" class="invalid"><?= ucfirst($errors["name"]) ?></em>
                                                                    <?php endif; ?>
                                                                </div>
                                                                    <div class="form-group">
                                                                    <input name="lastname" type="text"
                                                                        class="form-control" placeholder="Last Name" value="<?= displayLastName($studData) ?>">
                                                                    <?php if (isset($errors) && isset($errors["name"])): ?>
                                                                        <em for="lastname" class="invalid"><?= ucfirst($errors["name"]) ?></em>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="address" type="text"
                                                                        class="form-control" placeholder="Address" value="<?= displayAddress($studData) ?>">
                                                                    <?php if (isset($errors) && isset($errors["address"])): ?>
                                                                            <em for="address" class="invalid"><?= ucfirst($errors["address"]) ?></em>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="gender">
                                                                        <option>Select Gender</option>
                                                                        <option value="male" <?= displayGender($studData,"male") ?>>Male</option>
                                                                        <option value="female" <?= displayGender($studData,"female") ?>>Female</option>
                                                                    </select>
                                                                    <?php if (isset($errors) && isset($errors["gender"])): ?>
                                                                            <em for="gender" class="invalid"><?= ucfirst($errors["gender"]) ?></em>
                                                                    <?php endif; ?>
                                                                    
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="mobileno" type="number"
                                                                        class="form-control" placeholder="Mobile no." value="<?= displayMobileNumber($studData) ?>">
                                                                    <?php if (isset($errors) && isset($errors["mobile"])): ?>
                                                                        <em for="mobileno" class="invalid"><?= ucfirst($errors["mobile"]) ?></em>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="form-group alert-up-pd">
                                                                                                                                        <label for="images" class="drop-container">
                                                                    <span class="drop-title">Drop files here</span>
                                                                    or
                                                                    <input type="file" name="image" id="images" accept="image/*" >
                                                                    <?php if (isset($errors) && isset($errors["image"])): ?>
                                                                            <em for="image" class="invalid"><?= ucfirst($errors["image"]) ?></em>
                                                                    <?php endif; ?>
                                                                    </label>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="email"
                                                                        placeholder="Email" value="<?= displayEmailAddress($studData) ?>">
                                                                    <?php if (isset($errors) && isset($errors["email"])): ?>
                                                                            <em for="email" class="invalid"><?= ucfirst($errors["email"]) ?></em>
                                                                    <?php endif; ?>    
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="username" type="text"
                                                                        class="form-control" placeholder="User Name" value="<?= displayUserName($studData) ?> "<?= setUserName($studData) ?>>
                                                                </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress">
                                                                    <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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

