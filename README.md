# testingenosya-symfony-back

### install dependance
1)composer install

###  create database
2)php bin/console doctrine:database:create 

###  create migration 
3)php bin/console doctrine:migrations:migrate latest

###  http to https 
4)symfony server:ca:install

### start server symfony port:4641
5)symfony serve:start --port=4641
