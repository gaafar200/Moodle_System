<!-- Start Left menu area -->
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="<?= ROOT ?>Home"><img class="main-logo" src="<?= ASSETS ?>img/logo/logo.png" alt="" style="width: 80px;" /></a>
            <strong><a href="<?= ROOT ?>Home"><img src="<?= ASSETS ?>img/logo/logosn.png" alt="" style="width: 80px;" /></a></strong>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    <li class="active">
                        <a class="has-arrow" href="<?= ROOT ?>Home">
                            <span class="educate-icon educate-home icon-wrap"></span>
                            <span class="mini-click-non">Education</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Dashboard v.1" href="<?= ROOT ?>Home"><span
                                        class="mini-sub-pro">Dashboard</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="<?= ROOT ?>Employee" aria-expanded="false"><span
                                    class="educate-icon educate-professor icon-wrap"></span> <span
                                    class="mini-click-non">Employees</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Employee" href="<?= ROOT ?>Employee"><span class="mini-sub-pro">All
                            Employees</span></a></li>
                            <?php if(checkAuthorization("admin")): ?>
                                <li><a title="Add Employee" href="<?= ROOT ?>Employee/add"><span class="mini-sub-pro">Add
                                 Employee</span></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="<?= ROOT ?>Professor" aria-expanded="false"><span
                                class="educate-icon educate-professor icon-wrap"></span> <span
                                class="mini-click-non">Professors</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Professors" href="<?= ROOT ?>Professor"><span class="mini-sub-pro">All
                                            Professors</span></a></li>
                            <?php if(checkAuthorization("technical")): ?>
                                <li><a title="Add Professor" href="<?= ROOT ?>Professor/add"><span class="mini-sub-pro">Add
                                                Professor</span></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="<?= ROOT ?>Student" aria-expanded="false"><span
                                class="educate-icon educate-student icon-wrap"></span> <span
                                class="mini-click-non">Students</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Students" href="<?= ROOT ?>Student"><span class="mini-sub-pro">All
                                            Students</span></a></li>
                            <?php if(checkAuthorization("technical")):  ?>
                                <li><a title="Add Students" href="<?= ROOT ?>Student/add"><span class="mini-sub-pro">Add
                                                Student</span></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="<?= ROOT ?>Course" aria-expanded="false"><span
                                class="educate-icon educate-course icon-wrap"></span> <span
                                class="mini-click-non">Courses</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="All Courses" href="<?= ROOT ?>Course"><span class="mini-sub-pro">All
                                            Courses</span></a></li>
                            <?php if(checkAuthorization("technical")): ?>
                                <li><a title="Add Courses" href="<?= ROOT ?>Course/add"><span class="mini-sub-pro">Add
                                                Course</span></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span
                                class="educate-icon educate-message icon-wrap"></span> <span
                                class="mini-click-non">Mailbox</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a title="Inbox" href="mailbox.html"><span class="mini-sub-pro">Inbox</span></a>
                            </li>
                            <li><a title="View Mail" href="mailbox-view.html"><span class="mini-sub-pro">View
                                            Mail</span></a></li>
                            <li><a title="Compose Mail" href="mailbox-compose.html"><span
                                        class="mini-sub-pro">Compose Mail</span></a></li>
                        </ul>
                    </li>


                    <li id="removable">
                        <a class="has-arrow" href="#" aria-expanded="false"><span
                                class="educate-icon educate-pages icon-wrap"></span> <span
                                class="mini-click-non">Pages</span></a>
                        <ul class="submenu-angle page-mini-nb-dp" aria-expanded="false">
                            <li><a title="Login" href="<?= ROOT ?>Login"><span class="mini-sub-pro">Login</span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
</div>
<!-- End Left menu area -->