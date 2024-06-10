
FROM php:7.4-apache


WORKDIR /var/pairaw/sc


COPY . .


EXPOSE 80


CMD ["apache2-foreground"]
