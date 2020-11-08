Fun with PHP	
========

## Utilisation

Depuis la racine du projet, lancer:
`php public/index.php`

## Contexte

Vous venez d'être contacté par Blizzard.  
L'entreprise est sur le point de créer plusieurs jeux et vous a sélectionné pour créer un système de classement et match-making universel.  
Au départ chaque joueur est considéré comme ayant le même niveau que les autres, puis son niveau augmentera ou descendra selon ses victoires, défaites et match null.   
Chaque joueur commence avec 1200 points. 2700 points et plus représente les meilleurs, 1200 et en dessous sont les débutants.  
Chaque tranche de 200 points est un niveau de 1200 à 2200, puis tranche de 100 points est un niveau de 2200 à 2500. 
Un dernier gap de 200 points conclu la grille.

Afin de connaître la probabilité qu'un joueur A gagne face à un joueur B, il faut appliquer la formule suivante :

<img src="https://render.githubusercontent.com/render/math?math=1/1%2B10^{(Rb-Ra)/400}">

avec Rb le niveau du joueur B et Ra le niveau du joueur A.

lorsqu'un joueur gagne il obient 1.  
Lorsqu'un joueur perds il obtient 0.  
En cas d'égalité, chaque joueur obtient 0,5.  

pour corriger le niveau d'un joueur, en fonction de l'issue d'un match, il faut appliquer sur chaque joueur la formule suivante :

<img src="https://render.githubusercontent.com/render/math?math=R%2B32*(x-y)">

avec R le niveau du joueur, x le résultat du match et y la probabilité attendue.

Afin de tester votre algorithme, vous pouvez utiliser les données suivantes:

Joueur A avec un ratio de 1700, est un joueur averti  
Joueur B avec un ratio de 2500, est un joueur expert  
Joueur C avec un ratio de 1200, est un joueur qui a gagné quelques parties  
Joueur D avec un ratio de 1800, est un joueur averti mais un peu plus  

probabilité du joueur A face au joueur B: 0.0099009900990099  
probabilité du joueur B face au joueur A: 0.99009900990099  
probabilité du joueur C face au joueur A: 0.053240215202022  
probabilité du joueur A face au joueur C: 0.94675978479798  
probabilité du joueur D face au joueur A: 0.57146311740838  
probabilité du joueur A face au joueur D: 0.42853688259162  

Avec 1 pour la certitude de gagner, et 0 la certitude de perdre.  
Admettons que A gagne face à B contre toute attente. Il faudrait corriger leur niveaux respectifs.

Le nouveau niveau du joueur A est: `1700 + 32 * (1 - 0.0099009900990099)` soit `1731.68288`  
Le nouveau niveau du joueur B est: `2500 + 32 * (1 - 0.0099009900990099)` soit `2468.31712`  

## Demande

Réaliser un système de matchmaking.

* En tant que joueur je peux m'enregistrer avec mon pseudo qui doit être unique, et un mot de passe qui devra être sécurisé
* En tant que joueur je peux me connecter avec mon pseudo et mon mot de passe
* En tant que joueur une fois connecté, je suis redirigé vers une page d'accueil qui affiche :
  * mon classement
  * la liste les 10 meilleurs joueurs
  * la liste de mes matchs en attente de saisie score avec un bouton qui me redirige vers la page de match
  * un bouton "Lancer un match" visible uniquement si je n'ai pas de match en attente de saisie
* En tant que joueur lorsque je lance un match, je suis redirigé vers une page d'attente de match
* Si au minimum 2 joueurs étant dans la même tranche de niveau sont en attente de match, créer un match et rediriger les joueurs sur une page pour le match. Si aucun autre joueur n'est disponible pour la même tranche de niveau, attendre 5 secondes et réessayer. Après 20 secondes essayer de trouver des joueurs en incluant les joueurs du palier supérieur, toujours avec les joueurs du même niveau en priorité
* Depuis la page du match, les joueurs peuvent cliquer sur le joueur gagnant. Après le clic, les joueurs sont redirigés vers la page d'accueil
* Si les 2 joueurs ont cliqué sur la même chose, alors pas d'ambiguïté, sauvegarder le résultat du match et appliquer la mise à jour du niveau du joueur. En cas de différence, il y a un litige, appliquer un match nul.

## Contraintes imposées

Le PHP doit être écrit en Objet.
Vous pouvez utiliser un framework PHP (symfony, laravel, api-platform), à condition de vous contraindre d'utiliser au minimum 2 design pattern issu de https://refactoring.guru/design-patterns/catalog  
Rédiger un fichier README.md à la racine de votre projet qui explique comment installer, lancer et utiliser votre projet.
Respecter la spécification REST, HTTP, URL, vu durant les cours.

## Encouragements

Utiliser des design patterns. Vous pouvez vous aider de https://refactoring.guru/design-patterns/catalog

## Contraintes libres

Le choix de la base de données.  
Le choix d'un framework css (bulma, foundation, tailwind, vanillacss) + éventuellement d'un thème/template graphique gratuit tout fait pour gagner du temps ici (le fonctionnel avant le beau, n'y passez pas trop de temps, en vrai je m'en moque tant que les fonctionnalités sont là).  
Le choix de la technologie front (vuejs, sveltjs, alpinejs, vanillajs).

## Note supplémentaire.

Ce n'est pas prévu dans cette version, mais gardez en tête dans votre conception, que l'an prochain il faudra ajouter le fait qu'on puisse avoir plusieurs leagues/championnats, et que les joueurs pourront choisir dans quelle league/championnat s'inscrire, et potientiellement avoir un match par league en attente.
