# Starting Project
> `composer install`
## How to Start using the API
> Make your .env file using the .env.example file.
> Migrate the database using `php artisan migrate`
### Avaliable routes
| VERB     | ROUTE                          | Required Fields                                              | Nullable Fields      | Return             | Action                           |
|----------|--------------------------------|--------------------------------------------------------------|----------------------|--------------------|----------------------------------|
| **POST** | `/api/register`                | **string**: name, **string**: email, **string**: password, **string**: document | **boolean**: is_retailer | User Data          | Register new User                |
| **POST** | `/api/authenticate`            | **string**: email, **string**: password                               |                      | Sanctum Token      | Authenticate as User             |
| **POST** | `/api/transactions/{payee_id}` | **integer**: value                                               |                      | User's new Balance | Make a Transaction Between Users |
