# Projet « Cyberfolio »

## Compte administrateur

- URL du *back-office* : 127.0.0.1/gestion (bouton engrenages)
- Identifiant : oswinfreyr@gmail.com
- Mot de passe : 123456

## État d'avancement

Le site est fonctionnel pour afficher, créer, modifier et supprimer des centres d'interets, des competences, des expériences, des formations, des projet, des technologies et ajouter des utilisateurs (pas de lien associé affiché sur le site directement). L'accès aux créations, modifications et suppréssions sont autorisées seulement aux comptes admin

## Difficultés rencontrées et solutions

L'affichage des différentes catégories est fait sur des onglets mais lors de la modification d'une catégorie, il est affiché l'onglet par défaut, le premier, la modification se fait tout de meme sur le bon element. Pas de solutions trouvées à ce jour.
L'edition des projets ne fonctionne pas malgré un routing renvoyant un code 200 et pas d'erreur dans la console. Le reste des modifications s'effectuent sans soucis

## Bilan des acquis

- CRUD,
- Gestion backoffice, frontoffice, liaison entre les deux
- gestions des droits utilisateurs et du routing personnalisés en fonction des droits

## Remarques complémentaires

Le fichier .env.local est nommé .env.example et il faut le copier coller dans un .env en modifiant l'url de liasison de db
