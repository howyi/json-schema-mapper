# 概要

[![Build Status](https://travis-ci.org/howyi/json-schema-mapper.svg?branch=master)](https://travis-ci.org/howyi/json-schema-mapper)
[![Coverage Status](https://coveralls.io/repos/github/howyi/json-schema-mapper/badge.svg?branch=master)](https://coveralls.io/github/howyi/json-schema-mapper?branch=master)

JSONschemaから生成され得るJSONをjson_encode()で取得可能なPHPクラスを生成するコマンドとライブラリ

生成コマンド

```
./vendor/bin/jsm map [jsonDir] [phpDir] [namespace] [templatePath]
```


# 例
```
./vendor/bin/jsm map sample/json sample/generated Json
```

元となるJSON Schemaのディレクトリ構造
```
sample/json/
  ├ neta.json
  ├ osakanaType.json
  ├ shari.json
  └ sushi.json
```

生成されるPHPのディレクトリ構造
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
