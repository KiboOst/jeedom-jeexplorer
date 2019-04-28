<?php
if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}

$plugin = plugin::byId('jeexplorer');
$jeeXplorerConfig = array();
$jeeXplorerConfig["lang"] = config::byKey('language', 'jeexplorer', 'fr');
$jeeXplorerConfig["foldOnStart"] = config::byKey('foldOnStart', 'jeexplorer', '0');
$jeeXplorerConfig["rememberLastDir"] = config::byKey('rememberLastDir', 'jeexplorer', '1');
$jeeXplorerConfig["rememberLastDir"] = ($jeeXplorerConfig["rememberLastDir"] == "1" ? true : false);
sendVarToJS('jeeXplorerConfig', $jeeXplorerConfig);

//Core CodeMirror:
include_file('3rdparty', 'codemirror/lib/codemirror', 'js');
include_file('3rdparty', 'codemirror/lib/codemirror', 'css');
include_file('3rdparty', 'codemirror/addon/mode/loadmode', 'js');
include_file('3rdparty', 'codemirror/mode/meta', 'js');
//Core CodeMirror addons:
include_file('3rdparty', 'codemirror/addon/selection/active-line', 'js');
include_file('3rdparty', 'codemirror/addon/search/search', 'js');
include_file('3rdparty', 'codemirror/addon/search/searchcursor', 'js');
include_file('3rdparty', 'codemirror/addon/dialog/dialog', 'js');
include_file('3rdparty', 'codemirror/addon/dialog/dialog', 'css');

include_file('3rdparty', 'codemirror/addon/fold/brace-fold', 'js');
include_file('3rdparty', 'codemirror/addon/fold/comment-fold', 'js');
include_file('3rdparty', 'codemirror/addon/fold/foldcode', 'js');
include_file('3rdparty', 'codemirror/addon/fold/indent-fold', 'js');
include_file('3rdparty', 'codemirror/addon/fold/markdown-fold', 'js');
include_file('3rdparty', 'codemirror/addon/fold/xml-fold', 'js');
include_file('3rdparty', 'codemirror/addon/fold/foldgutter', 'js');
include_file('3rdparty', 'codemirror/addon/fold/foldgutter', 'css');


//JeeXplorer addons:
include_file('3rdparty', 'codemirror/theme/monokai', 'css', 'jeexplorer');

//elFinder:
include_file('3rdparty/elfinder', 'elfinder.min', 'css', 'jeexplorer');
include_file('3rdparty/elfinder/themes/Material', 'theme', 'css', 'jeexplorer');
include_file('3rdparty/elfinder', 'elfinder.min', 'js', 'jeexplorer');

?>

<div id="elfinder" class=""></div>

<style>
  .CodeMirror pre,
  .ui-dialog-content,
  .ui-widget textarea {
    font-size: 12px !important;
  }

  .elfinder-dialog .ui-helper-clearfix .elfinder-cwd-icon:before {
      display: none;
      color: red !important;
  }

  .elfinder-dialog .elfinder-dialog-icon-confirm {
      display: none;
  }

  .ui-dialog.elfinder-maximized {
    top: 50px !important;
    max-height: calc(100% - 60px) !important;
    max-width: calc(100% - 30px) !important;
  }

  .ui-helper-reset {
    line-height: 14px;
  }

  .elfinder-dialog {
    font-family: "Roboto";
  }
  .elfinder-dialog .ui-button-text {
    font-size: 12px;
    text-transform: capitalize;
  }

  .CodeMirror-dialog-top {
    background-color: rgb(40, 40, 40);;
  }

  .elfinder-dialog .CodeMirror-gutter,
  .elfinder-dialog .CodeMirror-gutters,
  .elfinder-dialog .CodeMirror-linenumber,
  .elfinder-dialog .CodeMirror-foldgutter-open {
    background: rgb(70,70,70) !important;
  }
  .elfinder-dialog .CodeMirror-foldgutter-folded {
    background: rgb(55,55,55) !important;
  }

  .elfinder-dialog-title {font-family:"Roboto"; font-size:12px;}

  .elfinder-dialog .ui-icon-plusthick { background-position: -32px -127px!important; color:rgb(60,60,60)!important;}
  .elfinder-dialog .ui-icon-minusthick { background-position: -63px -127px!important; color:rgb(60,60,60)!important;}
  .elfinder-dialog .ui-icon-closethick { background-position: -96px -128px!important; color:rgb(60,60,60)!important;}
  .elfinder-dialog .ui-icon-arrowreturnthick-1-s { background-position: -49px -62px!important; color:rgb(60,60,60)!important;}
  .elfinder-dialog .ui-helper-clearfix::after {height: 2px;}

  .elfinder-frontmost > div {
    color: rgb(180,180,180);
    background: rgb(60,60,60) !important;
  }
</style>

<?php
  $plufinSrc = '/plugins/jeexplorer/3rdparty/elfinder/js/i18n/elfinder.' . $jeeXplorerConfig["lang"] .'.js';
  echo '<script src="'.$plufinSrc.'"></script>';

  include_file('desktop', 'jeexplorer', 'js', 'jeexplorer');
  include_file('core', 'plugin.template', 'js');
?>
