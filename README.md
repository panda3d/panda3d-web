<img src="https://avatars2.githubusercontent.com/u/590956?v=3&s=500" align="right" width="200"/>

Panda3D - WordPress Theme
===

This custom WordPress theme is built for the Panda3D Game Engine. See it in action on [panda3d.org](https://panda3d.org).

Local Environment Setup
---------------

1. Set up a local instance of WordPress with the URL `panda3d.test`.
    * If you wish to use a URL other than panda3d.test, change the `projectURL` var in gulpfile.js to whatever local URL points to your WordPress installation.
2. Run `npm install` to install required packages for local development.
3. Download the FontAwesome icon set and place it in `assets/js/vendor/fontawesome` (See [FontAwesome Instructions](assets/js/vendor/fontawesome/README.md)).
4. Use `npm run` to compile SASS/JS and boot up gulp.
5. You're ready to go!

Running a Local Environment
---------------

After you've set up your Local Environment, just use `npm run` in the theme folder whenever you want to compile assets and run gulp. After a few seconds your browser should open the URL `localhost:8000`, which will automatically update with SASS/JS/PHP changes upon file save.
