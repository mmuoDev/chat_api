
## Backend Chat API

A backend Chat API written in Laravel with these features:

- Users can send and receive messages
- Users are authenticated in order to send and retrieve messages using Laravel Passport
- Uses cache system to increase speed of message retrieval
- Feature tests written to assert users can login, send messages and retrieve messages


## How to use
- Clone project
- Run **composer install**
- Add **.env** file and specify credentials for cache and database (if needed)
- Run **php artisan migrate** for migrations
- Run **php artisan db:seed** to seed users
- Run **php artisan passport:install** for laravel passport
- Test endpoints

## Endpoints

- **Login User** - /api/auth/login [POST]  
 
    Sample body - 
    {
        "username":"john",
        "password":"password"
    }  

- **Send Message** - /api/messages [POST]
    Sample body - 
    {
        "message":"hello world",
        "receiver_username":"john"
    }
    > This endpoint uses bearer token gotten from login endpoint  

- **Retrieve Message** - /api/messages [GET]
    > This endpoint uses bearer token gotten from login endpoint

## Testing

Run the feature test - **vender/bin/phpunit

