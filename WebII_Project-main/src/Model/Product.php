<?php

namespace APP\Model;

class Product
{

    // produto ok 
    private int $barCode;
    private string $tipo;
    private float $price;
    private int $quantity;
    private string $size;
    private string $color;


    public function __construct(
        string $tipo,
        int $quantity,
        string $size,
        string $color,
        float $price = 0,
        int $barCode = 0,
    ) {
        // Inicializando as propriedades
        $this->barCode = $barCode;
        $this->tipo = $tipo;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->size = $size;
        $this->color = $color;
    }


    public function __get($attribute)
    {
        return $this->$attribute;
    }
}
