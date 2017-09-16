scatchbling
===========

A Symfony project created on September 15, 2017, 9:34 pm.

# API Documentation


## Read
Using HTTP GET

- List all the backscratcher: **/api/backscratcher**
    - i.e.: http://projectscatchbling.herokuapp.com/api/backscratcher
 
- List only one, using id: **/api/backscratcher/{id}**
  - i.e.: http://projectscatchbling.herokuapp.com/api/backscratcher/1

## Create
Using HTTP POST
 - use the url: **/api/backscratcher** and send the backscratcher attributes by POST: name, description, sice and price
 - i.e.: http://projectscatchbling.herokuapp.com/api/backscratcher
 
## Delete
Using HTTP DELETE
 
- use the url with id: **/api/backscratcher/{id}**
  - i.e.: http://projectscatchbling.herokuapp.com/api/backscratcher/1


## Update
Using HTTP PUT
 - use the url: **/api/backscratcher/{id}** and send the backscratcher attributes: name, description, sice and price
 - i.e.: http://projectscatchbling.herokuapp.com/api/backscratcher/1
 
