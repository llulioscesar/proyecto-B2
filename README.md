instalar composer https://getcomposer.org/Composer-Setup.exe

abrir el cmd y dirigirse a la carpeta del codigo en mi caso es C:\xampp\htdocs\futbol y ejecuto el comando cd
cd C:\xampp\htdocs\futbol

luego ejecutar el siguiente comando
php -r "readfile('https://getcomposer.org/installer');" | php


agregar el .htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
