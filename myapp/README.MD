Run:

`docker-compose up`

If gives error

"ERROR: for symfony-angular_mariadb_1  Cannot start service mariadb: b'driver failed programming external connectivity on endpoint symfony-angular_mariadb_1 (066194adba212da6bd3cd282e39636d383a1cabcc35ed6127980ff7ae86eff24): Error starting userland proxy: listen tcp 0.0.0.0:3306: bind: address already in use'"

Run 
`service mysql stop`

to release port.

Go to localhost:8000

Run some command examples:

`docker-compose exec myapp myapp/bin/console make:entity`

`docker-compose exec myapp myapp/bin/console doctrine:migrations:diff `



`docker-compose exec myapp composer require symfony/maker-bundle --dev`

Run migrations
=
`docker-compose exec myapp myapp/bin/console doctrine:migrations:migrate`

Posting example:
=

Send post request with header:

Content-Type: application/json

And body: 

{
  "name": "tests"
}

Repository is here https://github.com/darius-v/symfony-angular-docker

TODO:

* uzloadint single page action is template. Atrodo cia reik is naujo pagal ta eranstalint bet i vidini composer.json !
 ir uzrasyt i readme kad tiap reik kai taip sugalvojo tas image kurejas su tuo myapp.
* savint is to single page su angular.