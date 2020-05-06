####commands:
* composer require lexik/jwt-authentication-bundle
* openssl genrsa -out config/jwt/private.pem -aes256 4096
* openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem




####key words:
Security
JWT : JSON Web Token
providers
firewalls
access_control

####exercice:
####questions:
####notes:
####notions:
JWT contains: header & payload
header : { "alg": "HS256", "typ": "JWT"}
payload: {"sub":"7667890","name":"John Cloe","iat":13976 date d'expiration}

username, password dans postman, check_login
send donne : token
on colle ça à chaque appel web service

