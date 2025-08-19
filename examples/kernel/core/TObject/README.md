# TObject Examples

This directory contains examples demonstrating the usage of the `TObject` class, the foundational class of the **Ascoos OS**, a Web 5.0 OS Kernel designed to serve as the base for unlimited platforms and frameworks.

The `TObject` class provides core functionality for property management, versioning, caching, and debugging, serving as the foundation for all other classes.

## Purpose
These examples illustrate how to use `TObject` methods in real-world scenarios, such as:
- Managing object properties (e.g., `setProperty`, `getProperty`).
- Freezing or locking properties (e.g., `freezeObject`, `isFreezed`, `isLocked`).
- Cloning objects and handling metadata.

## Structure
The examples are organized under the namespace `ASCOOS\OS\Kernel\Core\TObject` for consistency with the Ascoos OS architecture:
- Each example is a standalone PHP file named after the method it demonstrates (e.g., `freezeObject.php`).
- Documentation for the `TObject` class is available at [`/docs/kernel/core/TObject/README.md`](/docs/kernel/core/TObject/README.md).

## Available Examples
| Example File | Method | Description |
|--------------|--------|-------------|
| [`batchUpdateProperties.php`](batchUpdateProperties.php) | `batchUpdateProperties` | Demonstrates batch updating of properties with validation. |
| [`cacheProperties.php`](cacheProperties.php) | `cacheProperties` | Demonstrates caching object properties. |
| [`cloneObject.php`](cloneObject.php) | `cloneObject` | Demonstrates creating a deep clone of a TObject instance. |
| [`cloneProperties.php`](cloneProperties.php) | `cloneProperties` | Demonstrates cloning object properties. |
| [`compareProperties.php`](compareProperties.php) | `compareProperties` | Demonstrates comparing object properties. |
| [`executeBatchOperations.php`](executeBatchOperations.php) | `executeBatchOperations` | Demonstrates executing a series of operations. |
| [`exportToJson.php`](exportToJson.php) | `exportToJson` | Demonstrates exporting a TObject instance to JSON. |
| [`Free.php`](Free.php) | `Free` | Demonstrates freeing an object and its resources. |
| [`FreeProperties.php`](FreeProperties.php) | `FreeProperties` | Demonstrates freeing and resetting all object properties. |
| [`freezeObject.php`](freezeObject.php) | `freezeObject` | Demonstrates freezing an object. |
| [`getChildren.php`](getChildren.php) | `getChildren` | Demonstrates retrieving child classes. |
| [`getClassDeprecated.php`](getClassDeprecated.php) | `getClassDeprecated` | Demonstrates checking if a class is deprecated. |
| [`getClassMetadata.php`](getClassMetadata.php) | `getClassMetadata` | Demonstrates retrieving metadata. |
| [`getClassVersion.php`](getClassVersion.php) | `getClassVersion` | Demonstrates retrieving the class version. |
| [`getDeepProperty.php`](getDeepProperty.php) | `getDeepProperty` | Demonstrates retrieving a nested property. |
| [`getDescendantsTree.php`](getDescendantsTree.php) | `getDescendantsTree` | Demonstrates retrieving a hierarchical tree of descendant classes. |
| [`getParents.php`](getParents.php) | `getParents` | Demonstrates retrieving parent classes. |
| [`getProperty.php`](Properties.php) | `getProperty` | Demonstrates retrieving a property. |
| [`getPropertyMetadata.php`](getPropertyMetadata.php) | `getPropertyMetadata` | Demonstrates retrieving property metadata. |
| [`getPropertySnapshot.php`](getPropertySnapshot.php) | `getPropertySnapshot` | Demonstrates retrieving a snapshot of properties. |
| [`hasProperty.php`](hasProperty.php) | `hasProperty` | Demonstrates checking the existence of a property. |
| [`hasRequiredProperties.php`](hasRequiredProperties.php) | `hasRequiredProperties` | Demonstrates checking for required properties. |
| [`invalidateCache.php`](invalidateCache.php) | `invalidateCache` | Demonstrates invalidating cached properties. |
| [`invokeMethod.php`](invokeMethod.php) | `invokeMethod` | Demonstrates dynamically invoking a method. |
| [`isCallableMethod.php`](isCallableMethod.php) | `isCallableMethod` | Demonstrates checking if a method is callable. |
| [`isExecutable.php`](isExecutable.php) | `isExecutable` | Demonstrates checking if a class is executable. |
| [`isFreezed.php`](isFreezed.php) | `isFreezed` | Demonstrates checking if an object's properties are frozen. |
| [`isLocked.php`](isLocked.php) | `isLocked` | Demonstrates checking if an object's properties are locked. |
| [`isPropertyModified.php`](isPropertyModified.php) | `isPropertyModified` | Demonstrates checking if a property has been modified. |
| [`lockProperties.php`](lockProperties.php) | `lockProperties` | Demonstrates locking object properties. |
| [`mergeProperties.php`](mergeProperties.php) | `mergeProperties` | Demonstrates merging properties with different strategies (`overwrite`, `merge`, `append`). |
| [`Properties.php`](Properties.php) | `setProperty, getProperty` | Demonstrates setting and retrieving properties. |
| [`PropertySnapshot.php`](PropertySnapshot.php) | `getPropertySnapshot, setPropertySnapshot` | Demonstrates creating and retrieving a snapshot of properties. |
| [`propertyValidation.php`](propertyValidation.php) | `propertyValidation` | Demonstrates validating if a property key is a string or integer. |
| [`resetProperties.php`](resetProperties.php) | `resetProperties` | Demonstrates resetting object properties to their initial state. |
| [`restoreFromCache.php`](restoreFromCache.php) | `restoreFromCache` | Demonstrates restoring object properties from cache. |
| [`serializeToArray.php`](serializeToArray.php) | `serializeToArray` | Demonstrates serializing a TObject instance to an array. |
| [`setDeepProperty.php`](setDeepProperty.php) | `setDeepProperty` | Demonstrates setting a nested property. |
| [`setProjectVersion.php`](setProjectVersion.php) | `setProjectVersion` | Demonstrates setting the project version. |
| [`setProperty.php`](setProperty.php) | `setProperty` | Demonstrates setting a new property. |
| [`trackPropertyChanges.php`](trackPropertyChanges.php) | `trackPropertyChanges` | Demonstrates tracking changes to object properties. |
| [`unfreezeObject.php`](unfreezeObject.php) | `unfreezeObject` | Demonstrates unfreezing an object. |
| [`unlockProperties.php`](unlockProperties.php) | `unlockProperties` | Demonstrates unlocking object properties. |
| [`validatePropertyConstraints.php`](validatePropertyConstraints.php) | `validatePropertyConstraints` | Demonstrates validating property constraints. |
| *(More examples to be added)* | | |

## Getting Started
1. Ensure Ascoos OS is installed (see the [main repository](https://github.com/ascoos/os)). If you are using the [`ASCOOS Web Extended Studio (AWES)`](https://github.com/ascoos/awes), then you do not need to install Ascoos OS as it is preloaded.
2. Navigate to the example files in `/examples/kernel/core/TObject/`.
3. Execute the PHP files (e.g., `https://localhost/aos/examples/kernel/core/TObject/freezeObject.php`) to see the output.

## Example Usage
```php
use ASCOOS\OS\Kernel\Core\TObject;

$object = new TObject(['name' => 'TestObject']);
$object->freezeObject();
echo $object->isFreezed() ? "Object is frozen\n" : "Object is not frozen\n";
```

## Resources
- [TObject Documentation](/docs/kernel/core/TObject/)
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [Ascoos OS on LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS on X](https://www.x.com/ascoos)

## Contributing
Want to add more examples? Fork the repository, create a new example file, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
These examples are licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
