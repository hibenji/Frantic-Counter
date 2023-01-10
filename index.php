<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Frantik</title>
<meta content="Frantik" property="og:title">
<meta content="Frantik Table" property="og:description">
<meta content="https://frantik.benji.link" property="og:url">
<meta content="#43B581" data-react-helmet="true" name="theme-color">
<link rel="apple-touch-icon" sizes="180x180" href="assests/discord.png">
<link rel="icon" type="image/png" sizes="32x32" href="assests/discord.png">
<link rel="icon" type="image/png" sizes="16x16" href="assests/discord.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/yanchokraev/grayshift@1.0.2/dist/css/grayshift.min.css" integrity="sha384-BEz3swSE9zJc0Sejcc2Hzrbjq8/0rFfS2ASsVlVM1F3cdbXW2VYMlhod3OZr1k3M" crossorigin="anonymous">
<!-- import jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script async src="https://arc.io/widget.min.js#CCvEswcW"></script>

<style>

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}

th, td {
  text-align: center;
  padding-right:5px;
}

table {
  border-collapse: collapse;
  width: 100%;
}

table, th, td {
  table-layout: fixed;
  border: 2px solid black;
}

</style>


</head>
<body>
    <br>

<div class="container">

  <div class="row">

  <div class="card" style="min-width: 530px;">
    <h2>
      Frantic Table
    </h2>
    <small>Der Raabe cheated</small>

    <hr>

    <!-- table with 3 rows with every item being editable-->
    <table class="table table-striped table-hover" id="scoreTable">
      <thead>
        <tr>
          <th contenteditable="true" scope="col">Player1</th>
          <th contenteditable="true" scope="col">Player2</th>
          <th contenteditable="true" scope="col">Player3</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td contenteditable="true">0</td>
          <td contenteditable="true">0</td>
          <td contenteditable="true">0</td>
        </tr>
        <tr>
          <td contenteditable="true">0</td>
          <td contenteditable="true">0</td>
          <td contenteditable="true">0</td>
        </tr>
        <tr>
          <td contenteditable="true">0</td>
          <td contenteditable="true">0</td>
          <td contenteditable="true">0</td>
        </tr>
      </tbody>
    </table>
    <br>

    <!-- button to add row -->
    <button type="button" class="btn btn-dark" onclick="addRow()">Add Row</button>

    <!-- remove row -->
    <button type="button" class="btn btn-dark" onclick="deleteRow()">Remove Row</button>

    <script>

      // when button is pressed new row is added
      function addRow() {
        var table = document.getElementById("scoreTable");
        var row = table.insertRow(-1);

        // loop through all columns
        for (var i = 0; i < table.rows[0].cells.length; i++) {
          var cell = row.insertCell(i);
          cell.innerHTML = "0";
          cell.contentEditable = "true";
        }

      }


      // when button is pressed last row is removed
      function deleteRow() {
        var table = document.getElementById("scoreTable");
        table.deleteRow(-1);
      }


    </script>



    <hr>

    <h3 class="card-title">Total Score</h3>

    <!-- total score table with column for each player-->
    <table class="table table-striped table-hover" id="totalScoreTable">
      <tbody>
        <tr>
          <td>0</td>
          <td>0</td>
          <td>0</td>
        </tr>
      </tbody>
    </table>


    <script>

      // add up all numbers in one row of the table
      function sumTableColumn(table, columnIndex) {
        var tot=0;
        for(var i=1; i<table.rows.length; i++) {
          tot += parseInt(table.rows[i].cells[columnIndex].innerHTML);
        }
        return tot;
      }

      // update the total score
      function updateTotalScore() {

        var table = document.getElementById('scoreTable');
        // get the amount of columns in the table
        var columnCount = table.rows[0].cells.length;
        // get the total score table
        var totalScoreTable = document.getElementById('totalScoreTable');
        // loop through all columns
        for (var i = 0; i < columnCount; i++) {
          // get the total score for the column
          var totalScore = sumTableColumn(table, i);
          // update the total score table
          totalScoreTable.rows[0].cells[i].innerHTML = totalScore;
        }


      }

      // update the total score everytime something changes
      $("#scoreTable").bind("DOMSubtreeModified", function() {
          updateTotalScore();
      });

      sumTableColumn();

    </script>


    <hr>

    
    <!-- button to add extra column -->
    <button type="button" class="btn btn-dark" onclick="addColumn()">Add column</button>

    <!-- remove column -->
    <button type="button" class="btn btn-dark" onclick="deleteColumn()">Remove column</button>

    <script>

      // when button is pressed add a new column to the table
      function addColumn() {
        var table = document.getElementById('scoreTable');
        var header = table.getElementsByTagName('thead')[0];
        var body = table.getElementsByTagName('tbody')[0];

        // add a new header
        var newHeader = document.createElement('th');
        newHeader.setAttribute("contenteditable", "true");
        newHeader.innerHTML = "Player" + (header.rows[0].cells.length + 1);
        header.rows[0].appendChild(newHeader);

        // add a new column to every row
        for (var i = 0, row; row = body.rows[i]; i++) {
          var newCell = row.insertCell(-1);
          newCell.setAttribute("contenteditable", "true");
          newCell.innerHTML = "0";
        }

        // add a new column to the total score table
        var totalScoreTable = document.getElementById('totalScoreTable');
        var newCell = totalScoreTable.rows[0].insertCell(-1); 
        newCell.innerHTML = "0";
      }

      // when button is pressed remove the last column
      function deleteColumn() {
        var table = document.getElementById('scoreTable');
        var header = table.getElementsByTagName('thead')[0];
        var body = table.getElementsByTagName('tbody')[0];

        // remove the last header
        header.rows[0].deleteCell(-1);

        // remove the last column from every row
        for (var i = 0, row; row = body.rows[i]; i++) {
          row.deleteCell(-1);
        }

        // remove the last column from the total score table
        var totalScoreTable = document.getElementById('totalScoreTable');
        totalScoreTable.rows[0].deleteCell(-1);
      }


    </script>


</div>
<br>


</div>

</body>
</html>
