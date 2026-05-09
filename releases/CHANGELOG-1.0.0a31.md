# ASCOOS OS - Changelog for 1.0.0a31

Date: **2026-05-10 07:00:00**

Build: **17777**

State: **Alpha-31**


---

## Classes

### **TChangelogHandler**

Unified handler that generates both HTML and Markdown changelog output from the ASCOOS OS changelog.json format.

**Changes:**

- Added new methods (Initial)

**Methods:**

- **`__construct()`** : Loads changelog.json and release.json, validates them, and initializes TObject.
- **`findReleaseByBuild()`** : Searches the loaded releases and returns the one whose version list includes the given build.
- **`generateHtml()`** : Generates a complete HTML changelog document.
- **`generateMarkdown()`** : Generates a complete Markdown changelog document.
- **`getChangelogSection()`** : Returns the changelog entry that corresponds to the given key, or null if not found.
- **`loadJson()`** : Reads a JSON file, decodes it and ensures the result is a valid array.
- **`methodAnchorId()`** : Normalizes method names and combines them with the parent section ID to form valid HTML anchors.
- **`stateToChangelogKey()`** : Maps human-readable version states to internal changelog identifiers, supporting dynamic version prefixes.


---

### **TMechanicHandler**

TMechanicHandler provides a focused set of mechanics-related computations on top of the generic physics and math handlers. It encapsulates common formulas for stress, strain, elasticity, energy and machine performance.

**Changes:**

- Added new methods (Initial)

**Methods:**

- **`__construct()`** : Constructor for initializing the mechanics handler.
- **`getInstance()`** : Returns the singleton instance of TMechanicHandler.
- **`bulk_modulus()`** : Computes the bulk modulus K from Young’s modulus E and Poisson’s ratio ν.
- **`efficiency()`** : Calculates mechanical efficiency as a percentage.
- **`force_from_stress()`** : Calculates force from stress and cross-sectional area.
- **`hooke_energy()`** : Computes total elastic strain energy.
- **`hooke_strain()`** : Computes normal strain ε from stress and Young's modulus.
- **`hooke_stress()`** : Computes normal stress σ using Hooke's law.
- **`kinetic_energy`** : Calculates kinetic energy of a moving body.
- **`mechanical_advantage()`** : Calculates the mechanical advantage of a machine.
- **`normal_strain()`** : Calculates normal strain from final and original length.
- **`poisson_ratio()`** : Computes Poisson’s ratio from lateral and longitudinal strain.
- **`shear_modulus()`** : Computes shear modulus G from Young’s modulus E and Poisson’s ratio ν.
- **`shear_strain`** : Calculates shear strain from an angle in radians.
- **`stress()`** : Calculates normal stress from force and cross-sectional area.
- **`young_modulus()`** : Calculates Young's modulus (E) from stress and strain.


---

### **TUnitsConverterHandler**

The TUnitsConverterHandler class is an optional ASCOOS OS component that provides a centralized conversion engine for mathematical and physical units. All unit definitions are stored externally (PHP/JSON) and loaded lazily during runtime.

The handler supports:
	- Factor-based conversions (length, weight, volume, area, speed, energy, pressure, power)
	- Formula-based conversions (temperature: C, F, K)
	- Metadata access (categories, units)
	- Validation utilities
	- Normalization utilities

 It follows the ASCOOS OS deterministic design principles and integrates with the TObject lifecycle, including Free() cleanup.

**Changes:**

- Added new methods (Initial)

**Methods:**

- **`__construct()`** : Initializes the class with an array of optional properties.
- **`getInstance()`** : Returns the singleton instance of the handler, creating it if necessary.
- **`autoUnit()`** : Automatically selects the most appropriate unit for a given value within a category.
- **`convert()`** : Converts a value between two units within the same measurement category.
- **`convertTemperature()`** : Converts a temperature value between Celsius, Fahrenheit, and Kelvin.
- **`formatAuto()`** : Automatically selects the best unit for a value and formats it into a readable string.
- **`formatAutoComparison()`** : Automatically selects the best unit for two values and formats a comparison expression.
- **`formatAutoList()`** : Automatically selects the best unit for a list of values and formats them into a readable comma-separated string.
- **`formatAutoRange()`** : Automatically selects the best unit for a numeric range and formats it into a readable string.
- **`formatAutoTable()`** : Automatically selects the best unit for a table of values and formats them into an HTML table.
- **`formatComparison()`** : Formats a comparison expression between two numeric values using a shared unit.
- **`formatList()`** : Formats an array of numeric values using a shared unit into a comma-separated string.
- **`formatRange()`** : Formats a numeric start–end range together with a unit into a readable string.
- **`formatTable()`** : Formats a list or matrix of numeric values into an HTML table using a shared unit.
- **`formatValue()`** : Formats a numeric value together with its unit into a human-readable string.
- **`getCategories()`** : Returns all available measurement categories loaded from the external units data file.
- **`getUnits()`** : Returns all units defined under a specific measurement category.
- **`hasUnit()`** : Checks whether a specific unit exists within a given measurement category.
- **`loadAliases()`** : Loads unit alias definitions from the external alias configuration file.
- **`loadUnits()`** : Loads unit definitions from the external configuration file into the handler.
- **`normalizeUnit()`** : Normalizes a unit identifier to a canonical internal representation.
- **`registerAlias()`** : Registers a new alias and maps it to a canonical unit identifier.
- **`registerUnit()`** : Registers a new unit in an existing measurement category at runtime.
- **`resolveAlias()`** : Resolves alternative unit names (aliases) to their canonical unit identifiers.
- **`validate()`** : Validates whether a category and two units are defined in the units data file.


---
