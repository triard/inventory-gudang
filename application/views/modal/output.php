<?php if($cek == 0) { ?>
<div class="form-group">
    <label>Item</label>
    <select name="id_items" class="custom-select form-control" required>
        <option selected>Item</option>
        <?php foreach ($item as $i): ?>
        <option value="<?php echo  $i->id_item?>"><?php echo $i->nama_item ?></option>
        <?php endforeach; ?>
    </select> 
</div>
<div class="form-group">
    <label>Quantity</label><br>
    <input class="form-control" name="qty_output" type="number" placeholder="000" required>
</div>
<div class="form-group">
    <label>Tanggal</label><br>
    <input class="form-control" name="tgl_output" type="date" placeholder="00-00-0000" required>
</div>
<div class="form-group">
    <label>Id User</label><br>
    <input class="form-control" name="id_user" type="text" placeholder="sementara input dengan id" required>
</div>
<?php } else { ?>
    <?php foreach ($outputEdit as $outputEdit): ?>
    <input type="hidden" name="id_output" value="<?php echo $outputEdit->id_output;?>">
    <div class="form-group">
    <label>Item</label>
    <select name="id_items" class="custom-select form-control" required>
        <option selected value="<?php echo  $outputEdit->id_item?>"><?php echo $outputEdit->nama_item ?></option>
        <?php foreach ($item as $i): ?>
        <option value="<?php echo  $i->id_item?>"><?php echo $i->nama_item ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label>Quantity</label><br>
    <input class="form-control" name="qty_output" type="number" value="<?php echo  $outputEdit->qty_output?>" placeholder="000" required>
</div>
<div class="form-group">
    <label>Tanggal</label><br>
    <input class="form-control" name="tgl_output" type="date" value="<?php echo  $outputEdit->tgl_output?>" placeholder="00-00-0000" required>
</div>
<div class="form-group">
    <label>Id User</label><br>
    <input class="form-control" name="id_user" type="text" value="<?php echo  $outputEdit->id_user?>" placeholder="sementara input dengan id" required>
</div>
<?php endforeach; ?>
<?php } ?>