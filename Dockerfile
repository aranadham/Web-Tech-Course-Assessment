FROM php:7.4-cli
EXPOSE 8080
COPY . /var/www/html/
CMD [ "php", "/mail/contact_me.php"]
