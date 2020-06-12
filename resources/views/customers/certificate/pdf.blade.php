<!DOCTYPE html>
<html>
<head>
  <title>Certificate</title>
  <style>
  @page { margin: 0in; }
  .bg {
    position: absolute;
    z-index: -1000;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .center {
    margin: 0;
    position: absolute;
    top: 40%;
    left: 50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }
</style>
</head>
<body>
  <img class="bg" src="img/cert.jpg">
    <div class="center">
      <span style="font-size: 50px">{{ ucwords($data->get("user")->nama) }}</span>
    </div>
</body>
