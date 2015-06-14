restrictedArea
==============
A minimal PHP script to easily create password protected areas on a server without the need for a database. The script ships with a download area that lists the files of a specific folder but you can easily adapt it for anything you like.

**Warning: I am not a professional PHP programmer and there are probably still a lot of security flaws in this code. The script should not be used in it's current state. Contributions are very welcome.**

Discussion on HackerNews: https://news.ycombinator.com/item?id=9713192

## Screenshots
![Login Screen](https://dl.dropboxusercontent.com/u/2409265/ra/screenshot_login.jpeg "Login Screen")

![Login Screen](https://dl.dropboxusercontent.com/u/2409265/ra/screenshot_download.jpeg "Login Screen")

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
Basically you generate a hash (`create_hash.php`) for each user and save them in an associative array with the user names as keys. When a user logs in the script iterates through the array and the password is being validated. On validation two session variables are being set containing the username and hash. These variables are used to check if the user is authorized (see `authorized` function in `functions.php`).

When logged in the user is able to see the files of a folder named after the user within the specified download directory. By default the download directory is the folder `files`, which is protected by a `Deny from all` rule in the `.htaccess ` file. It is recommended to use a non public folder instead since the access rule can be circumvented.

The download script `download.php` first checks if the user is authorized. Then the received GET variable `file` is urldecoded and checked if it contains the string '../' to prevent accessing files from a parent folder. The `file` variable is concatenated with the download directory and the username and served to the user via readfile if it exists.

## Third Party Usage
- For generating hashes the script uses Password Hashing With PBKDF2 (http://crackstation.net/hashing-security.htm). Copyright (c) 2013, Taylor Hornby
- powered by Bootstrap
- jQuery is loaded from a CDN by default but not used in any way. Kick it out if you don't need it.
- The Bootstrap Theme in use is Cosmo: https://bootswatch.com/cosmo/

## ToDo
- Implement protected against brute force attack.
- Use `password_hash` and `password_verify` if PHP >=5.5.0 is available.
- Enforce https
- Implement 'remember me' check box.

## Release History

* 0.1.0 Initial release

<style>.markdown-body img{border:1px solid gray; padding:10px}</style>
