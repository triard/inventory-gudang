<?php if($cek == 0) { ?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Bahan Baku</label>
            <select name="id_baku" class="select2 baku" required>
                <!-- <option value="0">baku Baru</option> -->
                <option disabled selected>Pilih Bahan Baku</option>
                <?php foreach ($baku as $i): ?>
                <option value="<?php echo  $i->id_baku?>"><?php echo $i->nama_baku;?> <?php echo $i->netto;?> - <?php echo $i->merk;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="set-baku">
            <div class="form-group">
                <label>Nama Bahan Baku</label><br>
                <input class="form-control" name="nama_baku" type="text" placeholder="Nama baku" readonly>
            </div>
            <div class="form-group">
                <label>Netto</label><br>
                <input class="form-control" name="netto" type="text" placeholder="Netto" readonly>
            </div>
            <div class="form-group">
                <label>Merk</label><br>
                <input class="form-control" name="merk" type="text" placeholder="Merk" readonly>
            </div>
        </div>
        <div class="form-group">
            <label>Tanggal</label><br>
            <input class="form-control" name="tgl_input" type="date" placeholder="00-00-0000" required>
        </div>
        <div class="form-group">
            <label>Expired</label><br>
            <input class="form-control" name="expired" type="date" placeholder="00-00-0000" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Supplier</label>
            <select name="id_supplier" class="select2 supp" required>
                <option value="0">Supplier Baru</option>
                <option disabled>------------</option>
                <?php foreach ($supplier as $s): ?>
                <option value="<?php echo $s->id_supplier?>"><?php echo $s->nama_supplier ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="set-supplier">
            <div class="form-group">
                <label>Nama Supplier</label><br>
                <input class="form-control" name="nama_supplier" type="text" placeholder="Nama Supplier" readonly>
            </div>
            <div class="form-group">
                <label>Kontak</label><br>
                <input class="form-control" name="kontak" type="text" placeholder="Kontak" readonly>
            </div>
        </div>
        <div class="form-group">
            <label>Quantity</label><br>
            <input class="form-control" name="qty_input" type="number" placeholder="000" required>
        </div>
        <div class="form-group">
            <label>Koli / Box</label><br>
            <input class="form-control" name="kb_input" type="number" placeholder="000" required>
        </div>
        <div class="form-group">
            <label>No. Batch</label><br>
            <input class="form-control" name="batch" type="text" placeholder="No. Batch" required>
        </div>
        <!-- <input name="id_user" value="1" type="hidden"> -->
    </div>
</div>
<?php } else { ?>
    <?php foreach ($inputEdit as $inputEdit): ?>
    <input type="hidden" name="id_input" value="<?php echo $inputEdit->id_input;?>">
    <input name="id_user" type="hidden" value="<?php echo  $inputEdit->id_user?>">
    <div class="form-group">
    <label>Bahan Baku</label>
    <select name="id_baku" class="custom-select form-control" required>
        <option selected value="<?php echo  $inputEdit->id_baku?>" read><?php echo $inputEdit->nama_baku ?></option>
    </select>
</div>
<div class="form-group">
    <label>Supplier</label>
    <select name="id_supplier" class="custom-select form-control" required>
        <option selected value="<?php echo  $inputEdit->id_supplier?>"><?php echo $inputEdit->nama_supplier ?></option>
        <option disabled>--------------------------</option>
        <?php foreach ($supplier as $s): ?>
        <option value="<?php echo  $s->id_supplier?>"><?php echo $s->nama_supplier ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label>Quantity</label><br>
    <input class="form-control" name="qty_input" type="number" value="<?php echo  $inputEdit->qty_input?>" placeholder="000" required>
</div>
<div class="form-group">
    <label>Koli / Box</label><br>
    <input class="form-control" name="kb_input" type="number" value="<?php echo  $inputEdit->kb_input?>" placeholder="000" required>
</div>
<div class="form-group">
    <label>Tanggal</label><br>
    <input class="form-control" name="tgl_input" type="date" value="<?php echo  $inputEdit->tgl_input?>" placeholder="00-00-0000" required>
</div>
<div class="form-group">
    <label>Expired</label><br>
    <input class="form-control" name="expired" value="<?php echo  $inputEdit->expired?>" type="date" placeholder="00-00-0000" required>
</div>
<div class="form-group">
    <label>No. Batch</label><br>
    <input class="form-control" name="batch" value="<?php echo  $inputEdit->batch?>" type="text" placeholder="No. Batch" required>
</div>
<?php endforeach; ?>
<?php } ?>
<script>
$("select.select2").select2({
    dropdownAutoWidth: !0,
    width: "100%",
    dropdownParent: $(".modal")
})
$(".supp").on("change keydown paste input", function() {
    var a = $(".supp").val();
    $.get("<?php echo base_url();?>inputbaku/set_supplierBaku/" + a, function (b) {
        $(".set-supplier").html(b);
    })
})
$(".baku").on("change keydown paste input", function() {
    var a = $(".baku").val();
    $.get("<?php echo base_url();?>inputbaku/set_baku/" + a, function (b) {
        $(".set-baku").html(b);
    })
})
</script>