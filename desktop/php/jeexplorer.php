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
include_file('3rdparty/elfinder', 'elfinder.full', 'js', 'jeexplorer');

?>

<div id="elfinder" class=""></div>

<?php
  $plufinSrc = '/plugins/jeexplorer/3rdparty/elfinder/js/i18n/elfinder.' . $jeeXplorerConfig["lang"] .'.js';
  echo '<script src="'.$plufinSrc.'"></script>';

  include_file('desktop', 'jeexplorer', 'css', 'jeexplorer');
  include_file('desktop', 'jeexplorer', 'js', 'jeexplorer');
  include_file('core', 'plugin.template', 'js');
?>
