 #!/usr/bin/env bash

set -x

apt-get update
apt-get install -y apache2
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi

cp /vagrant/.vagrant/provision/virtualhost.conf /etc/apache2/sites-enabled/
service apache2 reload