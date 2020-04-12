var firstStart = true
function spielstart() {
  $("body").attr("data-fensterOpen", "spielen")
  if (firstStart) timer()
  firstStart = false
}

function regelnanzeigen() {
  $("body").attr("data-fensterOpen", "regeln")
}

function endeanzeigen() {
  for (var i = 3; i <= 7; i++){
    $("#movesLev" + i).html(movesPerLevel[i] == -1 ? "Level nicht erreicht" : movesPerLevel[i])
  }
  $("#erreichtesLevel").html(currentlevel-2)
  $("body").attr("data-fensterOpen", "ende")
}

var movesPerLevel = {3: -1, 4: -1, 5: -1, 6: -1, 7: -1}
var currentlevel = 3

function levelbeendet() {
  var moves = document.hanoi.yourmove.value
  movesPerLevel[currentlevel] = moves
  $(".levelanzeige").html(currentlevel - 2) //hier eigentlich unnötig
  $(".zügeanzeige").html(moves)
  if (currentlevel == 7) {
    $("#nextLevelButton").attr("disabled", "true")
    setTimeout(function () {
      endeanzeigen()
    }, 5000)
  }
  $("body").attr("data-fensterOpen", "levelende")
}

function nextLevel() {
  currentlevel++
  $(".levelanzeige").html(currentlevel - 2)
  document.hanoi.diskno.options.selectedIndex = currentlevel - 3
  initVars();
  drawDisks(currentlevel);
  $("body").attr("data-fensterOpen", "spielen")
}

function timer() {
// Set the date we're counting down to
  var countDownDate = new Date().getTime() + 60000 * 10;
  //var countDownDate = new Date().getTime() + 60000 * 0.1;

// Update the count down every 1 second
  var x = setInterval(function () {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="timeranzeige"
    document.getElementsByName("timeranzeige")[0].value = minutes + "m " + seconds + "s ";

    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementsByName("timeranzeige")[0].value = "EXPIRED";
      endeanzeigen()
    }
  }, 1000);
}
