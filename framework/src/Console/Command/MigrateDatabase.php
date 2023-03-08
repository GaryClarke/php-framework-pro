<?php

namespace GaryClarke\Framework\Console\Command;

class MigrateDatabase implements CommandInterface
{
    private string $name = 'database:migrations:migrate';

    public function execute(array $params = []): int
    {
        // Create a migrations table SQL if table not already in existence

        // Get $appliedMigrations which are already in the database.migrations table

        // Get the $migrationFiles from the migrations folder

        // Get the migrations to apply. i.e. they are in $migrationFiles but not in $appliedMigrations

        // Create SQL for any migrations which have not been run ..i.e. which are not in the database

        // Add migration to database

        // Execute the SQL query

        return 0;
    }
}