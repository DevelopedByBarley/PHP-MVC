<?php $levels = (object)[1, 2, 3] ?>
<div class="modal fade " id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModelLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header d-flex justify-content-between  text-white bg-purple-600">
				<h5 class="modal-title" id="exampleModalLabel">Admin hozzáadása</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" action="/admin/store">
					<?= $csrf->generate() ?>
					<div class="form-group my-2">
						<label for="exampleInputEmail1">Név</label>
						<input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Admin neve" value="<?= isset($prev->add_admin_modal->name) ? $prev->add_admin_modal->name : '' ?>" required
							validators='{"name": "name","required": true,"minLength": 12,"maxLength": 50,"noSpaces": true}'>
					</div>
					<div class="form-outline">
						<label class="form-label" for="form3Example3">E-mail cím</label>
						<input name="email" type="email" id="form3Example3" class="form-control" placeholder="admin@example.com" value="<?= isset($prev->add_admin_modal->email) ? $prev->add_admin_modal->email : '' ?>" required
							validators='{"name": "email","required": true,"email": true,"minLength": 12,"maxLength": 50}' />
					</div>
					<div class="form-outline">
						<label for="password">Jelszó</label>
						<input type="text" id="password" name="password" class="password form-control" placeholder="Jelszó" required
							validators='{"name": "password","required": true, "password": true,"match": "repeat"}' />
						<button type="button" class="d-inline btn border pw-generator">Generálás</button>
					</div>

					<div class="form-outline my-2">
						<label for="repeat">Jelszó megismétlése</label>
						<input type="text" id="repeat" name="repeat" class="form-control" placeholder="Jelszó megismétlése" required
							validators='{"name": "repeat","password": true,"match": "password","comparePw": true}' />
					</div>
					<div class="form-group my-2">
						<label for="level">Szint</label>
						<select class="form-select" name="level" aria-label="Default select example" required>
							<option value="" selected>Válassza ki az admin szintet</option>
							<?php foreach ($levels as $level): ?>
								<option <?= isset($prev->add_admin_modal->level) && (int)$level === (int)$prev->add_admin_modal->level ? 'selected' : '' ?> value="<?= $level ?>"><?= $level ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="avatars">
						<div class="row">
							<label for="avatars" class="my-3">Avatar kiválasztása</label>
							<?php foreach (AVATARS as $avatar) : ?>
								<div class="col-2 d-flex align-items-center justify-content-center mb-2">
									<div class="form-check form-check-inline image-radio">
										<input required class="form-check-input" type="radio" name="avatar-radio" id="avatar_radio-<?php echo $avatar; ?>" value="<?php echo $avatar; ?>">
										<label class="form-check-label" for="avatar_radio-<?php echo $avatar; ?>">
											<img src="/public/assets/images/avatars/<?php echo $avatar; ?>.png" class="h-45 w-45" alt="<?php echo ucfirst($avatar); ?>">
										</label>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn bg-purple-500 hover-bg-purple-600">Elküld</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
			</div>
			</form>
		</div>
	</div>
</div>