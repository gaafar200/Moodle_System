<?php $this->view("include/header",["pageName"=>$pageName]); ?>
<body>
  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>Forbidden</h1>
        <h2>You Are unauthorized to perform this operation</h2>
        <a class="btn" href="index.html">Back to home</a>
      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php $this->view("include/footer"); ?>