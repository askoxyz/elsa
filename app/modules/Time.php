<?php

class Time {

	public static function contextual($small_ts, $large_ts = false) {

		if(!$large_ts) $large_ts = time();

		$n = $large_ts - $small_ts;

		if($n <= 1) return '1 second ago';
		if($n < (60)) return $n . ' seconds ago';
		if($n < (60*60)) { $minutes = round($n/60); return '' . $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago'; }
		if($n < (60*60*16)) { $hours = round($n/(60*60)); return '' . $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago'; }
		if($n < (time() - strtotime('yesterday'))) return 'Yesterday';
		if($n < (60*60*24)) { $hours = round($n/(60*60)); return '' . $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago'; }
		if($n < (60*60*24*6.5)) return '' . round($n/(60*60*24)) . ' days ago';
		if($n < (time() - strtotime('last week'))) return 'Last week';
		if(round($n/(60*60*24*7))  == 1) return 'A week ago';
		if($n < (60*60*24*7*3.5)) return '' . round($n/(60*60*24*7)) . ' weeks ago';
		if($n < (time() - strtotime('last month'))) return 'Last month';
		if(round($n/(60*60*24*7*4))  == 1) return 'A month ago';
		if($n < (60*60*24*7*4*11.5)) return '' . round($n/(60*60*24*7*4)) . ' months ago';
		if($n < (time() - strtotime('last year'))) return 'Last year';
		if(round($n/(60*60*24*7*52)) == 1) return 'A year ago';
		if($n >= (60*60*24*7*4*12)) return '' . round($n/(60*60*24*7*52)) . ' years ago';

		return false;

	}

}
