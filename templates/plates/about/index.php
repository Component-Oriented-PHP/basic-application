<?php $this->layout('layouts/default', ['title' => 'About' /*this 'About' is to be replaced with  a variable passed by our controller*/]) ?>

Welcome to <span class="platesphp">PlatesPHP</span> About Us Page!

<?php $this->start('styles') ?>
<style>
    .platesphp {
        color: blue;
    }
</style>
<?php $this->end() ?>
