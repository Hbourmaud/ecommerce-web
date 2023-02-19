# commerce website

To install the project, you must clone the repository in a specific location: in the folder where the XAMPP software (htdocs) is installed.
You must launch Apache and MySQL so that you can display the project pages on your browser.

You need to use phpmyadmin (localhost/phpmyadmin) to be able to create the empty database. The database must have the name: php_exam_db. Then, import the sql file located in the directory (htdocs/php_exam/data/). This will allow you to complete the database.

There are two basic users: an admin (username: admin & password: admin) and a simple user (username: john & password: john).

## Availables features

### Register

This page will allow the user to create an account. 

### Login

This page will allow the user to login on this account. Connected, the user can access different features that an average user cannot access.

### Home

This is where all users come in, whether logged in or not.
They can login, view their profile, create an item to sell whatever they want.
If they are logged in, they can log out. They will have a `logout` button instead of `login`.

### Sell

The page allows you to create an item for sale. It also allows you to see the Article table to see the fields to put on the creation form. Finally, she can also see the Stock table.

### Detail

The page display details of the past article. The user can add the item to his basket via this page.

### Cart

The page displays all the items present in the cart of the currently logged in user. He has the option to place an order if the user's balance is sufficient. He also has the option of increasing the number of items in the basket. The user has the ability to remove items from the cart.

### Cart & Validation

The page validates the cart if the user's balance is sufficient. It also allows you to fill in the user's billing information and allows you to validate the order, empty the basket, and generate an invoice.

### Edit

The user has the possibility to modify or delete the article. Only the user who created the article or an admin is able to modify it.

### Account

If the page is targeting a user that isn't yours, it will display all articles posted by that account and display account information.
If the page is aimed at your user, it will display all the articles you have published. It will display the invoices. The user has the possibility to modify his personal information and has the possibility to add money to his balance.

### Admin

The page is accessible only to users with the administrator role. It consists of two other pages: one that lists all the posts, with the possibility of modifying or deleting them; the other that lists all users, with the option to edit or delete them.



---

This commerce website is made by: ***BOURMAUD Hugo***, ***BRAVO Valentin*** and ***PORTE Brandon***.