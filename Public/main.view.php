<?php

use CMW\Utils\Website;

/**
 * @var \CMW\Entity\Faq\FaqEntity [] $faqList
 */

Website::setTitle("F.A.Q");
Website::setDescription("F.A.Q");
?>

<?php if (\CMW\Controller\Users\UsersController::isAdminLogged()): ?>
    <div style="background-color: orange; padding: 6px; margin-bottom: 10px">
        <span>Votre thème ne gère pas cette page !</span>
        <br>
        <small>Seuls les administrateurs voient ce message !</small>
    </div>
<?php endif;?>

<div style="display: flex; flex-wrap: wrap; gap: 1rem;">
    <?php foreach ($faqList as $faq): ?>
        <div style="flex: 0 0 48%; border: solid 1px #4b4a4a; border-radius: 5px; padding: 9px;">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between">
                <h6>- <?= $faq->getQuestion() ?> :</h6>
                <div class="bg-gray-300 font-medium inline-block px-3 py-1 rounded-sm text-xs"><?= $faq->getAuthor()->getPseudo() ?></div>
            </div>
            <div class="ml-4"><?= $faq->getResponse() ?></div>
        </div>
    <?php endforeach; ?>
</div>

