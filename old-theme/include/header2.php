<style>
  .custom-header {
    background-color: #844fc1;
    padding: 10px 0;
    text-align: center;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
  }

  .custom-header img {
    height: 70px;
    width: auto;
  }

  .custom-header .center-text {
    flex: 1;
    text-align: center;
    color: #ffffff;
  }

  .custom-header .center-text h2 {
    margin: 0;
    font-size: 24px;
    font-weight: bold;
  }

  .custom-header .center-text h3 {
    margin: 0;
    font-size: 20px;
  }

  @media (max-width: 768px) {
    .custom-header {
      flex-direction: column;
    }

    .custom-header .center-text {
      order: 2;
      margin-top: 10px;
    }
  }
</style>

<div class="custom-header">
  <div style="padding-left: 20px;">
    <img src="img/satymev-jayte.png" alt="Gov Logo" />
  </div>

  <div class="center-text">
    <h2>NOC Management System</h2><br>
    <h3>जिल्हाधिकारी कार्यालय, यवतमाळ</h3>
  </div>

  <div style="padding-right: 20px;">
    <img src="img/Seal_of_Maharashtra.png" alt="State Seal" />
  </div>
</div>
