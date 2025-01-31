# Number to Words Calculator

A PHP-based web application that converts numbers into words, currency format, or check writing format with customizable letter casing.

## Features

- **Multiple Conversion Types:**
  - Words: Converts numbers to their word representation
  - Currency: Formats numbers as currency with dollars and cents
  - Check Writing: Formats numbers in check writing style with cents as fractions

- **Letter Case Options:**
  - Lower Case
  - Upper Case
  - Camel Case

- **User Interface:**
  - Clean, modern design
  - Responsive layout
  - Form validation
  - Clear function to reset inputs

## Usage

1. Enter a number in the input field
2. Select the conversion type (Words/Currency/Check Writing)
3. Choose the desired letter case
4. Click "Convert" to see the result
5. Use "Clear" to reset the form

## Examples

### Words Format
Input: 123
Output: one hundred and twenty-three

### Currency Format
Input: 123
Output: one hundred and twenty-three dollars

### Check Writing Format
Input: 123
Output: One hundred and twenty-three and 0/100

## Functions

The application includes several key functions:

- `convertNumbersToWords($number)`: Converts numbers to words
- `convertToCurrency($number)`: Formats numbers as currency
- `convertToCheckWriting($number)`: Formats numbers for check writing


## License

This project is open source and available under the [MIT License](https://opensource.org/licenses/MIT).

## Author

Sok Leaphea
