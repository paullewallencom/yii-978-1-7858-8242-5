## Mastering Yii Chapter 6 Source Code

[![Build Status](https://travis-ci.org/masteringyii/chapter10_2.svg?branch=master)](https://travis-ci.org/masteringyii/chapter10_2)

The following source code is the project for Chapter 10 of Mastering Yii
ISBN-CH: 978-1-78588-242-5_10

### Requirements

- PHP 5.6.0+
- A Webserver

### Installation

1. Have a web capable server (Apache, Nginx). See [here](http://www.yiiframework.com/doc-2.0/guide-start-installation.html) for how to do that.

[DigitalOcean](https://www.digitalocean.com/community/articles/how-to-install-and-setup-yii-php-framework) has a pretty comprehensive guide for setting up things if you aren't familiar with the process.

2. Download/Clone this project to your web directory, and setup your server so that it can be accessed.

3. Open up a Terminal window to the current working directory.

4. Make sure the following directories are writable by your webserver process

  - runtime
  - assets

5. Point your web browser to your application and you should see the application fire up.\

6. Install dependencies

```
composer selfupdate
composer global require "fxp/composer-asset-plugin:~1.0"
composer install -o -n
```

7. Migrate the database

```
./yii migrate/up --interactive=0
```

8. Run tests

```
./vendor/bin/codecept run
```