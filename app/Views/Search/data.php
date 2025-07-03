<?php
$d = $data;
if (isset($d['hp'])) {
    $hp = $this->data('Validasi')->valid_wa_direct($d['hp']); ?>
    <div class="p-2 rounded border">
        <div class="d-flex justify-content-between">
            <div class="px-1">
                <span class="fw-bold"><?= $d['nama'] ?></span><br>
                <?= $d['hp'] ?>
            </div>
            <div style="cursor: pointer;" class="px-1 text-success">
                <a target="_blank" class="text-success" href="https://api.whatsapp.com/send?phone=<?= $hp ?>&text=">
                    <h2><i class="fab fa-whatsapp"></i></h2>
                </a>
            </div>
        </div>
    </div>
<?php
} else { ?>
    <div class="p-2 rounded border">
        <div class="d-flex justify-content-between">
            <div class="px-1">
                No Data
            </div>
        </div>
    </div>
<?php } ?>