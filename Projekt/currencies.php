<?php
session_start();
if (file_exists("./.config/connect.php")) include_once("./.config/connect.php");
if (file_exists(".config/config.php")) include_once(".config/config.php");
if (!file_exists(".config/config.php")){
    header('Location: install.php');
    exit();
}
if (!file_exists(".config/connect.php")){
    header('Location: install.php');
    exit();
}
if (!isset($_SESSION['zalogowany'])) {
    header('Location: ./index.php');
    exit();
}
if ($_SESSION['isAdmin']==0) {
    header('Location: ./dashboard.php');
    exit();
}
if ($_SESSION['isActive']==0) {
    header('Location: ./logout.php');
    exit();
}
$currency = '';
$update = false;
$id = 0;
if (file_exists("dash_header.php")) include("dash_header.php");
if (isset($_POST['saveCurr'])){
    $currency = $_POST['currency'];
    $link->query("INSERT INTO currency (currency) VALUES ('$currency')") or die($link->error());
    echo "<meta http-equiv='refresh' content='0'>";
}
if (isset($_GET['deleteCurr'])){
    $id = $_GET['deleteCurr'];
    $link->query("DELETE FROM currency WHERE id=$id") or die($link->error());
}
if (isset($_GET['editCurr'])){
    $id = $_GET['editCurr'];
    $result = $link->query("SELECT * FROM currency WHERE id=$id") or die($link->error());
    if($result->num_rows){
        $row = $result->fetch_array();
        $currency = $row['currency'];
        $update = true;
    }
}
if (isset($_POST['updateCurr'])){
    $id = $_POST['id'];
    $currency = $_POST['currency'];
    $link->query("UPDATE currency SET currency='$currency' WHERE id=$id") or die($link->error());
}
?>
    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Zarządzanie walutami</h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>Nr</th>
                        <th>Waluta</th>
                    </tr>
                </thead>
				<tbody>
				<?php
					$result = mysqli_query($link,"SELECT * FROM currency");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["currency"]; ?></td>
					<td>
                        <a href="currencies.php?editCurr=<?php echo $row['id']; ?>" class="btn btn-info">Edytuj</a>
                        <a href="currencies.php?deleteCurr=<?php echo $row['id']; ?>" class="btn btn-danger">Usuń</a>
                    </td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
        </div>
    </div>
    <div class="row justify-content-center">
    <form action="currencies.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label>Nazwa waluty</label>
            <input type="text" name="currency" class="form-control" placeholder="Wprowadź nazwę waluty" value="<?php echo $currency; ?>" required>
        </div>
        <div class="form-group">
            <?php
            if ($update == true):
            ?>
            <button type="submit" class="btn btn-info" name="updateCurr">Zmień</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="saveCurr">Zapisz</button>
            <?php endif; ?>
        </div>
    </form>
    </div>
<?php
if (file_exists("dash_footer.php")) include("dash_footer.php");
?>