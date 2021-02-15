<?php if(isset($baku)) { ?>
<input name="nama_baku" value="<?php echo $baku->nama_baku;?>" type="hidden">
<div class="form-group">
    <label>Produsen</label><br>
    <input class="form-control" name="produsen" type="text" placeholder="Produsen" value="<?php echo $baku->produsen;?>" readonly>
</div>
<?php }