civblogs
========

Pr&eacute;sentation
-------------------
civblogs est un simple annuaire qui indexe les billets provenant de la blogosph&egrave;re ivoirienne.
Mais vous pouvez facilement l'adapter &agrave; toute autre blogosph&egrave;re.

Vous pouvez voir l'application en ligne &agrave; l'addresse : http://civblogs.akendewa.org

Fonctionnalites
----------------

*NB: Ce projet est encore tr&egrave;s r&eacute;cent, et peut changer a tout moment.*

  * Connexion des utilisateurs via twitter
  * Recherche des billets par cat&eacute;gories
  * Recherche des billets par tag
  * Affichage des billets recents
  * Affichage des billets d'un blog
  * Administration des utilisateurs
  * Administrations des blogues
  * Administrations des billets
  * R&eacute;cup&eacute;ration automatique des billets d'un blogue via le fill rss.
  * R&eacute;cup&eacute;ration automatique de l'apercu via Embedly.com
  - Administration des cat&eacute;gories
  
A faire
----------------

Comme mentionn&eacute; plus haut, ce projet est encore tr&egrave;s r&eacute;cent, il y'a donc beaucoup a faire.

Dans l'imm&eacute;diat, nous esp&eacute;rons :

 * Permettre aux utilisateurs de s'abonner aux blogues directement a partir de la plateforme
 * Produire un flux rss pour chaque cat&eacute;gorie
 * R&eacute;cup&eacute;ration automatique des billets via cron job
 * R&eacute;duire le nombre de bugs
 * Mettre en place les fonctionnalit&eacute;s sugg&eacute;r&eacute;es par les utilisateurs sur : http://github.com/akendewa/civblogs/issues


Installation
----------------

civblogs est bas&eacute; sur [CakePHP](http://cakephp.org) et n&eacute;cessite :

 * php >= 5.2
 * MySQL
 * Une application Twitter (Pour la connexion des utilisateurs)
 * Une application Embed.ly (Pour la r&eacute;cuperation des apercus des billets)

Commencez par t&eacute;l&eacute;charger le code source dans le dossier web de votre serveur php.
Si vous avez *Git* install&eacute; sur votre machine, vous pouvez simplement faire un 'clone' du projet

<pre>
git clone https://github.com/akendewa/civblogs.git
</pre>

Sinon cliquez sur le bouton *ZIP* en haut de cette page.

Une fois que vous avez t&eacute;l&eacute;charg&eacute; et copi&eacute; les fichiers dans le dossier web de votre serveur php, suivez les &eacute;tapes suivantes.

 * Cr&eacute;ez une application Twitter &agrave; l'addresse https://dev.twitter.com/apps/new
    * Assurez vous de remplir tous les champs requis et surtout le *Callback URL:*. (Vous pouvez entrer une addresse fictive telle que http://mondomaine.com)
    * Notez bien votre *Consumer key* et votre *Consumer secret*. Vous en aurez besoin pour continuer.    
 * Allez dans le dossier *app/Config* de votre application, faites une copie du fichier *bootstrap.php.default*. Ensuite renommez cette copie *bootstrap.php*
 * Ouvrez *bootstrap.php* et &agrave; la fin du fichier, changez les valeurs *Twitter.ConsumerKey* et *Twitter.ConsumerSecret* avec les votre.
<pre>
Configure::write('Twitter.ConsumerKey', 'VOTRE TWITTER CONSUMER KEY');
Configure::write('Twitter.ConsumerSecret', 'VOTRE TWITTER CONSUMER SECRET');
</pre> 

 * Cr&eacute;ez une application Embed.ly &agrave; l'addresse https://app.embed.ly/pricing/free
   * Assurez vous de choisir le *Free Plan* (Plan Gratuit)
   * Une fois votre application cr&eacute;&eacute;e, notez bien votre *API Key*. Vous en aurez besoin pour continuer.
 * Encore dans le fichier *bootstrap.php* et a&agrave; la fin du fichier, changez la valeur de  *Embedly.Key*.
<pre>
  Configure::write('Embedly.Key', 'VOTRE EMBEDLY KEY');
</pre>


*On y est presque :-)*

 * Dans le dossier *app/Config*, faites une copie du fichier *core.php.default*. Ensuite renommez cette copie *core.php*
 * R&eacute;p&eacute;rez les lignes suivantes, et changes les valeurs de ces deux variables de configuration
 
<pre>
/**
 * A random string used in security hashing methods.
 */
Configure::write('Security.salt', 'REPLACE THIS WITH YOUR SECURITY SALT');

/**
 * A random numeric string (digits only) used to encrypt/decrypt strings.
 */
Configure::write('Security.cipherSeed', 'REPLACE THIS WITH YOUR CIPHER SEED');
</pre>

Maintenant, il est temps d'installer les tables dans la base de donn&eacute;es de l'application.

* Cr&eacute;ez une base de donn&eacute;es MySQL si vous ne l'avez pas encore fait.
* Dans le dossier *app/Config*, faites une copie du fichier *database.php.default*. Ensuite renommez cette copie *database.php*
* Changez la variable *$default* et entrez les param&egrave;tres de connexion &agrave; votre base de donn&eacute;es 
<pre>
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'database_name',
		'prefix' => '',
		//'encoding' => 'utf8',
	);
</pre>

* Dans le dossier *app*, ouvrez le fichier *install-tables.sql* et executez toutes les commandes pr&eacute;sentes dans ce fichier dans votre base de donn&eacute;
* Si tous c'est bien pass&eacute;, les tables suivantes seront cr&eacute;&eacute;es :
<pre>
blogs
blogs_categories
categories
posts
tagged
tags
users
</pre>

Bien sur elles sont vides pour le moment.

Enfin! L'installation de votre application est termin&eacute;e. si tout c'est bien pass&eacute; vous pourrez voir la page d'accueil (vide pour le moment) en vous rendant &aacute; http://localhost/civblogs

D&eacute;marrage
----------------

Pour d&eacute;marrer votre application, vous devez rajouter des blogues, et ensuite l'application vous aidera &agrave; r&eacute;cup&eacute;rer les billets de ces blogues.

Pour pouvoir rajouter un blogue, il faut que vous ayez une compte utlisateur et un acc&egrave;s admin.
Civblogs utlise Twitter pour authentifier les utilisateurs.

Suivez les &eacute;tapes suivantes :

* Rendez vous a l'addresse http://localhost/civblogs/users/twitter_login. Vous serez redirig&eacute; vers une page Twitter.
* Autorisez votre application Twitter &agrave; avoir acc&egrave;s &agrave; votre compte.
* Apr&egrave;s l'autorisation, vous serez redirig&eacute; vers la page d'accueil. Si tout c'est bien pass&eacute;, vous verez votre pseudo twitter s'afficher dans la barre de menu.

Maintenant que vous avez cr&eacute;&eacute; votre compte utilisateur, il vous faut un acc&egrave;s *admin*.

* Si vous avez acc&egrave;s &agrave; *phpMyAdmin*, r&eacute;p&eacute;rez dans la table *users* l'enregistrement de votre compte utlisateur et changer la propri&eacute;t&eacute; *is_admin* &agrave; *1*.
* Sinon si vous pouvez ex&eacute;cuter la commande SQL suivante :
<pre>
  UPDATE  VOTRE_DB.`users` SET  `is_admin` =  '1' WHERE  `users`.`id` = ID_DE_VOTRE_COMPTE_UTILISATEUR;
</pre>

Et voil&agrave; lorsque vous actualiser la page http://localhost/civblogs, vous avez maintenant acc&egrave;s au menu *Admin*.


Ajout de donn&eacute;es;
----------------------

Pour ajouter des donn&eacutes; dans votre annuaire vous avez 2 choix :
 * Vous pouvez ex&eacute;cut&eacute; le fichier SQL *install-data.sql* dans votre base de donn&eacute;es
 * Ou rajouter des donn&eacute;es manuellement.

*Comment rajouter des donn&eacute;es manuellement?*

 * Cliquer sur *Admin* ensuite sur *Blogs*
 * Cliquer sur *Add blog* et completer le formulaire et soumettre. (Il est tr&eagrave;s important que vous remplissiez tous les champs)
 * Cliquer sur *Fetch rss*, les articles du blogue seront r&eacute;cup&eacute;r&eacute;s
 * Cliquer sur *See all fetched posts*. Vous aurez une liste de toutes billets de ce blogue.
 * Pour chaque billet, cliquer sur *fetch preview*, et ensuite sur *Change* dans la case suivante.

Et voila! les billet s'afficheront sur votre page d'accueil!


Contributeurs
--------------

 * R&eacute;gis Bamba (http://github.com/regisbamba)


License
--------------
Copyright 2012, Akendewa

Licensed under The MIT License
Redistributions of files must retain the above copyright notice.


