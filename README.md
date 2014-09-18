Symfony2 Rest Skeleton
========================
This is skeleton for building rest applications in Symfony2. Also one restful service is included.

Installation
========================
If you don't have composer installed
```
curl -sS https://getcomposer.org/installer | php
```
If you've composer installed

```
php composer.phar create-project m-fejczaruk/symfony2-rest-skeleton rest-example
cd rest-example
php app/console doctrine:migrations:migrate
```

And now you can enjoy phpunit tests :)

```
phpunit -c app/
```
And you can also check all carts ( basic restful service ) routes: ```php app/console router:debug | grep car```

You can test 'cart' restful api, with postman:
GET app_dev.php/carts
GET app_dev.php/carts/{id}
POST app_dev.php/carts
PUT app_dev.php/carts/{id}
DELETE app_dev.php/carts/{id}