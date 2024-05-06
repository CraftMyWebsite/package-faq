<?php

return [
    "faq" => "FAQ",
    "dashboard" => [
        "title" => "FAQ - Gestion",
        "desc" => "Gestion des FAQ de votre site",
        "table" => [
            "title" => "Liste des FAQ",
            "question" => "Questions",
            "response" => "Réponses",
            "author" => "Auteur",
            "editing" => "Modifications",
            "add" => "Ajouter une FAQ",
            "edit" => "Modifier la FAQ n° %faq_number%",
        ],
        "modal" => [
            "delete" => "Supression de :",
            "deletealert" => "La supression est definitive.",
        ],
        "add" => [
            "title" => "FAQ - Ajouts",
            "question" => [
                "label" => "Question",
                "placeholder" => "Ajouter une question",
            ],
            "response" => [
                "label" => "Réponse",
                "placeholder" => "Ajouter une réponse",
            ],
            "toaster" => [
                "success" => "FAQ ajoutée avec succès !",
            ],
        ],
        "edit" => [
            "title" => "FAQ - Modifications",
            "toaster" => [
                "success" => "FAQ %faq% modifiée avec succès !",
            ],
        ],
        "delete" => [
            "toaster" => [
                "success" => "FAQ %faq% supprimée avec succès !",
            ],
        ],
    ],
    "permissions" => [
        "faq" => [
            "show" => "Afficher les faq",
            "edit" => "Modifier les faq",
            "create" => "Créer une faq",
            "delete" => "Supprimer une faq",
        ],
    ],
];