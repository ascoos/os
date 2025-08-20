# Class `TObject`

***The base class for all Ascoos OS classes, providing versioning and debugging utilities.***

> #### Implements `TCoreHandler`, `Stringable`

## Usage
```php
use ASCOOS\OS\Kernel\Core\TObject;

class TNameClass extends TObject {
    // Custom implementation
}
```

See [Examples](https://github.com/ascoos/os/blob/main/examples/kernel/core/TObject/README.md).

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
| Methods               | Returns   | Description                                                              |
|-----------------------|-----------|--------------------------------------------------------------------------|
| `__construct`         | `void`    | Initialize the class. It must be called by the offspring if the classes are initialized. |
| `batchUpdateProperties` | `bool`    | Updates multiple properties in a batch, optionally validating constraints before updating. |
| `cacheProperties`     | `bool`    | Caches the object's properties to a specified storage (file or memory) for quick retrieval. |
| `cloneObject`         | `object`  | Creates a deep clone of the object, preserving all properties.          |
| `cloneProperties`     | `array`   | Creates a copy of the object's properties, excluding protected metadata. |
| `compareProperties`   | `array`   | Compares current properties with a snapshot or provided array, returning differences. |
| `executeBatchOperations` | `bool` | Executes a batch of operations (methods or callables) with optional rollback on failure. |
| `exportToJson`        | `string`  | Exports the object to a JSON string, including properties and optional metadata. |
| `freezeObject`        | `bool`    | Temporarily freezes the object, preventing modifications to its properties until unfrozen. |
| `getChildren`         | `array`   | Returns the child classes of the given class or object.                 |
| `getClassDeprecated`  | `bool`    | Returns true if class is deprecated, otherwise false.                   |
| `getClassMetadata`    | `array`   | Returns metadata about the object for debugging, introspection, or data processing. |
| `getClassVersion`     | `int`     | Returns the version of the class.                                       |
| `getDeepProperty`     | `mixed`   | Gets a property at any depth within the properties array.               |
| `getDescendantsTree`  | `array`   | Returns a tree array of all descendants of the given class or object.   |
| `getParents`          | `array` or `false` | Returns the parent classes of the given class or object.                |
| `getProperties`       | `array`   | Returns the table of class properties, excluding protected metadata.    |
| `getProperty`         | `mixed`   | Returns the content of the requested property, supporting nested properties. |
| `getPropertyMetadata` | `?array`  | Retrieves metadata for a specific property, including type, value, and change history if tracked. |
| `getPropertySnapshot` | `array` or `false` | Returns a snapshot of the current properties for later comparison or restoration. |
| `getPublicProperties` | `?array`  | Returns an array of the public properties of the class.                 |
| `getVersion`          | `int` or `false` | Gets the version as an integer.                                         |
| `getVersionStr`       | `string` or `false` | Gets the version as a formatted string.                                 |
| `hasMethod`           | `bool`    | Checks if a method exists in the class or its parents.                  |
| `hasProperty`         | `bool`    | Checks if a property exists in the class or its properties array.       |
| `hasRequiredProperties` | `bool` | Checks if all required properties exist and optionally verifies they are non-empty. |
| `invokeMethod`        | `mixed`   | Dynamically invokes a method on the class with the given arguments.     |
| `isCallableMethod`    | `bool`    | Checks if a method is callable on the object.                           |
| `isExecutable`        | `bool`    | Checks whether the current version of the class is executable according to the minimum and maximum versions specified. |
| `isFreezed`           | `bool`    | Checks if the class properties are frozen.                              |
| `isLocked`            | `bool`    | Checks if the class properties are locked.                              |
| `isPropertyModified`  | `bool`    | Checks if a specific property has been modified based on change history. |
| `lockProperties`      | `bool`    | Locks the object's properties to prevent further modifications.         |
| `mergeProperties`     | `bool`    | Merges an external properties array with the existing properties array, supporting different merge strategies. |
| `propertyValidation`  | `bool`    | Validates if property is string or integer.                             |
| `resetProperties`     | `bool`    | Resets the object's properties to their initial state or a provided array. |
| `restoreFromCache`    | `bool`    | Restores the object's properties from a cache (file or memory).         |
| `serializeToArray`    | `array`   | Serializes the object into an array, including properties and metadata. |
| `setDeepProperty`     | `void`    | Sets a property at any depth within the properties array.               |
| `setProjectVersion`   | `void`    | Sets the project version.                                               |
| `setProperties`       | `bool`    | Recursively sets properties of the class, merging sub-arrays without overwriting other data. |
| `setProperty`         | `bool`    | Sets a single property of the class, respecting locked and frozen states. |
| `setPropertySnapshot` | `bool`    | Creates a snapshot of the current properties for later comparison or restoration. |
| `trackPropertyChanges` | `bool` | Tracks changes to the object's properties, storing a history of modifications. |
| `unfreezeObject`      | `bool`    | Unfreezes the object, allowing modifications to its properties.         |
| `unlockProperties`    | `bool`    | Unlocks the object's properties to allow further modifications.         |
| `validatePropertyConstraints` | `bool` | Validates object properties against specified constraints (e.g., type, range). |
| `__toString`          | `string`  | Returns a string containing the name of this class.                     |
| `Free`                | `bool`    | Frees the memory of the Object or its clone.                            |
| `FreeProperties`      | `bool`    | Deletes and frees up memory for all class properties.                   |


---

<details>
<summary>🟠 INHERITANCES</summary>

Inherits `__toString` from `TCoreHandler`, overridden to return the class name. 

Implements `TCoreHandler` for core functionality and `Stringable` for string conversion.

</details>

---

## Links
- [Kernel Classes](/docs/kernel/CLASS.md)
- [Report Issues](https://issues.ascoos.com)

