# LastFM-Collage
Another LastFM album art collage generator. This time as simple as possible.

[ ![Codeship Status for beatles1/LastFM-Collage](https://app.codeship.com/projects/c48c7220-949f-0135-0ea9-46500c19f542/status?branch=master)](https://app.codeship.com/projects/250983)

## Usage
Edit the config at the top of the file, stick it on a webserver with PHP and visit it!

## Notes
* Don't push the sizes too far else the lastfm api has a tendancy to fall over but play around and see what you can get away with.
* It doesn't currently clear up its cache, shouldn't be too much of an issue unless you listen to a very broad range of music and call this very frequently.
* First call before files are cached can be very slow (over 10 seconds).
