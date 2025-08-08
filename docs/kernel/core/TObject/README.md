# Class `TObject`

***The base class for all Ascoos OS classes, providing versioning and debugging utilities.***

> #### Extends `stdClass`
> #### Implements `TCoreHandler`, `Stringable`

## Usage
```php
use ASCOOS\OS\Kernel\Core\TObject;

class TNameClass extends TObject {
    // Custom implementation
}
```

See `/examples/kernel/core/TObject/example1.php`.

## Detailed Documentation
For full details (parameters, types, examples), visit the [Official Documentation Site](https://docs.ascoos.com) (under construction).

---

## Properties
| Property | Type | Description |
|----------|------|-------------|
| `properties` | Array | Public array storing class properties dynamically. |

### Keys of `properties`
| Key | Type | Description |
|-----|------|-------------|
| `deprecated` | Boolean | Indicates if the class is deprecated (default: `false`). |
| `deprecatedAtAscoosVersion` | Integer | Version when deprecated (-1 if not). |
| `removedAtVersion` | Integer | Version for removal (-1 if not). |
| `version` | Integer | Class version (e.g., 2400070000). |
| `MinAscoosVersion` | Integer | Minimum Ascoos version (e.g., 2400070000). |
| `MaxAscoosVersion` | Integer | Maximum Ascoos version (-1 if unlimited). |
| `MinPHPVersion` | Integer | Minimum PHP version (e.g., 80200 for 8.2.0). |
| `MaxPHPVersion` | Integer | Maximum PHP version (-1 if unlimited). |
| `ProjectVersion` | Integer | Product version (-1 if unset). |

## Constants
| Constant | Value | Description |
|----------|-------|-------------|
| `DEBUG_LEVEL_INFO` | `INFO` | Debug level for informational messages. |
| `DEBUG_LEVEL_WARNING` | `WARNING` | Debug level for warnings. |
| `DEBUG_LEVEL_ERROR` | `ERROR` | Debug level for errors. |

## Methods
```php
void __construct(array $properties=[])                          // Initializes the class. Must be called by child classes.
string __toString()                                             // Returns the class name as a string.
bool Free(object $object)                                       // Frees memory of the object or its clone.
bool FreeProperties(object $object)                             // Deletes and frees memory for all class properties.
array getChildren(object|string|null $object_or_class = null)   // Returns child classes of the given class or object.
bool getClassDeprecated()                                       // Returns true if class is deprecated, otherwise false.
int getClassVersion()                                           // Returns the class version.
mixed getDeepProperty(array $keys, ?array $array = null)        // Gets a property at any depth in the properties array.
array getDescendantsTree(object|string|null $object_or_class = null) // Returns a tree of all descendants of the given class or object.
array|false getParents(object|string|null $object_or_class = null, bool $autoload = true) // Returns parent classes of the given class or object.
array getProperties()                                           // Returns the class properties array.
mixed getProperty(string $property)                             // Returns the content of the requested property.
?array getPublicProperties()                                    // Returns an array of public properties.
int|false getVersion(string $property)                          // Gets the version as an integer.
string|false getVersionStr(string $property)                    // Gets the version as a formatted string.
bool isExecutable(int $currentVersion, int $currentPHPVersion)  // Checks if the class version is executable based on specified versions.
void setDeepProperty(array $keys, mixed $value, ?array &$array = null) // Sets a property at any depth in the properties array.
void setProjectVersion(int|string $version = -1)                // Sets the project version.
bool setProperties(array $properties, string|int|null $property_key = null) // Recursively sets properties, merging sub-arrays.
bool setProperty(string|int $property, mixed $value, string|int|null $property_key = null) // Sets a single property.
```

---

<details>
<summary>🟠 INHERITANCES</summary>

Inherits `__toString` from `stdClass`, overridden to return the class name. Implements `TCoreHandler` for core functionality and `Stringable` for string conversion.

</details>

---

## Links
- [Kernel Classes](/docs/kernel/CLASS.md)
- [Report Issues](https://issues.ascoos.com)
