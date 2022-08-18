<?php

use CMW\Manager\Lang\LangManager;

$title = LangManager::translate("faq.dashboard.edit.title");
$description = LangManager::translate("faq.dashboard.edit.desc");

/* @var \CMW\Entity\Faq\FaqEntity $faq */
?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="" method="post">
                        <div class="card card-primary">

                            <div class="card-header">
                                <h3 class="card-title"><?= LangManager::translate("faq.dashboard.table.edit", ["faq_number" => $faq->getFaqId()]) ?></h3>
                            </div>

                            <div class="card-body">

                                <label for="question"><?= LangManager::translate("faq.dashboard.add.question.label") ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-question"></i></i></span>
                                    </div>
                                    <input type="text" name="question" class="form-control"
                                           placeholder="<?= LangManager::translate("faq.dashboard.add.question.placeholder") ?>"
                                           value="<?= $faq->getQuestion() ?>" required>

                                </div>

                                <label for="question"><?= LangManager::translate("faq.dashboard.add.response.label") ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-paper-plane"></i></span>
                                    </div>
                                    <input type="text" name="response" class="form-control"
                                           placeholder="<?= LangManager::translate("faq.dashboard.add.response.placeholder") ?>"
                                           value="<?= $faq->getResponse() ?>" required>
                                </div>

                            </div>


                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-primary float-right"><?= LangManager::translate("core.btn.save") ?></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>