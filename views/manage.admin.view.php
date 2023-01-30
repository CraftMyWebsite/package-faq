<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;

$title = LangManager::translate("faq.dashboard.title");
$description = LangManager::translate("faq.dashboard.desc");
?>

<div class="d-flex flex-wrap justify-content-between">
    <h3><i class="fa-solid fa-circle-question"></i> <span class="m-lg-auto"><?= LangManager::translate("faq.dashboard.title") ?></span></h3>
</div>

<section class="row">
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-header">
                <h4><?= LangManager::translate("faq.dashboard.table.add") ?></h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                        <?php (new SecurityManager())->insertHiddenToken() ?>
                    <h6><?= LangManager::translate("faq.dashboard.add.question.label") ?> :</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" name="question" required
                               placeholder="<?= LangManager::translate("faq.dashboard.add.question.placeholder") ?>">
                        <div class="form-control-icon">
                            <i class="fa-solid fa-circle-question"></i>
                        </div>
                    </div>
                    <h6><?= LangManager::translate("faq.dashboard.add.response.label") ?> :</h6>
                    <div class="form-group position-relative has-icon-left">
                        <textarea type="text" class="form-control" name="response" required
                               placeholder="<?= LangManager::translate("faq.dashboard.add.response.placeholder") ?>"></textarea>
                        <div class="form-control-icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><?= LangManager::translate("core.btn.add") ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4><?= LangManager::translate("faq.dashboard.table.title") ?></h4>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                    <tr>
                        <th class="text-center"><?= LangManager::translate("faq.dashboard.table.question") ?></th>
                        <th class="text-center"><?= LangManager::translate("faq.dashboard.table.response") ?></th>
                        <th class="text-center"><?= LangManager::translate("faq.dashboard.table.author") ?></th>
                        <th class="text-center"><?= LangManager::translate("core.btn.edit") ?></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php /** @var \CMW\Entity\Faq\FaqEntity[] $faqList */ foreach ($faqList as $faq) : ?>
                        <tr>
                            <td><?= $faq->getQuestion() ?></td>
                            <td><?= $faq->getResponse() ?></td>
                            <td><?= $faq->getAuthor()->getUsername() ?></td>
                            <td>
                                <a href="../faq/edit/<?= $faq->getFaqId() ?>">
                                    <i class="text-primary fa-solid fa-gears"></i>
                                </a>
                                <a href="../faq/delete/<?= $faq->getFaqId() ?>">
                                    <i class="ms-2 text-danger fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>