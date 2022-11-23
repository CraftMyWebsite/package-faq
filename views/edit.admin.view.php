<?php

use CMW\Manager\Lang\LangManager;
use CMW\Utils\SecurityService;

$title = LangManager::translate("faq.dashboard.edit.title");
$description = LangManager::translate("faq.dashboard.edit.desc");

/* @var \CMW\Entity\Faq\FaqEntity $faq */
?>

<div class="d-flex flex-wrap justify-content-between">
    <h3><i class="fa-solid fa-circle-question"></i> <span class="m-lg-auto"><?= LangManager::translate("faq.dashboard.edit.title") ?></span></h3>
</div>

<section>
    <div class="card">
        <div class="card-header">
            <h4><?= LangManager::translate("faq.dashboard.table.edit", ["faq_number" => $faq->getFaqId()]) ?></h4>
        </div>
        <div class="card-body">
            <form action="" method="post">
                    <?php (new SecurityService())->insertHiddenToken() ?>
                <h6><?= LangManager::translate("faq.dashboard.add.question.label") ?> :</h6>
                <div class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control" name="question" required
                           placeholder="<?= LangManager::translate("faq.dashboard.add.question.placeholder") ?>" value="<?= $faq->getQuestion() ?>">
                    <div class="form-control-icon">
                        <i class="fa-solid fa-circle-question"></i>
                    </div>
                </div>
                <h6><?= LangManager::translate("faq.dashboard.add.response.label") ?> :</h6>
                <div class="form-group position-relative has-icon-left">
                    <textarea type="text" class="form-control" name="response" required
                           placeholder="<?= LangManager::translate("faq.dashboard.add.response.placeholder") ?>"><?= $faq->getResponse() ?></textarea>
                    <div class="form-control-icon">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><?= LangManager::translate("core.btn.save") ?></button>
                </div>
            </form>
        </div>
    </div>
</section>