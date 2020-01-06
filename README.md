# ISAD251---Coursework

## Tools used:
- Mockaroo.com to create the mock data
- Bootstrap studio to help with creating the initial layout

## Dependencies:
- https://getcomposer.org/download/ for Laravel 
- follow steps to install Laravel: https://laravel.com/docs/6.x/installation

### To install project:
- git clone {insert project clone}
- "composer update" in pub-site folder
- composer install
- php artisan key:generate
- php artisan serve

### Settings/Tools:
- Laravel 6.5: https://laravel.com/
- Postman (To test API): https://www.getpostman.com/
- Mockaroo (to help create fake data): https://mockaroo.com/
- Bootstrap Studio (to help create the first layout): https://bootstrapstudio.io/ 
- Regex helper(to help with the regex for email): https://www.regextester.com/ 
- Composer (used to install dependencies for Laravel): https://getcomposer.org/download/

## Video Showing the program:
[![Pub Site youtube](https://img.youtube.com/vi/fsUunvlxkbU/0.jpg)](https://www.youtube.com/watch?v=fsUunvlxkbU)

https://www.youtube.com/watch?v=fsUunvlxkbU<VIDEO ID>

## Images used:
- Bottles on homepage https://www.freeimages.com/photo/bottle-1528364
- walkers crisp https://walkers.co.uk/crisps-range/walkers-crisps/ready-salted

## Screenshots
### Home
![homePage](Screenshot/homePage.PNG "Home Page")
### Add order
![addOrder](Screenshot/addOrder.PNG "Add Order")
### View order
![viewOrder](Screenshot/viewOrder.PNG "View Order")
### Admin
![admin](Screenshot/admin.PNG "Admin")
### Admin customer
![adminCustomer](Screenshot/adminCustomer.PNG "Admin Customer")
### Admin products
![adminProducts](Screenshot/adminProducts.PNG "Admin Products")

## Application fact sheet
    ## Customer orders snack
    1.	On the home page click order here on the image or order now on the tool bar
    2.	On the order page click the items you want on the left-hand side using + and –
    3.	type in a valid Email (this is validated by regex) to the left-hand side
    4.	type in a table number between 1-99
    5.	the comments are optional
    6.	Once filled in click the submit order button
    7.	If the email and/or table number is incorrect the program will prompt you 
    8.	if all the elements are correct the program will redirect you to a page that has all the order details including order ID, products and the total.
    ## Customer views/adds/removes order
    ### View order
    1.	On the home page click the “View Order” text at the top of the screen
    2.	To view your order either type in the Order ID or the Email
    ### Add Item to order ( follow steps in view order first)
    3.	To add an item to your order you type in the OrderID, ProductID, Quantity and price box at the bottom
    4.	Once all the details are correct click the add item to order button
    5.	Repeat step 2 to view order
    ### Remove Item in order ( follow steps in view order first)
    3.	To remove an item, click the red cross next to the item in the table to remove
    4.	Repeat step 2 to view order




## Browsers Compatibility
### Browsers that have been tested:
- Firefox
- Chrome
- Edge
### Browser that aren’t completable that have been tested:
- Internet Explorer
