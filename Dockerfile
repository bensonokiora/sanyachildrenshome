#
# NOTE: THIS DOCKERFILE IS GENERATED VIA "apply-templates.sh"
#
# PLEASE DO NOT EDIT IT DIRECTLY.
#

# ---- Builder Stage ----
FROM php:8.2-apache AS builder

# Install persistent dependencies (runtime deps needed in final image too)
RUN set -eux; \
	apt-get update; \
	apt-get install -y --no-install-recommends \
# Ghostscript is required for rendering PDF previews
		ghostscript \
# Runtime libs for PHP extensions, identified later but installed here for simplicity in builder
# Needed for gd:
		libfreetype6 \
		libjpeg62-turbo \
		libpng16-16 \
		libwebp7 \
# Needed for intl:
		libicu76 \
# Needed for imagick:
		libmagickcore-6.q16-7 \
		libmagickwand-6.q16-7 \
# Needed for zip:
		libzip4t64 \
	; \
	rm -rf /var/lib/apt/lists/*

# Install build dependencies and PHP extensions
RUN set -eux; \
	savedAptMark="$(apt-mark showmanual)"; \
	apt-get update; \
	apt-get install -y --no-install-recommends \
# Build dependencies for PHP extensions:
		libfreetype6-dev \
		libicu-dev \
		libjpeg-dev \
		libmagickwand-dev \
		libpng-dev \
		libwebp-dev \
		libzip-dev \
# Tools needed for build:
		curl \
		unzip \
	; \
	\
	docker-php-ext-configure gd \
		--with-freetype \
		--with-jpeg \
		--with-webp \
	; \
	docker-php-ext-install -j "$(nproc)" \
		bcmath \
		exif \
		gd \
		intl \
		mysqli \
		zip \
	; \
# Install imagick manually (same logic as before)
	curl -fL -o imagick.tgz 'https://pecl.php.net/get/imagick-3.7.0.tgz'; \
	echo '5a364354109029d224bcbb2e82e15b248be9b641227f45e63425c06531792d3e *imagick.tgz' | sha256sum -c -; \
	tar --extract --directory /tmp --file imagick.tgz imagick-3.7.0; \
	grep '^//#endif$' /tmp/imagick-3.7.0/Imagick.stub.php; \
	test "$(grep -c '^//#endif$' /tmp/imagick-3.7.0/Imagick.stub.php)" = '1'; \
	sed -i -e 's!^//#endif$!#endif!' /tmp/imagick-3.7.0/Imagick.stub.php; \
	grep '^//#endif$' /tmp/imagick-3.7.0/Imagick.stub.php && exit 1 || :; \
	docker-php-ext-install /tmp/imagick-3.7.0; \
	rm -rf imagick.tgz /tmp/imagick-3.7.0; \
	\
# Enable opcache
	docker-php-ext-enable opcache; \
	\
# Clean up build dependencies
	apt-mark auto '.*' > /dev/null; \
	apt-mark manual $savedAptMark; \
	apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
	rm -rf /var/lib/apt/lists/*; \
	\
# Verify extensions (optional but good practice)
	php -m; \
	err="$(php --version 3>&1 1>&2 2>&3)"; \
	[ -z "$err" ]

# Prepare PHP configs
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=2'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN { \
		echo 'error_reporting = E_ERROR | E_WARNING | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING | E_RECOVERABLE_ERROR'; \
		echo 'display_errors = Off'; \
		echo 'display_startup_errors = Off'; \
		echo 'log_errors = On'; \
		echo 'error_log = /dev/stderr'; \
		echo 'log_errors_max_len = 1024'; \
		echo 'ignore_repeated_errors = On'; \
		echo 'ignore_repeated_source = Off'; \
		echo 'html_errors = Off'; \
	} > /usr/local/etc/php/conf.d/error-logging.ini

# Prepare Apache configs (enabling modules needs apache)
RUN set -eux; \
	a2enmod rewrite expires remoteip; \
	\
	{ \
		echo 'RemoteIPHeader X-Forwarded-For'; \
		echo 'RemoteIPInternalProxy 10.0.0.0/8'; \
		echo 'RemoteIPInternalProxy 172.16.0.0/12'; \
		echo 'RemoteIPInternalProxy 192.168.0.0/16'; \
		echo 'RemoteIPInternalProxy 169.254.0.0/16'; \
		echo 'RemoteIPInternalProxy 127.0.0.0/8'; \
	} > /etc/apache2/conf-available/remoteip.conf; \
	a2enconf remoteip; \
	find /etc/apache2 -type f -name '*.conf' -exec sed -ri 's/([[:space:]]*LogFormat[[:space:]]+"[^"]*)%h([^"]*")/\1%a\2/g' '{}' +

# ---- Final Stage ----
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install runtime dependencies (must match libs used by extensions)
RUN set -eux; \
	apt-get update; \
	apt-get install -y --no-install-recommends \
		ghostscript \
		libfreetype6 \
		libicu76 \
		libjpeg62-turbo \
		libmagickcore-6.q16-7 \
		libmagickwand-6.q16-7 \
		libpng16-16 \
		libwebp7 \
		libzip4t64 \
# Install apache utilities needed for module enabling if not present
		apache2-utils \
	; \
	rm -rf /var/lib/apt/lists/*

# Copy PHP extensions from builder stage
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/

# Copy PHP configs from builder stage
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Copy Apache configs from builder stage
COPY --from=builder /etc/apache2/mods-available/ /etc/apache2/mods-available/
COPY --from=builder /etc/apache2/mods-enabled/ /etc/apache2/mods-enabled/
COPY --from=builder /etc/apache2/conf-available/ /etc/apache2/conf-available/
COPY --from=builder /etc/apache2/conf-enabled/ /etc/apache2/conf-enabled/
COPY --from=builder /etc/apache2/apache2.conf /etc/apache2/apache2.conf
COPY --from=builder /etc/apache2/ports.conf /etc/apache2/ports.conf

# Enable apache modules (copied as enabled, but good to ensure)
RUN a2enmod rewrite expires remoteip

# Application code
# Consider optimizing this part - e.g., only copy necessary files, not the whole directory if possible.
# If WordPress core files are not modified, consider adding them via a volume or downloading at runtime.
# For now, we copy the pre-existing directory.
COPY WordPress-new /var/www/html

# Ensure correct permissions (adjust if necessary based on your WordPress setup)
# RUN chown -R www-data:www-data /var/www/html

VOLUME /var/www/html/wp-content

# Entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]