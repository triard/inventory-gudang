<?php if(isset($items)) { ?>
<div class="form-group">
    <label>Jenis</label><br>
    <input class="form-control" name="jenis" type="text" placeholder="Jenis" value="<?php echo $items->jenis;?>" disabled>
</div>
<div class="form-group">
    <label>Netto</label><br>
    <input class="form-control" name="netto" type="text" placeholder="Netto" value="<?php echo $items->netto;?>" disabled>
</div>
<div class="form-group">
    <label>Merk</label><br>
    <input class="form-control" name="merk" type="text" placeholder="Merk" value="<?php echo $items->merk;?>" disabled>
</div>
<?php }