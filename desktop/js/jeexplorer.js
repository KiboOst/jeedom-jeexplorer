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

function callbackWarning() {
	jeedom.config.save({
		configuration: {'showWarning': 0},
		plugin : 'jeexplorer',
		error: function (error) {
			console.log(error.message)
		},
		success: function () {
			//console.log('callbackWarning ok')
		}
	})
}

$(function() {
	showWarning = jeeXplorerConfig.showWarning
	if (showWarning == "1") {
		bootbox.dialog({
			title: "<div class=\"danger\">Attention</div>",
			message: "<div class=\"alert alert-danger\">Comme tout explorateur de fichiers, celui-ci vous permet d'accéder et d'éditer tous les fichiers présent dans le répertoire racine de 	Jeedom. Attention donc aux mauvaises manipulations qui pourraient rendre votre Jeedom complètement inopérant ! </div>",
			buttons: {
				cancel: {label: '{{Ne plus afficher}}',
						 className: 'btn-danger',
						 callback: function () {
							callbackWarning()
						 }
						},
				confirm: {label: '{{Ok}}', className: 'btn-success'}
			}
		})
	}

  CodeMirror.modeURL = "/3rdparty/codemirror/mode/%N/%N.js"
  var options = {
	  url: 'plugins/jeexplorer/3rdparty/elfinder/php/connector.minimal.php',
	  lang: jeeXplorerConfig.lang,
	  startPath: '',
	  rememberLastDir: jeeXplorerConfig.rememberLastDir,
	  defaultView: 'list',
	  sort: 'kindDirsFirst',
	  sortDirect: 'kindDirsFirst',
	  contextmenu: {
		cwd: ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],
		files: ['edit', '|', 'rename' ,'|', 'getfile' , 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|','rm', '|', 'archive', 'extract', '|', 'info', 'places']
	  },
	  uiOptions: {
		toolbar: [
		  ['back', 'forward'],
		  ['reload', 'sort'],
		  ['home', 'up'],
		  ['mkdir', 'mkfile', 'upload','download'],
		  ['info'],
		  ['copy', 'cut', 'paste'],
		  ['edit','duplicate', 'rename', 'rm'],
		  ['extract', 'archive'],
		  ['search'],
		  ['view']
		]
	  },
	  handlers:
	  {
		  dblclick: function(event, elfinderInstance)
		  {
			  elfinderInstance.exec('edit')
			  return false
		  }
	  },
	  commandsOptions: {
		edit: {
			editors: [
			  {
				load : function(textarea) {
				  self = this
				  this.myCodeMirror = CodeMirror.fromTextArea(textarea, {
					  styleActiveLine: true,
					  lineNumbers: true,
					  lineWrapping: true,
					  matchBrackets: true,
					  autoRefresh: true,
					  foldGutter: true,
					  gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
					})
				  var editor = this.myCodeMirror

				  //Auto mode set:
				  var info, m, mode, spec;
				  if (!info) {
					  info = CodeMirror.findModeByMIME(self.file.mime);
				  }
				  if (!info && (m = self.file.name.match(/.+\.([^.]+)$/))) {
					  info = CodeMirror.findModeByExtension(m[1]);
				  }
				  if (info) {
					  mode = info.mode;
					  spec = info.mime;
					  editor.setOption('mode', spec);
					  CodeMirror.autoLoadMode(editor, mode);
				  }

				  //$(".cm-s-default").height('100%')
				  $(".cm-s-default").style('height', '100%', 'important')
				  editor.setOption('theme', 'monokai')

				  //expand on resize modal:
				  $('.elfinder-dialog-edit').resize(function() {
					editor.refresh()
				  })
				  $('.elfinder-dialog-active').width('75%')
				  $('.elfinder-dialog-active').css('left', '15%')

				  setTimeout(function(){
					editor.scrollIntoView({line:0, char:0}, 20)
					editor.setOption("extraKeys", {
					  "Ctrl-Y": cm => CodeMirror.commands.foldAll(cm),
					  "Ctrl-I": cm => CodeMirror.commands.unfoldAll(cm)
					})
					if (jeeXplorerConfig.foldOnStart == "1") {
					  CodeMirror.commands.foldAll(editor)
					}
				  }, 250)
				},
				close : function(textarea, instance) {
				  //this.myCodeMirror = null;
				},
				save : function(textarea, editor) {
				  textarea.value = this.myCodeMirror.getValue();
				  //this.myCodeMirror = null;
				  }
			  }
			]
		},
	  }
  }
  var elfinder = $('#elfinder').elfinder(options).elfinder('instance')
  $('#elfinder').css("height", $(window).height() - 80)
});

//resize explorer in browser window:
$(window).resize(function() {
  $('#elfinder').css("width", $(window).width() - 30)
  $('#elfinder').css("height", $(window).height() - 80)
})

