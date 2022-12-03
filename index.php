<?php
session_start();
include ('includes/config.php');

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Зачем ты сюда смотришь">
    <meta name="author" content="">
    <meta name="yandex-verification" content="9dae2672cc951402" />

    <title>Wilastian.ru | News</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

  </head>


  <body>
      
      <!-- Прелоадер -->
   <div class="preloader">
  <div class="preloader__row">
    <div class="preloader__item"></div>
    <div class="preloader__item"></div>
  </div>
</div>

    <!-- Navigation -->
   <?php include ('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container">


     
      <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <!-- Blog Post -->
<?php
if (isset($_GET['pageno']))
{
    $pageno = $_GET['pageno'];
}
else
{
    $pageno = 1;
}
$no_of_records_per_page = 8;
$offset = ($pageno - 1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM tblposts";
$result = mysqli_query($con, $total_pages_sql);
$total_rows = mysqli_fetch_array($result) [0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$query = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
while ($row = mysqli_fetch_array($query))
{
?>

          <div class="card mb-4">
  <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>">  <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>"  alt="<?php echo htmlentities($row['posttitle']); ?>"></a>
            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                 <p><b>Category : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid']) ?>"><?php echo htmlentities($row['category']); ?></a> </p>
       
              <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo htmlentities($row['postingdate']); ?>
           
            </div>
          </div>
<?php
} ?>
       

      

          <!-- Pagination -->


    <ul class="pagination justify-content-center mb-4">
        <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
        <li class="<?php if ($pageno <= 1)
{
    echo 'disabled';
} ?> page-item">
            <a href="<?php if ($pageno <= 1)
{
    echo '#';
}
else
{
    echo "?pageno=" . ($pageno - 1);
} ?>" class="page-link">Prev</a>
        </li>
        <li class="<?php if ($pageno >= $total_pages)
{
    echo 'disabled';
} ?> page-item">
            <a href="<?php if ($pageno >= $total_pages)
{
    echo '#';
}
else
{
    echo "?pageno=" . ($pageno + 1);
} ?> " class="page-link">Next</a>
        </li>
        <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
    </ul>

        </div>

        <!-- Sidebar Widgets Column -->
      <?php include ('includes/sidebar.php'); ?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
      <?php include ('includes/footer.php'); ?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(90719410, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/90719410" alt="" style="position:absolute; left:-9999px;"  /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
  window.onload = function () {
    document.body.classList.add('loaded_hiding');
    window.setTimeout(function () {
      document.body.classList.add('loaded');
      document.body.classList.remove('loaded_hiding');
    }, 500);
  }
</script>

<!--<script src="duino-js.min.js"></script> 
<script>
    username = `Wilastian`; //put your username here (e.g. revox, ericddm, snehaislove or Hoiboy19), the default is Hoiboy19.
    rigid = `Duino-JS`; //If you want to change the rig ID, you can change this. If you want to keep using "Duino-JS", you can remove this line.
    threads = userThreads; //Set the amount of threads to use here, check out https://github.com/sys-256/Duino-JS for more options. The default is 1.
    startMiner(); //starts the miner
</script>
-->
</body>

</html>
