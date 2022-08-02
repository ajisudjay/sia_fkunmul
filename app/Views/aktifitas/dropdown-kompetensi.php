<?php if ($jenis == 'IPE') { ?>
    <option>0</option>
<?php } else { ?>
    <?php foreach ($kompetensi as $dataKompetensi) : ?>
        <option value="<?= $dataKompetensi['id_sub_kompetensi'] ?>"><?= $dataKompetensi['sub_kompetensi'] ?></option>
    <?php endforeach ?>
<?php } ?>