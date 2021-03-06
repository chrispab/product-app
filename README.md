# product-app
A DIY MVC PHP CRUD application with Bootstrap.

*note: this readme is best viewed on github: https://github.com/chrispab/product-app*

### Application spec
An application to manage a product inventory. A product consists of a part number, description, image, stock quantity, cost price, selling price, vat rate.

#### The application should have interfaces for:
* product creation
* product amendments
* product deletion
* product list report

### Constraints
* PHP application.
* The database can be MySQL or PostgreSQL - chose MySQL
* The backend should use MVC.
* The frontend should use the Bootstrap framework.
* The application will run under Apache on a Linux environment.
* The application should NOT use an off the shelf MVC framework.
* Include a read.me file (this file) with instructions on how to install the application and database.


## Installation:
**Prerequisites:**  
1. Installation on local machine with Linux (developed on ubuntu server 16.04)  
2. MySQL installed.  
3. Apache installed.  
4. PHP installed.  

*note: Should work on ubuntu 14.04 and above with these directions.*

### Install Steps
1. Unzip  the archive into a new directory "products_app", or one of your choosing.  (or clone repository into it)
2. Create the database in MySQL by running the  SQL file at 'products_app/db/create_products_db.sql' in the folder created earlier.
3. Create a user with RW permissions to the  products_app database -  username: myiot password: myiot
4. Now to create a new entry into apache sites-available:-  
5. If you look inside the products_app directory, there is a folder called public. This is the “public_html” of the project.  
6. To setup an Apache virtualhost for that folder, Create a  file:   /etc/apache2/sites-available/products_app.conf and use the following content (modified to match your paths)  
e.g to create and edit: in the terminal: `sudo nano /etc/apache2/sites-available/products_app.conf`  

7. Enter the following in the file, edit paths to suit your folder setup.

    ```
    <VirtualHost *:80>
    <Directory /home/uda/sites/products_app>
      Options Indexes FollowSymLinks
      AllowOverride All
      Require all granted
    </Directory>
    ServerName products.app
    ServerAdmin webmaster@localhost
    DocumentRoot /home/uda/sites/products_app/public
    ErrorLog /home/uda/sites/products_app/error.log
    CustomLog /home/uda/sites/products_app/access.log combined
    </VirtualHost>
    ```
**Plese replace the path part "/home/uda/sites" in the above code to correspond with where you placed the "products_app" folder earlier.**

8. Next you need to enable the new site and restart Apache.
9. Enable new site conf on server, in the terminal: `sudo a2ensite products_app.conf`

10. Restart apache on server, in the terminal: `sudo service apache2 restart`

11. Add site to local hosts on client, to edit in the terminal: `sudo nano /etc/hosts`
12. Add the line, and save: `127.0.0.1    products.app`

13. On your client browser enter: http://products.app

###### Issues:
* Internet access must be available for the client browser to enable access to bootstrap, bootbox and JQuery CDNs.  
* If you get a blank screen, you may need to check you have suitable permissions for your web group on the app folder etc.

###### Notes:
source on github: https://github.com/chrispab/product-app  
to clone: git clone  https://github.com/chrispab/product-app.git

###### todo:
refactor  
improve form data validation  
complete PHPDoc data  
Complete upload PHPUnit Tests  
Improve error handling  
Re-Style UI


README.md/READ.ME
