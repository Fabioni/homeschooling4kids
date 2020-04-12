<!doctype html>
<html class="no-js" lang="de">
<head>
  <meta charset="utf-8">
  <title>Hanoi - Valerie Schulte</title>
  <link rel="icon" href="https://www.phwien.ac.at/favicon.ico" type="image/x-icon">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/hanoi.css">
  <link rel="stylesheet" href="css/valerie.css">

  <script src="js/vendor/modernizr-3.8.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script src="js/hanoi.js"></script>
  <script src="js/valerie.js"></script>

  <meta name="theme-color" content="#fafafa">


</head>
<body onload="init();" data-fensterOpen="start" onselectstart="return false" oncontextmenu="return false">
<form data-role="window" name="hanoi" data-fenster="spielen">

  <div id="title"
       style="position: absolute; left: 270px; top: 30px; width: 160px; height: 20px; font: bold 20px Tahoma; text-align: center; display: none">
    Türme von Hanoi
  </div>

  <div id="tower1" class="container" style="left: 30px; top: 80px; width: 200px; height: 200px;"
       onmousemove="indexTo=1">
    <div id="verttower1" class="towervert" style="left:99px;top:10px;width:3px;height:170px"></div>
    <div id="horiztower1" class="towerhoriz" style="left:0px;top:180px;width:200px;height:2px"></div>
    <div class="tower">Turm A</div>
  </div>

  <div id="tower2" class="container" style="left: 250px; top: 80px; width: 200px; height: 200px;"
       onmousemove="indexTo=2">
    <div id="verttower2" class="towervert" style="left:99px;top:10px;width:3px;height:170px"></div>
    <div id="horiztower2" class="towerhoriz" style="left:0px;top:180px;width:200px;height:2px"></div>
    <div class="tower">Turm B</div>
  </div>

  <div id="tower3" class="container" style="left: 470px; top: 80px; width: 200px; height: 200px;"
       onmousemove="indexTo=3">
    <div id="verttower3" class="towervert" style="left:99px;top:10px;width:3px;height:170px"></div>
    <div id="horiztower3" class="towerhoriz" style="left:0px;top:180px;width:200px;height:2px"></div>
    <div class="tower">Turm C</div>
  </div>

  <div id="disk1" class="disk"
       style="left: 105px; top: 200px; width: 50px; height: 19px; background-color: pink; z-index: 8;"
       onmousedown="initializeDrag(this,event)" onmouseup="dropDisk(this)" title="Scheibe 1"></div>
  <div id="disk2" class="disk"
       style="left: 95px; top: 220px; width: 70px; height: 19px; background-color: violet; z-index: 7;"
       onmousedown="initializeDrag(this,event)" onmouseup="dropDisk(this)" title="Scheibe 2"></div>
  <div id="disk3" class="disk"
       style="left: 85px; top: 240px; width: 90px; height: 19px; background-color: indigo; z-index: 6;"
       onmousedown="initializeDrag(this,event)" onmouseup="dropDisk(this)" title="Scheibe 3"></div>
  <div id="disk4" class="disk"
       style="left: -250px; top: -250px; width: 110px; height: 19px; background-color: blue; z-index: 5;"
       onmousedown="initializeDrag(this,event)" onmouseup="dropDisk(this)" title="Scheibe 4"></div>
  <div id="disk5" class="disk"
       style="left: -250px; top: -250px; width: 130px; height: 19px; background-color: green; z-index: 4;"
       onmousedown="initializeDrag(this,event)" onmouseup="dropDisk(this)" title="Scheibe 5"></div>
  <div id="disk6" class="disk"
       style="left: -250px; top: -250px; width: 150px; height: 19px; background-color: yellow; z-index: 3;"
       onmousedown="initializeDrag(this,event)" onmouseup="dropDisk(this)" title="Scheibe 6"></div>
  <div id="disk7" class="disk"
       style="left: -250px; top: -250px; width: 170px; height: 19px; background-color: orange; z-index: 2;"
       onmousedown="initializeDrag(this,event)" onmouseup="dropDisk(this)" title="Scheibe 7"></div>
  <div id="disk8" class="disk"
       style="left: -250px; top: -250px; width: 190px; height: 19px; background-color: red; z-index: 1;"
       onmousedown="initializeDrag(this,event)" onmouseup="dropDisk(this)" title="Scheibe 8"></div>

  <div>
    <div id="leveltimerzüge" class="container" style="right: 30px; top: 400px">
      <table>
        <tbody>
        <tr>
          <td>Minimum an Zügen</td>
          <td><input name="minmove" style="border:none" size="4" value="255" readonly="readonly"></td>
        </tr>
        <tr>
          <td>Anzahl deiner Züge</td>
          <td><input name="yourmove" style="border:none" size="4"
                     value="0" readonly="readonly"></td>
        </tr>
        <tr>
          <td>Level</td>
          <td><span class="levelanzeige" size="4">1</span>/5</td>
        </tr>
        <tr>
          <td>Zeit</td>
          <td><input name="timeranzeige" style="border:none" size="6" value="10:00" readonly="readonly"></td>
        </tr>
        </tbody>
      </table>

    </div>

    <div class="container" style="left: 30px; top: 400px">
      <input type="button" name="btnIns" value="Regeln" onclick="regelnanzeigen()">
      <input type="button" name="btnRes" value="Neustart" onclick="document.hanoi.btnRes.style = ''; newGame(document.hanoi.diskno)">
      <input type="button" name="btnUndo" value="Schritt zurück" onclick="unDo(this)" disabled="disabled">
      <input type="button" name="btnSolve" value="Lösung" onclick="solve(this)">
    </div>
  </div>

  <div id="settings" class="container" style="left: 150px; top: 310px; width: 260px; display: none">
    <select name="diskno" onchange="newGame(this)" onclick="prevIndex=this.options.selectedIndex">
      <option value="7" selected="">3</option>
      <option value="15">4</option>
      <option value="31">5</option>
      <option value="63">6</option>
      <option value="127">7</option>
      <option value="255">8</option>
    </select>
  </div>
</form>

<div data-role="header"><h1>Türme von Hanoi</h1>
  <img src="hanoi.png" height="164.8" width="240.0"></div>

<div data-role="window" data-fenster="start">

  <input type="button" value="Regeln" onclick="regelnanzeigen()">
  <input type="button" value="Spielen" onclick="spielstart()">
</div>

<div data-role="window" data-fenster="regeln">
  <p>Beachte folgende Regeln</p>
  <img src="gluehbirne.png" style="height: 3em; margin-left: -40px; position: absolute">
  <ul>
    <li>Man darf in jedem Spielzug nur <b>eine</b> Scheibe verschieben</li>
    <li>Es darf nie eine größere Scheibe auf einer kleineren liegen</li>
  </ul>

  <input type="button" value="Spielen" onclick="spielstart()">
</div>

<div data-role="window" data-fenster="levelende">
  <div><h3 style="color: blue">Super!</h3>
    <img src="prima.gif" style="height: 3em">
    <p>Level <span class="levelanzeige"></span> geschafft</p>
    <p>Anzahl der Züge: <span class="zügeanzeige"></span></p></div>
  <input id="nextLevelButton" style="margin-top: 15px" type="button" value="nächstes Level" onclick="nextLevel()">
</div>
<div data-role="window" data-fenster="ende">
  <!-- <div style="float: right">
    <h3>weitere Quelle:</h3>
    <ul>
      <li>
        <a href="http://hausdermathematik.at/hdma/hdma_sek2/hanoi/hanoi.php">hausdermathematik.at</a>
      </li>
      <li>
        <a href="http://www.buergel-grundschule.de/Mathe-TagdesSpiels2011/TurmvonHanoi.pdf">www.buergel-grundschule.de</a>
      </li>
      <li>
        <a href="https://li.hamburg.de/contentblob/4305240/36dec398b3d92f812ee67dc2e2a42558/data/pdf-schuelerzirkel-mathematik-grundschule-band-3.pdf">li.hamburg.de</a>
      </li>
      <li>
        <a href="http://www.mathematische-basteleien.de/hanoi.htm">www.mathematische-basteleien.de</a>
      </li>
    </ul>
  </div>-->
<div>
  <h3>Gut gespielt!</h3>
  <p>Dein erreichtes Level: <span id="erreichtesLevel"></span></p>
  <p style="margin-bottom: 2px">Deine Züge:</p>
  <img src="ende.png" style="height: 15em; position: absolute; left: 22em; margin-top: -50px">
  <table style="margin-left: 10px">
    <tbody>
    <tr>
      <td>
        Level 1:
      </td>
      <td>
        <span id="movesLev3"></span>
      </td>
    </tr>
    <tr>
      <td>
        Level 2:
      </td>
      <td>
        <span id="movesLev4"></span>
      </td>
    </tr>
    <tr>
      <td>
        Level 3:
      </td>
      <td>
        <span id="movesLev5"></span>
      </td>
    </tr>
    <tr>
      <td>
        Level 4:
      </td>
      <td>
        <span id="movesLev6"></span>
      </td>
    </tr>
    <tr>
      <td>
        Level 5:
      </td>
      <td>
        <span id="movesLev7"></span>
      </td>
    </tr>
    </tbody>
  </table>
</div>
</div>
</body>
</html>
