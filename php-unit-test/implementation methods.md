# Implementation methods

#### Writing Tests for PHPUnit

## Assertions 

<details><summary>1.Boolean</summary>

#### Boolean Assertions
Here you can write about how to use Boolean assertions in PHPUnit.

```php
$this->assertTrue($condition);
$this->assertFalse($condition);
```
</details>



<details><summary>2.Identity</summary>
Identity Assertions

Here you can write about how to use identity assertions in PHPUnit.

```php

$this->assertSame($expected, $actual);
$this->assertNotSame($expected, $actual);
```
</details>
<details><summary>3.Equality</summary>
Equality Assertions

Here you can write about how to use equality assertions in PHPUnit.

```php

$this->assertEquals($expected, $actual);
$this->assertNotEquals($expected, $actual);
```
</details>
<details><summary>4.Iterable</summary>
Iterable Assertions

Here you can write about how to use iterable assertions in PHPUnit.

```php

$this->assertContains($needle, $haystack);
$this->assertNotContains($needle, $haystack);
```
</details>
<details><summary>5.Objects</summary>
Object Assertions

Here you can write about how to use object assertions in PHPUnit.

```php

$this->assertInstanceOf(ClassName::class, $object);
$this->assertNotInstanceOf(ClassName::class, $object);
```
</details>
<details><summary>6.Cardinality</summary>
Cardinality Assertions

Here you can write about how to use cardinality assertions in PHPUnit.

```php

$this->assertCount($expectedCount, $haystack);
$this->assertNotCount($unexpectedCount, $haystack);
```
</details>
<details><summary>7.Types</summary>
Type Assertions

Here you can write about how to use type assertions in PHPUnit.

```php

$this->assertIsInt($variable);
$this->assertIsString($variable);
```
</details>
<details><summary>8.Strings</summary>
String Assertions

Here you can write about how to use string assertions in PHPUnit.

```php

$this->assertStringContainsString($needle, $haystack);
$this->assertStringNotContainsString($needle, $haystack);
```
</details>
<details><summary>9.JSON</summary>
JSON Assertions

Here you can write about how to use JSON assertions in PHPUnit.

```php

$this->assertJson($jsonString);
$this->assertJsonStringEqualsJsonString($expectedJson, $actualJson);
```
</details>
<details><summary>10.XML</summary>
XML Assertions

Here you can write about how to use XML assertions in PHPUnit.

```php

$this->assertXmlStringEqualsXmlString($expectedXml, $actualXml);
$this->assertXmlStringNotEqualsXmlString($expectedXml, $actualXml);
```
</details>
<details><summary>11.Filesystem</summary>
Filesystem Assertions

Here you can write about how to use filesystem assertions in PHPUnit.

```php

$this->assertFileExists($filename);
$this->assertFileNotExists($filename);
```
</details>
<details><summary>12.Math</summary>
Math Assertions

Here you can write about how to use math assertions in PHPUnit.

```php
$this->assertGreaterThan($expected, $actual);
$this->assertLessThan($expected, $actual);
```
</details>
<details><summary>13.Constraints</summary>
Constraints Assertions

Here you can write about how to use constraints assertions in PHPUnit.

```php

$this->assertThat($value, $constraint);
```
</details>




