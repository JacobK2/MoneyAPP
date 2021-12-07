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
if ($_SESSION['isActive']==0) {
    header('Location: ./logout.php');
    exit();
}
$idUser = '';
$name = '';
$value = '';
$idCurrency = '';
$idCategory = '';
$date = '';
$update = false;
$id = 0;
$archived = false;
if (file_exists("dash_header.php")) include("dash_header.php");
if (isset($_POST['saveGoal'])){
    $idUser = $_POST['idUser'];
    $name = $_POST['name'];
    $value = $_POST['value'];
    $idCurrency = $_POST['idCurrency'];
    $idCategory = $_POST['idCategory'];
    $date = $_POST['date'];
    $archived = $_POST['archived'];
    $link->query("INSERT INTO goals (idUser, `name`, `value`, idCurrency, idCategory, `date`, archived ) VALUES ('$idUser', '$name', '$value', '$idCurrency', '$idCategory', '$date', '$archived')") or die($link->error());
    echo "<meta http-equiv='refresh' content='0'>";
}
if (isset($_GET['deleteGoal'])){
    $id = $_GET['deleteGoal'];
    $link->query("DELETE FROM goals WHERE id=$id") or die($link->error());
}
if (isset($_GET['editGoal'])){
    $id = $_GET['editGoal'];
    $result = $link->query("SELECT * FROM goals WHERE id=$id") or die($link->error());
    if($result->num_rows){
        $row = $result->fetch_array();
        $idUser = $row['idUser'];
        $name = $row['name'];
        $value = $row['value'];
        $idCurrency = $row['idCurrency'];
        $idCategory = $row['idCategory'];
        $date = $row['date'];
        $archived = $row['archived'];
        $update = true;
    }
}
if (isset($_POST['updateGoal'])){
    $id = $_POST['id'];
    $idUser = $_POST['idUser'];
    $name = $_POST['name'];
    $value = $_POST['value'];
    $idCurrency = $_POST['idCurrency'];
    $idCategory = $_POST['idCategory'];
    $date = $_POST['date'];
    $archived = 0;
    $link->query("UPDATE goals SET idUser='$idUser', `name`='$name', `value`='$value', idCurrency='$idCurrency', idCategory='$idCategory', `date`='$date', archived='$archived' WHERE id=$id") or die($link->error());
}
?>

    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><?php if ($_SESSION['isAdmin']==1){
                                echo "Zarządzanie wszystkimi celami";
                            } 
                            else{
                                echo "Zarządzanie moimi celami";
                            }
                            ?>
                        </h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>Nr</th>
                        <?php if ($_SESSION['isAdmin']==1):
                        ?>
                        <th>Użytkownik</th>
                        <?php endif; ?>
                        <th>Nazwa</th>
                        <th>Kwota</th>
                        <th>Waluta</th>
                        <th>Kategoria</th>
                        <th>Data</th>
                        <th>Zarchiwizowane</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
				<tbody>
                    <?php
                        if ($_SESSION['isAdmin']==1):
                        $result = mysqli_query($link,"SELECT goals.id, goals.idUser, goals.name, goals.value, goals.idCurrency, goals.idCategory, goals.date, goals.archived, users.email, currency.currency, category.category FROM (((goals INNER JOIN users ON goals.idUser = users.id) INNER JOIN currency ON goals.idCurrency = currency.id) INNER JOIN category ON goals.idCategory = category.id);");
                        $i=1;
                        while($row = mysqli_fetch_array($result)) {
                    ?>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["value"]; echo " "; echo $row["currency"]; ?></td>
                    <td><?php echo $row["currency"]; ?></td>
                    <td><?php echo $row["category"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                    <td><?php echo $row["archived"]; ?></td>
					<td>
                        <a href="goals.php?editGoal=<?php echo $row['id']; ?>" class="btn btn-info">Edytuj</a>
                        <a href="goals.php?deleteGoal=<?php echo $row['id']; ?>" class="btn btn-danger">Usuń</a>
                    </td>
				    </tr>
                    <?php
                    $i++;
                    }
                        endif;
                        if ($_SESSION['isAdmin']==0):
                        $user = $_SESSION['id'];
                        $result = mysqli_query($link,"SELECT goals.id, goals.idUser, goals.name, goals.value, goals.idCurrency, goals.idCategory, goals.date, goals.archived, users.email, currency.currency, category.category FROM (((goals INNER JOIN users ON goals.idUser = users.id) INNER JOIN currency ON goals.idCurrency = currency.id) INNER JOIN category ON goals.idCategory = category.id) WHERE goals.idUser = $user ORDER BY goals.id DESC;");
                        $i=1;
                        while($row = mysqli_fetch_array($result)) {
                    ?>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["value"]; echo " "; echo $row["currency"]; ?></td>
                        <td><?php echo $row["currency"]; ?></td>
                        <td><?php echo $row["category"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["archived"]; ?></td>
                        <td>
                            <a href="goals.php?editGoal=<?php echo $row['id']; ?>" class="btn btn-info">Edytuj</a>
                            <a href="goals.php?deleteGoal=<?php echo $row['id']; ?>" class="btn btn-danger">Usuń</a>
                        </td>
                        </tr>
                    <?php
                    $i++;
                    }
                    endif;
                    ?>
				</tbody>
			</table>
        </div>
    </div>
    <br>
    <br>
    <!-- <div class="form-row justify-align-items-center"> -->
    <form action="goals.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php if ($_SESSION['isAdmin']==0):
        ?>
        <input type="hidden" name="idUser" value="<?php echo $_SESSION['id']; ?>">
        <?php endif; ?>
        <?php if ($_SESSION['isAdmin']==1):
        ?>
        <div class="col-auto">
        <label for="idUser" class="col-sm-2 col-form-label">Użytkownik</label>
        <select name="idUser" id="idUser">
            <?php 
            $resultCurr = mysqli_query($link,"SELECT * FROM users;");
            $i=1;
            while($row = mysqli_fetch_array($resultCurr)){
            ?>
            <option value="<?php echo $row['id'];?>"><?php echo $row['email'];?></option>
            <?php
            $i++;
            }
            ?>
        </select>
        </div>
        <?php endif; ?>
        <div class="col-auto">
            <label class="col-sm-2 col-form-label">Nazwa</label>
            <input type="text" name="name" class="form-control" placeholder="Podaj kwotę" value="<?php echo $name; ?>" required>
        </div>
        <br>
        <div class="col-auto">
            <label class="col-sm-2 col-form-label">Kwota</label>
            <input type="text" name="value" class="form-control" placeholder="Podaj kwotę" value="<?php echo $value; ?>" required>
        </div>
        <br>
        <div class="col-auto">
            <label for="idCurrency" class="col-sm-2 col-form-label">Waluta</label>
            <select name="idCurrency" id="idCurrency">
            <?php 
            $resultCurr = mysqli_query($link,"SELECT * FROM currency;");
            $i=1;
            while($row = mysqli_fetch_array($resultCurr)){
            ?>
            <option value="<?php echo $row['id'];?>"><?php echo $row['currency'];?></option>
            <?php
			$i++;
			}
			?>
            </select>
            <br>
        </div>
        <div class="col-auto">
            <label for="idCategory" id="idCategory" class="col-sm-2 col-form-label">Kategoria</label>
            <select name="idCategory" id="idCategory">
            <?php 
            $resultCat = mysqli_query($link,"SELECT * FROM category;");
            $i=1;
            while($row = mysqli_fetch_array($resultCat)){
            ?>
            <option value="<?php echo $row['id'];?>"><?php echo $row['category'];?></option>
            <?php
		    $i++;
			}
			?>
            </select>
        </div>
        <br>
        <div class="col-auto">
            <label for="data" id="data" class="col-sm-2 col-form-label">Data</label>
            <input type="date" id="date" name="date" class="form-control" placeholder="Wprowadź datę" value="<?php echo $date; ?>" required>
        </div>
        <br>
        <div class="col-auto">
            <input type="checkbox" id="archived" name="archived" value=<?php echo $archived; ?>>
            <label for="archived">Zarchiwizuj</label>
        </div>
        <br>
        <div class="col-auto">
            <?php
            if ($update == true):
            ?>
            <button type="submit" class="btn btn-info" name="updateGoal">Zmień</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="saveGoal">Zapisz</button>
            <?php endif; ?>
        </div>
    </form>
    
    <!-- </div> -->
<?php
if (file_exists("dash_footer.php")) include("dash_footer.php");
?>