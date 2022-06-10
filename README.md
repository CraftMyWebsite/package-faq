# Package FAQ pour [CraftMyWebsite](https://craftmywebsite.fr)

Ajoutez facilement des faq sur votre site avec ce package !

## Fonctionnalités

- Questions / réponses
- Auteur
- Modifications rapide 


## Exemple

Tout d'abord veuillez créer un fichier dans le dossier ```view```de votre thème ```faq/main.view.php```

Voici un exemple pour afficher toutes les faq (question / réponses)
```php
 <?php foreach ($faqList as $faq) : ?>
        <ul>
            <li><strong><?= $faq['question'] ?></strong></li> 
            <ol><?= $faq['response'] ?></ol>
        </ul>
 <?php endforeach; ?>
```


> Version: `V1.0`

