<!doctype html>

<?php
//include auth.php file on all secure pages
include("auth.php");
include_once "config.php";

?>
<?php
  if(isset($_POST['submit']))
  {
      $l_id=$_SESSION['login_sno'];
	  $title=$_POST['title'];
	  $description=$_POST['description'];
	  $uploadDir = '/lib/uploadedFiles/';
$fileTypes = array('jpg', 'jpeg',  'png','pdf','doc','docx' ); // Allowed file extensions
$filename = $_FILES['uploaddoc']['name'];

if($filename != '')
{

$tempFile   = $_FILES['uploaddoc']['tmp_name'];
$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
$file_ext = substr($filename , strripos($filename, '.'));
$uuid = gen_uuid();
$uuid = str_replace(' ', '', $uuid);
$newfilename=$uuid.$file_ext;
$targetFile = $uploadDir . $newfilename;
$fileParts = pathinfo($_FILES['uploaddoc']['name']);
if (in_array(strtolower($fileParts['extension']), $fileTypes))
 {	
    // print_r($tempFile);
    // print_r($targetFile);

    move_uploaded_file($tempFile, $targetFile);
    $newfilename="uploadedFiles/".$newfilename;
    // echo $targetFile;
    $sql=$conn->query("INSERT INTO library(title,description,file_path,login_sno) values('".$title."','".$description."','".$newfilename."','".$l_id."')");

	  if($sql)
	  {
        header("Location: home.php");

	  } else
	  {
        header("Location: home.php");

      }
      
      
	
 }
}
	 

	  
  }

  function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
  ?>



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

              <div class="brand" style="width: auto;"> Lib </div>
            </a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li >
                <a href="home.php">
                  <i class="pe-7s-notebook">
                    <span class="label"></span>
                  </i>
                  <p>Books</p>
                </a>
              </li>
              <li class="active">
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
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="description">
                </div>
                <div class="form-group">
                    <label for="uploaddoc">upload doc</label>
                    <input type="file" class="form-control-file" id="uploaddoc" name="uploaddoc">
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Upload" />

            </form>
      </div>
    </div>
  </div>


</body>

<script src="js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>

<script src="js/ct-navbar.js"></script>


</html>