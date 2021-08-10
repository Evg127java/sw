
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
Protected routes:<br><hr>
<b>post('/api/logout')</b>  User's logout. Returns inform message <br>
<b>put('/api/people/{id}')</b>  Persons's update. Returns updated person <br>
<b>delete('/api/people/{id}')</b>  Persons's delete. Returns null <br>
