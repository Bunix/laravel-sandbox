<?php

namespace App\Console\Commands;

/**
 * Class Test
 *
 * @package App\Console\Commands
 */
class Test extends CommandAbstract
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cron:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Command Functionality.';

    /**
     * Command Name for output
     *
     * @var string
     */
    protected $command_name = 'Test Command';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->handleStart();

        sleep(4);
        $result = true;

        $this->handleComplete($result);
    }


}
