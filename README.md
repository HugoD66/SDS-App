<img src="https://github.com/HugoD66/SDS-App/tree/main/public/picture/logo-marque/db-border-bgdark.png">
<h2>Sommaire</h2>
    <ul>
        <li>Introduction</li>
        <li>Technologies utilisées</li>
        <li>Manuel d'utilisation</li>
            <ul>
                <li>Prerequis</li>
                <li>Installation</li>
            </ul>
        <li>Compléments</li>
    </ul>

***

<h1>Introduction</h1>
    <p><b>Dantabase</b> est un programme de gestion en ligne d'entreprise, simple d'utilisation. C'est plus précisement une application qui régle les droits des différents 
structure que compose une franchise. <br> Cette application est utilisée par l'équipe de développement de la marque pour y créer et actualiser les droits d'accés de chaque bâtiments,
puis est consultée par les différents collaborateurs de la franchise.<br>
On y retrouve toutes les structures en activité, ainsi que celles qui sont indisponibles pour raison diverse. Dans le derniers cas, 
le propriétaire de la marque ne pourra pas accéder à l'application.</p><br>
Ce projet m'a été demandé pour une évaluation en cours de formation à l'école <b>Studi +</b>.

***

<h1>Technologies utilisées</h1>
<h4>Frontend:</h4>
<ul>
    <li>HTML </li>
    <li>CSS /Sass</li>
    <li>Bootstrap</li>
    <li>JavaScript</li>
    <li>Webpack ENCORE</li>
    <li>Twig</li>
</ul>
<h4>Backend:</h4>

<ul>
    <li>PHP</li>
    <li>Symfony</li>
    <li>Composer</li>
    <li>Symfony Stimulus</li>
</ul>
<h4>Base de donée :</h4>
<ul>
    <li>MySql</li>
</ul>
<h4>Compilateur :</h4>
<ul>
    <li>NPM</li>
</ul>

***

<h1>Manuel d'utilisation</h1>

<h3>Prérequis</h3>

<p>Il est nécessaire de posséder sur son ordinateur avant utilisation : </p>
<ul>
    <li> php: >=8.1</li>
    <li> MySql </li>
    <li> NPM </li>
    <li> Composer </li>
</ul>
<p>Si il vous manque certains de ces composants, il sera nécessaire d'aller le télécharger sur internet.</p>


<h3>Installation</h3>
<p>Veuillez à suivre la bonne procédure pour avoir accès au projet en local.</p>

<ul>
    <li>Positionnez vous dans le repertoire où vous souhaitez implanter votre application, puis tapez dans votre terminal.

        git clone https://github.com/HugoD66/SDS-App.git <br>
        cd -nom du projet- 
</li>
    <li>Il est maintenant nécessaire d'installer les dépendances décrites plus haut.
        
        composer install
        npm install
</li>
    <li>Compilez maintenant les assets et lancez grâce à symfony le serveur local.
        
        npm run dev-server
        symfony server:start -d
</li>
    <li>C'est au tour de la base de donnée à être configurée. Démarez le serveur MySql ( à l'aide de Xampp), puis créez la base de donnée.

        symfony console doctrine:database:create
        symfony console doctrine:migrations:migrate

Il sera malgrès tout obligatoire de configurer le fichier .env de l'application afin d'y accéder.
</li>


</ul>


<h1>Compléments</h1>

<p>Vous retrouverez toutes les informations complémentaires dans le dossier Anneexes de l'application. S'y trouveront notamment :</p>
<ul>
    <li>La Documentation technique</li>
    <li>La charte graphique</li>
    <li>Le zoning du projet</li>
    <li>Le manuel d'utilisation</li>
    <li>La copie de l'évaluation à rendre</li>

</ul>

- Dans la documentation technique se trouveront toutes les spécifications techniques de l'application. S'y trouvera également le diagramme UML finale.
- Dans la charte graphique, seront placées toutes les pallettes de couleurs, et les types de polices utilisés durant la création de l'application.
- Dans le zoning du projet se trouvera toutes les ébauches crées durant le développement de mon application. Il y aura également le code couleur utilisé pour différencier les multiples blocs.
- Dans le manuel d'utilisation sera mis à disposition les identifiants servant à découvrir l'application. Il y aura également la feuille de route permettant de découvrir la navigation du site.
- Pour finir, la copie de l'évaluation à rendre obligatoirement en paralléle du programme sera mis a disposition.

Bonne découverte!  