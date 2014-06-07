# BuildEx

## Experiment Builder

## Setting up the Environment

### Requirements

Download and Install Bitnami's Stack (LAPP for Linux/ MAPP for Mac/ WAPP for Windows):

http://www.bitnami.com/article/apache-php-and-postgresql-all-in-one

Clone this repository in:

```
install/dir/lappstackdir/apache2/htdocs/
```

In Linux/Mac, permission issues might appear. Use chmod to htdocs folder to fix this.

```bash
#From install/dir/lappstackdir/apache2
#You can also try 755 for more secured installation
sudo chmod 777 htdocs/ 
```

Go to the cloned folder. Create a file in BuildEx/application/config and name it ```database.php```

Copy-paste the following, make sure to supply the correct username and password:

```php
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = '<username>';
$db['default']['password'] = '<password>';
$db['default']['database'] = 'buildex_db';
$db['default']['dbdriver'] = 'postgre';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

?>
```

Start LAPP.

In Linux:

```bash
cd /opt/lappstackdir/
sudo ./manager-linux-x64.run #change x64 depending on your installation
```

On your browser, go to http://localhost/phppgadmin.

Log-in the postgreSQL server with your own specified username and password from the installation of lappstack.
```
default username: postgres
default password: <none> #just leave it blank
```

Click 'Create database'.

Name it 'buildex_db', without the ''. Leave all the default settings and click the 'Create' Button.

## Manual Migration

Import the database files to phppgAdmin:

First, import ```buildex_db_struct.sql```.

Then, import ```buildex_db_data.sql```.

NOTE:
If you can't see the import button, try this:
From the side tab, click PostGreSQL
Click now the 'buildex_db' database and go to the 'SQL' tab.

On your browser, go to http://localhost/BuildEx/. A welcome page should appear.

## Credentials

### Admin

```
username: buildex.admin
password: password
```

### Faculty

```
username: mtcarreon
password: password
```

Note: Other roles are under development.

Code.Code.Code. Start!