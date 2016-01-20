# Réalisation du site de l'association **Echos-Libres**





*Tu souhaites installer ce site sur ton serveur local ?*

Je vais essayer de te guider pas à pas.


Je te recommandes d'avoir Composer afin de gérer les dépendances du site.
```
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer.phar
alias composer='/usr/local/bin/composer.phar'
```


Dans ton dossier www :  
`
git clone https://github.com/auchalet/Yii-Echos-Lbres.git
`  

Sous Linux, je te recommande créer un lien symbolique sur ton répertoire home par bonne pratique de ne pas
manipuler le répertoire du serveur.

`sudo ln -s /var/www /home/utilisateur/`

Renomme ce répertoire si nécessaire.

Par défaut, sous Linux, l'adresse http://localhost pointe sur le répertoire default, il faut donc créer
un fichier dans la configuration d'Apache correspondant au nouveau site.

`
cd /etc/apache2/sites-available/
`

Prenez pour exemple le fichier 000-default.conf

`
cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/votresite.conf
`

Editez ce fichier de cette manière :

```
<VirtualHost *:80>
   ServerName frontend.dev
   DocumentRoot "/var/www/votresite/frontend/web/"

   <Directory "/var/www/votresite/frontend/web/">
       # use mod_rewrite for pretty URL support
       RewriteEngine on
       # If a directory or a file exists, use the request directly
       RewriteCond %{REQUEST_FILENAME} !-f
       RewriteCond %{REQUEST_FILENAME} !-d
       # Otherwise forward the request to index.php
       RewriteRule . index.php

       # use index.php as index file
       DirectoryIndex index.php

       # ...other settings...
   </Directory>
</VirtualHost>

<VirtualHost *:80>
   ServerName backend.dev
   DocumentRoot "/var/www/votresite/backend/web/"

   <Directory "/var/www/votresite/backend/web/">
       # use mod_rewrite for pretty URL support
       RewriteEngine on
       # If a directory or a file exists, use the request directly
       RewriteCond %{REQUEST_FILENAME} !-f
       RewriteCond %{REQUEST_FILENAME} !-d
       # Otherwise forward the request to index.php
       RewriteRule . index.php

       # use index.php as index file
       DirectoryIndex index.php

       # ...other settings...
   </Directory>
</VirtualHost>
```


Déclarez enfin votre Virtual Host dans le fichier `/etc/hosts`

```
127.0.0.1   backend.dev
127.0.0.1   frontend.dev
```

Il ne reste plus qu'à activer le fichier de configuration créé  
`sudo a2ensite votresite`

Vérifier que le mod_rewrite d'Apache est bien activé  
`sudo a2enmod rewrite`  

Redémarrez votre serveur Apache  
`
sudo service apache2 restart`
`

A ce stade, à l'adresse frontend.dev et backend.dev vous devriez accéder à la page d'accueil.
(PS : j'ai eu à renommer le dossier /vendor/bower-asset en /vendor/bower )


Installer les dépendances :  
`
sudo composer install`
`

Et la base de données contenue sur ce dépôt : https://github.com/auchalet/sql

Copiez/Collez le contenu dans mysql.

Lancez une première fois l'application en mode développement
A la racine du répertoire du site :  
`
php yii init
`

Editez le fichier /config/main-local.php 
```
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=echos',
            'username' => 'login',
            'password' => 'password',
            'charset' => 'utf8',
        ],
    ];
```


Vous avez (si tout se passe bien), installé le site !
Si ce n'est pas le cas, je vous encourage à me contacter via l'adresse : echos-libres@protonmail.com, afin de
parfaire ce tutoriel.  
  
  
Liens utiles :  
Installation du framework : https://github.com/yiisoft/yii2-app-advanced/blob/master/docs/guide/start-installation.md  
Installer un environnement LAMP sur Ubuntu 14.04 : https://doc.ubuntu-fr.org/lamp  
Gestion des hôtes virtuels Apache : https://doc.ubuntu-fr.org/tutoriel/virtualhosts_avec_apache2


L'aventure **Echos-Libres** débutera prochainement...





