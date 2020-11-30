<?php

/**
 * Format Class
 */
class Format
{
	public function formatDate($date)
	{
		return date("F j, Y, g:i a", strtotime($date));
	}

	public function textShorten($text, $limit = 400)
	{
		$text .= " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, " "));
		$text .= " ...";
		return $text;
	}

	public function validation($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function isEmpty($data)
	{
		$data = trim($data);

		if (isset($data) === true && $data === '') {
			return true;
		} else {
			return false;
		}
	}

	public function nameShorten($name)
	{
		$names = explode(' ', $name);
		$firstname = $names[0];

		if (count($names) > 1) {
			$lastname = $names[count($names) - 1];
			return $firstname . ' ' . $lastname;
		} else {
			return $firstname;
		}
	}
}
