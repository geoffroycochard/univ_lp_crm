# CRM / Gestion des opportunitées en fonction d'une liste de produits.

Nous voulons créer une application qui va nous servir à gérer nos potentiels clients 
suite à un échange.

Process : 
 * Je définie la personne que j'ai en face de moi (contact)
 * Il est interessé par des produits, je crée une opportinité en fonction de ses besoins (dans un catalogue simple)
 
# Installation

Clone du dépôt :

`````bash
$ git clone https://github.com/geoffroycochard/univ_lp_crm.git
````` 

Installation des dépendances php
`````bash
$ composer install
````` 



Installation des dépendances frontend et compilation
`````bash
$ yarn intall
$ yarn dev
`````

# Fonctionnalité de l'application

## Opportunité pour un contact

Comme indiqué dans le process il faut qu'une opportunité soit associée à un contact qui peut avoir 
plusieurs opportunités.

## Opportunité composé de plusieurs produits

Le potentiel de l'opportunité est dirigé par une sorte "de panier".

## Valeur estimé de l'opportunité

Créer un nouveau champs "estimatedValue" dans opportunité qui permet de faire la somme des produits associés à chaque modification de l'opportunité.
