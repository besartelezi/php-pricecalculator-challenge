# PHP - Pricecaclulating Heroes Present!
This is a challenge that Glenn and I will tackle on together.
We need to apply basic OOP principles, import data with a database, and learn to use an MVC.
Calling this challenge a real challenge would be an understatement.

## The First Step
We decided that we'll start out by reading up on MVC's, skimming through the boilerplate code we received, and just try to make sense of it all.
The coaches have also given us a small to-do list to help us get started.

- [x] explore what is mvc ? why is everything a class? send help plz
- [x] make DB
- [x] make connection between controller/model and DB
- [x] display data to test connection
- [x] DO IT ALL ON HOMEPAGE FOR TESTING REFACTOR LATER

Our current major goal is to be able to make a connection between the controller/model and the database.
Once we have a way better understanding of this exercise, we will be able to create a more concrete TO-DO list.
And with that TO-DO list, we will be able to create a working price-calculating website that we can both be proud of!

## MVC - Explained (as best as we can)
Now that we were finally able to make a connection, we want to have a deeper understanding of MVC, so we can figure out the next steps we should take.
We found a very neat article [that you can read here](https://www.guru99.com/mvc-tutorial.html) that helped us out a lot.
And for those that are more visual learners, there is a neat image that we added here down below that explains it very well.
In the README given to us by the coaches, they also wrote down some key qualities that the MVS structure needs to adhere to.
````
For now you should create 3 different directories:
- Controller: has access to GET/POST vars, receives the Request
- Model: Most of your code should be here, for example the Product and Customer class.
- View: Your HTML files.
````

![alt-text](resources/images/mvc-structure.PNG)

With this information, we think that these have to be our next goals:
- [x] Put the code that gets us the database in the model folder
- [x] Test out the controller and view
  - [x] Add code to the controller to create variables. These variables call on the Getter that was set in the module to get more specific information.
  - [x] Echo the variables that were made in the controller onto the view.
This is something we will do in group.
As long as we still don't have any small, concrete goals and we're still figuring out stuff, working together is advised.
Once we're done with this small TO-DO list, Glenn and I will once again come together and figure out the next step.
The most important thing we have to figure out, is what classes should be created exactly in the model.

## MVC 2: Electric Boogaloo
We were finally able to properly connect through the database, while following the MVC structure AND get specific information from the database.
After getting this "massive W" (how the cool youths of today like to refer to something that went great), we've gotten a better understanding of the MVC structure and it's advantages.
One of those advantages being how easy it makes it to be able to work in teams without interfering in each other's code.
With that said, here are our next goals:
- [x] Create a dropdown for the customers as well
- [x] Check if the $_GET or $_POST show up 
- [x] Create a new function in the controller, that asks the database for the information the user requested
  - [x] Get user input
  - [x] Get basic information of the product the user selected
  - [x] Display the basic information (name, price, id)
- [x] Show the requested data on the view

## Getting down to :bee: siness
Another chapter, another new object on the to-do list.
- [ ] Get the user requested information, regarding the customer groups
  - [ ] Create a Class called CustomerGroup
  - [ ] Access the customer group ID from the Customer database
    - [ ] This is something that we should normally already be able to access.
          If not, then we should edit the query to be able to access it.
  - [ ] Create a new query in the homepage controller that requests the customerGroup database with the matching customer group id.
- [ ] var_dump the information of that customer group
- [ ] Check if the customer group has a parent_id (if statement)
  - [ ] If they have a parent_id, access the customer group of that parent_id
    - [ ] Repeat this until we hit something with parent_id = NULL

Once we have all the customer groups of the user requested customer, var_dump all the customer groups with all their information.
Once we're sure that everything works accordingly, we can finally start on the logic part of the project.
This means that we can start on doing the thing that you'd expect from a price calculator, and we'll calculate some prices!

#### To calculate the price:
- [ ] For the customer group: In case of variable discounts look for highest discount of all the groups the user has.
- [ ] If some groups have fixed discounts, count them all up.
- [ ] Look which discount (fixed or variable) will give the customer the most value. 
- [ ] Now look at the discount of the customer.
- [ ] In case both customer and customer group have a percentage, take the largest percentage.
- [ ] First subtract fixed amounts, then percentages!
- [ ] A price can never be negative.