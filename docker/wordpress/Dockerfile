FROM ctac/wordpress-base:4.7-php7.0

COPY docker/wordpress/rootfs /
COPY app/platform.gsa.gov /var/www/html
#COPY app/wordpress /var/www/html

# Remove original WP themes
RUN rm -rf /var/www/html/wp-content/themes/twentytwelve && \
	rm -rf /var/www/html/wp-content/themes/twentythirteen && \
	rm -rf /var/www/html/wp-content/themes/twentyfourteen && \
	rm -rf /var/www/html/wp-content/themes/twentyfifteen && \
	rm -rf /var/www/html/wp-content/themes/twentysixteen && \
	rm -rf /var/www/html/wp-content/themes/twentyseventeen
	
#RUN chown -R www-data:www-data /var/www/html
#RUN chmod 644 /var/www/html/wp-includes/pomo/mo.php