#!/usr/bin/env bash
set -Eeuo pipefail

if [[ "$1" == apache2* ]] || [ "$1" = 'php-fpm' ]; then
    uid="$(id -u)"
    gid="$(id -g)"
    if [ "$uid" = '0' ]; then
        case "$1" in
            apache2*)
                user="${APACHE_RUN_USER:-www-data}"
                group="${APACHE_RUN_GROUP:-www-data}"

                # strip off any '#' symbol ('#1000' is valid syntax for Apache)
                pound='#'
                user="${user#$pound}"
                group="${group#$pound}"
                ;;
            *) # php-fpm
                user='www-data'
                group='www-data'
                ;;
        esac
    else
        user="$uid"
        group="$gid"
    fi

    # Check if wp-config-prod.php file exists
    if [ -f "/var/www/html/wp-config-prod.php" ]; then
        # Rename or replace the wp-config-prod.php file
        mv /var/www/html/wp-config-prod.php /var/www/html/wp-config.php
    fi


    # Set ownership of /var/www/html to www-data (only if running as root)
    if [ "$uid" = '0' ]; then
        chown -R www-data:www-data /var/www/html
        # Set the correct permissions for the uploads directory
        # chmod -R 775 /var/www/html/wp-content/uploads
        chmod -R 777 /var/www/html/wp-content/
    fi

fi

exec "$@"