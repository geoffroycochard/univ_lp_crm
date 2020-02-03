# CRM / Gestion des opportunitées en fonction d'une liste de produits.

Nous voulons créer une application qui va nous servir à gérer nos potentiels clients suite à un échange.

Process : 
 * Je définie la personne que j'ai en face de moi (contact)
 * Il est interessé par des produits, je crée une opportunité en fonction de ses besoins (dans un catalogue simple)
 
# Installation

Cloner le dépôt, et y installer / initialiser
 * les dépendances php
 * les dépendances frontend et les compiler (webpack-encore)
 * la base de donnée sqlite
 * le data model et [ses fixtures](https://github.com/geoffroycochard/univ_lp_crm/blob/master/src/DataFixtures/AppFixtures.php) `$ bin/console doctrine:fixtures:load` 

# Fonctionnalités de l'application

## Opportunité pour un contact

Comme indiqué dans le process il faut qu'une opportunité soit associée à un contact qui peut avoir 
plusieurs opportunités. Il faut que ce champs soit visible et modifiable dans le CRUD.

## Opportunité composé de plusieurs produits

Le potentiel de l'opportunité est dirigé par une sorte "de panier". Il faut que ce champs là soit visible et modifiable dans le CRUD.

## Valeur estimée de l'opportunité

Créer un nouveau champs "estimatedValue" dans opportunité qui permet de faire la somme des produits associés à chaque modification de l'opportunité.
Afficher cette somme dans la liste des opportunités et dans la vue single