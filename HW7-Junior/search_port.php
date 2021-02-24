<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
  <style>
body  {
  background-image: url("");
}

</style>
<body>
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators" align = "center">
          <li data-target="#demo" data-slide-to="0" class="active"></li>
          <li data-target="#demo" data-slide-to="1"></li>
          <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        
        <!-- The slideshow -->
        <div class="carousel-inner" align = "center">
          <div class="carousel-item active">
            <img src="ikon.jpg" alt="Los Angeles" width="1350" height="550">
          </div>
          <div class="carousel-item">
            <img src="bp.png" alt="Chicago" width="1350" height="550">
          </div>
          <div class="carousel-item">
            <img src="ts.jpg" alt="New York" width="1350" height="550">
          </div>
        </div>
        
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
    <center><font color ="black"><h1>ค้นหาเพลง</h1>
    <input type="text" id="kw">
    <select id="typ">

    <?php
        // connect database 
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "123456";
        $db_name = "songs";

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
        $mysqli->set_charset("utf8");

        // check connection error 
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        } else {
            // connect success, do nothing
            // echo "Connect success.";
        
        }
        $sql = "SELECT *
                FROM song
                WHERE NameSong LIKE '%$kw%'AND Artist_Name LIKE '%$typ%'";
        $result = $mysqli->query($sql);
        while($row = $result->fetch_object()) {
            echo "<option value='$row->Artist_Name'>$row->Artist_Name</option>";
        }

    ?></center></font>
    </select>
    <button onclick="search()"class="btn btn-lg btn-warning">ค้นหา</button>
    <h5><div id="disp"></div><h5>
    <h3><center><form method="post" action="search.html">
            <input type="submit"class="btn btn-danger"  value="Search">
    </form></center></h3>
    <script>
        function search() {
            kw = document.getElementById('kw').value;
            typ = document.getElementById('typ').value;
            console.log("kw=" + kw);
            console.log("typ=" + typ);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // document.getElementById('disp').innerHTML = this.responseText;
                        arr = JSON.parse(this.responseText);
                        console.log(arr);
                        if (arr.length == 0) {
                            document.getElementById('disp').innerHTML = "Not found";
                        } else {
                            html = "";
                            for (i = 0; i < arr.length; i++) {
                                html +="ชื่อเพลง: "+ arr[i].NameSong + "<br>" + 
                                "ศิลปิน: "+arr[i].Artist_Name +"<br>" +
                                "อัลบั้ม: "+ arr[i].Album_name + "<br>"+ 
                                "Lyrics: "+arr[i].Lyrics + "<br>";
                            }
                            document.getElementById('disp').innerHTML = html;
                        }
                    }
                }
            parameters = "kw=" + kw + "&typ=" + typ;
            xmlhttp.open("post", "search.php");
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(parameters);
        }
    </script>
</body>
</html>