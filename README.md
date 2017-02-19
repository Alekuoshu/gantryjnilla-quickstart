# gantryjnilla-quickstart

Joomla! 3.x quickstart package for rapid site and template development with a core hacked version of Gantry Framework and part of the Jnilla Framework - Use it under your own responsibility.

## Abstract:

This is pretty much a work in proggress, feel free to use it, collaborate, report issues or request new features.

This project is based in the latest Joomla! 3.x version.

We don't have any release schedule or planification "yet", we will release/update as soon as we require/desire. 

Documentation can be seen here (temporally): https://docs.google.com/document/d/1fwoWNdjGUZXvyGXyqzgGibaM6pZFhA_t-k9fc_2Cvu0/edit#heading=h.lgi9d83xl2u6


## Development:

The folder <code>site</code> is an uncompressed Akeeba backup, so it is ready to download and install.

The file <code>build.php</code> is a PHP console script to prepare and build the source from the most recent akeeba backup.

You will requiere to create the file <code>build_vars.php</code> (same folder as <code>build.php</code>) to store configuration vars requiered by the build.php script.

**Example: build_vars.php**
<code>
<?php 
$source_dir = '/path/to/my/development/installation';
?>
</code>

## Change log:

* 02/19/2016
  * jn-animation: Code was simplified
  * jn-anchor: Is a new feature to add transitions to anchors by using a class.
  * jn-parallax: Is a new feature to add background parallax effect to elements by using a class.
  * jn-video: Is a new feature to add minimalistic video controls to video tags.
  * Demo page was updated
  
