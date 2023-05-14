<!------------------------------------
       -----    SHOW FAQ   -----
-------------------------------------->



<?php
/* @var \CMW\Entity\Faq\FaqEntity[] $faqList */

foreach ($faqList as $faq) : ?>
    <?= $faq->getQuestion() ?>
    <?= $faq->getAuthor()->getPseudo() ?>
    <?= $faq->getResponse() ?>
<?php endforeach; ?>