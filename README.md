# MIDI.js Soundfonts

The goal with this project is to add drums to the midi-js soundfonts from gleitz.  They haven't been added yet, sorry!

[MIDI.js](https://github.com/mudcube/MIDI.js) is a fantastic library for MIDI sequencing and playback in Javascript. It comes packaged with a [soundfont-generator](https://github.com/gleitz/MIDI.js/tree/master/soundfont-generator/) that is unfortuantely a little difficult to get up and running (requires installation of Ruby, Node.js, FluidSynth, Lame, etc.)

This project contains pre-rendered [General MIDI](https://en.wikipedia.org/wiki/General_MIDI) soundfonts that can be used immediately with MIDI.js.

Soundfonts Available Are Mostly From Gleitz's Original Source Right Now
----

- Fluid-Soundfont
    - Generated from [FluidR3_GM.sf2](http://www.musescore.org/download/fluid-soundfont.tar.gz) (141 MB uncompressed)
    - Released under [Creative Commons Attribution 3.0 license](http://creativecommons.org/licenses/by/3.0/us/)
    - Instrument names as .json file [here](http://gleitz.github.io/midi-js-soundfonts/FluidR3_GM/names.json)
    - URL prefix to fetch files WITHOUT drums (I haven't added them yet): http://gleitz.github.io/midi-js-soundfonts/FluidR3_GM/

- Musyng Kite Soundfont
    - I am not maintaining this one.
    - It is available from [the original source on GitHub](https://github.com/gleitz/midi-js-soundfonts)

Notes
-----

- Fork of MIDI.js with parallized soundfont generation [available here](https://github.com/gleitz/MIDI.js).
- You can fetch Soundfont files directly from this repository, so you can access them directly from a browser. Use the prefix URL following by the instrument name. For example: http://gleitz.github.io/midi-js-soundfonts/FluidR3_GM/marimba-mp3.js
