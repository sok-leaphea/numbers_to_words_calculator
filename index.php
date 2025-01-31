<?php
if (isset($_POST['number']) && isset($_POST['convert-to']) && isset($_POST['letter-case'])) {
    $number = (int)$_POST['number'];
    $type = $_POST['convert-to'];
    $letterCase = $_POST['letter-case'];

    switch ($type) {
        case 'words':
            $result = convertNumbersToWords($number);
            break;
        case 'currency':
            $result = convertToCurrency($number);
            break;
        case 'check-writing':
            $result = convertToCheckWriting($number);
            break;
        default:
            $result = convertNumbersToWords($number);
    }

    switch ($letterCase) {
        case 'upper-case':
            $result = strtoupper($result);
            break;
        case 'lower-case':
            $result = strtolower($result);
            break;
        case 'camel-case':
            $result = ucwords(strtolower($result));
            break;
    }
}

function convertToCurrency($number)
{
    $result = convertNumbersToWords(floor($number));
    $cents = round(($number - floor($number)) * 100);

    if ($cents > 0) {
        $result .= ' dollars and ' . convertNumbersToWords($cents) . ' cents';
    } else {
        $result .= ' dollars';
    }

    return $result;
}

function convertToCheckWriting($number)
{
    $result = convertNumbersToWords(floor($number));
    $cents = round(($number - floor($number)) * 100);

    $result = ucfirst($result) . ' and ' . str_pad($cents, 2, '0', STR_PAD_LEFT) . '/100';
    return $result;
}

function convertNumbersToWords($number)
{
    $ones = [
        0 => '',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen'
    ];

    $tens = [
        2 => 'twenty',
        3 => 'thirty',
        4 => 'forty',
        5 => 'fifty',
        6 => 'sixty',
        7 => 'seventy',
        8 => 'eighty',
        9 => 'ninety'
    ];

    $scales = [
        '',
        'thousand',
        'million',
        'billion',
        'trillion',
        'quadrillion'
    ];

    if ($number === 0) {
        return 'zero';
    }

    if ($number < 0) {
        return 'negative ' . convertNumbersToWords(abs($number));
    }

    $words = '';
    $scaleCount = 0;

    while ($number > 0) {
        $chunk = $number % 1000;
        if ($chunk != 0) {
            $chunkWords = '';

            if ($chunk >= 100) {
                $chunkWords .= $ones[floor($chunk / 100)] . ' hundred ';
                $chunk %= 100;
            }

            if ($chunk > 0) {
                if ($chunkWords !== '') {
                    $chunkWords .= 'and ';
                }

                if ($chunk < 20) {
                    $chunkWords .= $ones[$chunk];
                } else {
                    $chunkWords .= $tens[floor($chunk / 10)];
                    if ($chunk % 10 > 0) {
                        $chunkWords .= '-' . $ones[$chunk % 10];
                    }
                }
            }

            $chunkWords .= ($scaleCount > 0 ? ' ' . $scales[$scaleCount] : '');
            $words = $chunkWords . ($words ? ' ' . $words : '');
        }

        $number = floor($number / 1000);
        $scaleCount++;
    }

    return trim($words);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numbers to Words Calculator</title>
    <link rel="stylesheet" href="./assets/styles.css">
    <script src="./assets/scripts.js"></script>
</head>

<body>
    <div class="cal-container">
        <div class="cal-header">
            <h1>Numbers to Words Calculator</h1>
        </div>
        <form method="POST" id="converterForm">
            <div class="cal-body">
                <label for="number">Convert this Number:</label>
                <input type="number" name="number" id="number" required value="<?php if (isset($_POST['number'])) echo htmlspecialchars($number); ?>">

                <label>To:</label>
                <div class="radio-group">
                    <input type="radio" id="words" name="convert-to" value="words" <?php if (isset($_POST['convert-to']) && $_POST['convert-to'] == "words") echo "checked"; ?> />
                    <label for="words">Words</label>
                </div>
                <div class="radio-group">
                    <input type="radio" id="currency" name="convert-to" value="currency" <?php if (isset($_POST['convert-to']) && $_POST['convert-to'] == "currency") echo "checked"; ?> />
                    <label for="currency">Currency</label>
                </div>
                <div class="radio-group">
                    <input type="radio" id="check-writing" name="convert-to" value="check-writing" <?php if (isset($_POST['convert-to']) && $_POST['convert-to'] == "check-writing") echo "checked"; ?> />
                    <label for="check-writing">Check Writing</label>
                </div>

                <label for="letter-case">Letter Case:</label>
                <select name="letter-case" id="letter-case" required>
                    <option value="lower-case" <?php if (isset($_POST['letter-case']) && $_POST['letter-case'] == 'lower-case') echo 'selected'; ?>>Lower Case</option>
                    <option value="upper-case" <?php if (isset($_POST['letter-case']) && $_POST['letter-case'] == 'upper-case') echo 'selected'; ?>>Upper Case</option>
                    <option value="camel-case" <?php if (isset($_POST['letter-case']) && $_POST['letter-case'] == 'camel-case') echo 'selected'; ?>>Camel Case</option>
                </select>

                <div class="action-btn-container">
                    <button type="submit" id="convert">Convert</button>
                    <button type="reset" id="clear">Clear</button>
                </div>
            </div>

            <div class="cal-footer">
                <label for="result">Result:</label>
                <input type="text" name="result" id="result" readonly value="<?php if (isset($_POST['number']) && $_POST['convert-to'] && isset($_POST['letter-case'])) echo htmlspecialchars($result); ?>">
            </div>
        </form>
    </div>
</body>

</html>