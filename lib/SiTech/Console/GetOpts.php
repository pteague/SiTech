<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @package SiTech_Console
 * @subpackage SiTech_Console_GetOpts
 */
class SiTech_Console_GetOpts
{
	const TYPE_STRING = 1;

	const TYPE_INT = 2;

	const TYPE_FLOAT = 3;
	
	protected $long = array();

	protected $params = array();
	
	protected $program;

	protected $options = array();

	protected $short = array();

	protected $version;

	protected $usage;

	/**
	 * Constructor.
	 */
	public function __construct($usage = '%prog [options]', $version = null, $description = null)
	{
		$this->program = basename($_SERVER['argv'][0]);

		$this->setUsage($usage);
		$this->setVersion($version);
	}

	public function addOption(array $option)
	{
		if (!isset($option['short']) && !isset($option['long'])) {
			$this->params[] = $option;
		} else {
			$this->options[] = $option;
			if (isset($option['short'])) {
				$this->short[$option['short']] = key($this->options);
			}
			if (isset($option['long'])) {
				$this->long[$option['long']] = key($this->options);
			}
		}
	}

	public function displayHelp($exit = true)
	{
		$this->displayUsage(false);
		echo "\n";
		if (!empty($this->version)) {
			printf("%-30s%s\n", "--version", "display the current version and exit");
		}
		printf("%-30s%s\n", "-h, --help", "show this help message and exit");

		$params = array();
		foreach ($this->options as $option) {
			$opts = array();

			if (isset($option['short'])) {
				$opts[] = '-'.$option['short'];
			}
			if (isset($option['long'])) {
				$opts[] = '--'.$option['long'];
			}
			
			$opts = implode(', ', $opts);
			printf("%-30s%s\n", $opts, (isset($option['desc'])? $option['desc'] : null));
		}

		if ($exit) exit;
	}

	public function displayUsage($exit = true)
	{
		echo "Usage: $this->usage";

		if (sizeof($this->params) > 0) {
			foreach ($this->params as $key => $param) {
				echo ' [param',($key+1),']';
			}
		}

		echo "\n";
		if ($exit) exit;
	}

	public function displayVersion($exit = true)
	{
		echo $this->version,"\n";
		if ($exit) exit;
	}

	public function parse()
	{
		$options = array();

		for ($i = 1; $i < $_SERVER['argc']; $i++) {
			switch ($_SERVER['argv'][$i]) {
				case '-h':
				case '--help':
					$this->displayHelp();
					break;

				case '--version':
					$this->displayVersion();
					break;

				default:
					$arg = $_SERVER['argv'][$i];
					if (substr($arg, 0, 2) == '--') {
						$arg = substr($arg, 2);
						if (isset($this->long[$arg])) {
							$options[$arg] = true;
						} else {
							echo 'Unknown long option --',$arg,"\n";
						}
					} elseif ($arg[0] == '-') {
						$arg = substr($arg, 1);
						if (isset($this->short[$arg])) {
							$options[$arg] = true;
						} else {
							echo 'Unknown short option -',$arg,"\n";
						}
					} else {
						/* parameter */
					}
					break;
			}
		}

		return($options);
	}

	public function setUsage($usage)
	{
		$this->usage = rtrim(str_replace('%prog', $this->program, $usage));
	}

	public function setVersion($version)
	{
		$this->version = $version;
	}

	protected function __get($name)
	{
		switch ($name) {
			case 'program':
				return($this->program);
				break;
		}
	}
}
