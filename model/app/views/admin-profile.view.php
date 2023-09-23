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
                <div class="breadcome-list single-page-breadcome" style="margin-top: 10vh;">
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
                                <li><span class="bread-blod">Professor Profile</span>
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
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="profile-info-inner">
                    <div class="profile-img">
                        <img src="<?= $user->photo?>" alt="" />
                    </div>
                    <div class="profile-details-hr">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                <div class="address-hr">
                                    <p><b>Name</b><br /><?= $user->f_name. " "  . $user->l_name ?></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                    <p><b>Designation</b><br /><?= $user->rank ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                <div class="address-hr">
                                    <p><b>Email ID</b><br /><?= $user->email ?></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                    <p><b>Phone</b><br /><?= $user->phone_number ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="address-hr">
                                    <p><b>Address</b><br /><?= $user->address ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                    <ul id="myTabedu1" class="tab-review-design">
                        <li><a href="#reviews"> Biography</a></li>
                        <li><a href="#INFORMATION">Update Details</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade" id="reviews">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <div class="address-hr biography">
                                                    <p><b>Full Name</b><br /> Fly Zend</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <div class="address-hr biography">
                                                    <p><b>Mobile</b><br /> 01962067309</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <div class="address-hr biography">
                                                    <p><b>Email</b><br /> fly@gmail.com</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <div class="address-hr biography">
                                                    <p><b>Location</b><br /> UK</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="content-profile">
                                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate
                                                        eget, arcu. In enim justo, rhoncus ut, imperdiet a,
                                                        venenatis vitae, justo. Nullam dictum felis eu pede
                                                        mollis pretium. Integer tincidunt.Cras
                                                        dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                                        eleifend tellus. Aenean leo ligula, porttitor eu,
                                                        consequat vitae, eleifend ac, enim.</p>
                                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate
                                                        eget, arcu. In enim justo, rhoncus ut, imperdiet a,
                                                        venenatis vitae, justo. Nullam dictum felis eu pede
                                                        mollis pretium. Integer tincidunt.Cras
                                                        dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                                        eleifend tellus. Aenean leo ligula, porttitor eu,
                                                        consequat vitae, eleifend ac, enim.</p>
                                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate
                                                        eget, arcu. In enim justo, rhoncus ut, imperdiet a,
                                                        venenatis vitae, justo. Nullam dictum felis eu pede
                                                        mollis pretium. Integer tincidunt.Cras
                                                        dapibus. Vivamus elementum semper nisi. Aenean vulputate
                                                        eleifend tellus. Aenean leo ligula, porttitor eu,
                                                        consequat vitae, eleifend ac, enim.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mg-b-15">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="skill-title">
                                                            <h2>Skill Set</h2>
                                                            <hr />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress-skill">
                                                    <h2>Java</h2>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 90%;"
                                                             class="progress-bar progress-yellow"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-skill">
                                                    <h2>Php</h2>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 80%;"
                                                             class="progress-bar progress-green"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-skill">
                                                    <h2>Apps</h2>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 70%;"
                                                             class="progress-bar progress-blue"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-skill">
                                                    <h2>C#</h2>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 60%;"
                                                             class="progress-bar progress-red"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mg-b-15">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="skill-title">
                                                            <h2>Education</h2>
                                                            <hr />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ex-pro">
                                                    <ul>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mg-b-15">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="skill-title">
                                                            <h2>Experience</h2>
                                                            <hr />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ex-pro">
                                                    <ul>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="skill-title">
                                                            <h2>Subjects</h2>
                                                            <hr />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ex-pro">
                                                    <ul>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor
                                                            sit amet, consectetur adipiscing elit.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="INFORMATION">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input name="number" type="text" class="form-control"
                                                           placeholder="First Name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                           placeholder="Last Name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                           placeholder="Address">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                           placeholder="Date of Birth">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                           placeholder="Department">
                                                </div>
                                                <div class="form-group">
                                                    <input type="number" class="form-control"
                                                           placeholder="Pincode">
                                                </div>
                                                <div class="file-upload-inner ts-forms">
                                                    <div class="input prepend-big-btn">
                                                        <label class="icon-right" for="prepend-big-btn">
                                                            <i class="fa fa-download"></i>
                                                        </label>
                                                        <div class="file-button">
                                                            Browse
                                                            <input type="file"
                                                                   onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                                        </div>
                                                        <input type="text" id="prepend-big-btn"
                                                               placeholder="no file selected">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group sm-res-mg-15 tbpf-res-mg-15">
                                                    <input type="text" class="form-control"
                                                           placeholder="Description">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option>Select Gender</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option>Select country</option>
                                                        <option>India</option>
                                                        <option>Pakistan</option>
                                                        <option>Amerika</option>
                                                        <option>China</option>
                                                        <option>Dubai</option>
                                                        <option>Nepal</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option>Select state</option>
                                                        <option>Gujarat</option>
                                                        <option>Maharastra</option>
                                                        <option>Rajastan</option>
                                                        <option>Maharastra</option>
                                                        <option>Rajastan</option>
                                                        <option>Gujarat</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option>Select city</option>
                                                        <option>Surat</option>
                                                        <option>Baroda</option>
                                                        <option>Navsari</option>
                                                        <option>Baroda</option>
                                                        <option>Surat</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                           placeholder="Website URL">
                                                </div>
                                                <input type="number" class="form-control"
                                                       placeholder="Mobile no.">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="payment-adress mg-t-15">
                                                    <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light mg-b-15">Submit</button>
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

