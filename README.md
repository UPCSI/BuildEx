# Social Gradebook

## Installation

### Requirements

1. Download and Install XAMPP/LAMPP 
http://www.apachefriends.org/en/index.html

2. Clone this repository.

3. Create a file in BuildEx/application/config and name it database.php

4. Copy-paste the following, make sure to supply the correct username and password:

```php
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root'; //default username of your database server is "root". Change this accordingly.
$db['default']['password'] = 'intelleq';//password of your database server. Change this. Leave it blank by default.
$db['default']['database'] = 'social_gradebook_db';
$db['default']['dbdriver'] = 'mysql';
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
```

4. Start XAMPP/LAMPP

5. From the cloned project/directory, import BuildEx_db.sql to phpMyAdmin

6. On your browser, go to http://localhost/BuildEx/. A welcome page should appear.

START!