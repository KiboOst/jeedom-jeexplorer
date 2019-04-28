<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';
include_file('core', 'authentification', 'php');
if (!isConnect()) {
	include_file('desktop', '404', 'php');
	die();
}

include_file('3rdparty', 'codemirror/lib/codemirror', 'js');

?>

<form class="form-horizontal">
<fieldset>
	<div class="form-group">
		<label class="col-sm-3  col-xs-12 control-label">{{Langue de l'explorateur}}</label>
		<div class="col-sm-3 col-xs-12">
			<div class="dropdown dynDropdown">
			<button class="btn btn-default dropdown-toggle configKey" type="button" data-toggle="dropdown" data-l1key="language" value="fr">
				French<span class="caret"></span>
			</button>
			<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="#" data-value="en">English</a></li>
				<li><a href="#" data-value="fr">French</a></li>
				<li><a href="#" data-value="de">German</a></li>
				<li><a href="#" data-value="es">Spanish</a></li>
				<li><a href="#" data-value="ru">Russian</a></li>
				<li><a href="#" data-value="it">Italian</a></li>
			</ul>
		</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 col-xs-12 control-label">{{Ouvrir sur le dernier répertoire}}
			<sup><i class="fas fa-question-circle tooltips" title="{{Ouvrir l’explorateur sur le dernier répertoire consulté}}"></i></sup>
		</label>
		<div class="col-sm-3 col-xs-12">
			<input type="checkbox" class="configKey" data-l1key="rememberLastDir" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 col-xs-12 control-label">{{Collapser le code à l'ouverture}}</label>
		<div class="col-sm-3 col-xs-12">
			<input type="checkbox" class="configKey" data-l1key="foldOnStart" />
		</div>
	</div>
	<br/>

	<div class="form-group">
		<label class="col-sm-3 col-xs-6 control-label">{{CodeMiror (Core)}}</label>
		<label class="col-sm-3 col-xs-6 control-label"><span id="cmVersion" class="label label-info"></span></label>
	</div>
	<div class="form-group">
		<label class="col-sm-3 col-xs-6 control-label">{{edFinder (JeeXplorer)}}</label>
		<label class="col-sm-3 col-xs-6 control-label"><span id="elfinderVersion" class="label label-info"></span></label>
	</div>
</fieldset>
</form>

<script>
	$(function() {
		$('#cmVersion').html(CodeMirror.version)
		 $.getJSON("/plugins/jeexplorer/3rdparty/elfinder/package.json", function(result){
			$('#elfinderVersion').html(result.version)
		})
	})
</script>
