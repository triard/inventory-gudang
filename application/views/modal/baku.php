<?php if ($cek == 0) { ?>
<div class="form-group">
    <label>Nama Bahan Baku</label><br>
    <input class="form-control" name="nama_baku" type="text" placeholder="Nama"
        required>
</div>
<div class="form-group">
    <label>Netto</label><br>
    <input class="form-control" name="netto" type="text" placeholder="Netto"
        required>
</div>
<div class="form-group">
    <label>Merk</label><br>
    <input class="form-control" name="merk" type="text" placeholder="Merk">
</div>
<div class="form-group">
    <label>Limit Stok</label><br>
    <input class="form-control" name="stok_limit" type="text" placeholder="Limit Stok">
</div>
<?php } else if($cek == 1){ ?>
<input type="hidden" name="id_baku" value="<?php echo $baku->id_baku;?>">
<?php if($this->session->userdata('level')=="superadmin"){ ?>
<div class="form-group">
    <label>Nama baku</label><br>
    <input class="form-control" value="<?php echo $baku->nama_baku;?>" name="nama_baku" type="text" placeholder="Nama"
        required>
</div>
<div class="form-group">
    <label>Merk</label><br>
    <input class="form-control" value="<?php echo $baku->merk;?>" name="merk" type="text" placeholder="Merk">
</div>
<?php } else { ?>
    <input class="form-control" value="<?php echo $baku->nama_baku;?>" name="nama_baku" type="hidden" placeholder="Nama"
        required>
    <input class="form-control" value="<?php echo $baku->merk;?>" name="merk" type="hidden" placeholder="Merk">
<?php } ?>
<div class="form-group">
    <label>Limit Stok</label><br>
    <input class="form-control" value="<?php echo $baku->stok_limit;?>" name="stok_limit" type="text"
        placeholder="Nama" required>
</div>
<?php } ?>