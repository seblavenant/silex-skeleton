 #!/usr/bin/env bash

apt-get update
apt-get install -y apache2
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi

cp virtuahost.conf /etc/apache2/site-enabled/
service apache2 reload