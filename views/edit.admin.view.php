<?php
$title = FAQ_DASHBOARD_EDIT_TITLE;
$description = FAQ_DASHBOARD_DESC;

/* @var \CMW\Entity\Faq\FaqEntity $faq */
?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="" method="post">
                        <div class="card card-primary">

                            <div class="card-header">
                                <h3 class="card-title"><?= FAQ_DASHBOARD_TABLE_EDIT_TITLE ?>
                                    <strong><?= $faq->getFaqId() ?></strong></h3>
                            </div>

                            <div class="card-body">

                                <label for="question"><?= FAQ_DASHBOARD_ADD_QUESTION_LABEL ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-question"></i></i></span>
                                    </div>
                                    <input type="text" name="question" class="form-control"
                                           placeholder="<?= FAQ_DASHBOARD_ADD_QUESTION_PLACEHOLDER ?>"
                                           value="<?= $faq->getQuestion() ?>" required>

                                </div>

                                <label for="question"><?= FAQ_DASHBOARD_ADD_RESPONSE_LABEL ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-paper-plane"></i></span>
                                    </div>
                                    <input type="text" name="response" class="form-control"
                                           placeholder="<?= FAQ_DASHBOARD_ADD_RESPONSE_PLACEHOLDER ?>"
                                           value="<?= $faq->getResponse() ?>" required>
                                </div>

                            </div>


                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-primary float-right"><?= CORE_BTN_SAVE ?></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>