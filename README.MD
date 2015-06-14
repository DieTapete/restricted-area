restrictedArea
==============
A minimal PHP script to easily create password protected areas on a server without the need for a database or a .htaccess file.

**Warning: I am not a professional PHP programmer and there are probably still a lot of security flaws in this code. The script should not be used in it's current state. Contributions are very welcome.**

There's currently a discussion on HackerNews: https://news.ycombinator.com/item?id=9713192

## Usage
- Open `config.php` and remove the line `define('DEBUG', TRUE);`.<br>
  Also edit the other variables as needed.
- Upload all the files to a directory on your server.<br>
  It is not recommended to upload `create_hash.php` though. Use it in a local environment instead.
- Run `create_hash.php` in a web browser to generate a hash for a password.
- Open `config.php` and paste the generated hash into the `LOGINS` array. Remove the entry for ``user1``.
- For each user create a folder in the download directory that you defined in `config.php`. **For security reasons it is strongly recommended to use a folder in the non public area of the server (document root).**  If that is not possible just keep the default `files` directory.

## Info
The script comes with an example user named ``user1`` and the password ``password``. There is also an example file in the folder `files/user1` for the user to download.

For generating hashes the script uses Password Hashing With PBKDF2 (http://crackstation.net/hashing-security.htm). Copyright (c) 2013, Taylor Hornby


## Release History

* 0.1.0 Initial release
