### Install {#install}

`composer require howyi/json-schema-mapper:dev-master`

### Command {#command}

JSON Schema directory map to PHP Classes
```bash
./vendor/bin/jsm map [jsonDir] [phpDir] [namespace] [templatePath]
```

*例*
JSON schema directory sample/json to sample/Generated and namespace is `App\Json`
```bash
./vendor/bin/jsm map sample/json sample/generated "App\Json"
```

### About generated classes {#generated}

Source JSON Schema directory
```
sample/json/
  ├ neta.json
  ├ osakanaType.json
  ├ shari.json
  └ sushi.json
```

Generated PHP class directory
```
sample/generated/
  ├ Neta/
  │  ├ Neta.php
  │  ├ NetaInterface.php
  │  └ NetaTrait.php
  ├ Shari/
  │  ├ Shari.php
  │  ├ ShariInterface.php
  │  └ ShariTrait.php
  ├ Sushi/
  │  ├ Sushi.php
  │  ├ SushiInterface.php
  │  └ SushiTrait.php
  └ OsakanaType.php
```

- When JSON Schema implements 'enum', Generated class inherits `Eloquent\Enumeration\AbstractEnumeration`
- When JSON Schema type 'object', Generated class constructer typehinting properties.
  - Those that are not required are nullable type hints, and if you pass null, the key itself is not set.
  - additionalProperties is represented by the last argument and must be passed as an associative array of keys and values.
  - Generated class implements `\JsonSerializable`, `json_encode()` can convert to Json that JSON Schema expects.
  - Generated class is in the form divided into three class, interface, trait.


### annotation {#annnotation}
- When you want to set null
  - set constructer to `\JsonSchemaMapper\ExistsNull`
