# product-app

## Description
A primitive MVC(P) PHP CRUD application with Bootstrap.

### Application spec
Application spec
We need an application to manage a product inventory. A product consists  
of a part number, description, image, stock quantity, cost price,  
selling price, vat rate.

The application should have interfaces for:
* product creation
* product amendments
* product deletion
* product list report

#### Constraints
• Build and supply the above as a PHP application.
• The database can be MySQL or PostgreSQL
• The backend should use MVC.
• The frontend should use the Bootstrap framework.
• The application will run under Apache on a Linux environment.
• The application should NOT use an off the shelf MVC framework.
• Include a read.me file with instructions on how to install the application and database.

## Installation:
#### Assuming:
1. Installation on local machine with Linux (developed on ubuntu server 16.04)
2. MySQL installed.
3. Apache installed.
4. PHP installed.
note: Should work on ubuntu 14.04 and above with these directions.



1. Unzip  the archive into a new directory (I suggest "product_app") of your choosing (or clone repository into it)
2. Create the database in MySQL by running the  SQL file at 'db/create_products_db.sql' in the folder created earlier.
add user with RW permissions to the  produst_app database -  username: myiot password: myiot
3. Check perms on db
4. entry into apache sites-available
mkdir ~/Sites
cd ~/Sites

If you look inside the product_app directory, you will see a folder called public. This is the “public_html” of the project.

To setup an Apache virtualhost for that folder:
Create a  file: /etc/apache2/sites-available/product_app.conf and use the following contect (modified to match your paths)

e.g to create and edit:

`sudo nano etc/apache2/sites-available/myiot.conf`

```
<VirtualHost *:80>
<Directory /home/uda/sites/myiot>
  Options Indexes FollowSymLinks
  AllowOverride All
  Require all granted
</Directory>
ServerName myiot.local
ServerAdmin webmaster@localhost
DocumentRoot /home/uda/sites/myiot/public
ErrorLog /home/uda/sites/myiot/error.log
CustomLog /home/uda/sites/myiot/access.log combined
</VirtualHost>
```

add site to local hosts on client;
sudo nano /etc/hosts
add 127.0.0.1    myiot.local


Next you need to enable the new site and restart Apache.

# enable new site conf on server
sudo a2ensite apple.conf

# restart apache on server
sudo service apache2 restart

If you get a blank screen, you may need to give app/storage different permissions.
    notes on paths used - replace with own
5. restart apache
6. enter into local hosts file
7. Running: in browser http://products.app
8. permissions on dir

on github: https://github.com/chrispab/product-app

##### todo:
improve form data validation
complete PHPDoc data
Complete PHPUnit Tests
Improve error handling


READ.ME/README.md
for: Product_app
By:C.Battisson
