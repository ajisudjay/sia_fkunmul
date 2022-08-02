<?php if ($jenis == 'IPE') { ?>
    <option value="0">0</option>
<?php } else { ?>
    <?php foreach ($kompetensi as $dataKompetensi) :
        if ($dataKompetensi == null) { ?>
            <option value="<?= $id_sub_kompetensi ?>"><?= $sub_kompetensi ?></option>
        <?php } else { ?>
            <option value="<?= $dataKompetensi['id_sub_kompetensi'] ?>"><?= $dataKompetensi['sub_kompetensi'] ?></option>
        <?php } ?>
    <?php endforeach ?>
<?php } ?>