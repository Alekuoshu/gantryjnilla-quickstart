<?php
/**
 * @package         Regular Labs Library
 * @version         16.12.3209
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2016 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

require_once dirname(__DIR__) . '/helpers/functions.php';

class JFormFieldRL_HR extends JFormField
{
	public $type = 'HR';

	protected function getLabel()
	{
		return '';
	}

	protected function getInput()
	{
		RLFunctions::stylesheet('regularlabs/style.min.css');

		return '<div class="rl_panel rl_hr"></div>';
	}
}
