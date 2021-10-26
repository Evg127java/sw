<h2>About the project</h2>
This project gets data from external API and reproduce it like a database with GUI and its own API microservice. 

The project implements the following microservices:
<ul>
<li>Database service based on Laravel framework 8.0
<li>Api service based on Laravel framework 8.0
</ul>
<br>
<h2>Requirements</h2>
<ul>
<li> PHP:7.4+, MySQL:5.7+
<li> Composer latest
<li> Node latest
<li> npm latest
</ul>
<br>

<h2>Deployment for local development</h2>
<ul>
<li>Create MySQL database named laravel
<li>Make a project folder on your local machine
<li>Clone this repository to the project folder
<li>Go to the project folder
<li>Run <code>cp .env.example .env</code>  and edit <code>.env</code> file according to your configuration:
<ul>
<li>Set environment in DB SECTION
<li>Set environment in MAIL SECTION 
</ul>
<li>Run <code>php artisan key:generate</code>
<li>Run <code>composer install</code>
<li>Run <code>nmp install && run dev</code>
<li>Run <code>php artisan migrate --seed</code>
<li>Run <code>php artisan storage:link</code>
<li>Run <code>php artisan serve</code>
<li>Run <code>php artisan queue:work</code> in a separate terminal 
</ul>
<br>

<h2>API service</h2>

<h6>Public routes:</h6>
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
<br>
<h6>Protected routes(only for authenticated users):</h6>
<b>post('/api/logout')</b>  User's logout. Returns inform message <br>
<b>put('/api/people/{id}')</b>  Persons's update. Returns updated person <br>
<b>delete('/api/people/{id}')</b>  Persons's delete. Returns null <br>
