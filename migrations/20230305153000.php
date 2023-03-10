<?php

return new class
{
    public function up(): void
    {
        // Table creation / modification code goes here

        echo get_class($this) . ' "up" method called' . PHP_EOL;
    }

    public function down(): void
    {
        // Table drop / modification code goes here

        echo get_class($this) . ' "down" method called' . PHP_EOL;
    }
};

