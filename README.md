# Profily
Profily is a place where users can create profiles and start writing posts and comments. It supports CRUD operations. There are three types of users (normal user, moderator, and admin).

The project was built using PHP, Bootstrap 5, and Illuminate Database while learning the MVC architecture pattern.

# Requirements
* PHP 7.4+.
* MySQL.
* Apache web server with `mod_rewrite` enabled.

# Installation
1. run `composer install` in the app root.
2. Make sure that you have `mod_rewrite` enabled and edit the `RewriteBase` in `public/.htaccess`.
3. Run the .sql statements in `install` folder (you can use PHPMyAdmin for example).
4. Edit the database credentials and the URL of the app in `app/Config.php`.
5. Open the app and create an account, the first registered user becomes the admin.

# Screenshots
![alt text](https://raw.githubusercontent.com/Khaled-Farhat/Profily/master/screenshots/home.png)


![alt text](https://raw.githubusercontent.com/Khaled-Farhat/Profily/master/screenshots/profile.png)


![alt text](https://raw.githubusercontent.com/Khaled-Farhat/Profily/master/screenshots/comments.png)


![alt text](https://raw.githubusercontent.com/Khaled-Farhat/Profily/master/screenshots/login.png)


![alt text](https://raw.githubusercontent.com/Khaled-Farhat/Profily/master/screenshots/notAllowed.png)
