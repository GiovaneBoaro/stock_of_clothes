<?php
namespace APP\Model;

class Validation
{

    //validation ok
    public static function validateTipo(string $tipo):bool
    {
        return mb_strlen($tipo) > 0;
    }
    public static function validatePrice(int|float $price): bool
    {
        return $price > 0;
    }
    public static function validateBarCode(int $barCode):bool
    {
        return mb_strlen($barCode) == 13 && mb_substr($barCode, 0, 3) == '511';
    }
    public static function validateSize(string $size): bool
    {
        return mb_strlen($size) > 0;
    }
    public static function validateColor(string $color): bool
    {
        return mb_strlen($color) > 3;
    }
    public static function validateQuantity(int $quantity): bool
    {
        return $quantity > 0;
    }
}
