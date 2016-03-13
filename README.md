# ServerPi
ServerPi is a homepage for your Raspberry Pi who allows you to explore file and manage your system.

#### Setup
- First, you need to install apache2 and php5 on your Raspberry Pi :

  ```sudo apt-get install apache2 php5```
- After that, you have to find the root of your website. You can found the path by copy/paste this command : 

  ```grep -i "DocumentRoot" /etc/apache2/sites-available/000-default.conf```
- Go to the path found in the last point, clean it and clone the repository : 

  ```git clone https://github.com/Naipsys/ServerPi.git .```
- Now you have to configure ServerPi by editing the file ServerPi/config.php.
