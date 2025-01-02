<?php

use CMW\Utils\Website;

/**
 * @var \CMW\Entity\Faq\FaqEntity [] $faqList
 */

Website::setTitle("F.A.Q");
Website::setDescription("F.A.Q");
?>

<section style="width: 70%;padding-bottom: 6rem;margin: 1rem auto auto;">

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

</section>