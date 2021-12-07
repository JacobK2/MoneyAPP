<?php
session_start();
  
if (file_exists(".config/config.php")) include_once(".config/config.php");
if ($dev == 1){
  ini_set( 'display_errors', 'On' );
  error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
}
if (file_exists(".config/connect.php")) require_once(".config/connect.php");

if (file_exists("dash_header.php")) include("dash_header.php");

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">Page Not Found</p>
                        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                        <a href="dashboard.php">&larr; Back to Dashboard</a>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>

<?php
if (file_exists("dash_footer.php")) include("dash_footer.php");

?>