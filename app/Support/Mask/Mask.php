<?php

namespace App\Support\Mask;

class Mask
{
    /**
     * The masks.
     *
     * @var array
     */
    private $masks;

    /**
     * The string that will be masked.
     *
     * @var string
     */
    private $string;

    /**
     * The escape characters that will be used in the mask.
     *
     * @var array
     */
    private $escapeChars = [
        '#' => '[0-9]',
        'X' => '[a-zA-Z0-9]'
    ];

    /**
     * Create the mask service.
     *
     * @param array|string $masks
     * @param string $string
     */
    public function __construct($masks, string $string)
    {
        $this->masks = $this->sanitizeMask($masks);
        $this->string = $this->sanitizeString($string);
    }

    /**
     * Mask the given string.
     *
     * @return string
     * @throws ApiException
     */
    public function mask(): string
    {
        foreach ($this->masks as $mask) {
            if (!$this->validate($mask, $this->string)) {
                continue;
            }

            for ($i = 0; $i < strlen($this->string); $i++) {
                $char = $this->getNextChar($mask);

                if (empty($char)) {
                    break;
                }

                if (preg_match('/' . $this->escapeChars[$char] . '/', $this->string[$i])) {
                    $mask[strpos($mask, $char)] = $this->string[$i];
                }
            }

            return $mask;
        }

        throw new \App\Exceptions\ApiException("The provided masks not match with the string", 500);
    }

    /**
     * Sanitize the masks, puting all in a array.
     *
     * @param array|string $masks
     * @return void
     * @throws ApiException
     */
    private function sanitizeMask($masks)
    {
        if (!is_string($masks) && !is_array($masks)) {
            throw new \App\Exceptions\ApiException("Invalid mask provided", 500);
        }

        if (is_string($masks)) {
            return [$masks];
        }

        return $masks;
    }

    /**
     * Sanitize the string, removing the empty spaces.
     *
     * @param string $string
     * @return string
     */
    private function sanitizeString(string $string): string
    {
        return str_replace(" ", "", $string);
    }

    /**
     * Validate if the string matches if the mask.
     *
     * @param string $mask
     * @param string $string
     * @return boolean
     */
    private function validate(string $mask, string $string): bool
    {
        $chars = implode('', array_keys($this->escapeChars));
        return strlen($string) == strlen(preg_replace('/(?!([' . $chars . ']))./', '', $mask));
    }

    /**
     * Get the next escape char of the mask.
     *
     * @param string $mask
     * @return string
     */
    private function getNextChar(string $mask): string
    {
        $result = '';
        $pos = null;

        foreach ($this->escapeChars as $char => $preg) {
            $charPos = strpos($mask, $char);

            if ($charPos === false) {
                continue;
            }

            if ($pos === null || $charPos < $pos) {
                $pos = $charPos;
                $result = $char;
            }
        }

        return $result;
    }
}
