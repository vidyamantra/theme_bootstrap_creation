var moodle = moodle || { 'settings': {}, 'behaviors': {}, 'themes': {}, 'locale': {} };


moodle.jsEnabled = document.getElementsByTagName && document.createElement && document.createTextNode && document.documentElement && document.getElementById;

moodle.attachBehaviors = function(context) {
  context = context || document;
  if (moodle.jsEnabled) {
    // Execute all of them.
    jQuery.each(moodle.behaviors, function() {
      this(context);
    });
  }
};

moodle.checkPlain = function(str) {
  str = String(str);
  var replace = { '&': '&amp;', '"': '&quot;', '<': '&lt;', '>': '&gt;' };
  for (var character in replace) {
    var regex = new RegExp(character, 'g');
    str = str.replace(regex, replace[character]);
  }
  return str;
};

moodle.t = function(str, args) {
  if (moodle.locale.strings && moodle.locale.strings[str]) {
    str = moodle.locale.strings[str];
  }

  if (args) {
    for (var key in args) {
      switch (key.charAt(0)) {
        case '@':
          args[key] = moodle.checkPlain(args[key]);
        break;
        case '!':
          break;
        case '%':
        default:
          args[key] = moodle.theme('placeholder', args[key]);
          break;
      }
      str = str.replace(key, args[key]);
    }
  }
  return str;
};

moodle.formatPlural = function(count, singular, plural, args) {
  var args = args || {};
  args['@count'] = count;
  var index = moodle.locale.pluralFormula ? moodle.locale.pluralFormula(args['@count']) : ((args['@count'] == 1) ? 0 : 1);

  if (index == 0) {
    return moodle.t(singular, args);
  }
  else if (index == 1) {
    return moodle.t(plural, args);
  }
  else {
    args['@count['+ index +']'] = args['@count'];
    delete args['@count'];
    return moodle.t(plural.replace('@count', '@count['+ index +']'));
  }
};

moodle.theme = function(func) {
  for (var i = 1, args = []; i < arguments.length; i++) {
    args.push(arguments[i]);
  }

  return (moodle.theme[func] || moodle.theme.prototype[func]).apply(this, args);
};

moodle.parseJson = function (data) {
  if ((data.substring(0, 1) != '{') && (data.substring(0, 1) != '[')) {
    return { status: 0, data: data.length ? data : moodle.t('Unspecified error') };
  }
  return eval('(' + data + ');');
};

moodle.freezeHeight = function () {
  moodle.unfreezeHeight();
  var div = document.createElement('div');
  $(div).css({
    position: 'absolute',
    top: '0px',
    left: '0px',
    width: '1px',
    height: $('body').css('height')
  }).attr('id', 'freeze-height');
  $('body').append(div);
};

moodle.unfreezeHeight = function () {
  $('#freeze-height').remove();
};

moodle.encodeURIComponent = function (item, uri) {
  uri = uri || location.href;
  item = encodeURIComponent(item).replace(/%2F/g, '/');
  return (uri.indexOf('?q=') != -1) ? item : item.replace(/%26/g, '%2526').replace(/%23/g, '%2523').replace(/\/\//g, '/%252F');
};

moodle.getSelection = function (element) {
  if (typeof(element.selectionStart) != 'number' && document.selection) {
    var range1 = document.selection.createRange();
    var range2 = range1.duplicate();
    range2.moveToElementText(element);
    range2.setEndPoint('EndToEnd', range1);
    var start = range2.text.length - range1.text.length;
    var end = start + range1.text.length;
    return { 'start': start, 'end': end };
  }
  return { 'start': element.selectionStart, 'end': element.selectionEnd };
};

moodle.ahahError = function(xmlhttp, uri) {
  if (xmlhttp.status == 200) {
    if (jQuery.trim($(xmlhttp.responseText).text())) {
      var message = moodle.t("An error occurred. \n@uri\n@text", {'@uri': uri, '@text': xmlhttp.responseText });
    }
    else {
      var message = moodle.t("An error occurred. \n@uri\n(no information available).", {'@uri': uri, '@text': xmlhttp.responseText });
    }
  }
  else {
    var message = moodle.t("An HTTP error @status occurred. \n@uri", {'@uri': uri, '@status': xmlhttp.status });
  }
  return message;
}

if (moodle.jsEnabled) {
  $(document.documentElement).addClass('js');
  document.cookie = 'has_js=1; path=/';
  $(document).ready(function() {
    moodle.attachBehaviors(this);
  });
}

moodle.theme.prototype = {
  placeholder: function(str) {
    return '<em>' + moodle.checkPlain(str) + '</em>';
  }
};
