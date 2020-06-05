#############
Instructions
#############

************
Requirements
************
* XAMPP Server
* Windows OS

**********************
Installation of Xampp
**********************

Xampp is available for Windows, Linux and Mac OS 
from `here <https://www.apachefriends.org/index.html>`_ .
After downloading, install Xampp.

**********************
Downloading the files
**********************
Clone the github repository from https://github.com/pranav1503/todo into htdocs folder, which is 
present inside the folder where xampp was installed.

***********************
Setting up the files
***********************
| After the files are cloned, follow the steps:
1. Go to application/config folder of the project.
#. Open the config.php file. Change the base_url to the url(localhost url) to which the folder is linked to.
#. Open the database.php, change the database name, username and password to installed phpmyadmin credentials.
#. Go to localhost/phpmyadmin in a browser, login and create a database called as todo.
#. Upload the sql file which is attached to the files into the phpmyadmin.
#. The setup is ready.Enter the localhost link in the brower and view the website.