<?php if(isset($baku)) { ?>
   
<div class="form-group">
    <label>Nama Bahan Baku</label><br>
    <input class="form-control" name="nama_baku" type="text" placeholder="Nama Bahan Baku" value="<?php echo $baku->nama_baku;?>" readonly>
</div>
<div class="form-group">
    <label>Netto</label><br>
    <input class="form-control" name="netto" type="text" placeholder="Netto" value="<?php echo $baku->netto;?>" readonly>
</div>
<div class="form-group">
    <label>Merk</label><br>
    <input class="form-control" name="merk" type="text" placeholder="Merk" value="<?php echo $baku->merk;?>" readonly>
</div>

<?php } else { ?>
<div class="form-group">
    <label>Nama Bahan Baku</label><br>
    <input class="form-control" name="nama_baku" type="text" placeholder="Nama Bahan Baku" readonly>
</div>
<div class="form-group">
    <label>Netto</label><br>
    <input class="form-control" name="netto" type="text" placeholder="Netto" readonly>
</div>
<div class="form-group">
    <label>Merk</label><br>
    <input class="form-control" name="merk" type="text" placeholder="Merk" readonly>
</div>
<?php } ?>