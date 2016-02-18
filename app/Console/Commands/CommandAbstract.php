<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class CommandAbstract
 *
 * @package App\Console\Commands
 */
abstract class CommandAbstract extends Command
{
    use CommandLoggerTrait;

    /**
     * Log Command Runs
     *
     * @var bool
     */
    protected $is_logged = true;

    /**
     * Time Command Runs
     *
     * @var bool
     */
    protected $is_timed = true;

    /**
     * Lock the commands from running overlapped
     *
     * @var bool
     */
    protected $is_locked = true;

    /**
     * Start Time of Command
     *
     * @var
     */
    protected $start_time;

    /**
     * End Time of Command
     *
     * @var
     */
    protected $end_time;

    /**
     * Total Run Time of Command
     *
     * @var
     */
    protected $run_time;

    /**
     * Handle Start Commands
     *
     * @return bool
     */
    protected function handleStart()
    {
        set_time_limit(0);
        if ($this->is_timed === true) {
            $this->startTimer();
        }

        return true;
    }


    /**
     * Handle Complete Commands
     *
     * @param bool $result
     * @return bool
     */
    protected function handleComplete($result = true)
    {
        if ($this->is_timed === true) {
            $run_time = $this->stopTimer();
        }

        $info_string = $this->getCommandName(). ' has';

        if ($result) {
            $info_string .= ' completed';
        } else {
            $info_string .= ' failed';
        }

        if (isset($run_time)) {
            $info_string .=  ' after '.$run_time.' sec(s)';
        }

        $info_string .= '!';

        if ($result) {
            $this->info($info_string);
            if ($this->is_logged) {
                $this->logInfo($info_string);
            }
        } else {
            $this->error($info_string);
            if ($this->is_logged) {
                $this->logError($info_string);
            }
        }

        return true;
    }

    /**
     * Start Timer for command
     *
     * @return mixed
     */
    protected function startTimer()
    {
        $this->start_time = microtime(true);

        return $this->start_time;
    }


    /**
     * Stop Timer for Command and return run time
     *
     * @return mixed
     */
    protected function stopTimer()
    {
        $this->end_time = microtime(true);
        $this->run_time = round($this->end_time - $this->start_time, 3);

        return $this->run_time;
    }

    /**
     * Check is option is assigned for command called
     *
     * @param $option_name
     * @return bool
     */
    protected function isAssignedOption($option_name)
    {
        $options = $this->getOptions();

        foreach ($options as $option) {
            if ($option[0] === $option_name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get Command Name
     *
     * @throws \Exception
     * @return mixed
     */
    public function getCommandName()
    {
        if (!isset($this->command_name)){
            throw new \Exception("Command Name not set in class:". get_called_class());
        }
        return $this->command_name;
    }

}
