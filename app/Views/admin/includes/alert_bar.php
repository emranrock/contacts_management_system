<?php 
if(session()->has('message')){
?>
    <div class="alert alert-<?= session()->getFlashdata('alert-class') ?>">
         <?= session()->getFlashdata('message') ?>
    </div>
<?php
}
?>