# BuildEx

##Important!

Upon creating the commit message, 
"the body should provide a meaningful commit message, which:
- uses the imperative, present tense: "change", not "changed" or "changes"."
Git recommends that format.

buildex_db_struct.sql is the real schema and structure of our database.
buildex_db_data.sql is the dump data of our database. This will serve as out test case(s) source.

Import first the structure before getting on the data.

## Installation

### Requirements

Download and Install Bitnami's Stack (LAPP for Linux/MAPP for Mac/WAPP for Windows)
http://www.bitnami.com/article/apache-php-and-postgresql-all-in-one

Clone this repository in install/dir/lappstackdir/apache2/htdocs/

In Linux/Mac, permission issues might appear. Use chmod to htdocs folder to fix this.

```bash
#From install/dir/lappstackdir/apache2
#You can also try 755 for more secured installation
sudo chmod 777 htdocs/ 
```

Go to the cloned folder. Create a file in BuildEx/application/config and name it database.php

Copy-paste the following, make sure to supply the correct username and password:

```php
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'postgres';
$db['default']['password'] = 'intelleq';//password of your database server. Change this. Leave it blank by default.
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

Log-in the postgreSQL server with default username "postgres" and your own specified password from the installation of lappstack.

Click 'Create database' just below the table 'Actions on multiple lines'.

Name it 'buildex_db', without the ''. Leave all the default settings and click the 'Create' Button.

Import the exported database file buildex_db.sql to phppgAdmin. It's located in the directory of the cloned project.

NOTE: If you can't see the import button, try this:
  From the side tab, click PostGreSQL
  Click now the 'buildex_db' database and go to the 'SQL' tab.
  Click the 'Choose File' and select the buildex_db.sql then click 'Execute'

On your browser, go to http://localhost/BuildEx/. A welcome page should appear.

Code.Code.Code. Start!
