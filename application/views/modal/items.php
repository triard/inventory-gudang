<?php if($cek == 0) { ?>
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" name="nama_items" type="text" placeholder="Nama Items" required>
</div>
<div class="form-group">
	<label>Jenis</label><br>
    <input class="form-control" name="jenis" type="text" placeholder="Jenis" required>
</div>
<div class="form-group">
	<label>Netto</label><br>
    <input class="form-control" name="netto" type="text" placeholder="Netto" required>
</div>
<div class="form-group">
	<label>Merk</label><br>
    <input class="form-control" name="merk" type="text" placeholder="Merk" required>
</div>
<div class="form-group">
	<label>Stok</label><br>
    <input class="form-control" name="stok" type="text" placeholder="Stok" required>
</div>
<?php } else if($cek == 1){ ?>
<input type="hidden" name="id_user" value="<?php echo $user->id_user;?>">
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" value="<?php echo $user->nama_user;?>" name="nama_user" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Email</label><br>
    <input class="form-control" value="<?php echo $user->email;?>" name="email" type="email" placeholder="Email" required>
</div>
<div class="form-group">
	<label>Level</label><br>
	<select name="level" id="level" class="form-control" value="<?php echo $user->level;?>">
	  <option value="admin">Admin</option>
	  <option value="superadmin">Super Admin</option>
	</select>
</div>
<?php } else if($cek == 2){ ?>
<input type="hidden" name="id_user" value="<?php echo $user->id_user;?>">
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" value="<?php echo $user->nama_user;?>" name="nama_user" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Email</label><br>
    <input class="form-control" value="<?php echo $user->email;?>" name="email" type="email" placeholder="Email" required>
</div>
<div class="form-group">
	<label>Level</label><br>
	<select name="level" id="level" class="form-control" value="<?php echo $user->level;?>">
	  <option value="admin">Admin</option>
	  <option value="superadmin">Super Admin</option>
	</select>
</div>
<?php } else if($cek == 3){ ?>
<input type="hidden" name="id_user" value="<?php echo $user->id_user;?>">
<div class="form-group">
	<label>Nama</label><br>
    <input class="form-control" value="<?php echo $user->nama_user;?>" name="nama_user" type="text" placeholder="Nama" required>
</div>
<div class="form-group">
	<label>Email</label><br>
    <input class="form-control" value="<?php echo $user->email;?>" name="email" type="email" placeholder="Email" required>
</div>
<div class="form-group">
	<label>Level</label><br>
	<select name="level" id="level" class="form-control" value="<?php echo $user->level;?>">
	  <option value="admin">Admin</option>
	  <option value="superadmin">Super Admin</option>
	</select>
</div>
<?php } ?>