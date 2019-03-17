Nice Dump Helper
======
Simple Function to dump variables to the screen, in a nicley formatted manner. You can use this small function to dump your data in nicley formatted manner instead of using default var_dump or print_r functions.

Working Demo
------
[Demo](https://demo.forward-web.com/nice-dump)

Getting started
------
First you need to include the helper file in your project
```php
require_once ('nice_dump/nice_dump.php');
```

Examples
------
Here we have an array of data and we need to dump it
```php
# array of products
$products = array(
  array(
    'id'      => 1,
    'name'    => 'Test Product 1',
    'desc'    => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.',
    'price'   => '75.00',
    'status'  => 1,
    'category => 1,
    'created' => '2019-03-17 06:25:00'
  ),
  array(
    'id'      => 2,
    'name'    => 'Test Product 2',
    'desc'    => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.',
    'price'   => '50.00',
    'status'  => 1,
    'category => 3,
    'created' => '2019-03-17 06:25:05'
  ),
  array(
    'id'      => 3,
    'name'    => 'Test Product 3',
    'desc'    => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.',
    'price'   => '90.50',
    'status'  => 0,
    'category => 2,
    'created' => '2019-03-17 06:27:12'
  )
};
```
### Simple usage
```php
nice_dump($products);
```
![Default Preview](https://forward-web.com/uploads/default.png)

### Usage with custom options
```php
# define your options in array
$options = array('return' => 'echo', 'label' => 'Products list');

# call the function with your custom options
nice_dump($products, $options);
```
![Default Preview](https://forward-web.com/uploads/custom.png)

### Available Options
| Option Name        | Type            | Accepted values  | Default Value   |
| ------------------ |-----------------|------------------|---------------- |
| labe               | String          | Any text         | Dump Data       |
| json               | Boolean         | TRUE - FALSE     | FALSE           |
| return             | string          | echo - return    | echo            |
| color              | string          | HEX color        | #aaa            |
| bg_color           | string          | HEX color        | #222            |

> The function will render HTML **div tag** with toggle button using jQuery. if jQuery is not defined it will dynamically load the included jQuery file.
