<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>Turn On Button Effect || Code Village</title>
</head>

<body>
  <p>Manage Light</p>
  <label id="btn">
    <input type="checkbox" id="checkbox">
    <span><img src="bulb_off.png" alt="" class="icon"></span>
    <div class="bulb" id="bulb"></div>
  </label>

  <audio id="audio" src="click.mp3" autostart="false"></audio>
  <script type=text/javascript>
    let btn = document.querySelector('#btn');
    let body = document.querySelector('body');
    let audio = document.querySelector('#audio');
    const checkbox = document.getElementById("checkbox");
    btn.onclick = function() {
      if (checkbox.checked) {
        checkbox.checked = false;
      } else {
        checkbox.checked = true;
      }
      audio.play();
      validate();


    }

    function validate() {
      if (checkbox.checked) {
        sendOn();
      } else {

        sendOff();
      }
    }

    function sendOn() {

      fetch('/save.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          "status": "ON"
        })
      })

    }

    function sendOff() {
      
      fetch('/save.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          "status": "OFF"
        })
      })
    }
    //status of the bulb
    function update() {
      let bulb = document.getElementById("bulb");

      $.get("/status.php", function(data) {
        data = JSON.parse(data);
        console.log(data)
        if (data.status == "ON") {
          checkbox.checked = true;

          bulb.style.backgroundImage = "url('./bulb_on.png')";
        } else {
          checkbox.checked = false;
          bulb.style.backgroundImage = "url('./bulb_off.png')";
        }
        $("#status").html("bulb status: " + data);
        window.setTimeout(update, 1000);
      });
    }
    window.onload = update;
  </script>
  <script type="text/javascript" src="./jquery.js"></script>
</body>

</html>