# Plateforme de Gestion de Contenu Dev.to
## Aperçu du Projet
Un système de gestion de contenu pour Dev.to qui facilite la création, la gestion et la découverte d'articles techniques. La plateforme comprend à la fois un back office pour les administrateurs et un front office pour les utilisateurs/auteurs. <br>
**Tâches :**  
- Implémenter l’attribution des rôles (auteur, admin).  
- Développer des fonctionnalités pour suspendre ou supprimer des utilisateurs.  
- Concevoir une interface pour les détails et actions sur les profils utilisateurs.
## Fonctionnalités
- **Gestion des Catégories** : Création, modification, suppression des catégories ; association des articles aux catégories ; visualisation des statistiques via des graphiques interactifs.
- **Gestion des Tags** : Création, modification, suppression des tags ; association de tags aux articles ; visualisation des statistiques des tags.
- **Gestion des Utilisateurs** : Gestion des profils utilisateurs, assignation des rôles (auteur, admin), suspension ou suppression des utilisateurs.
- **Gestion des Articles** : Consultation, validation, refus ou archivage des articles ; affichage des articles les plus populaires.
- **Tableau de Bord** : Statistiques détaillées pour les utilisateurs, articles, catégories, et tags via des graphiques interactifs.
### **Front Office (Utilisateurs)**
- **Authentification** : Inscription, connexion sécurisée et redirection en fonction du rôle.
- **Découverte de Contenu** : Recherche d’articles, catégories ou tags ; navigation dynamique entre le contenu.
- **Interaction avec les Articles** : Consultation des détails, catégories, tags et informations sur l’auteur.
- **Espace Auteur** : Création, modification, suppression d’articles ; gestion des contenus publiés.
## Technologies Utilisées
- **Langage de Programmation** : PHP 8 (Programmation Orientée Objet).
- **Base de Données** : MySQL avec PDO.
- **Frontend** : HTML5, CSS3, JavaScript.
- **Framework** : Design responsive avec un framework CSS.
- **Versionnement** : Git.
- **Gestion des Tâches** : Jira (méthodologie Scrum).
- **Diagrammes** : UML (Diagramme de Classe et de Cas d'Utilisation).
## Installation
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/ka-amina/Dev.to-Blogging-Plateform
   ```
2. Accédez au répertoire du projet :
   ```bash
   cd Dev.to-Blogging-Plateform
   ```
3. Configurez la base de données :
- Importez le script SQL fourni (database.sql) dans votre serveur MySQL.
- Mettez à jour les paramètres de connexion à la base dans config.php.
4. Lancez un serveur local (par ex. Apache) et accédez au projet dans votre navigateur.
