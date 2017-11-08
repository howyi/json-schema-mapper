# About

[![Build Status](https://travis-ci.org/howyi/json-schema-mapper.svg?branch=master)](https://travis-ci.org/howyi/json-schema-mapper)
[![Coverage Status](https://coveralls.io/repos/github/howyi/json-schema-mapper/badge.svg?branch=master)](https://coveralls.io/github/howyi/json-schema-mapper?branch=master)

Commands and libraries that generate PHP classes that can be acquired from JSONschema with json_encode().

Generate command

```
./vendor/bin/jsm map [jsonDir] [phpDir] [namespace] [templatePath]
```


# example
```
./vendor/bin/jsm map sample/json sample/generated Json
```

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
