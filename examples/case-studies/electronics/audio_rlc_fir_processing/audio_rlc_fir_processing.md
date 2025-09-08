# Signal Design and Processing with RLC Band-Pass Filter and Digital FIR Filter

This case study demonstrates how **Ascoos OS** can be used to design an analog RLC band-pass filter, apply a digital FIR filter to an audio signal, generate a SPICE netlist for simulation, and process the audio with trimming, normalization, and fade effects. Additionally, a frequency response graph is generated.

## Purpose
The example utilizes the following Ascoos OS classes:
- **TElectronicsHandler**: Calculates RLC filter parameters and impedance.
- **TCircuitHandler**: Generates SPICE netlist for simulation.
- **TDigitalCircuitHandler**: Designs FIR filter and analyzes frequency response.
- **TAudioHandler**: Processes audio (trimming, normalization, fade-in/out).
- **TValidationHandler**: Validates filter parameters.
- **TEventHandler**: Logs processing events.
- **TErrorMessageHandler**: Handles errors and exceptions.
- **TArrayGraphHandler**: Generates frequency response graphs.

## Structure
The study is implemented in a single PHP file:
- [`audio_rlc_fir_processing.php`](./audio_rlc_fir_processing.php): Includes RLC filter design, digital audio processing, analysis, and report generation.

## Requirements
1. Installation of Ascoos OS ([main repository](https://github.com/ascoos/os)).
2. Access to a WAV audio file (e.g., `input_audio.wav`) in `$AOS_TMP_DATA_PATH`.
3. Write permissions for `$AOS_LOGS_PATH` and `$AOS_TMP_DATA_PATH/reports/audio_rlc_fir/`.
4. Installed font (e.g., Murecho) for graph rendering.

## Getting Started
1. Place a WAV file in `$AOS_TMP_DATA_PATH`.
2. Run the script via web server:
   ```
   https://localhost/aos/examples/case-studies/electronics/audio_rlc_fir_processing/audio_rlc_fir_processing.php
   ```

## Usage Example
```php
$electronicsHandler = new TElectronicsHandler();
$centerFrequency = 1000; // Hz
$resistance = 1000; // 1 kΩ
$inductance = 0.1; // 100 mH
$capacitance = 1 / (4 * pi() * pi() * $inductance * $centerFrequency * $centerFrequency);
$bandpassGain = $electronicsHandler->bandpassFilterGain($centerFrequency, $resistance, $inductance, $capacitance);

$digitalHandler = new TDigitalCircuitHandler();
$firCoefficients = [0.25, 0.5, 0.25];
$signal = $audioHandler->readWavFile("input_audio.wav");
$filteredSignal = $digitalHandler->applyFIRFilter($firCoefficients, $signal);

$audioHandler = new TAudioHandler();
$trimmedSignal = $audioHandler->trimSignal($filteredSignal, 1.0, 9.0, 44100);
$signalWithFade = $audioHandler->fadeIn($trimmedSignal, 44100 * 0.5);
$signalWithFade = $audioHandler->fadeOut($signalWithFade, 44100 * 0.5);
$normalizedSignal = $audioHandler->normalizeSignal($signalWithFade, 0.9);
$audioHandler->writeWavFile($normalizedSignal, 44100, "processed_audio.wav");
```

## Expected Output
The script generates:
- A SPICE netlist file (`rlc_filter.sp`)
- A frequency response graph of the FIR filter (`fir_frequency_response.png`)
- A processed WAV file (`processed_audio.wav`)
- A JSON report file (`audio_rlc_fir_report.json`):
```json
{
    "rlc_filter": {
        "center_frequency": 1000,
        "resistance": 1000,
        "inductance": 0.1,
        "capacitance": 2.533e-5,
        "gain_at_center": 0.707
    },
    "fir_filter": {
        "coefficients": [0.25, 0.5, 0.25]
    },
    "signal_stats": {
        "samples": 352800,
        "duration": 8
    }
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contribution
Want to contribute to this case study? Fork the repository, modify or add new features to `audio_rlc_fir_processing.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is covered under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md) for details.
