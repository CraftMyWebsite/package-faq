<!------------------------------------
       -----    SHOW FAQ   -----
-------------------------------------->

<?php foreach ($faqList as $faq) : ?>
    <?= $faq->getQuestion() ?>
    <?= $faq->getAuthor()->getPseudo() ?>
    <?= $faq->getResponse() ?>
<?php endforeach; ?>