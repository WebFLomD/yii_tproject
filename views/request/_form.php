<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(['Active' => 'Active', 'Resolver' => 'Resolver'], ['prompt' => '', 'id' => 'status-dropdown']) ?>

    <div id="comment-container" style="display: none;"> <!-- Скрываем контейнер с комментарием по умолчанию -->
        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    </div>

    <?php $script = <<< JS
        $(document).ready(function() {
            function toggleCommentField() {
                var status = $('#status-dropdown').val();
                if (status === 'Resolver') {
                    $('#comment-container').show(); // Показываем поле комментария
                } else {
                    $('#comment-container').hide(); // Скрываем поле комментария
                }
            }
            toggleCommentField();
        
            // Обработчик события изменения для выпадающего списка
            $('#status-dropdown').change(function() {
                toggleCommentField();
            });
        });
       JS;
    $this->registerJs($script); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
