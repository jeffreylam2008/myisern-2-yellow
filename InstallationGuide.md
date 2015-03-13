#following the guide for setup.

# Introduction #

Installation guide for symfony, XAMPP and Database.

# Getting Started #

## Download XAMPP & Symfony PHP Framework: ##

**XAMPP** from "http://www.apachefriends.org/download.php?xampp-win32-1.6.4.zip"

**Symfony PHP Framework** from "http://www.symfony-project.org/get/symfony-stable.tgz"

## STEP 1 -> Setup XAMPP: ##

There is a great installation guide for setup symfony:
**http://www.symfony-project.org/book/1_0/03-Running-Symfony**

**Step 1:** Unzip the folder to system directory i.e. C:\xampp (Don't put it into Program Files).

**Step 2:** Go to C:\xampp and double-click on "xampp-control.exe", then click Apache and MySQL start. (If both display -running-, that mean apache and MySQL is working)

**Step 3:** Go to your browser and type http://localhost, then you will see the XAMPP main page.

## STEP 2 -> Create database password: ##

Go to "http://localhost/security/index.php" -> click on link "http://localhost/security/xamppsecurity.php"

set MySQL password as "password", or you can set whatever you want, but you need to do configuration for myisern later, so let use password as default.

## STEP 3 -> Setup Database ##

**Step 1:** Extract myisern-yellow in C:\

**Step 2:** Go to http://localhost/phpmyadmin

**Step 3:** Login username as "root" & password as "password".

**Step 4:** Go "Import" -> "Browse" -> c:\myisern-yellow\web\myisern2\sql\myisern.sql, then click "Go".

You already inserted the database. Next go to install setup Symfony.

## STEP 4 -> Setup Symfony ##

There is a great installation guide for setup symfony:
http://www.symfony-project.org/book/1_0/03-Running-Symfony

**Step 1:** Create a folder under XAMPP web document directory i.e. C:\xampp\htdocs\symfony.

**Step 2:** Do following command line:

```
> pear channel-discover pear.symfony-project.com

> pear install symfony/symfony

> symfony -V
```

**Step 3:** Setup the environment variable:

```
%PHP_HOME% = c:\xampp\php
```
Set PATH for PHP\_HOME

**Step 4:** Create a VirtualHost for apache, then go to C:\xampp\apache\conf\httpd.conf and put following codes at the end of file.

```
<VirtualHost *:80>
  ServerName myisernapp.example.com
  DocumentRoot "C:\myisern-yellow\web"
  DirectoryIndex index.php
  Alias \sf C:\php5\pear\data\symfony\web\sf
  <Directory "/$sf_symfony_data_dir/web/sf">
    AllowOverride All
    Allow from All
  </Directory>
  <Directory "C:\myisern-yellow\web">
    AllowOverride All
    Allow from All
  </Directory>
</VirtualHost>
```

**Step 5:** Restart XAMPP by using XAMPP Control Panel.(If XAMPP cannot run properly, that mean some path is wrong or didn't exist on the code above).

## STEP 5 -> Use myisern-yellow ##

  1. Go to http://127.0.0.1/myisern2/.
  1. Enter username "demo".
  1. Enter password "demo".

DONE!!! ENJOY!!!