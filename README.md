# social_insurance_number_validator
Validator for social insurance number in Germany

## Cloning & Installing Repository
- Clone repository
    ```
    git clone https://github.com/vladi-ri/social-insurance-number-validator.git
    ```

- Install package
    ```
    composer create-project vladiri/social_insurance_number_validator
    ```

## Usage
### 1. Generate object of SINValidator - here with example SIN
    <?php $validator = new SINValidator("04 260887 M 08 0"); ?>
### 2. Get SIN from generated object
    <?php $sin       = $validator->getSIN(); ?>
### 3. Call main method of SINValidator
    <?php $validator->validateSocialInsuranceNumber($sin)); ?>

## Current Release
### v1.0
- Validation of example social insurance number, that is statically written into code.

## Future Releases
### v1.1
- Basic Form with input field for social insurance number
- Validation of SIN with social insurance number from user input
