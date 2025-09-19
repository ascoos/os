# Orbital Simulation of a Satellite Around Earth

This case study demonstrates how **Ascoos OS** can simulate a satellite in circular orbit around Earth.  
It calculates key physical quantities and stores the results in JSON, while also generating visual output.

## Purpose
- Calculate orbital velocity
- Compute kinetic and potential energy
- Generate chart with computed values
- Log completion event
- Save report in JSON format

## Core Ascoos OS Classes
- **TPhysicsHandler**  
  Performs physics calculations (velocity, energy, etc.)  
- **TArrayGraphHandler**  
  Generates chart from computed values  
- **TEventHandler**  
  Logs system events  
- **TErrorMessageHandler**  
  Handles exceptions and error messages  

## File Structure
The implementation is contained in a single PHP file:
- [`orbital_simulation.php`](orbital_simulation.php)

It includes all logic: calculations, visualization, logging, and data export.

## Requirements
1. PHP ≥ 8.2  
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)

## Execution Flow
1. Define physical parameters (mass, radius, gravitational constant).
2. Calculate orbital velocity using: `v = √(GM / r)`
3. Compute kinetic energy: `K = ½ m v²`
4. Compute potential energy: `U = -GMm / r`
5. Generate chart with values
6. Log completion event
7. Save JSON report
8. Output summary to console

## Code Example
```php
$orbitalVelocity = $physicsHandler->OrbitalVelocity($G, $earthMass, $orbitalRadius);
$kineticEnergy = $physicsHandler->KineticEnergy($satelliteMass, $orbitalVelocity);
$potentialEnergy = -$G * $earthMass * $satelliteMass / $orbitalRadius;

$graphHandler->setArray([
    ['label' => 'Orbital Velocity (m/s)', 'value' => $orbitalVelocity],
    ['label' => 'Kinetic Energy (J)', 'value' => $kineticEnergy],
    ['label' => 'Potential Energy (J)', 'value' => $potentialEnergy]
], ['label', 'value']);
$graphHandler->createLineChart($outputPath . '/orbital_simulation.png');
```

## Expected Output
```
Orbital Simulation Complete.
Orbital Velocity: 7672.598648 m/s
Kinetic Energy: 29440800000 J
Potential Energy: -58881600000 J
```

## Resources
- [Ascoos OS Documentation](/docs/)  
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
You can extend the simulation to include elliptical orbits, variable mass, or multi-body interactions.  
See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is covered under the Ascoos General License (AGL).  
See [LICENSE.md](/LICENSE.md).
