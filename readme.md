

# How to install Empire

Copy Empire to app/

```
app/
    Models/
        (all shared)  Common/ -- This is used by all projects in the Empire
        (some shared) Empire/ -- Cherry picked code from other repos as needed
        (none shared) / -- Only used by this project
```


1. Edit **composer.json**
```json
"files": [
    "app/Common/Helpers/helpers.php"
]
```

2. Add to **app.php** 'aliases'

```php
/*
 * Third Party Aliases
 */
'Breadcrumbs' => App\Common\Libraries\Breadcrumbs::class,
```

3. copy **resources\lang\en\auth.php**

4. copy **routes\Web\Common** and modify **routes\web.php** to include:

```php
/**
 * Common Routes
 */
Route::namespace('Common')->group(function () {
    require base_path('routes/Web/Common/Auth.php');
});
```
