<?php $this->layout('layouts/default', ['title' => $title]) ?>

Welcome to <span class="platesphp">PlatesPHP</span>!

<?php $this->start('styles') ?>
<style>
    .platesphp {
        color: red;
    }
</style>
<?php $this->end() ?>