To install **SHOTNGET** Api, clone the content of this repository in your website directory (ex: /var/ww)

First install the php5 modules :
```bat
apt-get install php5-mcrypt
apt-get install php5-gd
```

```php5-mcrypt``` is used for encryption and decipherment and ```php5-gd``` is used to generate the QRCode to flash.

Now in a different directory, create a **certphone** directory (ex: /usr/certphone). We recommand to not place this directory inside the website directories (/var/www) because the private key will be stored here.

Inside this directory, create another : ```path_to_certphone/temp```

Now create the private and public key used by the server to encrypt / decipher exchanges between the smartphone and the server.
```bat
openssl genrsa -out kpri 1024
openssl rsa -in kpri -pubout -out kpub
```
Place the kpub and kpri files inside the **certphone** directory.
Now give the rights to the files and directories :
```bat
chmod 640 path_to_certphone/kpri
chown www-data:www-data path_to_certphone/temp
```

To use the plugin you need a signature form the TrustDesigner company. To have one you must do the following steps :
  - Put the kpub file at the root of yout website (ex: /var/www)
  - Send a mail to activation@shotnget.com with the following content :
      WebSite URL : your_website_url/kpub_filename (ex: https://mail.test.com/kpub_filename)

A response will be send with the signature to put in a file named **urlsign** in the certphone directory.

Now all you have to do is to configure the Api.

In the **shotngetapi** directory create a config.php file containing the following :
```php
<?php

  class Config
  {
    public static $TEMP_PATH = 'path_to_certphone/certphone/temp/';

    // The $RESPONSE_URL page is the page which the smartphone is connecting to
    public static $RESPONSE_URL = 'url_of_your_website/api_dir/response_handler.php';

    // The $TARGET_REDIRECT page is the page calleed when the shotnget transaction is done
    public static $TARGET_REDIRECT = 'url_of_your_website/redirect.php';

    public static $URLSIGN = 'path_to_certphone/certphone/urlsign';
    public static $OLDURLSIGN = 'path_to_certphone/certphone/urlsign';
    public static $KPUB = 'path_to_certphone/certphone/kpub';
    public static $KPRI = 'path_to_certphone/certphone/kpri';
  }
?>
```

The **url_of_your_website** is for example https://your_website.com/

The **redirect.php** is the page to perform login, you can use the shotngetapi function with the rand to get the loggin and the password.

In the **request_handler.php** page, you can change the type of data you want by sending a request to the smartphone. See shotngetapi/cmd for the list of commands and shotngetapi/tmpl/cparam.php to see all the parameters.

In **shot_listener.js**, change the link to the redirect page and change the error handler if you need it.

Before calling the function for the QRCode you must include two javascript files : **shotngetapi.js** and **shot_listener.js**.
To call the process, you only have to call the finction ```get_shotnget_code(url, callback, text);``` in the onclick method of a button. The url is the url to the ```get_code.php``` page, the callback is a function to call when the QRCode finished loading in the client and text is the text to affich under the QRCode. See the index.html page for an example.
