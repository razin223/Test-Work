# Tasks

- Write migrations for the required tables.
- Endpoint to create a "post" for a "particular website".
- Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
- Use of command to send email to the subscribers.
- Use of queues to schedule sending in background.
- No duplicate stories should get sent to subscribers.
- Deploy the code on a public github repository.

## What I did

- In Migration folder 4 tables (```users, websites,posts, subscriptions```), Models at their location with 2 static property (post and subscription) for validation control and relation
- end point will be ```/api/Post/Create``` with ```website_id, title, post, summary, cover_image, email``` field with their proper validation with validation message (at ```Post``` model).
- end pint will be ```/api/Subscription/Create``` with email, website with their proper vaildation and validation message (at ```Subscription``` model). Also checked if already subscribed.
- Written a command to send all user with their proper subscription which will be execute with cron every day at 12.01AM and send all posts of previous day according to their subscribed website using laravel mail and queue. Emailer will be found at ```app/Mail``` directory and used view to generate the html email text which resides at ```/resources/views/Email``` directory
- Everyday the email sending will occur once at 12.01AM at send just previous day posts only. thats why no duplicate story will be sent.

## Create Post API DOC
URL
```sh
/api/Post/Create
```

#### Fields
| Field | Field Type |
|-------|------------|
|email| Email address (abc@xyz.com)|
|title|string, max: 1024|
|post| post (string)|
|summary| string, max: 1024|
|cover_image|image, max: 2MB|
|website_id|id of the website|

Method
```sh
POST
```
Response Header
```200 for success, others for error```


Response Type
```JSON```

Response Example ```Success```
```sh
{
    "status": true,
    "success": "User subscription completed to abc.com."
}
```

Response Example ```Error```
```sh
{
    "error": {
        "website": [
            "You must enter website."
        ]
    }
}

OR

{
    "error": [
        "User already subscribed."
    ]
}
```


## How to use
- Clone the repository
- run composer update
- Run migrations (sorry did not able to make seeds)
- For email sending set email config in env file
