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
$category = '';
$update = false;
$id = 0;
if (file_exists("dash_header.php")) include("dash_header.php");
if (isset($_POST['saveCat'])){
    $category = $_POST['category'];
    $link->query("INSERT INTO category (category) VALUES ('$category')") or die($link->error());
    echo "<meta http-equiv='refresh' content='0'>";
}
if (isset($_GET['deleteCat'])){
    $id = $_GET['deleteCat'];
    $link->query("DELETE FROM category WHERE id=$id") or die($link->error());
}
if (isset($_GET['editCat'])){
    $id = $_GET['editCat'];
    $result = $link->query("SELECT * FROM category WHERE id=$id") or die($link->error());
    if($result->num_rows){
        $row = $result->fetch_array();
        $category = $row['category'];
        $update = true;
    }
}
if (isset($_POST['updateCat'])){
    $id = $_POST['id'];
    $category = $_POST['category'];
    $link->query("UPDATE category SET category='$category' WHERE id=$id") or die($link->error());
}
?>
    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Zarządzanie kategoriami</h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>Nr</th>
                        <th>Kategoria</th>
                    </tr>
                </thead>
				<tbody>
				<?php
					$result = mysqli_query($link,"SELECT * FROM category");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["category"]; ?></td>
					<td>
                        <a href="categories.php?editCat=<?php echo $row['id']; ?>" class="btn btn-info">Edytuj</a>
                        <a href="categories.php?deleteCat=<?php echo $row['id']; ?>" class="btn btn-danger">Usuń</a>
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
    <form action="categories.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label>Nazwa kategorii</label>
            <input type="text" name="category" class="form-control" placeholder="Wprowadź nazwę kategorii" value="<?php echo $category; ?>" required>
        </div>
        <div class="form-group">
            <?php
            if ($update == true):
            ?>
            <button type="submit" class="btn btn-info" name="updateCat">Zmień</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="saveCat">Zapisz</button>
            <?php endif; ?>
        </div>
    </form>
    </div>
<?php
if (file_exists("dash_footer.php")) include("dash_footer.php");
?>