<?php
    session_start();
    include '../koneksi.php';
    if (!isset($_SESSION['username'])) {
        header("Location:../index.html");
    }
    if (empty($_SESSION['username'])) {
        echo "<script type='text/javascript'>alert('Success, please sign in first!')</script>";
        echo "<script language='javascript' type='text/javascript'> location.href='../index.html'</script>";
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
  <header class="app-header"><a class="app-header__logo" href="">Apotik Gowok</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="logout_user.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">Hello, <?php echo $_SESSION['username'];?></p>
          <p class="app-sidebar__user-designation"> <?php echo $_SESSION['jabatan'];?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="utama_customer.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Inventory</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             <li><a class="treeview-item active" href="profil_obat_pelanggan.php"><i class="icon fa fa-circle-o"></i> Medicine</a></li>
             <li><a class="treeview-item" href="profil_category_pelanggan.php"><i class="icon fa fa-circle-o"></i> Category</a></li>
             <li><a class="treeview-item" href="profil_suppliers_pelanggan.php"><i class="icon fa fa-circle-o"></i> Suppliers</a></li>
          </ul>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             <li><a class="treeview-item" href="profil_pembelian_pelanggan.php"><i class="icon fa fa-circle-o"></i> Purchase</a></li>
          </ul>
        </li>
      </ul>
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-laptop"></i> Medicine Inventory </h1>
          <p>Table to display medicine data</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Inventory</li>
          <li class="breadcrumb-item active"><a href="">Medicine</a></li>
        </ul>
      </div>
    <ul class="app-nav">
         <li class="app-search">
          <form action="profil_obat_pelanggan_act.php" method="GET">
            <input class="app-search__input" type="text" placeholder="Search medicine" name="cari">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
          </form>
        </li>
      </ul>
            <?php $no=1; $tampil = mysqli_query($koneksi, "SELECT * FROM data_obat ORDER BY id_obat");
                if (mysqli_num_rows($tampil) > 0) { ?>
            <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr align="center">
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Selling Price</th>
                    <th>Purchase Price</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
            <?php if(isset($_GET['cari'])){
                $cari=mysqli_real_escape_string($koneksi, $_GET['cari']);
                if ($cari!="") {
                    // $tampil=mysqli_query($koneksi, "SELECT * FROM data_obat where nama_obat LIKE '%$cari%' OR nama_kategori LIKE '%$cari%'");
                    $tampil=mysqli_query($koneksi, "CALL GetMedicine('$cari')");
                }
            }
            while ($data=mysqli_fetch_array($tampil)) { ?>
            <td hidden="hidden"> <?php echo $data['id_obat'];?> </td>
            <td align="center"> <?php echo $no;?> </td>
            <td align="left"> <?php echo $data['nama_obat'];?> </td>
            <td align="center"> <?php echo $data['nama_kategori'];?> </td>
            <td align="center"> <?php echo $data['harga_jual'];?> </td>
            <td align="center"> <?php echo $data['harga_beli'];?> </td>
            <td align="center"> <?php echo $data['jumlah_obat'];?> </td>
            <td align="left"> <?php echo $data['nama_supplier'];?> </td>
            <?php $no++; ?>
        </tr>
                <?php } }?>
    </table>
</button>
</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</button>
</main>
<script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
      }
    </script>
</html>