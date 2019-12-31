<?php 
error_reporting(0);
ob_start();
session_start();

if(isset($_SESSION['username'])){


  include "conn.php";
  $username=$_SESSION['username'];

?>

    <!DOCTYPE html>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="smk.ico" type="image/x-icon">

    
    

    <title>E-Grading | SMK Teladan Kertasmaya</title>
        <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        
        <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
            <link rel="stylesheet" type="text/css" href="js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="lineicons/style.css">   
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    <script src="js/chart-master/Chart.js"></script>

        
       
    </head>
    
    <body> 
      <section id="container">
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            
            <a href="?page=home.php" class="logo"><b>E-Grading</b></a>
            
            
           
        </header>
      
      <aside>
          <div id="sidebar"  class="nav-collapse ">
           
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><img src="images/SMK.jpg" class="img-circle" width="70"></p>
                  <h5 class="centered"><?php
              echo "Selamat Datang "?> <br>
              <?php echo $_SESSION['username'];?></h5>
         
                  <?php 
            $domain=$_SESSION['domain'];
            
            if($domain=='admin'){

                include "menu-admin.php";
            }
            
            if($domain=='dosen'){
                include "menu-dosen.php";
            }
            
            if($domain=='mahasiswa'){
                include "menu-mahasiswa.php";
            }
            
            ?>

           

              </ul>
              
          </div>
      </aside>



      <section id="main-content">
          <section class="wrapper">


              
    
      <?php include "content.php"; ?>
    </section>
</section>
</section>


<footer class="site-footer">
          <div class="text-center">
              2019 &copy; E-Grading SMK Teladan Kertasmaya
              <a href="home.php?page=admin#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
    </section>




 <script src="js/jquery.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery.sparkline.js"></script>


    
    <script src="js/common-scripts.js"></script>
    
    <script type="text/javascript" src="js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="js/gritter-conf.js"></script>

    
    <script src="js/sparkline-chart.js"></script>    
   
  
  <script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            
            title: 'E-Grading SMK Teladan Kertasmaya',
          
            text: 'Selamat Datang <?php echo $_SESSION['username']?> <br> <?php
echo "Waktu Akses : " . date("l") .", ". date("d-m-Y");
?> ',
            
            image: 'images/logo.png',
            
            sticky: true,
            
            time: '',
            
            class_name: 'my-sticky-class'
        });

        return false;
        });
  </script>
  
  <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  
  
      <script type="text/javascript" src="./tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    
    toolbar2: "print preview media | forecolor backcolor emoticons", 
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
        

     
    </body>
    </html>
    
<?php
}else{
  session_destroy();
  header('Location:index.php?status=Silahkan Login');
}
ob_flush();
?>  
