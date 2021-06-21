<?php
session_start();
$user="";
if(isset($_SESSION["username"])){
$user=$_SESSION["username"];
}
?>
<html lang="en"> 
  <head>
    <meta charset="utf-8">
    <title>ImportExportCn</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Ask online Form">
    <meta name="keywords" content="HTML, CSS, JavaScript,Bootstrap,js,Forum,webstagram ,webdesign ,website ,web ,webdesigner ,webdevelopment">
    <meta name="robots" content="index, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>

<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!-- <link href="css/animate.css" rel="stylesheet" type="text/css"> -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
  </head>
<body>
<div id="header">
	<!-- Translate page-->
<div id="google_translate_element" class="pull-right"></div><br><br><br>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- End Translate page-->	
<div class="container">
<div id="welcomeLine" class="row ms-auto">
	<?Php echo"<div class='span6'>Welcome! <strong>$user</strong></div>";?>
<div class="span6" >
	<div class="pull-right">
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$db="importexportcn";
			
			// Create connection
			$conn = new mysqli($servername, $username, $password,$db);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			  }
  ?>
  </div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="index.php"><img src="themes/images/logo.png" alt="Bootsshop"/></a>
		<form class="form-inline navbar-search" method="post" action="products.php" >
		<input id="srchFld" class="srchTxt" type="text" name="arg" />
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="addTopic.php">Create Topic</a></li>
	 <li class=""><a href="Forum.php">Forum</a></li>
	 <li class=""><a href="contact.php">Contact</a></li>
	 <?php 
   $sql = "	 SELECT utente.id,impresa.VAT FROM utente
	 INNER JOIN impresa ON impresa.VAT=utente.Piva
	  WHERE nick='$user'";
	 $result = $conn->query($sql);
   if(isset($_SESSION["username"]) && ($result->num_rows > 0)){
		echo"<li class=''><a href='sell.php' ><span class='btn btn-large btn-success'>Sell</span></a></li>";}
	 if(isset($_SESSION["username"])){

	 }
	else{
		echo"<li class=''><a href='login.php' ><span class='btn btn-large btn-success'>Login</span></a></li>";
	}?>
    </ul>
  </div>
</div>
</div>
</div>
<!-- Header End====================================================================== -->

<!-- ======content section/body=====-->
<section class="main-content920">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="main">
                        <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1">Recent Post</label>
                        <input id="tab2" type="radio" name="tabs">
                        <label for="tab2">Most Popular</label>
                        <input id="tab3" type="radio" name="tabs">
                        <section id="content1">
                               <!--Recent Question Content Section -->
                        <?php
                        $sql = "SELECT * FROM post
                        INNER JOIN utente ON utente.id=post.id
                        GROUP BY data DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $count=0;
                            while($row = $result->fetch_assoc()) {
                                $query="SELECT COUNT(idMessaggio) AS NUM FROM `messaggio` WHERE messaggio.idPost=$row[idPost]";
                                $ris=$conn->query($query);
                                $riga=$ris->fetch_assoc();
                            echo"<div class='question-type2033'>
                            <div class='row'>
                                <div class='col-md-2'>
                                <h5>$row[nick]</h5>
                                    <div class='left-user12923 left-user12923-repeat'>
                                        <a href='#'><img src='image/images.png' alt='image'></a> <a href='#'><i class='fa fa-check' aria-hidden='true'></i></a> </div>
                                </div>
                                
                                <div class='col-md-8'>
                                    <div class='right-description893'>
                                        <div id='que-hedder2983'>
                                            <h3><a href='post_details.php?id=$row[idPost]' target='_blank'>$row[titolo]</a></h3> </div>
                                        <div class='ques-details10018'>
                                            <p>$row[descrizione]</p></div>
                                        <hr>
                                        <div class='ques-icon-info3293'> <a href='#'><i class='fa fa-star' aria-hidden='true'> 5 </i> </a> <a href='#'><i class='fa fa-folder' aria-hidden='true'> wordpress</i></a> <a href='#'><i class='fa fa-clock-o' aria-hidden='true'>$row[data]</i></a> <a href='#'><i class='fa fa-question-circle-o' aria-hidden='true'> Question</i></a> <a href='#'><i class='fa fa-bug' aria-hidden='true'> Report</i></a> </div>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='ques-type302'>
                                        <a href='#'>
                                            <button type='button' class='q-type238'><i class='fa fa-comment' aria-hidden='true'>  $riga[NUM] Answer</i></button>
                                        </a>
                                        <a href='#'>
                                            <button type='button' class='q-type23 button-ques2973'> <i class='fa fa-user-circle-o' aria-hidden='true'> $row[views] Views </i> </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                            }
                        }
                        ?>
                            
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                  <li>
                                    <a href="#" aria-label="Previous">
                                      <span aria-hidden="true">&laquo;</span>
                                    </a>
                                  </li>
                                  <li><a href="#">1</a></li>
                                  <li><a href="#">2</a></li>
                                  <li><a href="#">3</a></li>
                                  <li><a href="#">4</a></li>
                                  <li><a href="#">5</a></li>
                                  <li>
                                    <a href="#" aria-label="Next">
                                      <span aria-hidden="true">&raquo;</span>
                                    </a>
                                  </li>
                                </ul>
                              </nav>
                        </section>
                        <!--  End of content-1------>
                        <section id="content2">
                               <!--Popular Question Content Section -->
                        <?php
                        $sql = "SELECT * FROM post
                        INNER JOIN utente ON utente.id=post.id
                        GROUP BY post.views DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $count=0;
                            while($row = $result->fetch_assoc()) {
                                $query="SELECT COUNT(idMessaggio) AS NUM FROM `messaggio` WHERE messaggio.idPost=$row[idPost]";
                                $ris=$conn->query($query);
                                $riga=$ris->fetch_assoc();
                            echo"<div class='question-type2033'>
                            <div class='row'>
                                <div class='col-md-2'>
                                <h5>$row[nick]</h5>
                                    <div class='left-user12923 left-user12923-repeat'>
                                        <a href='#'><img src='image/images.png' alt='image'></a> <a href='#'><i class='fa fa-check' aria-hidden='true'></i></a> </div>
                                </div>
                                
                                <div class='col-md-8'>
                                    <div class='right-description893'>
                                        <div id='que-hedder2983'>
                                            <h3><a href='post_details.php?$row[idPost]' target='_blank'>$row[titolo]</a></h3> </div>
                                        <div class='ques-details10018'>
                                            <p>$row[descrizione]</p></div>
                                        <hr>
                                        <div class='ques-icon-info3293'> <a href='#'><i class='fa fa-star' aria-hidden='true'> 5 </i> </a> <a href='#'><i class='fa fa-folder' aria-hidden='true'> wordpress</i></a> <a href='#'><i class='fa fa-clock-o' aria-hidden='true'>$row[data]</i></a> <a href='#'><i class='fa fa-question-circle-o' aria-hidden='true'> Question</i></a> <a href='#'><i class='fa fa-bug' aria-hidden='true'> Report</i></a> </div>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='ques-type302'>
                                        <a href='#'>
                                            <button type='button' class='q-type238'><i class='fa fa-comment' aria-hidden='true'>  $riga[NUM] Answer</i></button>
                                        </a>
                                        <a href='#'>
                                            <button type='button' class='q-type23 button-ques2973'> <i class='fa fa-user-circle-o' aria-hidden='true'> $row[views] Views </i> </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                            }
                        }
                        ?>
                            
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                  <li>
                                    <a href="#" aria-label="Previous">
                                      <span aria-hidden="true">&laquo;</span>
                                    </a>
                                  </li>
                                  <li><a href="#">1</a></li>
                                  <li><a href="#">2</a></li>
                                  <li><a href="#">3</a></li>
                                  <li><a href="#">4</a></li>
                                  <li><a href="#">5</a></li>
                                  <li>
                                    <a href="#" aria-label="Next">
                                      <span aria-hidden="true">&raquo;</span>
                                    </a>
                                  </li>
                                </ul>
                              </nav>
                        </section>
                        <!--  End of content-1------>





                      </div></div></div>
<!-- Footer ================================================================== -->
<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="login.php">YOUR ACCOUNT</a>
				<a href="login.php">PERSONAL INFORMATION</a> 
				<a href="login.php">ADDRESSES</a> 
				<a href="login.php">DISCOUNT</a>  
				<a href="login.php">ORDER HISTORY</a>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="contact.html">CONTACT</a>  
				<a href="register.php">REGISTRATION</a>  
				<a href="legal_notice.html">LEGAL NOTICE</a>  
				<a href="tac.html">TERMS AND CONDITIONS</a> 
				<a href="faq.html">FAQ</a>
			 </div>
			<div class="span3">
				<h5>OUR OFFERS</h5>
				<a href="#">NEW PRODUCTS</a> 
				<a href="#">TOP SELLERS</a>  
				<a href="special_offer.html">SPECIAL OFFERS</a>  
				<a href="#">MANUFACTURERS</a> 
				<a href="#">SUPPLIERS</a> 
			 </div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="https://www.facebook.com/"><img width="60" height="60" src="themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="https://www.twitter.com/"><img width="60" height="60" src="themes/images/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="https://www.youtube.com/"><img width="60" height="60" src="themes/images/youtube.png" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		<p class="pull-right">&copy; ImportExportChina</p>
	</div><!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
	
	<!-- Themes switcher section ============================================================================================= -->
<div id="secectionBox">
<link rel="stylesheet" href="themes/switch/themeswitch.css" type="text/css" media="screen" />
<script src="themes/switch/theamswitcher.js" type="text/javascript" charset="utf-8"></script>
	<div id="themeContainer">
	<div id="hideme" class="themeTitle">Style Selector</div>
	<div class="themeName">Oregional Skin</div>
	<div class="images style">
	<a href="themes/css/#" name="bootshop"><img src="themes/switch/images/clr/bootshop.png" alt="bootstrap business templates" class="active"></a>
	<a href="themes/css/#" name="businessltd"><img src="themes/switch/images/clr/businessltd.png" alt="bootstrap business templates" class="active"></a>
	</div>
	<div class="themeName">Bootswatch Skins (11)</div>
	<div class="images style">
		<a href="themes/css/#" name="amelia" title="Amelia"><img src="themes/switch/images/clr/amelia.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="spruce" title="Spruce"><img src="themes/switch/images/clr/spruce.png" alt="bootstrap business templates" ></a>
		<a href="themes/css/#" name="superhero" title="Superhero"><img src="themes/switch/images/clr/superhero.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="cyborg"><img src="themes/switch/images/clr/cyborg.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="cerulean"><img src="themes/switch/images/clr/cerulean.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="journal"><img src="themes/switch/images/clr/journal.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="readable"><img src="themes/switch/images/clr/readable.png" alt="bootstrap business templates"></a>	
		<a href="themes/css/#" name="simplex"><img src="themes/switch/images/clr/simplex.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="slate"><img src="themes/switch/images/clr/slate.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="spacelab"><img src="themes/switch/images/clr/spacelab.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="united"><img src="themes/switch/images/clr/united.png" alt="bootstrap business templates"></a>
		<p style="margin:0;line-height:normal;margin-left:-10px;display:none;"><small>These are just examples and you can build your own color scheme in the backend.</small></p>
	</div>
	<div class="themeName">Background Patterns </div>
	<div class="images patterns">
		<a href="themes/css/#" name="pattern1"><img src="themes/switch/images/pattern/pattern1.png" alt="bootstrap business templates" class="active"></a>
		<a href="themes/css/#" name="pattern2"><img src="themes/switch/images/pattern/pattern2.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern3"><img src="themes/switch/images/pattern/pattern3.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern4"><img src="themes/switch/images/pattern/pattern4.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern5"><img src="themes/switch/images/pattern/pattern5.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern6"><img src="themes/switch/images/pattern/pattern6.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern7"><img src="themes/switch/images/pattern/pattern7.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern8"><img src="themes/switch/images/pattern/pattern8.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern9"><img src="themes/switch/images/pattern/pattern9.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern10"><img src="themes/switch/images/pattern/pattern10.png" alt="bootstrap business templates"></a>
		
		<a href="themes/css/#" name="pattern11"><img src="themes/switch/images/pattern/pattern11.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern12"><img src="themes/switch/images/pattern/pattern12.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern13"><img src="themes/switch/images/pattern/pattern13.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern14"><img src="themes/switch/images/pattern/pattern14.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern15"><img src="themes/switch/images/pattern/pattern15.png" alt="bootstrap business templates"></a>
		
		<a href="themes/css/#" name="pattern16"><img src="themes/switch/images/pattern/pattern16.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern17"><img src="themes/switch/images/pattern/pattern17.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern18"><img src="themes/switch/images/pattern/pattern18.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern19"><img src="themes/switch/images/pattern/pattern19.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern20"><img src="themes/switch/images/pattern/pattern20.png" alt="bootstrap business templates"></a>
	</div>
	</div>
</div>
<span id="themesBtn"></span>
</body>
</html>
