<?php $d = $data; ?>
<div class="p-2 rounded border">
    <div class="d-flex justify-content-between">
        <div class="px-1">
            <span class="fw-bold"><?= $d['nama'] ?></span><br>
            <?= $d['hp'] ?>
        </div>
        <div style="cursor: pointer;" class="px-1 text-success">
            <h2><i class="fab fa-whatsapp"></i></h2>
        </div>
    </div>
</div>