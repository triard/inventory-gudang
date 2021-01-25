<?php if($cek == 1){ ?>

<input type="hidden" name="id_item" value="<?php echo $items->id_item;?>">
<?php if($this->session->userdata('level')=="superadmin"){ ?>
<div class="form-group">
    <label>Nama Item</label><br>
    <input class="form-control" value="<?php echo $items->nama_item;?>" name="nama_item" type="text" placeholder="Nama"
        required>
</div>
<div class="form-group">
    <label>Jenis</label><br>
    <input class="form-control" value="<?php echo $items->jenis;?>" name="jenis" type="text" placeholder="Nama"
        required>
</div>
<div class="form-group">
    <label>Merk</label><br>
    <input class="form-control" value="<?php echo $items->merk;?>" name="merk" type="text" placeholder="Nama" required>
</div>
<?php }else{ ?>
    <input class="form-control" value="<?php echo $items->nama_item;?>" name="nama_item" type="hidden" placeholder="Nama"
        required>
    <input class="form-control" value="<?php echo $items->jenis;?>" name="jenis" type="hidden" placeholder="Nama" required>
    <input class="form-control" value="<?php echo $items->merk;?>" name="merk" type="hidden" placeholder="Nama" required>
<?php } ?>
<div class="form-group">
    <label>Limit Stok</label><br>
    <input class="form-control" value="<?php echo $items->stok_limit;?>" name="stok_limit" type="text"
        placeholder="Nama" required>
</div>
<?php } ?>