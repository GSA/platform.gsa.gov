FROM ctac/wordpress-base:4.7-php7.0

# Inject Consul Template
ENV CONSUL_TEMPLATE_VERSION 0.16.0

## S6 managed consul-template to generate env files

ADD https://releases.hashicorp.com/consul-template/${CONSUL_TEMPLATE_VERSION}/consul-template_${CONSUL_TEMPLATE_VERSION}_linux_amd64.zip /

RUN unzip -d / /consul-template_${CONSUL_TEMPLATE_VERSION}_linux_amd64.zip && \
    mv /consul-template /usr/local/bin/consul-template &&\
    rm -rf /consul-template_${CONSUL_TEMPLATE_VERSION}_linux_amd64.zip && \
    mkdir -p /consul-template /consul-template/config.d /consul-template/templates

COPY consul-template/config.d /consul-template/config.d/
COPY consul-template/templates /consul-template/templates/

COPY s6 /etc/services.d/

# Add the S3 proxy mapping for media library files
COPY docker/wordpress/rootfs/etc/nginx/conf.d/wordpress-ms-sites-map.conf /etc/nginx/conf.d/wordpress-ms-sites-map.conf

# Add the php.ini overrides
COPY docker/wordpress/rootfs/etc/php/7.0/fpm/conf.d/zz-php.ini /etc/php/7.0/fpm/conf.d/zz-php.ini

# Add the application.
COPY docker/wordpress/rootfs/etc/nginx/sites-include/platform.gsa.gov /etc/nginx/sites-include/platform.gsa.gov
COPY app/platform.gsa.gov /var/www/html

# Remove original WP themes
RUN rm -rf /var/www/html/wp-content/themes/twentytwelve && \
	rm -rf /var/www/html/wp-content/themes/twentythirteen && \
	rm -rf /var/www/html/wp-content/themes/twentyfourteen && \
	rm -rf /var/www/html/wp-content/themes/twentyfifteen && \
	rm -rf /var/www/html/wp-content/themes/twentysixteen && \
	rm -rf /var/www/html/wp-content/themes/twentyseventeen

#Set permissions for temporarily saved media library files
RUN chown -R www-data:www-data /var/www/html/wp-content/uploads
# RUN chown -R www-data:www-data /var/www/html/wp-content/blogs.dir

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*