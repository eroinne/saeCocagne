# SAE Cocagne

## Principe
Crée un site web qui fonctionnerait sous le même principe que les Jardins de Cocagne, où un client pourrait s'inscrire à un jardin, commander des paniers, et qui comporterait une partie admin permettant de créer les pages, les produits, les livraisons, et d'ajouter des dépôts.

## Installation

Faire les commandes:
- composer install
- npm install


### Base de données:

#### Option 1:

Prendre le fichier .sql disponible.


#### Option 2:

- php artisan migrate
- php artisan migrate --seeder

Pour accèder au panel adherent ou staffs -> modifier le mot de passe d'un utilisateur par 12345678 en faisant la commande:
- php artisan command:create-staffs
- php artisan command:create-user

Prendre l'email du staffs ou de l'adhérent d'id 1


## Outils

Fais avec:
- Laravel
- Alpine JS
- Livewire
- Swagger
- Maria DB

