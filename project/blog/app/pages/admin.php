
<?php include_once 'admin_page/Layout/Header.php';?>

<?php
  if(!logged_in())
  {
    redirect('login');
  }

  $section  = $url[1] ?? 'dashboard';
  $action   = $url[2] ?? 'view';
  $id       = $url[3] ?? 0;

  $filename = "../app/pages/admin_page/".$section.".php";
  if(!file_exists($filename))
  {
    $filename = "../app/pages/404.php";
  }
  // if($section == 'users')
  // {
  //   require_once "../app/pages/admin_page/users-controller.php";
  // }else
  // if($section == 'categories')
  // {
  //   require_once "../app/pages/admin_page/categories-controller.php";
  // }else
  // if($section == 'posts')
  // {
  //   require_once "../app/pages/admin_page/posts-controller.php";
  // }
?>
<body>
    <div class="app-container app-theme-gray app-sidebar-full">
      <div class="app-main">

        <?php
           include_once 'admin_page/Layout/Sidebar.php';
        ?>

        <div class="app-main__outer">
          <div class="app-main__inner">
            <div class="app-inner-layout app-inner-layout-page">
              <div class="app-inner-layout__wrapper pt-5">
                <?php
                    require_once $filename;
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
       include_once 'admin_page/Layout/Footer.php';
    ?>
