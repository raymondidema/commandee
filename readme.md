## Commandee Command / Event listener

### How to install

#### By command line

````
composer require raymondidema/commandee
````

#### By composer.json

````
...
  "require" : {
  ...
    "raymondidema/commandee": "1.*"
  }
...
````

### Configuration

Add a new file named: 'commandee.php' in your app/config folder

Example:

````
<?php
  return array(
    'listenName' => 'Acme.*', // How to listen dot notation
    'listeners' => array( // All listeners listed here
      'Acme\\Listeners\\EmailNotification'
    )
  );
````

