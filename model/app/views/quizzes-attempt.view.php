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
                                        <h4 class="course-name">Digital Electronics</h4>
                                    </div>
                                    <div class="questions-page-container">
                                        <form class="form-questions" method="POST" enctype="multipart/form-data">
                                            <div class="questions-page-questions">
                                                <?php $count = 1; ?>
                                                <?php foreach ($questions as $question): ?>
                                                    <div class="questions-page-question-wrapper">
                                                        <div class="questions-page-question-details">
                                                            <span class="questions-page-question-details-number">
                                                                Question <span><?= $count++ ?> </span>
                                                            </span>
                                                            <span class="questions-page-question-details-mark">
                                                                <span><?= $question->mark_value ?></span> Mark
                                                            </span>
                                                        </div>
                                                        <div class="questions-page-question-container">
                                                            <?php if($question->photo != ""): ?>
                                                                <img class="questions-page-question-container-img"
                                                                    src="<?= $question->photo ?>" />/
                                                            <?php endif; ?>
                                                            <span class="questions-page-question"><?= $question->question ?></span>
                                                            <?php if($question->type == "essayQuestion"): ?>
                                                                <label for="images" class="drop-container">
                                                                    <span class="drop-title">Drop files here</span>
                                                                    or
                                                                    <input type="file" name="<?= $question->id ?>" id="images" accept="*" />
                                                                </label>
                                                            <?php else: ?>
                                                                <span class="questions-page-select">Select one:</span>
                                                                <div class="questions-page-choices">
                                                                    <?php foreach ($question->choices as $choice): ?>
                                                                        <div onclick="document.querySelector('#<?= $question->name .  $choice->name ?>').click()" class="questions-page-choice-one">
                                                                            <input value="<?= $choice->choice ?>" type="radio" id="<?= $question->name .  $choice->name ?>" name="<?= $question->id ?>" />
                                                                            <label for="<?= $choice->name ?>"><?= $choice->choice ?></label>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>


                                                <div class="questions-page-move">
                                                    <?php if($quiz_data[0]->is_recursive): ?>
                                                        <a><button type="button" class="questions-page-move-previous">
                                                            Previous page
                                                        </button></a>
                                                    <?php endif; ?>
                                                    <?php if(!$Finish): ?>
                                                        <button type="submit" class="questions-page-move-next">
                                                            Next page
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="submit" class="questions-page-move-next">
                                                            Finish Attempt
                                                        </button>
                                                    <?php endif; ?>
                                                    </div>
                                            </div>
                                        </form>
                                        <div class="quiz-navigation">
                                            <span class="quiz-navigation-title"> Quiz navigation </span>
                                            <img
                                                src="<?= $user->photo ?>" />
                                            <span class="quiz-navigation-name"><?= ucfirst($user->f_name) . " "  . ucfirst($user->l_name)?></span>
                                            <div class="quiz-navigation-questions">
                                                <?php for($i = 1;$i <= $number_of_quiz_questions;$i++): ?>
                                                    <span class="quiz-navigation-questions-number">
                                                        <a href="#"><?= $i ?></a>
                                                    </span>
                                                <?php endfor; ?>
                                            </div>
                                            <a href="#" class="quiz-navigation-finish">Finish attempt...</a>
                                            <div class="quiz-navigation-timer">
                                                <span class="quiz-navigation-time-left"> Time left </span>
                                                <div class="quiz-navigation-time">
                                                    <span class="quiz-navigation-time-hours"><?= displayTimeValue($quiz_time["hours"]) ?></span>:
                                                    <span class="quiz-navigation-time-minutes"><?= displayTimeValue($quiz_time["minutes"]) ?></span>:
                                                    <span class="quiz-navigation-time-seconds"><?= displayTimeValue($quiz_time["seconds"]) ?></span>
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
<script>
let countDown = document.querySelector('.quiz-navigation-time')
let countDownHours = document.querySelector('.quiz-navigation-time-hours')
let countDownMinutes = document.querySelector('.quiz-navigation-time-minutes')
let countDownSeconds = document.querySelector('.quiz-navigation-time-seconds')

// Set the countdown time in hours, minutes, and seconds
let hours = Number(countDownHours.innerHTML);
let minutes = Number(countDownMinutes.innerHTML);
let seconds =Number(countDownSeconds.innerHTML);

// Calculate the total countdown time in seconds
let totalTime = hours * 3600 + minutes * 60 + seconds;

// Get the HTML element where the countdown will be displayed


// Update the countdown timer every second
let countdown = setInterval(function() {

  // Calculate the remaining time in hours, minutes, and seconds
  let remainingHours = Math.floor(totalTime / 3600);
  let remainingMinutes = Math.floor((totalTime % 3600) / 60);
  let remainingSeconds = Math.floor(totalTime % 60);
  
if(remainingHours === 0 && remainingMinutes === 0 && remainingSeconds < 60){
              countDown.style.backgroundColor = 'red';
}
  // Display the remaining time in the HTML element
  countDownHours.innerHTML = remainingHours > 9? remainingHours : '0' + remainingHours ;
  countDownMinutes.innerHTML = remainingMinutes > 9? remainingMinutes :'0'+ remainingMinutes ;
  countDownSeconds.innerHTML = remainingSeconds > 9? remainingSeconds : '0' + remainingSeconds ;

  

  // Decrease the total countdown time by 1 second
  totalTime--;

  // Stop the countdown when the total countdown time reaches zero
  if (totalTime < 0) {

    const url1 = window.location.href;
    const quizId = url1.split(/[/?]/);
    const idId = quizId[quizId.length-2];
    console.log(idId);
    const data = {
        time :"finish",
    };
 const url = `http://localhost/model/public/StudentQuizes/finish/${idId}`;

fetch(url, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify(data)
})
  .then(response => response.url)
  .then(data => {
    window.location.href =data;
  })
  .catch((error) => {
    console.error('Error:', error);
  });
    clearInterval(countdown);

  }

}, 1000); // Run the countdown function every second
</script>
<?php $this->view("include/footer"); ?>