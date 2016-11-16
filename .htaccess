AddType application/x-javascript .js
AddType application/x-shockwave-flash .swf .SWF
AddType image/bmp .bmp .BMP
AddType image/gif .gif .GIF
AddType image/ief .ief
AddType image/jpeg .jpg .jpe .jpeg .JPG .JPEG .JPE
AddType image/png .png .PNG
AddType image/tiff .tiff .TIFF .tif .TIF
AddType image/vnd.wap.wbmp .wbmp .WBMP
AddType image/x-portable-anymap .pnm
AddType image/x-portable-bitmap .pbm
AddType image/x-portable-graymap .pgm
AddType image/x-portable-pixmap .ppm
AddType image/x-rgb .rgb
AddType image/x-xbitmap .xbm
AddType image/x-xpixmap .xpm
AddType image/x-xwindowdump .xwd
AddType text/css .css
AddType text/html .htm .html
AddType text/plain .asc .ico .txt .ASC .ICO .TXT
AddType text/richtext .rtx
AddType text/sgml .sgm .sgml
AddType text/xml .xml
<Files ~ "tools">
Order allow,deny
Deny from all
</Files>
php_value register_globals 0
#php_value error_reporting 0
php_value display_errors 0
php_value html_errors 0
php_value session.use_trans_sid 1
php_value magic_quotes_gpc 0
php_value magic_quotes_runtime 0
php_value magic_quotes_sybase 0
php_value file_uploads 1
php_value max_upload_filesize 2M
php_value date.timezone "Europe/Moscow"
directoryindex dfb.php
adddefaultcharset utf-8
options -indexes
ErrorDocument 403 /er.php?code=1
ErrorDocument 404 /er.php?code=1
#Options +FollowSymLinks
RewriteEngine On
RewriteCond %{REQUEST_METHOD} ^TRACE
RewriteRule .* - [F]
RewriteRule ^adm/index.board$ /adm/edit.php [L,QSA]
RewriteRule ^adm/boards.board$ /adm/board.php [L,QSA]
RewriteRule ^adm/zhaloby.board$ /adm/pretense.php [L,QSA]
RewriteRule ^add.board$ /new.php [L,QSA]
RewriteRule ^contact.board$ /cont.php [L,QSA]
RewriteRule ^createlog.board$ /reg.php [L,QSA]
RewriteRule ^index.board$ /dfb.php [L,QSA]
RewriteRule ^login.board$ /auth.php [L,QSA]
RewriteRule ^myboards.board$ /myboard.php [L,QSA]
RewriteRule ^number.board$ /num.php [L,QSA]
RewriteRule ^razdel.board$ /raz.php [L,QSA]
RewriteRule ^screen.board$ /resize.php [L,QSA]
fileetag none
<filesmatch ".(css|gif|ico|jpg|jpeg|js|png|swf)$">
ExpiresActive on
ExpiresDefault "access plus 1 day"
</filesmatch>
