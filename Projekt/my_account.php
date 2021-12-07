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
if (file_exists("dash_header.php")) include("dash_header.php");
?>

    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Moje Konto</h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
						<th>Email</th>
                        <th>Hasło</th>
                    </tr>
                </thead>
				<tbody>
				
				<?php
                    $sessionid = $_SESSION['id'];
					$result = mysqli_query($link,"SELECT * FROM users WHERE `id` = $sessionid");
                    $row = mysqli_fetch_array($result);
				?>
					<td><?php echo $row["imie"]; ?></td>
					<td><?php echo $row["nazwisko"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["password"]; ?></td>
					<td>
						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $row["id"]; ?>"
							data-imie="<?php echo $row["imie"]; ?>"
							data-nazwisko="<?php echo $row["nazwisko"]; ?>"
							data-email="<?php echo $row["email"]; ?>"
							data-password="<?php echo $row["password"]; ?>"
                            data-isAdmin="<?php echo $row["isAdmin"]; ?>"
							data-isActive="<?php echo $row["isActive"]; ?>"
							title="Edit">&#xE254;</i>
						</a>
						<!-- <a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete">&#xE872;</i></a> -->
                    </td>
				</tr>
				</tbody>
			</table>
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edytuj użytkownika</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Imie</label>
							<input type="text" id="imie_u" name="imie" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nazwisko</label>
							<input type="text" id="nazwisko_u" name="nazwisko" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="email_u" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Hasło</label>
							<input type="text" id="password_u" name="password" class="form-control" required>
						</div>
                        <div class="form-group">
							<input type="hidden" value=<?php echo $_SESSION['isAdmin'];?> id="isAdmin_u" name="isAdmin" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="hidden" value=<?php echo $_SESSION['isActive'];?> id="isActive_u" name="isActive" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Aktualizuj</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<!-- <div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Usuń moje konto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Czy jesteś pewien, że chcesz usunąć te konta?</p>
						<p class="text-warning"><small>Tej czynności nie można cofnąć!</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Usuń</button>
					</div>
				</form>
			</div>
		</div>
	</div> -->
<?php
if (file_exists("dash_footer.php")) include("dash_footer.php");
?>