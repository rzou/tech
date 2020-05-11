####commands:
* 



####key words:
Event Subscriber

####exercice:
####questions:
Comment tokenStorage est injecté dans event subscriber ??

how to hide password and email ? by normalization context get.

Problématique: après le changement de password, token doit etre plus valide, 
mais il l'est. Comment déconnecter ce user ?
####notes:
créer un blogPost sans indiquer l'auteur. author is setted à partir de 
token par l'event subscriber. ca c top du top!!
Only owner of blogPost can modify(put) it

object.getAuthor() == user

no username change

hashing password lors de put
avec @groups , en changeant le username en put, this will be ignored


