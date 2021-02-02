<?php
//include auth.php file on all secure pages
include("auth.php");
include_once "config.php";

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link href="css/bootstrap.css" rel="stylesheet" />

  <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
  <link href="css/ct-navbar.css" rel="stylesheet" />

  <!--     Font Awesome     -->
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>

  <link href='http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

  
  <style>
    .fa-heart {
      color: #F74933;
    }

    .space-100 {
      height: 100px;
      display: block;
    }

    pre.prettyprint {
      background-color: #ffffff;
      border: 1px solid #999;
      margin-top: 20px;
      padding: 20px;
      text-align: left;
    }

    .atv,
    .str {
      color: #05AE0E;
    }

    .tag,
    .pln,
    .kwd {
      color: #3472F7;
    }

    .atn {
      color: #2C93FF;
    }

    .pln {
      color: #333;
    }

    .com {
      color: #999;
    }
  </style>
</head>

<body>
  <div id="navbar-full">
    <div id="navbar">
      <!--    
        navbar-default can be changed with navbar-ct-blue navbar-ct-azzure navbar-ct-red navbar-ct-green navbar-ct-orange  
        -->
      <nav class="navbar navbar-ct-blue navbar-fixed-top " role="navigation">

        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navbar-brand-logo" href="">

              <div class="brand" style="width: auto;"> Hand free notes </div>
            </a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li class="active">
                <a href="home.php">
                  <i class="pe-7s-notebook">
                    <span class="label"></span>
                  </i>
                  <p>Books</p>
                </a>
              </li>
              <li>
                <a href="upload.php">
                  <i class="pe-7s-plus">
                    <span class="label"></span>
                  </i>
                  <p>Add Books</p>
                </a>
              </li>
              <li>
                <a href="logout.php">
                  <i class="pe-7s-power">
                    <span class="label"></span>
                  </i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

    </div><!--  end navbar -->

  </div> <!-- end menu-dropdown -->

  <div class="main">
    <div class="container tim-container" style=" padding-top:100px">
      <div class="col-md-12">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>S no</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>date</th>
                        <th>User Name</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $list="SELECT l.library_id,l.title,l.description,l.file_path,l.date,u.name FROM library l,users u WHERE l.login_sno = u.login_sno order by l.date";
                        $sqlList=$conn->query($list);
                        if ($sqlList->num_rows > 0) {
                            $sno=1;
                            while($row = $sqlList->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $sno; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><a class="btn btn-info" target="_blank" href="<?php echo $row['file_path']; ?>"><i class="pe-7s-cloud-download" ></i></a></td>
                        </tr>
                    <?php $sno=$sno+1; }
                        }
                    ?>
                </tbody>
            </table>
      </div>
    </div>
  </div>

   
            


</body>

<script src="js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
//
<script src="js/ct-navbar.js"></script>


</html>

<script>
    $(document).ready( function () {
    $('#example').DataTable();
} );
    </script>