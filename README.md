# php-symfony
Symfony 4 &amp; 5 Web Development Guide: Beginner To Advanced

## Install PHP and composer

```s
$ sudo apt install php-cli unzip
$ cd ~
$ curl -sS https://getcomposer.org/installer -o composer-setup.php
$ HASH=`curl -sS https://composer.github.io/installer.sig`
$ echo $HASH
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
$ sudo apt install php-xml
```

### Server

```s
$ php -S 127.0.0.1:8000 -t [folder]
```

### Modules

```s
$ composer require maker
$ composer require doctrine
$ composer require orm
```

### DB - SQLite

uncomment the line in `.env`

```s
$ bin/console doctrine:database:create
$ bin/console make:entity
```
Now complete the fields for every column (ID is created automatically).

Then migrate:

```s
$ bin/console make:migration
$ bin/console doctrine:migrations:migrate
```