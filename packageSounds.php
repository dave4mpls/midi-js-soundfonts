<?php

// Package a bunch of sounds into a MIDIjs-compatible JavaScript soundfont file.
ini_set("display_errors",0);
ini_set("error_reporting",0);
// Command-line arguments: php packageSounds.php [MP3|OGG] <folder-for-sounds> <output-filename>.

function giveCommandLineFormat() {
	echo "Command line format:\r\n";
	echo "php packageSounds.php [MP3|OGG] <folder-for-sounds> <output-filename>.\r\n";
}

function giveFullErrorThenExit($e) {
	echo $e . "\r\n\r\n";
	giveCommandLineFormat();
	exit(1);
}

function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}

//------- MAIN PROGRAM
set_error_handler("exception_error_handler");

if ($argc < 2 || $argv[1] == "/?" || strtolower($argv[1]) == "--help" || strtolower($argv[1]) == "-h" || strtolower($argv[1]) == "/h")
	{
	echo "PackageSounds: Takes a folder of mp3 or ogg files and makes a MIDI.js soundfont JavaScript file out of them.\r\n\r\n";
	giveCommandLineFormat();
	exit(1);
	}

try {
	if ($argc != 4) throw new Exception("Wrong number of arguments.");
	$mySoundFormat = strtolower($argv[1]);
	if ($mySoundFormat != "mp3" && $mySoundFormat != "ogg") throw new Exception( "Sound Format must be mp3 or ogg .");
	$sourcePath = $argv[2];
	if (substr($sourcePath,-1,1) == DIRECTORY_SEPARATOR) $sourcePath = substr($sourcePath,0,strlen($sourcePath)-1);
	$destFile = $argv[3];
	echo "Converting files from " . $sourcePath . " and placing in " . $destFile . "...\r\n";
	//---- prepare beginning of file
	$mimeType = ($mySoundFormat == "mp3") ? "audio/mp3" : "audio/ogg";
	$outstr = <<<EOF

if (typeof(MIDI) === 'undefined') var MIDI = {};
if (typeof(MIDI.Soundfont) === 'undefined') MIDI.Soundfont = {};
MIDI.Soundfont.acoustic_grand_piano = {
EOF;
	$outstr .= "\r\n";
	//---- main read directory loop
	if (is_dir($sourcePath)) {
		    if ($dh = opendir($sourcePath)) {
			while (($file = readdir($dh)) !== false) {
				// process the file here
				if ($file == ".") continue;
				if ($file == "..") continue;
				echo $file . "    ";
				$fileData = file_get_contents($sourcePath . DIRECTORY_SEPARATOR . $file);
				$fileDataBase64 = base64_encode($fileData);
				$noteName = pathinfo($file, PATHINFO_FILENAME);
				$outstr .= "\"" . $noteName . "\":\"data:" . $mimeType . ";base64," . $fileDataBase64 . "\",\r\n";
			}
			closedir($dh);
		    }
		}	
	echo "\r\n";
	$outstr .= "};\r\n\r\n";
	file_put_contents($destFile, $outstr);
	echo "File {$destFile} written.\r\n";
	exit(0);
	}
catch(Exception $e)
	{
	giveFullErrorThenExit($e->getMessage());
	}
?>