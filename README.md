# Placement-Cell
Placement Management System

             A Placement Management System In PHP is aimed at developing an online application for the Training and Placement. 
             The Placement Management System Using PHP is an online application that can be accessed throughout the organization 
             and outside as well with proper login provided.
             
Front end: HTML,CSS,Javascript
Back end: MySQL, PHP

**EXECUTION:**

Step 1: Download source code.

Step 2: Extract file.

Step 3: Copy project folder in htdocs of xampp folder

Step 4: Open xampp and start the apache and Mysql

Step 5: Open browser and go to URL http://localhost/phpmyadmin/

Step 6: Create database and Create database naming “trinfosoft_entertainment”.

Step 7: Click on browse file and select “trinfosoft_entertainment.sql” file which is inside “database” folder and after import click “go“.

Step 8: Open a browser and go to URL “http://localhost/placement/”.

Step 9: Explore. Login from the User’s login side. Just provide the Admin’s login detail, it will redirect you to Admin panel.

![image (10)](https://user-images.githubusercontent.com/122424835/211743256-3220b794-412d-46d2-ad57-cd2a18cc610b.png)

![image (9)](https://user-images.githubusercontent.com/122424835/211742290-5b2ab2a0-ee44-4966-9e00-d850bd319340.png)

![image (8)](https://user-images.githubusercontent.com/122424835/211742330-c8c51dfd-c71b-4f60-aba0-7a6dfbcecd9d.png)

![image](https://user-images.githubusercontent.com/122424835/211742342-54b5d6e5-a175-4efb-8de1-ed3568876f39.jpg)



**ERRORS:**

1.
**Fatal error:** Uncaught mysqli_sql_exception: Access denied for user 'root'@'localhost' (using password: YES) in C:\xampp\htdocs\Placement\includes\header.php:4 Stack trace: #0 C:\xampp\htdocs\Placement\includes\header.php(4): mysqli_connect('localhost', 'root', 'trinfosoft_ente...') 

**Solution:** C:\xampp\htdocs\Placement\home.php(2): include('C:\\xampp\\htdocs...') #2 {main} thrown in C:\xampp\htdocs\Placement\includes\header.php on line 4 (28000) access denied for user 'root'@'localhost' (using password: yes). This usually occurs when you enter an incorrect password or password for your database. Fixing these credentials can resolve this error in no time.

2.
**Error:**
Port 80 in use by "Unable to open process" with PID 4!

**Solution:**
Simply set Apache to listen on a different port. This can be done by clicking on the "Config" button on the same line as the "Apache" module, select the "httpd.conf" file in the dropdown, then change the "Listen 80" line to "Listen 8080". Save the file and close it.
Now it avoids Port 80 and uses Port 8080 instead without issue. The only additional thing you need to do is make sure to put localhost:8080 in the browser so the browser knows to look on Port 8080. Otherwise it defaults to Port 80 and won't find your local site.

3.
**Error:** phpMyAdmin in xampp not working

**Solution:**
First of all go to apache config.Now go to select Apache “httpd.conf” so now you can see that a notepad file will be opened”.
Find the word “Listen” using ctrl + F button or go to Edit then select find. Replace “Listen 80” to “Listen 8080“.
Again find another “Listen” now change “ServerName localhost:80” to “ServerName localhost:8080” and then save it.
“We are almost done to fix localhost/phpmyadmin” Step 6: Again go to config and select “Apache (httpd-sss.conf)“.
Step 7 is to Find “Listen 443” and change it to “Listen 4433“
Step 8: Find “” and replace this with “” and again save it.
Step 9: Go to config and select “service & ports settings” and change the port to 8080 and 4433 and save it.
Step 10: Restart, the localhost/phpmyadmin is solved.



