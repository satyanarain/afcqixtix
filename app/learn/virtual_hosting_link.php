
https://glyphsearch.com/?query=BUS
 {!!Form::label('registration_term', 'Registration Term')!!}
 {!!Form::select("registration_term", ['7' => "7 Years", '10' => '10 Years', '14' => '14 Years', '15' => '15 Years'], isset($trademark->registration_term) ? $trademark->registration_term : 'null', ['class' => "form-control",onChange=>'reNewwalYear(this.value)','placeholder'=>'Select Registration Term'])!!}
 <VirtualHost *:80>
    # ServerAlias 162.243.93.216
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html

    Alias /projecta /var/www/projecta
    Alias /projectb /var/www/projectb

    <Directory /var/www/>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            allow from all
     </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>


///////////////////////////////////////////////////Command "make:" is ambiguous./////////////////////////////////////
it means you have not correct commad it may be space        
///////////////////////////////////////////////////
<VirtualHost *:80>
    ServerAdmin admin@newkerda.com
    ServerName newkerda.com
    ServerAlias www.newkerda.com
    DocumentRoot /var/www/kerda/public
     <Directory /var/www/html/kerda>
                AllowOverride All
        </Directory>
    ErrorLog /var/log/apache2/error.log
    CustomLog /var/log/apache2/access.log combined
</VirtualHost>
opiant.com.conf
<VirtualHost *:80>  
    ServerAdmin laravel.pmpmlpass@pmpmlpass.com
    ServerName laravel.pmpmlpass.com
    ServerAlias www.laravel.pmpmlpass.com
    DocumentRoot /var/www/pmpmlpass/public
      <Directory /var/www/html/pmpmlpass/>
                AllowOverride All
        </Directory>
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
sudo a2enmod rewrite
If that doesn't work you can change the virtualhost configuration to something like this

<VirtualHost *:80>
        ServerName laravel.example.com
        DocumentRoot /var/www/html/mynewhost/public
       <Directory />
                Options FollowSymLinks
                AllowOverride None
        </Directory>
        <Directory /var/www/html/mynewhost/>
                AllowOverride All
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/error.log
        LogLevel warn
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
Additionally add the ServerName to /etc/hosts

<your-server-ip-address> laravel.example.com

sudo a2enmod rewrite
sudo a2enmod php7.0
 sudo service apache2 restart
systemctl restart apache2
chown -R www-data:www-data /var/www/html/laravel

chmod -R 755 /var/www/html/laravel/storage


<VirtualHost *:80>
ServerAdmin admin@your_domain.com
DocumentRoot /var/www/html/your_website/public/
ServerName your_domain.com
ServerAlias www.your_domain.com
<Directory /var/www/html/your_website/>
AllowOverride All
Order allow,deny
allow from all
</Directory>
ErrorLog /var/log/apache2/your_domain.com-error_log
CustomLog /var/log/apache2/your_domain.com-access_log common
</VirtualHost>
<VirtualHost *:80>
	# The ServerName directive sets the request scheme, hostname and port that
	# the server uses to identify itself. This is used when creating
	# redirection URLs. In the context of virtual hosts, the ServerName
	# specifies what hostname must appear in the request's Host: header to
	# match this virtual host. For the default virtual host (this file) this
	# value is not decisive as it is used as a last resort host regardless.
	# However, you must set it for any further virtual host explicitly.
	#ServerName www.example.com

	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html

	# Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
	# error, crit, alert, emerg.
	# It is also possible to configure the loglevel for particular
	# modules, e.g.
	#LogLevel info ssl:warn

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined

	# For most configuration files from conf-available/, which are
	# enabled or disabled at a global level, it is possible to
	# include a line for only one particular virtual host. For example the
	# following line enables the CGI configuration for this host only
	# after it has been globally disabled with "a2disconf".
	#Include conf-available/serve-cgi-bin.conf
</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
<VirtualHost *:80>
        # The ServerName directive sets the request scheme, hostname and port that
        # the server uses to identify itself. This is used when creating
        # redirection URLs. In the context of virtual hosts, the ServerName
        # specifies what hostname must appear in the request's Host: header to
        # match this virtual host. For the default virtual host (this file) this
        # value is not decisive as it is used as a last resort host regardless.
        # However, you must set it for any further virtual host explicitly.
        #ServerName www.example.com

        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html

        <Directory /var/www/html>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            allow from all
            Require all granted
        </Directory>

        # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
        # error, crit, alert, emerg.
        # It is also possible to configure the loglevel for particular
        # modules, e.g.
        #LogLevel info ssl:warn

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        # For most configuration files from conf-available/, which are
        # enabled or disabled at a global level, it is possible to
        # include a line for only one particular virtual host. For example the
        # following line enables the CGI configuration for this host only
        # after it has been globally disabled with "a2disconf".
        #Include conf-available/serve-cgi-bin.conf
</VirtualHost>


# a2ensite your_website.conf
service apache2 reload

<?php
{{ route($segments[0] . '.create')}}
?>
/******************************************88/
 * https://github.com/Zizaco/entrust
 */
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}

  <h3 class="box-title">{{headingMain()}}</h3>
  https://www.youtube.com/watch?v=lw6xOu6ot30&vl=en
      
     user :opiano1v_mantisb 
     database  opiano1v_mantisb
     pass:opiano1v_mantisb 


      
      admin
      
     APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:bCODvPrtlLvQP7Q6eXlDh66ENCQAbVwUak1ACqtLiKQ=

DB_HOST=localhost
DB_DATABASE=kerda
DB_USERNAME=root
DB_PASSWORD=opiant@098!123

CACHE_DRIVER=array
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=localhost
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null