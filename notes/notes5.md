####commands:
* composer require symfony/orm-pack
* composer require symfony/maker-bundle --dev:
*--dev means that this bundle will be installed just for dev env.*
* php bin/console make:entity
* php bin/console make:migration
* php bin/console doctrine:database:create
* php bin/console doctrine:migrations:migrate
* composer require --dev doctrine/doctrine-fixtures-bundle
* php bin/console doctrine:fixtures:load
* php bin/console debug:router
* composer require admin



####key words:
####exercice:
####questions:
comment récupérer le wildcard ?
en général c : $request->get("...");
réponse : passe en paramètre à la méthode controller
####notes:
* enter "?" to see all types
* BlogPost(id, title, content, published, author)
//string 255, text, datetime, string 255

@Route("/{page}", name="blog_list", defaults={"page":5}, requirements={"page"="\d+"})

faite attention à l'ordre des routes
