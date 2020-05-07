####commands:
* php bin/console debug:router
* composer require api

* php bin/console doctrine:fixtures:load
* composer require --dev fzaninotto/faker



####key words:
api platforme
faker : generate fake data...
faker->datetime peut générer des date ca va pas
solution: dateTimeThisYear()

notion de reference : à comprendre
####exercice:
####questions:
####notes:
encodage de password:
Dans AppFixtures:
$this->passwordEncoder->encodePassword($user, "psswd")
Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface

\Faker\Factory::create()
->realText(30)
->dateTime

