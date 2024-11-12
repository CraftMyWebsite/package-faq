<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;

/** @var \CMW\Entity\Faq\FaqEntity[] $faqList */
$title = LangManager::translate('faq.dashboard.title');
$description = LangManager::translate('faq.dashboard.desc');
?>

<h3><i class="fa-solid fa-circle-question"></i> <?= LangManager::translate('faq.dashboard.title') ?></h3>

<div class="grid-3">
    <div class="card">
        <h6><?= LangManager::translate('faq.dashboard.table.add') ?></h6>
        <form action="" method="post">
            <?php SecurityManager::getInstance()->insertHiddenToken() ?>
            <label for="question"><?= LangManager::translate('faq.dashboard.add.question.label') ?> :</label>
            <div class="input-group">
                <i class="fa-solid fa-circle-question"></i>
                <input type="text" id="question" name="question" required
                       placeholder="<?= LangManager::translate('faq.dashboard.add.question.placeholder') ?>">
            </div>
            <label for="response"><?= LangManager::translate('faq.dashboard.add.response.label') ?> :</label>
            <textarea id="response" class="textarea" name="response" required
                      placeholder="<?= LangManager::translate('faq.dashboard.add.response.placeholder') ?>"></textarea>
            <button type="submit" class="btn-primary btn-center mt-4">
                <?= LangManager::translate('core.btn.add') ?>
            </button>
        </form>
    </div>
    <div class="card col-span-2">
        <h6><?= LangManager::translate('faq.dashboard.table.title') ?></h6>
        <div class="table-container table-container-striped">
            <table id="table1">
                <thead>
                <tr>
                    <th><?= LangManager::translate('faq.dashboard.table.question') ?></th>
                    <th><?= LangManager::translate('faq.dashboard.table.response') ?></th>
                    <th><?= LangManager::translate('faq.dashboard.table.author') ?></th>
                    <th class="text-center"><?= LangManager::translate('core.btn.edit') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($faqList as $faq): ?>
                    <tr>
                        <td><?= mb_strimwidth($faq->getQuestion(), 0, 40, '...') ?></td>
                        <td><?= mb_strimwidth($faq->getResponse(), 0, 40, '...') ?></td>
                        <td><?= $faq->getAuthor()->getPseudo() ?></td>
                        <td class="text-center space-x-2">
                            <a href="../faq/edit/<?= $faq->getFaqId() ?>">
                                <i class="text-info fa-solid fa-gears"></i>
                            </a>
                            <button data-modal-toggle="modal-<?= $faq->getFaqId() ?>" type="button"><i
                                    class="text-danger fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <div id="modal-<?= $faq->getFaqId() ?>" class="modal-container">
                        <div class="modal">
                            <div class="modal-header-danger">
                                <h6><?= LangManager::translate('faq.dashboard.modal.delete') ?> <?= mb_strimwidth($faq->getQuestion(), 0, 30, '...') ?></h6>
                                <button type="button" data-modal-hide="modal-<?= $faq->getFaqId() ?>"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </div>
                            <div class="modal-body">
                                <?= LangManager::translate('faq.dashboard.modal.deletealert') ?>
                            </div>
                            <div class="modal-footer">
                                <a href="../faq/delete/<?= $faq->getFaqId() ?>" class="btn-danger">
                                    <?= LangManager::translate('core.btn.delete') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
