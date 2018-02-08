(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Component', ['exports', 'jquery'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery);
    global.Component = mod.exports;
  }
})(this, function (exports, _jquery) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  if (typeof Object.assign === 'undefined') {
    Object.assign = _jquery2.default.extend;
  }
  var Component = function () {
    function Component() {
      var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      babelHelpers.classCallCheck(this, Component);

      this.$el = options.$el ? options.$el : (0, _jquery2.default)(document);
      this.el = this.$el[0];
      delete options.$el;

      this.options = options;

      this.isProcessed = false;
    }

    babelHelpers.createClass(Component, [{
      key: 'initialize',
      value: function initialize() {
        // Initialize the Component
      }
    }, {
      key: 'process',
      value: function process() {
        // Bind the Event on the Component
      }
    }, {
      key: 'run',
      value: function run() {
        // run Component
        if (!this.isProcessed) {
          this.initialize();
          this.process();
        }

        this.isProcessed = true;
      }
    }, {
      key: 'triggerResize',
      value: function triggerResize() {
        if (document.createEvent) {
          var ev = document.createEvent('Event');
          ev.initEvent('resize', true, true);
          window.dispatchEvent(ev);
        } else {
          element = document.documentElement;
          var event = document.createEventObject();
          element.fireEvent('onresize', event);
        }
      }
    }]);
    return Component;
  }();

  exports.default = Component;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Plugin', ['exports', 'jquery'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery);
    global.Plugin = mod.exports;
  }
})(this, function (exports, _jquery) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });
  exports.pluginFactory = exports.getDefaults = exports.getPlugin = exports.getPluginAPI = exports.Plugin = undefined;

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var plugins = {};
  var apis = {};

  var Plugin = function () {
    function Plugin($el) {
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      babelHelpers.classCallCheck(this, Plugin);

      this.name = this.getName();
      this.$el = $el;
      this.options = options;
      this.isRendered = false;
    }

    babelHelpers.createClass(Plugin, [{
      key: 'getName',
      value: function getName() {
        return 'plugin';
      }
    }, {
      key: 'render',
      value: function render() {
        if (_jquery2.default.fn[this.name]) {
          this.$el[this.name](this.options);
        } else {
          return false;
        }
      }
    }, {
      key: 'initialize',
      value: function initialize() {
        if (this.isRendered) {
          return false;
        }
        this.render();
        this.isRendered = true;
      }
    }], [{
      key: 'getDefaults',
      value: function getDefaults() {
        return {};
      }
    }, {
      key: 'register',
      value: function register(name, obj) {
        if (typeof obj === 'undefined') {
          return;
        }

        plugins[name] = obj;

        if (typeof obj.api !== 'undefined') {
          Plugin.registerApi(name, obj);
        }
      }
    }, {
      key: 'registerApi',
      value: function registerApi(name, obj) {
        var api = obj.api();

        if (typeof api === 'string') {
          var _api = obj.api().split('|');
          var event = _api[0] + ('.plugin.' + name);
          var func = _api[1] || 'render';

          var callback = function callback(e) {
            var $el = (0, _jquery2.default)(this);
            var plugin = $el.data('pluginInstance');

            if (!plugin) {
              plugin = new obj($el, _jquery2.default.extend(true, {}, getDefaults(name), $el.data()));
              plugin.initialize();
              $el.data('pluginInstance', plugin);
            }

            plugin[func](e);
          };

          apis[name] = function (selector, context) {
            if (context) {
              (0, _jquery2.default)(context).off(event);
              (0, _jquery2.default)(context).on(event, selector, callback);
            } else {
              (0, _jquery2.default)(selector).on(event, callback);
            }
          };
        } else if (typeof api === 'function') {
          apis[name] = api;
        }
      }
    }]);
    return Plugin;
  }();

  function getPluginAPI(name) {
    if (typeof name === 'undefined') {
      return apis;
    } else {
      return apis[name];
    }
  }

  function getPlugin(name) {
    if (typeof plugins[name] !== 'undefined') {
      return plugins[name];
    } else {
      console.warn('Plugin:' + name + ' has no warpped class.');
      return false;
    }
  }

  function getDefaults(name) {
    var PluginClass = getPlugin(name);

    if (PluginClass) {
      return PluginClass.getDefaults();
    } else {
      return {};
    }
  }

  function pluginFactory(name, $el) {
    var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

    var PluginClass = getPlugin(name);

    if (PluginClass && typeof PluginClass.api === 'undefined') {
      return new PluginClass($el, _jquery2.default.extend(true, {}, getDefaults(name), options));
    } else if (_jquery2.default.fn[name]) {
      var plugin = new Plugin($el, options);
      plugin.getName = function () {
        return name;
      };
      plugin.name = name;
      return plugin;
    } else if (typeof PluginClass.api !== 'undefined') {
      // console.log('Plugin:' + name + ' use api render.');
      return false;
    } else {
      console.warn('Plugin:' + name + ' script is not loaded.');
      return false;
    }
  }

  exports.Plugin = Plugin;
  exports.getPluginAPI = getPluginAPI;
  exports.getPlugin = getPlugin;
  exports.getDefaults = getDefaults;
  exports.pluginFactory = pluginFactory;
  exports.default = Plugin;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Base', ['exports', 'jquery', 'Component', 'Plugin'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'), require('Component'), require('Plugin'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Component, global.Plugin);
    global.Base = mod.exports;
  }
})(this, function (exports, _jquery, _Component2, _Plugin) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var _Component3 = babelHelpers.interopRequireDefault(_Component2);

  var Base = function (_Component) {
    babelHelpers.inherits(Base, _Component);

    function Base() {
      babelHelpers.classCallCheck(this, Base);
      return babelHelpers.possibleConstructorReturn(this, (Base.__proto__ || Object.getPrototypeOf(Base)).apply(this, arguments));
    }

    babelHelpers.createClass(Base, [{
      key: 'initializePlugins',
      value: function initializePlugins() {
        var context = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

        (0, _jquery2.default)('[data-plugin]', context || this.$el).each(function () {
          var $this = (0, _jquery2.default)(this),
              name = $this.data('plugin'),
              plugin = (0, _Plugin.pluginFactory)(name, $this, $this.data());

          if (plugin) {
            plugin.initialize();
          }
        });
      }
    }, {
      key: 'initializePluginAPIs',
      value: function initializePluginAPIs() {
        var context = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;

        var apis = (0, _Plugin.getPluginAPI)();

        for (var name in apis) {
          (0, _Plugin.getPluginAPI)(name)('[data-plugin=' + name + ']', context);
        }
      }
    }]);
    return Base;
  }(_Component3.default);

  exports.default = Base;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Config', ['exports'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports);
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports);
    global.Config = mod.exports;
  }
})(this, function (exports) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });
  var values = {
    fontFamily: 'Noto Sans, sans-serif',
    primaryColor: 'blue',
    assets: '../assets'
  };

  function get() {
    var data = values;
    var callback = function callback(data, name) {
      return data[name];
    };

    for (var _len = arguments.length, names = Array(_len), _key = 0; _key < _len; _key++) {
      names[_key] = arguments[_key];
    }

    for (var i = 0; i < names.length; i++) {
      var name = names[i];

      data = callback(data, name);
    }

    return data;
  }

  function set(name, value) {
    if (typeof name === 'string' && typeof value !== 'undefined') {
      values[name] = value;
    } else if ((typeof name === 'undefined' ? 'undefined' : babelHelpers.typeof(name)) === 'object') {
      values = $.extend(true, {}, values, name);
    }
  }

  function getColor(name, level) {
    if (name === 'primary') {
      name = get('primaryColor');
      if (!name) {
        name = 'red';
      }
    }

    if (typeof values.colors === 'undefined') {
      return null;
    }

    if (typeof values.colors[name] !== 'undefined') {
      if (level && typeof values.colors[name][level] !== 'undefined') {
        return values.colors[name][level];
      }

      if (typeof level === 'undefined') {
        return values.colors[name];
      }
    }

    return null;
  }

  function colors(name, level) {
    return getColor(name, level);
  }

  exports.get = get;
  exports.set = set;
  exports.getColor = getColor;
  exports.colors = colors;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Section/Menubar', ['exports', 'jquery', 'Component'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'), require('Component'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Component);
    global.SectionMenubar = mod.exports;
  }
})(this, function (exports, _jquery, _Component2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var _Component3 = babelHelpers.interopRequireDefault(_Component2);

  var $BODY = (0, _jquery2.default)('body');
  var $HTML = (0, _jquery2.default)('html');

  var Scrollable = function () {
    function Scrollable($el) {
      babelHelpers.classCallCheck(this, Scrollable);

      this.$el = $el;
      this.native = false;
      this.api = null;

      this.init();
    }

    babelHelpers.createClass(Scrollable, [{
      key: 'init',
      value: function init() {
        if ($BODY.is('.site-menubar-native')) {
          this.native = true;
          return;
        }

        this.api = this.$el.asScrollable({
          namespace: 'scrollable',
          skin: 'scrollable-inverse',
          direction: 'vertical',
          contentSelector: '>',
          containerSelector: '>'
        }).data('asScrollable');
      }
    }, {
      key: 'update',
      value: function update() {
        if (this.api) {
          this.api.update();
        }
      }
    }, {
      key: 'enable',
      value: function enable() {
        if (this.native) {
          return;
        }
        if (!this.api) {
          this.init();
        }
        if (this.api) {
          this.api.enable();
        }
      }
    }, {
      key: 'disable',
      value: function disable() {
        if (this.api) {
          this.api.disable();
        }
      }
    }]);
    return Scrollable;
  }();

  var Menubar = function (_Component) {
    babelHelpers.inherits(Menubar, _Component);

    function Menubar() {
      var _ref;

      babelHelpers.classCallCheck(this, Menubar);

      for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      var _this = babelHelpers.possibleConstructorReturn(this, (_ref = Menubar.__proto__ || Object.getPrototypeOf(Menubar)).call.apply(_ref, [this].concat(args)));

      _this.setupMenu();
      _this.$menuBody = _this.$el.children('.mm-panels');

      // state
      _this.type = 'fold'; // unfold, fold, open, hide;
      return _this;
    }

    babelHelpers.createClass(Menubar, [{
      key: 'initialize',
      value: function initialize() {
        if (this.$menuBody.length > 0) {
          this.initialized = true;
        } else {
          this.initialized = false;
          return;
        }

        this.scrollable = new Scrollable(this.$menuBody);

        $HTML.removeClass('css-menubar').addClass('js-menubar');

        this.change(this.type);
      }
    }, {
      key: 'setupMenu',
      value: function setupMenu() {
        if (typeof _jquery2.default.fn.mmenu !== 'undefined') {
          this.$el.mmenu({
            offCanvas: false,
            navbars: [{
              position: 'bottom',
              content: ['<div class="site-menubar-footer">\n              <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Settings">\n                <span class="icon wb-settings" aria-hidden="true"></span>\n              </a>\n              <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">\n                <span class="icon wb-eye-close" aria-hidden="true"></span>\n              </a>\n              <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout">\n                <span class="icon wb-power" aria-hidden="true"></span>\n              </a>\n            </div>']
            }]
          });
        }
      }
    }, {
      key: 'getMenuApi',
      value: function getMenuApi() {
        return this.$el.data('mmenu');
      }
    }, {
      key: 'update',
      value: function update() {
        this.scrollable.update();
      }
    }, {
      key: 'change',
      value: function change(type) {
        if (this.initialized) {
          this.reset();
          this[type]();
        }
      }
    }, {
      key: 'animate',
      value: function animate(doing) {
        var _this2 = this;

        var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : function () {};

        $BODY.addClass('site-menubar-changing');

        doing.call(this);

        this.$el.trigger('changing.site.menubar');

        setTimeout(function () {
          callback.call(_this2);
          $BODY.removeClass('site-menubar-changing');
          _this2.update();
          _this2.$el.trigger('changed.site.menubar');
        }, 500);
      }
    }, {
      key: 'hoverTrigger',
      value: function hoverTrigger() {
        var _this3 = this;

        this.$el.on('mouseenter', function () {
          $BODY.addClass('site-menubar-hover');

          setTimeout(function () {
            _this3.scrollable.enable();
          }, 500);
        }).on('mouseleave', function () {
          $BODY.removeClass('site-menubar-hover');

          var api = _this3.getMenuApi();
          if (api) {
            api.openPanel((0, _jquery2.default)('#mm-0'));
          }

          setTimeout(function () {
            _this3.scrollable.disable();
          }, 500);
        });
      }
    }, {
      key: 'hoverTriggerOff',
      value: function hoverTriggerOff() {
        this.$el.off('mouseenter');
        this.$el.off('mouseleave');
      }
    }, {
      key: 'reset',
      value: function reset() {
        $BODY.removeClass('site-menubar-hide site-menubar-open site-menubar-fold site-menubar-unfold');
        $HTML.removeClass('disable-scrolling');
      }
    }, {
      key: 'open',
      value: function open() {
        this.animate(function () {
          $BODY.addClass('site-menubar-open site-menubar-unfold');

          $HTML.addClass('disable-scrolling');
        }, function () {
          this.scrollable.enable();
        });

        this.type = 'open';
      }
    }, {
      key: 'hide',
      value: function hide() {
        this.animate(function () {
          $BODY.addClass('site-menubar-hide site-menubar-unfold');
        }, function () {
          this.scrollable.enable();
        });

        this.type = 'hide';
      }
    }, {
      key: 'unfold',
      value: function unfold() {
        this.animate(function () {
          $BODY.addClass('site-menubar-unfold');
          this.hoverTriggerOff();
        }, function () {
          this.scrollable.enable();

          this.triggerResize();
        });

        this.type = 'unfold';
      }
    }, {
      key: 'fold',
      value: function fold() {
        this.scrollable.disable();

        this.animate(function () {

          $BODY.addClass('site-menubar-fold');
          this.hoverTrigger();
        }, function () {
          this.triggerResize();
        });

        this.type = 'fold';
      }
    }]);
    return Menubar;
  }(_Component3.default);

  exports.default = Menubar;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Section/Sidebar', ['exports', 'jquery', 'Base', 'Plugin'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'), require('Base'), require('Plugin'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Base, global.Plugin);
    global.SectionSidebar = mod.exports;
  }
})(this, function (exports, _jquery, _Base2, _Plugin) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var _Base3 = babelHelpers.interopRequireDefault(_Base2);

  var Sidebar = function (_Base) {
    babelHelpers.inherits(Sidebar, _Base);

    function Sidebar() {
      babelHelpers.classCallCheck(this, Sidebar);
      return babelHelpers.possibleConstructorReturn(this, (Sidebar.__proto__ || Object.getPrototypeOf(Sidebar)).apply(this, arguments));
    }

    babelHelpers.createClass(Sidebar, [{
      key: 'process',
      value: function process() {
        if (typeof _jquery2.default.slidePanel === 'undefined') {
          return;
        }
        var sidebar = this;
        (0, _jquery2.default)(document).on('click', '[data-toggle="site-sidebar"]', function () {
          var $this = (0, _jquery2.default)(this);

          var direction = 'right';
          if ((0, _jquery2.default)('body').hasClass('site-menubar-flipped')) {
            direction = 'left';
          }

          var options = _jquery2.default.extend({}, (0, _Plugin.getDefaults)('slidePanel'), {
            direction: direction,
            skin: 'site-sidebar',
            dragTolerance: 80,
            template: function template(options) {
              return '<div class="' + options.classes.base + ' ' + options.classes.base + '-' + options.direction + '">\n\t    <div class="' + options.classes.content + ' site-sidebar-content"></div>\n\t    <div class="slidePanel-handler"></div>\n\t    </div>';
            },
            afterLoad: function afterLoad() {
              var self = this;
              this.$panel.find('.tab-pane').asScrollable({
                namespace: 'scrollable',
                contentSelector: '> div',
                containerSelector: '> div'
              });

              sidebar.initializePlugins(self.$panel);

              this.$panel.on('shown.bs.tab', function () {
                self.$panel.find('.tab-pane.active').asScrollable('update');
              });
            },
            beforeShow: function beforeShow() {
              if (!$this.hasClass('active')) {
                $this.addClass('active');
              }
            },
            afterHide: function afterHide() {
              if ($this.hasClass('active')) {
                $this.removeClass('active');
              }
            }
          });

          if ($this.hasClass('active')) {
            _jquery2.default.slidePanel.hide();
          } else {
            var url = $this.data('url');
            if (!url) {
              url = $this.attr('href');
              url = url && url.replace(/.*(?=#[^\s]*$)/, '');
            }

            _jquery2.default.slidePanel.show({
              url: url
            }, options);
          }
        });

        (0, _jquery2.default)(document).on('click', '[data-toggle="show-chat"]', function () {
          (0, _jquery2.default)('#conversation').addClass('active');
        });

        (0, _jquery2.default)(document).on('click', '[data-toggle="close-chat"]', function () {
          (0, _jquery2.default)('#conversation').removeClass('active');
        });
      }
    }]);
    return Sidebar;
  }(_Base3.default);

  exports.default = Sidebar;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Section/PageAside', ['exports', 'jquery', 'Component'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'), require('Component'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Component);
    global.SectionPageAside = mod.exports;
  }
})(this, function (exports, _jquery, _Component2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var _Component3 = babelHelpers.interopRequireDefault(_Component2);

  var $BODY = (0, _jquery2.default)('body');

  var PageAside = function (_Component) {
    babelHelpers.inherits(PageAside, _Component);

    function PageAside() {
      var _ref;

      babelHelpers.classCallCheck(this, PageAside);

      for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      var _this = babelHelpers.possibleConstructorReturn(this, (_ref = PageAside.__proto__ || Object.getPrototypeOf(PageAside)).call.apply(_ref, [this].concat(args)));

      _this.$scroll = _this.$el.find('.page-aside-scroll');
      _this.scrollable = _this.$scroll.asScrollable({
        namespace: 'scrollable',
        contentSelector: '> [data-role=\'content\']',
        containerSelector: '> [data-role=\'container\']'
      }).data('asScrollable');
      return _this;
    }

    babelHelpers.createClass(PageAside, [{
      key: 'process',
      value: function process() {
        var _this2 = this;

        if ($BODY.is('.page-aside-fixed') || $BODY.is('.page-aside-scroll')) {
          this.$el.on('transitionend', function () {
            _this2.scrollable.update();
          });
        }

        Breakpoints.on('change', function () {
          var current = Breakpoints.current().name;

          if (!$BODY.is('.page-aside-fixed') && !$BODY.is('.page-aside-scroll')) {
            if (current === 'xs') {
              _this2.scrollable.enable();
              _this2.$el.on('transitionend', function () {
                _this2.scrollable.update();
              });
            } else {
              _this2.$el.off('transitionend');
              _this2.scrollable.update();
            }
          }
        });

        (0, _jquery2.default)(document).on('click.pageAsideScroll', '.page-aside-switch', function () {
          var isOpen = _this2.$el.hasClass('open');

          if (isOpen) {
            _this2.$el.removeClass('open');
          } else {
            _this2.scrollable.update();
            _this2.$el.addClass('open');
          }
        });

        (0, _jquery2.default)(document).on('click.pageAsideScroll', '[data-toggle="collapse"]', function (e) {
          var $trigger = (0, _jquery2.default)(e.target);
          if (!$trigger.is('[data-toggle="collapse"]')) {
            $trigger = $trigger.parents('[data-toggle="collapse"]');
          }
          var href = void 0;
          var target = $trigger.attr('data-target') || (href = $trigger.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '');
          var $target = (0, _jquery2.default)(target);

          if ($target.attr('id') === 'site-navbar-collapse') {
            _this2.scrollable.update();
          }
        });
      }
    }]);
    return PageAside;
  }(_Component3.default);

  exports.default = PageAside;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Section/GridMenu', ['exports', 'jquery', 'Component'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'), require('Component'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Component);
    global.SectionGridMenu = mod.exports;
  }
})(this, function (exports, _jquery, _Component2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var _Component3 = babelHelpers.interopRequireDefault(_Component2);

  var $BODY = (0, _jquery2.default)('body');
  var $HTML = (0, _jquery2.default)('html');

  var Scrollable = function () {
    function Scrollable($el) {
      babelHelpers.classCallCheck(this, Scrollable);

      this.$el = $el;
      this.api = null;

      this.init();
    }

    babelHelpers.createClass(Scrollable, [{
      key: 'init',
      value: function init() {
        this.api = this.$el.asScrollable({
          namespace: 'scrollable',
          skin: 'scrollable-inverse',
          direction: 'vertical',
          contentSelector: '>',
          containerSelector: '>'
        }).data('asScrollable');
      }
    }, {
      key: 'update',
      value: function update() {
        if (this.api) {
          this.api.update();
        }
      }
    }, {
      key: 'enable',
      value: function enable() {
        if (!this.api) {
          this.init();
        }
        if (this.api) {
          this.api.enable();
        }
      }
    }, {
      key: 'disable',
      value: function disable() {
        if (this.api) {
          this.api.disable();
        }
      }
    }]);
    return Scrollable;
  }();

  var GridMenu = function (_Component) {
    babelHelpers.inherits(GridMenu, _Component);

    function GridMenu() {
      var _ref;

      babelHelpers.classCallCheck(this, GridMenu);

      for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      var _this = babelHelpers.possibleConstructorReturn(this, (_ref = GridMenu.__proto__ || Object.getPrototypeOf(GridMenu)).call.apply(_ref, [this].concat(args)));

      _this.isOpened = false;
      _this.scrollable = new Scrollable(_this.$el);
      return _this;
    }

    babelHelpers.createClass(GridMenu, [{
      key: 'open',
      value: function open() {
        this.animate(function () {
          this.$el.addClass('active');

          (0, _jquery2.default)('[data-toggle="gridmenu"]').addClass('active').attr('aria-expanded', true);

          $BODY.addClass('site-gridmenu-active');
          $HTML.addClass('disable-scrolling');
        }, function () {
          this.scrollable.enable();
        });

        this.isOpened = true;
      }
    }, {
      key: 'close',
      value: function close() {
        this.animate(function () {

          this.$el.removeClass('active');

          (0, _jquery2.default)('[data-toggle="gridmenu"]').addClass('active').attr('aria-expanded', true);

          $BODY.removeClass('site-gridmenu-active');
          $HTML.removeClass('disable-scrolling');
        }, function () {
          this.scrollable.disable();
        });

        this.isOpened = false;
      }
    }, {
      key: 'toggle',
      value: function toggle(opened) {
        if (opened) {
          this.open();
        } else {
          this.close();
        }
      }
    }, {
      key: 'animate',
      value: function animate(doing, callback) {
        var _this2 = this;

        doing.call(this);
        this.$el.trigger('changing.site.gridmenu');

        setTimeout(function () {
          callback.call(_this2);

          _this2.$el.trigger('changed.site.gridmenu');
        }, 500);
      }
    }]);
    return GridMenu;
  }(_Component3.default);

  exports.default = GridMenu;
});