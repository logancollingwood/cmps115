# An eSports thing...
Course assignments can be found in docs/


##Installation
1. Install Composer (https://getcomposer.org/)

2. Run `composer install` to install php libraries. These external dependencies can be found in composer.json.

3. Update .env.example and fill in with local mysql credentials. Once this is done, save as .env.

4. Run `sudo npm install` to install node dependencies

5. Create database `lolstat` or whatever you want to call it (just update .env)
6. Run `php artisan migrate` to create database migration 
7. Run `php artisan db:seed` to run seed with example data
8. Serve the database using mysql, and configure apache2 virtualhosts to point to where you want to store the application (with virtualbox this will be where you mount the shared folder).
9. Run `sudo service apache2 restart` to restart apache (on Ubuntu)
