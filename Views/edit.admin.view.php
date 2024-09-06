<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;

$title = LangManager::translate('faq.dashboard.edit.title');
$description = LangManager::translate('faq.dashboard.edit.desc');

/* @var \CMW\Entity\Faq\FaqEntity $faq */
?>

<h3><i class="fa-solid fa-circle-question"></i> <?= LangManager::translate('faq.dashboard.edit.title') ?></h3>

<div class="card">
    <form action="" method="post">
        <?php (new SecurityManager())->insertHiddenToken() ?>
        <label for="question"><?= LangManager::translate('faq.dashboard.add.question.label') ?> :</label>
        <div class="input-group">
            <i class="fa-solid fa-circle-question"></i>
            <input type="text" id="question" name="question" required
                   placeholder="<?= LangManager::translate('faq.dashboard.add.question.placeholder') ?>"
                   value="<?= $faq->getQuestion() ?>">
        </div>
        <label for="response"><?= LangManager::translate('faq.dashboard.add.response.label') ?> :</label>
        <textarea id="response" class="textarea" name="response" required
                  placeholder="<?= LangManager::translate('faq.dashboard.add.response.placeholder') ?>"><?= $faq->getResponse() ?></textarea>
        <button type="submit" class="btn-primary mt-4 btn-center">
            <?= LangManager::translate('core.btn.save') ?>
        </button>
    </form>
</div>