# BuildEx

## Installation

### Requirements

1. Download and Install Bitnami's Stack (LAPP for Linux/MAPP for Mac/WAPP for Windows)
http://www.bitnami.com/article/apache-php-and-postgresql-all-in-one

2. Clone this repository in install/dir/lappstackdir/apache2/htdocs/

In Linux/Mac, permission issues might appear. Use chmod to htdocs folder to fix this.

```bash
#From install/dir/lappstackdir/apache2
#You can also try 755 for more secured installation
sudo chmod 777 htdocs/ 
```

3. Go to the cloned folder. Create a file in BuildEx/application/config and name it database.php

4. Copy-paste the following, make sure to supply the correct username and password:

```php
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'postgres';
$db['default']['password'] = 'intelleq';//password of your database server. Change this. Leave it blank by default.
$db['default']['database'] = 'buildex_db';
$db['default']['dbdriver'] = 'postgres';
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

5. Start LAPP.

In Linux:

```bash
cd /opt/lappstackdir/
sudo ./manager-linux-x64.run #change x64 depending on your installation
```

6. On your browser, go to http://localhost/phppgadmin.

7. Log-in the postgreSQL server with default username "postgres" and your own specified password from the installation of lappstack.

8. Create a database and name it buildex_db.

9. Import the exported database file buildex_db.sql to phppgAdmin. It's located in the directory of the cloned project.

10. On your browser, go to http://localhost/BuildEx/. A welcome page should appear.

Code.Code.Code. Start!