## Mastering Yii Chapter 10 Source Code

The following source code is the project for Chapter 10 of Mastering Yii
ISBN-CH: 978-1-78588-242-5_10

### Template
The template is stored in the ```template``` tag. You should start there at the beginning of the chapter

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

5. Point your web browser to your application and you should see the application fire up.

6. Install composer dependnecies

```
composer install
```

7. Run tests by running:

````
./vendor/bin/codecept run
```
