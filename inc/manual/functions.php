<?php

require get_template_directory() . '/inc/manual/toc.php';
require get_template_directory() . '/inc/manual/redirects.php';

function manual_title() {
	global $manual_toc;

	$title = $_GET['title'];
	if (!isset($title) || empty($title)) {
		$title = 'Main Page';
	}

	$title = str_replace("\\'", "'", $title);
	//$title = str_replace('%20', ' ', $title);
	//$title = str_replace('%3A', ':', $title);
	//$title = str_replace('%2B', '+', $title);
	$title = str_replace('_', ' ', $title);
	$title = str_replace('\\', '/', $title);
	$title = ltrim($title, '/.');
	$title = str_replace('/./', '/', $title);
	$title = str_replace('/../', '/', $title);

	if (strpos($title, 'C  ') !== FALSE && !in_array($title, $manual_toc)) {
		$title = str_replace('C  ', 'C++', $title);
	}

	$title = ltrim(trim($title), '/.');

	return $title;
}

function manual_permalink($page = NULL) {
	if (!$page) {
		$page = manual_title();
	}
	$page = str_replace(' ', '_', $page);
	$page = str_replace('+', '%2B', $page);
	return '/manual/index.php/' . $page;
}

function manual_redirect($page = NULL) {
	global $manual_redirects;
	if (!$page) {
		$page = manual_title();
	}
	if (isset($manual_redirects[$page])) {
		return $manual_redirects[$page];
	}
	return NULL;
}

function manual_top() {
	if (manual_title() != 'Main Page') {
		return manual_permalink('Main Page');
	} else {
		return NULL;
	}
}

function manual_language() {
	$language = $_GET['language'];
	if (isset($language) && !empty($language)) {
		$_SESSION['PandaManualProgrammingLanguage'] = $language;
	} else {
		if (isset($_SESSION['PandaManualProgrammingLanguage'])) {
			$language = strtolower($_SESSION['PandaManualProgrammingLanguage']);
			$language = trim($language);
			if ($language != 'cxx' && $language != 'raw') {
				$language = 'python';
			}
		} else {
			$language = 'python';
		}
	}
	return $language;
}

function manual_content() {
	$title = manual_title();
	$title = str_replace(' ', '_', $title);
	$title = str_replace(':', '%3A', $title);
	$path = WP_CONTENT_DIR . '/manual/pages/' . $title . '.html';
	$content = file_get_contents($path);
	if ($content !== FALSE) {
		$language = manual_language();
		if ($language == 'cxx') {
			$content = preg_replace("|\\[python\\](.+?)\\[\\/python\\]|s", "", $content);
			$content = preg_replace("|\\[cxx\\](.+?)\\[\\/cxx\\]|s", "\\1", $content);
			$content = str_replace("[;]", ";", $content);
			$content = str_replace("[->]", "->", $content);
			$content = str_replace("[::]", "::", $content);
			// Convert Python functions to C++ functions
			$functags = array();
			preg_match_all("|\\[func\\](.+?)\\[\\/func\\]|", $content, $functags, PREG_SET_ORDER);
			foreach ($functags as $functag) {
				$content = str_replace($functag[0], strtolower(preg_replace("|([a-z])([A-Z])|", "\\1_\\2", $functag[1])), $content);
			}
		} else if ($language != 'raw') {
			$content = preg_replace("|\\[cxx\\](.+?)\\[\\/cxx\\]|s", "", $content);
			$content = preg_replace("|\\[python\\](.+?)\\[\\/python\\]|s", "\\1", $content);
			$content = str_replace("[;]", "", $content);
			$content = str_replace("[->]", ".", $content);
			$content = str_replace("[::]", ".", $content);
			// Convert C++ functions to Python functions
			$functags = array();
			preg_match_all("|\\[func\\](.+?)\\[\\/func\\]|", $content, $functags, PREG_SET_ORDER);
			foreach ($functags as $functag) {
				// The CSS thing is a hack, for some reason \u doesn't work with preg_replace.
				$content = str_replace($functag[0], preg_replace("|([a-z])_([a-z])|", "\\1<span style=\"text-transform: uppercase\">\\2</span>", $functag[1]), $content);
			}
		}

		return $content;
	} else {
		return '<p>The requested page does not exist.</p>';
	}
	return $path;
}

function manual_next() {
	global $manual_toc;
	$title = manual_title();
	$key = array_search($title, $manual_toc);
	if ($key !== FALSE && $key + 1 < count($manual_toc)) {
		$page = $manual_toc[$key + 1];
		$page = str_replace(' ', '_', $page);
		return manual_permalink($page);
	}
	return NULL;
}

function manual_prev() {
	global $manual_toc;
	$title = manual_title();
	$key = array_search($title, $manual_toc);
	if ($key !== FALSE) {
		if ($key > 0) {
			$page = $manual_toc[$key - 1];
		} else {
			$page = 'Main Page';
		}
		$page = str_replace(' ', '_', $page);
		return manual_permalink($page);
	}
	return NULL;
}
