# Package FAQ pour [CraftMyWebsite](https://craftmywebsite.fr)

Ajoutez facilement des faq sur votre site avec ce package !

## Fonctionnalités

- Questions / réponses
- Auteur
- Modifications rapide 


## Exemple

Tout d'abord veuillez créer un fichier dans le dossier ```View```de votre thème ```Faq/main.view.php```

Voici un exemple pour afficher toutes les faq (question / réponses)
```php
<?php /* @var \CMW\Entity\Faq\FaqEntity[] $faqList */
   foreach ($faqList as $faq) : ?>
       <ul>
           <li><strong><?= $faq->getQuestion() ?></strong></li>
           <ol><?= $faq->getResponse() ?></ol>
           <ol><?= $faq->getAuthor()->getPseudo() ?></ol>
       </ul>
   <?php endforeach; ?>
```

Pour accéder à votre page FAQ rendez-vous à cette url → ``monsite.fr/faq``


> Version: `V1.0`

