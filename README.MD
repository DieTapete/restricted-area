restrictedArea
==============
A minimal PHP script to easily create password protected areas on a server without the need for a database. The script ships with a download area that lists the files of a specific folder but you can easily adapt it for anything you like.

**Warning: I am not a professional PHP programmer and there are probably still a lot of security flaws in this code. The script should not be used in it's current state. Contributions are very welcome.**

## Usage
- Open `config.php` and remove the line `define('DEBUG', TRUE);`.
  Also edit the other variables like `TITLE` as needed.
- Upload all the files to a directory on your server.
  <small>Hint: It's not recommended to upload `create_hash.php` though. Use it in a local environment instead.</small>
- Run `create_hash.php` in a web browser to generate a hash for a password.
- Open `config.php` and paste the generated hash into the `LOGINS` array. Remove the entry for ``user1``.
- For each user create a folder in the download directory that you defined in `config.php`.
<small>**For security reasons it is strongly recommended to use a folder in the non public area of the server (document root). If that is not possible just keep the default `files` directory or copy the `.htaccess` file from it to your alternative download folder.**</small>

## Info
The script comes with an example user named ``user1`` and the password ``password``. There is also an example file in the folder `files/user1` for the user to download.

## How does it work?
Basically you generate a hash (`create_hash.php`) for each user and save them in an associative array with the user names as keys. When a user logs in the script iterates through the array and the password is being validated. On validation two session variables are being set containing the username and the hash combined with the user agent string. These variables are used to check if the user is authorized (see `authorized` function in `functions.php`).
The hashing algorithm is implemented in `includes/pw.php` and uses PBKDF2 (`hash_pbkdf2` is used only if it exists) and SHA256 with 30000 iterations.

When logged in the user is able to see the files of a folder named after the user within the specified download directory. By default the download directory is the folder `files`, which is protected by a `Deny from all` rule in the `.htaccess ` file. It is recommended to use a non public folder instead since the access rule can be circumvented.

The download script `download.php` first checks if the user is authorized. Then the received GET variable `file` is urldecoded and checked if it contains the string '../' to prevent accessing files from a parent folder. The `file` variable is concatenated with the download directory and the username and served to the user via readfile if it exists.

## Third Party Usage
- For generating hashes the script uses Password Hashing With PBKDF2 (http://crackstation.net/hashing-security.htm). Copyright (c) 2013, Taylor Hornby
- powered by Bootstrap
- jQuery is loaded from a CDN by default but not used in any way. Kick it out if you don't need it.
- The Bootstrap Theme in use is Cosmo: https://bootswatch.com/cosmo/

## ToDo
- Implement security methods from this article: https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet
- Hash password also in the client: https://crackstation.net/hashing-security.htm
- Implement protection against brute force attack.
- Use `password_hash` and `password_verify` if `PHP >=5.5.0` is available.
- Use password compat for `PHP >=5.3` https://github.com/ircmaxell/password_compat
- Use SSL option in config.php and enforce `https` if script is called via `http`.
- Implement 'remember me' check box.
- Implement gallery module.

## Release History

* 0.2.0 Added modules system
* 0.1.0 Initial release
