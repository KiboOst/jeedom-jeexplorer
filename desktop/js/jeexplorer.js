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

$().ready(function() {
  var options = {
      url  : 'plugins/jeexplorer/3rdparty/elfinder/php/connector.minimal.php',
      lang : jeexplorerLang,
      defaultView: 'list',
      rememberLastDir: true,
      sort: 'kindDirsFirst',
      contextmenu : {
        navbar : ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],
        cwd    : ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],
        files  : ['edit', '|', 'open', 'rename' ,'|', 'getfile' , 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|',
            'rm', '|', 'resize', '|', 'archive', 'extract', '|', 'info', 'places'
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
      edit : {
          editors : [
            {
              load : function(textarea) {
                CodeMirror.modeURL = "/3rdparty/codemirror/mode/%N/%N.js"
                self = this
                this.myCodeMirror = CodeMirror.fromTextArea(textarea, {
                  lineNumbers: true,
                  matchBrackets: true,
                  autoRefresh: true
                })
                var editor = this.myCodeMirror

                //Auto mode set:
                var info, m, mode, spec;
                if (! info) {
                    info = CodeMirror.findModeByMIME(self.file.mime);
                }
                if (! info && (m = self.file.name.match(/.+\.([^.]+)$/))) {
                    info = CodeMirror.findModeByExtension(m[1]);
                }
                if (info) {
                    mode = info.mode;
                    spec = info.mime;
                    editor.setOption('mode', spec);
                    CodeMirror.autoLoadMode(editor, mode);
                }

                $(".cm-s-default").height('100%')

                //expand on resize modal:
                $('.elfinder-dialog-edit').resize(function() {
                  editor.refresh()
                })
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
      }
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

