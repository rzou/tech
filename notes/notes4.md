##### softwares
* phpstorm 
* configure phpstorm with plugins
* postman

****~~~~****
##### commands
composer create-project symfony/skeleton project "4.4.*"
php -S 127.0.0.1:8000 -t public/ (1)
shell script s.sh that contains 1.
composer require annotations

****~~~~****
##### contents
###### routing & controllers
Créer un controlleur "DefaultController" qui hérite de AbstractController
et utilise les annotations (require annotations) @Route.
Et qui permet de retourner du json 
"BlogController"
En définissant 4 routes: index(action & time), get_by_slug, get_by_id ..
route parameter wildcards
routing - default parameter value
generating urls using route name 
**array_search**
**array_column**
**array_map**
============================
array_search($id, array_column(array associatif, "id")) et ça retourne un index
AbstractController
Symfony\Bundle\FrameworkBundle\Controller\AbstractController
contient **json** et **generateUrl**
Question: my controller inherits from AbstractController, and we can use ->json et 
->generateUrl. These methods don't exist neither in my controller nor in the abstract one
So where ???? in a trait used by abstractController.

There is a difference between wildcard and request params
###### annotations
annotations 1 and 2 are complicated. I should read all the optional part.