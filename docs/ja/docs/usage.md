### インストール {#install}

`composer require howyi/json-schema-mapper:dev-master`

### コマンド {#command}

JSON SchemaのディレクトリをPHPのディレクトリにマッピングするコマンド
```bash
./vendor/bin/jsm map [jsonDir] [phpDir] [namespace] [templatePath]
```

*例*
sample/jsonディレクトリをsample/Generatedディレクトリ内にPHPクラス化し、ネームスペースは App\Json とする場合
```bash
./vendor/bin/jsm map sample/json sample/generated "App\Json"
```

### 生成されるクラスについて {#generated}

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

- enumが指定されているものは `Eloquent\Enumeration\AbstractEnumeration` を継承したenumクラスを生成する
- objectの場合、各プロパティに沿ったタイプヒントを行ったクラスを生成する
- コンストラクタの引数はプロパティと同じとなる。
  - requiredでないものはnullableタイプヒントとなり、nullを渡した場合はキーそのものがセットされない。
  - additionalPropertiesは最後尾の引数によって表現され、キーと値の連想配列で渡す必要がある。
  - 生成されたobjectクラスは、`\JsonSerializable` が予め実装されているため、`json_encode()` で JSON Schemaが期待するJsonへの変換が行えるようになっている
  - objectクラスは class, interface, trait の３つに分割された形で生成される。
  - classを使わずに、別のクラスにinterface, traitを実装することで、そのクラスを `\JsonSerializable` とすることが可能


### 注釈 {#annnotation}
- nullをセットしたい場合
  - `\JsonSchemaMapper\ExistsNull` という空のクラスを渡すことでnullをセットすることが出来る
