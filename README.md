<h2>About the project</h2>
This project gets data from external API and reproduce it like a database with GUI and its own API microservice. 

The project uses the following microservices:
<ul>
<li>Api service based on Laravel framework
<li>User authentication based on VueJS framework
</ul>
<hr>
<br>
<h2>Requirements</h2>
<ul>
<li> PHP:7.4+, MySQL:5.7+
<li> Composer 2.08
<li> Node 14.9.0
<li> npm 7.19.1
</ul>

<h2>Installation for local development</h2>
<ul>
<li>Create database named Laravel in your MySQL
<li>Clone this repository to your local machine
<li>Go to the root directory of the project
<li>Create .env file and edit it according to your configuration
<li>Run php artisan key:generate
<li>Run composer install
<li>Run nmp install && run dev
<li>Run php artisan migrate --seed
<li>Run php artisan serve
<li>Run in a separate terminal: php artisan queue:work
</ul>

<h2>API service</h2>
<b>API routes:</b>

<br>
Public routes:<br><hr>
<b>post('/api/register')</b> User's register. Returns user and token <br>
<b>post('/api/login')</b>  User's login. Returns token <br> 
<b>get('/api/people')</b> Gets all people array<br>
<b>get('/api/people/{id}')</b> Gets one person by specified id<br>
<b>get('/api/homeworlds')</b> Gets all homeworlds array<br>
<b>get('/api/homeworlds/{id}')</b> Gets one homeworld by specified id<br>
<b>get('/api/images')</b> Gets all images array<br>
<b>get('/api/images/{id}')</b> Gets one image by specified id<br>
<b>get('/api/films')</b> Gets all films array<br>
<b>get('/api/films/{id}')</b> Gets one film type by specified id<br>
<br><br>
Protected routes(only for authenticated users):<br><hr>
<b>post('/api/logout')</b>  User's logout. Returns inform message <br>
<b>put('/api/people/{id}')</b>  Persons's update. Returns updated person <br>
<b>delete('/api/people/{id}')</b>  Persons's delete. Returns null <br>
