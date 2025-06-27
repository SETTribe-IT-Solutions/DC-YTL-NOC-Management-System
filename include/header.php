<style>
  .heading {
    /* margin-right: 39%; */
    color: white;
    font-size: 33px;
    margin-left: 20%;
  }

  @media (max-width: 768px) {
      .navbar-menu-wrapper {
        flex-direction: column !important;
        align-items: center !important;
        text-align: center;
        padding: 10px;
      }

      .heading {
        font-size: 20px !important;
        margin-left: 0 !important;
        margin-bottom: 5px;
        font-size: 1px;
        text-align: center;
      }

      .navbar-brand img {
        height: 65px !important;
        width: 50px !important;
      }
    }
    @media (max-width: 991px) {
    .navbar .navbar-menu-wrapper .navbar-toggler.navbar-toggler-right {
        box-shadow: none;
        /* padding-left: -41px; */
       
        margin-top: -6px;
        padding-left: 90%;
    }
}
</style>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
          <a class="navbar-brand brand-logo" href="index.html"><img style="height: 70px; width: 70px;" src="img/Picsart2.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img  src="img/Picsart2.png" alt="logo"/></a>
          
        </div>
      </div>
      <div class="navbar-menu-wrapper  align-items-center justify-content-end" style="background-color:#844fc1;">
          <h3 class="heading" style="margin-left: 23%;"><b>NOC Management System</b></h3>
            <h3 class="heading"><b>
              जिल्हाधिकारी कार्यालय, यवतमाळ</b></h3>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>