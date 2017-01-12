<?php

/* @var $this yii\web\View */

$this->title = 'Daw2 - 2016 - Actividades y eventos';
?>
<div class="site-index">

    <div class="jumbotron">

    <?php
    $session = Yii::$app->session;
    $reg= $session->get('reg');
    if($reg=='ok')
    {?>
        <h1>Usuario creado correctamente</h1>
        <?php $session->remove('reg');?>

       <?php } else {?>

        <h1>Bienvenido!</h1>

        <?php }?>

        <p class="lead">.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Noticia 1.</p>

                  </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Noticia 2.</p>

                
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Noticia 3.</p>
                
            </div>
        </div>

    </div>
</div>
