<?php if(isset($baku)) { ?>
<input name="nama_baku" value="<?php echo $baku->nama_baku;?>" type="hidden">
<div class="form-group">
    <label>Netto</label><br>
    <input class="form-control" name="netto" type="text" placeholder="Netto" value="<?php echo $baku->netto;?>" readonly>
</div>
<div class="form-group">
    <label>Merk</label><br>
    <input class="form-control" name="merk" type="text" placeholder="Merk" value="<?php echo $baku->merk;?>" readonly>
</div>
<?php }