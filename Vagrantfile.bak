# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.

#script to install vm stuff for apache server

$script_web = <<-SCRIPT 
sudo apt-get update -y
sudo apt install php libapache2-mod-php php-mysql -y
sudo apt install php7.4-mysqli
sudo apt-get install apache2 -y
sudo apt-get install mysql-client -y
sudo ufw enable -y
sudo ufw allow http
sudo ufw allow ssh
sudo ufw allow mysql
sudo service apache2 restart
cp -r /data/. /var/www/html
rm /var/www/html/index.html
sudo mkdir Isaac
sudo chown -R $USER:$USER /var/www/Isaac
sudo a2ensite Isaac
sudo a2dissite 000-default
sudo apache2ctl configtest
sudo systemctl reload apache2
SCRIPT



 $script_db = <<-SCRIPT 
 sudo apt-get update -y
 sudo apt-get install mysql-server -y
 echo y | sudo ufw enable
 sudo ufw allow mysql
 sudo ufw allow ssh
 # mysql < /data/mysql_script.sql
 # sudo sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf
 # sudo systemctl restart mysql
 SCRIPT

Vagrant.configure("2") do |config|
config.vm.box = "bento/ubuntu-20.04"
config.vm.synced_folder ".", "/data"
config.vm.synced_folder ".", "/vagrant"
  config.vm.provider "virtualbox" do |v|
    v.linked_clone = true
    v.memory = 1024
    v.cpus = 1
  end

  config.vm.define "web" do |web|
  web.vm.hostname = "webserver"
  web.vm.network "private_network", ip: "192.168.56.2"
  web.vm.provision "shell" , inline: $script_web
  web.vm.provision "file" ,source: "confFile.txt", destination: "/etc/apache2/sites-available/Isaac.conf"
  web.vm.provision "file" ,source: "test.php", destination: "/var/www/Isaac/info.php"

  end

 
  config.vm.define "db" do |db|
    db.vm.hostname = "db"
    db.vm.network "private_network", ip: "192.168.56.3"
	db.vm.provision "shell" , inline: $script_db
    end

   
end