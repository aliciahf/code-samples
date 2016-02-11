$(document).ready(function(){
  console.log('main.js');

  $('.term').each(function (i, e) {
    $(e).popover({
      title: 'Definition',
      content: e.dataset.definition || 'No definition',
      trigger: 'hover'
    });
  });

  $('.equation').each(function (i, e) {
    var text = e.innerText;
    text = text.replace(/_+/, '\\underline');
    e.innerText = '`' + text + '`';
  });

  CodeMirror.defineSimpleMode("simplemode", {
    // The start state contains the rules that are intially used
    start: [
      // The regex matches the token, the token property contains the type
      {regex: /\s*\$.*/, token: "section", sol: true},
      {regex: /\s*#.*/, token: "field", sol: true},
      {regex: /\s*@.*/, token: "reference", sol: true},
      {regex: /\s*\/\/\s*error.*/i, token: "error", sol: true},
      {regex: /\/\/.*/, token: "comment"},
      {regex: /\s*%%.*/, token: "equation", sol: true},
      {regex: /%%(?:[^\\]|\\.)*?%%/, token: "equation"},
      {regex: /{{(?:[^\\]|\\.)*?}}/, token: "definition"},
      // // You can match multiple tokens at once. Note that the captured
      // // groups must span the whole string in this case
      // {regex: /(function)(\s+)([a-z$][\w$]*)/,
      //  token: ["keyword", null, "variable-2"]},
      // // Rules are matched in the order in which they appear, so there is
      // // no ambiguity between this one and the one above
      // {regex: /(?:function|var|return|if|for|while|else|do|this)\b/,
      //  token: "keyword"},
      // {regex: /true|false|null|undefined/, token: "atom"},
      // {regex: /0x[a-f\d]+|[-+]?(?:\.\d+|\d+\.?\d*)(?:e[-+]?\d+)?/i,
      //  token: "number"},
      // {regex: /\/(?:[^\\]|\\.)*?\//, token: "variable-3"},
      // // A next property will cause the mode to move to a different state
      // {regex: /\/\*/, token: "comment", next: "comment"},
      // {regex: /[-+\/*=<>!]+/, token: "operator"},
      // // indent and dedent properties guide autoindentation
      // {regex: /[\{\[\(]/, indent: true},
      // {regex: /[\}\]\)]/, dedent: true},
      // {regex: /[a-z$][\w$]*/, token: "variable"},
      // // You can embed other modes with the mode property. This rule
      // // causes all code between << and >> to be highlighted with the XML
      // // mode.
      // {regex: /<</, token: "meta", mode: {spec: "xml", end: />>/}}
    ],
    // The multi-line comment state.
    comment: [
      {regex: /.*?\*\//, token: "comment", next: "start"},
      {regex: /.*/, token: "comment"}
    ],
    // The meta property contains global information about the mode. It
    // can contain properties like lineComment, which are supported by
    // all modes, and also directives like dontIndentStates, which are
    // specific to simple modes.
    meta: {
      dontIndentStates: ["comment"],
      lineComment: "//"
    }
  });


  var source = $('#source');
  var content = source.val();
  var localStorage = window.localStorage;

  if (!content.trim()) {
    source.val(localStorage.getItem('source'));
  } else {
    localStorage.setItem('source', content);
  }

  var cm = CodeMirror.fromTextArea(document.getElementById("source"), {
    lineNumbers: true,
    mode: "simplemode"
  });

  setInterval(function () {
    if (cm) {
      localStorage.setItem('source', cm.getValue());
    }
  }, 500);

  $('#clear').click(function (evt) {
    if (cm) {
      cm.setValue('');
    }
  });



  // var editor = ace.edit("editor");
  // editor.setTheme("ace/theme/monokai");
  // editor.getSession().setMode("ace/mode/text");
});
