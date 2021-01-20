<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Установка

<ol>
<li>Склонировать проект</li>
<li>Скопировать .env.example в .env</li>
<li>Добавить переменную MEDIA_DISK=media в .env</li>
<li>Запустить команду composer update</li>
<li>Запустить команду php artisan key:generate</li>
<li>Запустить команду php artisan storage:link</li>
<li>Сконфигурировать базу данных</li>
<li>Сконфигурировать nginx</li>
<li>Переключить session в database</li>
<li>Запустить php artisan migrate --seed</li>
</ol>

<p>
Login: khamsolt@xcar.lo <br> Password: password
</p>
ГОТОВО!.

## Nginx Configuration
    server {
        listen 80;
        listen 443 ssl;
        listen [::]:80;

        server_name xcar.lo *.xcar.lo;

        ssl_certificate     /etc/nginx/ssl/khamsolt.crt;
        ssl_certificate_key /etc/nginx/ssl/khamsolt.key;

        access_log /var/www/xcar/storage/logs/nginx_access.log;
        error_log /var/www/xcar/storage/logs/nginx_error.log;

        root /var/www/xcar/public;
        index index.php;

        add_header X-Frame-Options "SAMEORIGIN";
        add_header X-XSS-Protection "1; mode=block";
        add_header X-Content-Type-Options "nosniff";

        charset utf-8;

        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }

        error_page 404 /index.php;

        # serve static files directly
        location ~* \.(jpg|jpeg|gif|css|png|js|ico|html)$ {
            access_log off;
            expires max;
            log_not_found off;
        }

        # removes trailing slashes (prevents SEO duplicate content issues)
        if (!-d $request_filename)
        {
            rewrite ^/(.+)/$ /$1 permanent;
        }

        # enforce NO www
        if ($host ~* ^www\.(.*))
        {
            set $host_without_www $1;
            rewrite ^/(.*)$ $scheme://$host_without_www/$1 permanent;
        }

        # unless the request is for a valid file (image, js, css, etc.), send to bootstrap
        if (!-e $request_filename)
        {
            rewrite ^/(.*)$ /index.php?/$1 last;
            break;
        }

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~* \.php$ {
            try_files $uri = 404;
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_pass php-upstream; # may also be: 127.0.0.1:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }

        location ~ /\.ht {
            deny all;
        }
    }
