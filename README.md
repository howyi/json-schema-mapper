# json-schema-mapper (jsm)
Json-Schema Object|Enum to PHP classes

```php
$loader = new \Twig_Loader_Filesystem('templates');
$twig = new \Twig_Environment($loader);

$allFiles = FileFactory::fromAllSchemaList(
    $twig,
    'sample/generated',
    SchemaDirFactory::fromDir('sample/json', 'Json')
);

FileReflector::reflect($allFiles);
```
