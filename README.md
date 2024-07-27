## Laravel BlogApplication

This is a BlogApplication, RESTful API made using Laravel where the users are allowed to store, update, delete, view posts along with the ability to search and filter. Some features are as follows:

-   Authentication functionality using Laravel's [Sanctum](https://laravel.com/docs/11.x/sanctum#main-content) for Token-Based API authentication.
-   Role-based access control using Spatie [laravel-permission package](https://spatie.be/docs/laravel-permission/v6/basic-usage/middleware).
-   API endpoint for CRUD operation of Users, Posts, Categories, Tags and Comments.
-   Polymorphic relationships between users and posts, and posts and tags.
-   search feature using [Laravel-query-builder](https://spatie.be/docs/laravel-query-builder/v5/introduction)
-   Used Middleware, Roles-permissions and Policies for restrictions.

## Installation Steps

Follow this instructions to install the project on your machine:

1. Clone this repo.
    ```bash
     git clone https://github.com/AyushMahatara/BlogApplication.git
    ```
2. `cd BlogApplication`
3. `composer install`
4. `copy and paste .env.example`
5. `rename the copied file '.env copy.example' to '.env'`
6. `php artisan key:generate`
7. Set **database config** on `.env` file `optional`
8. `php artisan migrate --seed`
9. `php artisan serve`
10. Open postman and hit the url.

#### Note: While you seed in the database two categories and tags with one admin is created.

### Authentication URL

-   For login `http://127.0.0.1:8000/api/auth/login`

    1. Provide admin credentials i.e., email `admin@gmail.com` and password `password`
    2. Token will be provided use it for performing all the task.

-   For register `http://127.0.0.1:8000/api/auth/register`

    1. Provide name, email and password.
    2. Token will be provided use it for performing all the task.
    3. You be be assigned as author.

-   To logout `http://127.0.0.1:8000/api/auth/logout`

#### Restrictions:

-   User can perform CRUD operations for only Posts and Comments that they created.
-   User who created post can delete any comment on his/her posts.
-   Admin are also bound with this two points but admin is the one who can CRUD Category and Tags.

#### Note: use method GET in index, POST in store and update, PUT or PATCH in update, DELETE in delete

### Post URL

-   For post index `http://127.0.0.1:8000/api/posts`
-   For post store `http://127.0.0.1:8000/api/posts`

```bash
for storing post
 {
 "title": "post title",
 "description": "post description",
 "category_id": 1,
 "tags": [1,2]
 }
```

-   For post show `http://127.0.0.1:8000/api/posts/{id}`
-   For post update `http://127.0.0.1:8000/api/posts/{id}`
-   For post delete `http://127.0.0.1:8000/api/posts/{id}`

### Category URL

-   For category index `http://127.0.0.1:8000/api/category`
-   For category store `http://127.0.0.1:8000/api/category`

```bash
for storing category
 {
"name": "name"
 }
```

-   For category show `http://127.0.0.1:8000/api/category/{id}`
-   For category update `http://127.0.0.1:8000/api/category/{id}`
-   For category delete `http://127.0.0.1:8000/api/category/{id}`

### Tags URL

-   For tags index `http://127.0.0.1:8000/api/tags`
-   For tags store `http://127.0.0.1:8000/api/tags`

```bash
for storing tags
 {
"name": "name"
 }
```

-   For tags show `http://127.0.0.1:8000/api/tags/{id}`
-   For tags update `http://127.0.0.1:8000/api/tags/{id}`
-   For tags delete `http://127.0.0.1:8000/api/tags/{id}`

### User URL

-   For user index `http://127.0.0.1:8000/api/users`
-   For user store `http://127.0.0.1:8000/api/users`

```bash
for storing user
 {
   "name": "user name",
    "email": "example@gmail.com",
    "password": "password"
 }
```

-   For user show `http://127.0.0.1:8000/api/users/{id}`
-   For user update `http://127.0.0.1:8000/api/users/{id}`
-   For user delete `http://127.0.0.1:8000/api/users/{id}`

### Comment URL

-   For comment store `http://127.0.0.1:8000/api/posts/{post}/comments`
-   For comment show `http://127.0.0.1:8000/api/comment/{id}`

```bash
for storing comment
 {
 "feedback": "comment by 28"
 }
```

-   For comment update `http://127.0.0.1:8000/api/comment/{id}`
-   For comment delete `http://127.0.0.1:8000/api/comment/{id}`

### Filtering Post

-   `http://127.0.0.1:8000/api/posts?filter[title]=&filter[category.name]=&filter[tags.name]=&filter[user.name]=
`
-   For filtering according to Post Title `filter[title]=`
-   For filtering according to Category Name `filter[category.name]=`
-   For filtering according to Tags Name `filter[tags.name]=`
-   For filtering according to User Name `filter[user.name]=`
