# sqlexique
Lexique.org to MySQL

Un script qui permet d'enregistrer les données Lexique.org dans une base de données MySQL.

## Installation

Pour installer ce script, il vous faut :
* Une base de données MySQL
* Un serveur PHP
* Composer

Suivez ces 5 étapes :
1. Récupérez la dernière version de la base de données sur le site [Lexique](http://lexique.org) au format Excel.
2. Convertissez ledit fichier au format CSV.
3. Lancez [Composer](https://getcomposer.org/) pour installer les dépendances `league/csv`, `illuminate/database`, `illuminate/events` et `illuminate/container`.
4. Créez une base de données puis un fichier sqlCredentials.php (avec les variables suivantes : `$dbAppHost`, `$dbAppName`, `$dbAppLogin`, `$dbAppPassword`.
5. Le script copiera le lexique dans votre base de données pour vos projets.

## Licence

Le code source de sqlexique est publié sous licence MIT.
La base de données [Lexique](http://lexique.org) est sous [licence publique générale](http://lexique.org/public/license_lexique.htm) (inspirée de GNUv2).

© Philippe-Alexandre Pierre - 2018
