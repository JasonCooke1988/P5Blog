P5Blog
P5 Blog is a blog for showcasing my journey as a developer. It is the fifth project in my PHP / Symfony developper course with OpenClassrooms.

Installation
Clone the repository.

Use the package manager composer to install the projects dependencies.

composer install
Once installed change the value for 'base.path' (initially http://www.p5blog.com) in config/config.php with your local access path with the public folder on the end (ex: http://localhost/p5blog/public).

Create a database with the name 'p5blog' and import the SQL dump file 'p5blog.sql' found in the root directory.

Check that the values for 'db.host', 'db.user', 'db.pass' & 'db.name' in config/config.php are correct for accessing your database.

#Access admin privileges in the application

To use a user account with admin privileges connect with these credentials :

Email : admin@admin.com
Pass : test

Structure
config

public
⋅⋅1. css
⋅⋅2. gulp
⋅⋅3. img
⋅⋅4. js

scss

src
⋅⋅1. Controller
⋅⋅2. Core
⋅⋅3. Helper
⋅⋅4. Manager
⋅⋅5. Model
⋅⋅6. Service

template
⋅⋅1. mail

vendor
⋅⋅1. composer

License
MIT