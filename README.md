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
php app/console doctrine:migrations:execute