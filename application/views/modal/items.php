<?php if($cek == 1){ ?>
	
<input type="hidden" name="id_item" value="<?php echo $items->id_item;?>">
<div class="form-group">
    <label>Limit Stok</label><br>
    <input class="form-control" value="<?php echo $items->stok_limit;?>" name="stok_limit" type="text" placeholder="Nama"
        required>
</div>
<?php } ?>