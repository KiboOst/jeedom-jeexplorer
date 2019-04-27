<?php
if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}

$plugin = plugin::byId('jeexplorer');
$jeexplorerLang = config::byKey('language', 'jeexplorer', 'fr');
sendVarToJS('jeexplorerLang', $jeexplorerLang);

//core codemirror
include_file('3rdparty', 'codemirror/lib/codemirror', 'js');
include_file('3rdparty', 'codemirror/lib/codemirror', 'css');
include_file('3rdparty', 'codemirror/addon/mode/loadmode', 'js');
include_file('3rdparty', 'codemirror/mode/meta', 'js');

//elfinder
include_file('3rdparty/elfinder', 'elfinder.min', 'css', 'jeexplorer');
include_file('3rdparty/elfinder/themes/Material', 'theme', 'css', 'jeexplorer');
include_file('3rdparty/elfinder', 'elfinder.min', 'js', 'jeexplorer');

?>

<div id="elfinder" class="elfinder ui-helper-reset ui-helper-clearfix ui-widget ui-widget-content ui-corner-all elfinder-ltr ui-resizable"></div>

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
</style>

<?php
  $plufinSrc = '/plugins/jeexplorer/3rdparty/elfinder/js/i18n/elfinder.' . $jeexplorerLang .'.js';
  echo '<script src="'.$plufinSrc.'"></script>"';

  include_file('desktop', 'jeexplorer', 'js', 'jeexplorer');
  include_file('core', 'plugin.template', 'js');
?>