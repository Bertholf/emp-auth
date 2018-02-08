(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Site', ['exports', 'jquery', 'Base', 'Menubar', 'Sidebar', 'PageAside', 'GridMenu'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'), require('Base'), require('Menubar'), require('Sidebar'), require('PageAside'), require('GridMenu'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Base, global.SectionMenubar, global.SectionSidebar, global.SectionPageAside, global.SectionGridMenu);
    global.Site = mod.exports;
  }
})(this, function (exports, _jquery, _Base2, _Menubar, _Sidebar, _PageAside, _GridMenu) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });
  exports.getInstance = exports.run = exports.Site = undefined;

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var _Base3 = babelHelpers.interopRequireDefault(_Base2);

  var _Menubar2 = babelHelpers.interopRequireDefault(_Menubar);

  var _Sidebar2 = babelHelpers.interopRequireDefault(_Sidebar);

  var _PageAside2 = babelHelpers.interopRequireDefault(_PageAside);

  var _GridMenu2 = babelHelpers.interopRequireDefault(_GridMenu);

  var DOC = document;
  var $DOC = (0, _jquery2.default)(document);
  var $BODY = (0, _jquery2.default)('body');

  var Site = function (_Base) {
    babelHelpers.inherits(Site, _Base);

    function Site() {
      babelHelpers.classCallCheck(this, Site);
      return babelHelpers.possibleConstructorReturn(this, (Site.__proto__ || Object.getPrototypeOf(Site)).apply(this, arguments));
    }

    babelHelpers.createClass(Site, [{
      key: 'initialize',
      value: function initialize() {
        var _this2 = this;

        this.startLoading();
        this.initializePluginAPIs();
        this.initializePlugins();

        this.initComponents();
        setTimeout(function () {
          _this2.setDefaultState();
        }, 500);
      }
    }, {
      key: 'process',
      value: function process() {
        this.polyfillIEWidth();
        this.initBootstrap();

        this.setupMenubar();
        this.setupFullScreen();
        this.setupMegaNavbar();
        this.setupTour();
        this.setupNavbarCollpase();
        this.setupGridMenu();

        // Dropdown menu setup
        // ===================
        this.$el.on('click', '.dropdown-menu-media', function (e) {
          e.stopPropagation();
        });
      }
    }, {
      key: '_getDefaultMeunbarType',
      value: function _getDefaultMeunbarType() {
        var breakpoint = this.getCurrentBreakpoint(),
            type = false;

        if ($BODY.data('autoMenubar') === false || $BODY.is('.site-menubar-keep')) {
          if ($BODY.hasClass('site-menubar-fold')) {
            type = 'fold';
          } else if ($BODY.hasClass('site-menubar-unfold')) {
            type = 'unfold';
          }
        }

        switch (breakpoint) {
          case 'lg':
          case 'md':
          case 'sm':
            type = type || 'fold';
            break;
          case 'xs':
            type = 'hide';
            break;
        }
        return type;
      }
    }, {
      key: 'menubarType',
      value: function menubarType(type) {
        var toggle = function toggle($el) {
          $el.toggleClass('hided', !(type === 'open'));
          $el.toggleClass('unfolded', !(type === 'fold'));
        };

        (0, _jquery2.default)('[data-toggle="menubar"]').each(function () {
          var $this = (0, _jquery2.default)(this);
          var $hamburger = (0, _jquery2.default)(this).find('.hamburger');

          if ($hamburger.length > 0) {
            toggle($hamburger);
          } else {
            toggle($this);
          }
        });
      }
    }, {
      key: 'initComponents',
      value: function initComponents() {
        this.menubar = new _Menubar2.default({
          $el: (0, _jquery2.default)('.site-menubar')
        });

        this.gridmenu = new _GridMenu2.default({
          $el: (0, _jquery2.default)('.site-gridmenu')
        });
        this.sidebar = new _Sidebar2.default();

        var $aside = (0, _jquery2.default)('.page-aside');
        if ($aside.length > 0) {
          this.aside = new _PageAside2.default({
            $el: $aside
          });

          this.aside.run();
        }

        this.menubar.run();
        this.gridmenu.run();
      }
    }, {
      key: 'setDefaultState',
      value: function setDefaultState() {
        this.menubar.change(this._getDefaultMeunbarType());
      }
    }, {
      key: 'getCurrentBreakpoint',
      value: function getCurrentBreakpoint() {
        var bp = Breakpoints.current();
        return bp ? bp.name : 'lg';
      }
    }, {
      key: 'initBootstrap',
      value: function initBootstrap() {
        // Tooltip setup
        // =============
        $DOC.tooltip({
          selector: '[data-tooltip=true]',
          container: 'body'
        });

        (0, _jquery2.default)('[data-toggle="tooltip"]').tooltip();
        (0, _jquery2.default)('[data-toggle="popover"]').popover();
      }
    }, {
      key: 'polyfillIEWidth',
      value: function polyfillIEWidth() {
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
          var msViewportStyle = DOC.createElement('style');
          msViewportStyle.appendChild(DOC.createTextNode('@-ms-viewport{width:auto!important}'));
          DOC.querySelector('head').appendChild(msViewportStyle);
        }
      }
    }, {
      key: 'setupGridMenu',
      value: function setupGridMenu() {
        var self = this;
        $DOC.on('click', '[data-toggle="gridmenu"]', function () {
          var $this = (0, _jquery2.default)(this);
          var isOpened = self.gridmenu.isOpened;

          if (isOpened) {
            $this.addClass('active').attr('aria-expanded', true);
          } else {
            $this.removeClass('active').attr('aria-expanded', false);
          }

          self.gridmenu.toggle(!isOpened);
        });
      }
    }, {
      key: 'setupFullScreen',
      value: function setupFullScreen() {
        if (typeof screenfull !== 'undefined') {
          $DOC.on('click', '[data-toggle="fullscreen"]', function () {
            if (screenfull.enabled) {
              screenfull.toggle();
            }

            return false;
          });

          if (screenfull.enabled) {
            DOC.addEventListener(screenfull.raw.fullscreenchange, function () {
              (0, _jquery2.default)('[data-toggle="fullscreen"]').toggleClass('active', screenfull.isFullscreen);
            });
          }
        }
      }
    }, {
      key: 'setupMegaNavbar',
      value: function setupMegaNavbar() {
        $DOC.on('click', '.navbar-mega .dropdown-menu', function (e) {
          e.stopPropagation();
        }).on('show.bs.dropdown', function (e) {
          var $target = (0, _jquery2.default)(e.target);
          var $trigger = e.relatedTarget ? (0, _jquery2.default)(e.relatedTarget) : $target.children('[data-toggle="dropdown"]');
          var animation = $trigger.data('animation');

          if (animation) {
            var $menu = $target.children('.dropdown-menu');
            $menu.addClass('animation-' + animation).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
              $menu.removeClass('animation-' + animation);
            });
          }
        }).on('shown.bs.dropdown', function (e) {
          var $menu = (0, _jquery2.default)(e.target).find('.dropdown-menu-media > .list-group');

          if ($menu.length > 0) {
            var api = $menu.data('asScrollable');
            if (api) {
              api.update();
            } else {
              $menu.asScrollable({
                namespace: 'scrollable',
                contentSelector: '> [data-role=\'content\']',
                containerSelector: '> [data-role=\'container\']'
              });
            }
          }
        });
      }
    }, {
      key: 'setupMenubar',
      value: function setupMenubar() {
        var _this3 = this;

        (0, _jquery2.default)(document).on('click', '[data-toggle="menubar"]', function () {
          var type = _this3.menubar.type;

          switch (type) {
            case 'fold':
              type = 'unfold';
              break;
            case 'unfold':
              type = 'fold';
              break;
            case 'open':
              type = 'hide';
              break;
            case 'hide':
              type = 'open';
              break;
            // no default
          }

          _this3.menubar.change(type);
          _this3.menubarType(type);
          return false;
        });

        Breakpoints.on('change', function () {
          _this3.menubar.type = _this3._getDefaultMeunbarType();
          _this3.menubar.change(_this3.menubar.type);
        });
      }
    }, {
      key: 'setupNavbarCollpase',
      value: function setupNavbarCollpase() {
        (0, _jquery2.default)(document).on('click', "[data-target='#site-navbar-collapse']", function (e) {
          var $trigger = (0, _jquery2.default)(this);
          var isClose = $trigger.hasClass('collapsed');
          $BODY.addClass("site-navbar-collapsing");
          $BODY.toggleClass("site-navbar-collapse-show", !isClose);
          setTimeout(function () {
            $BODY.removeClass("site-navbar-collapsing");
          }, 350);
        });
      }
    }, {
      key: 'startLoading',
      value: function startLoading() {
        if (typeof _jquery2.default.fn.animsition === 'undefined') {
          return false;
        }

        // let loadingType = 'default';
        $BODY.animsition({
          inClass: 'fade-in',
          inDuration: 800,
          loading: true,
          loadingClass: 'loader-overlay',
          loadingParentElement: 'html',
          loadingInner: '\n      <div class="loader-content">\n        <div class="loader-index">\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n        </div>\n      </div>',
          onLoadEvent: true
        });
      }
    }, {
      key: 'setupTour',
      value: function setupTour(flag) {
        if (typeof this.tour === 'undefined') {
          if (typeof introJs === 'undefined') {
            return;
          }
          var overflow = (0, _jquery2.default)('body').css('overflow'),
              self = this,
              tourOptions = Config.get('tour');

          this.tour = introJs();

          this.tour.onbeforechange(function () {
            (0, _jquery2.default)('body').css('overflow', 'hidden');
          });

          this.tour.oncomplete(function () {
            (0, _jquery2.default)('body').css('overflow', overflow);
          });

          this.tour.onexit(function () {
            (0, _jquery2.default)('body').css('overflow', overflow);
          });

          this.tour.setOptions(tourOptions);
          (0, _jquery2.default)('.site-tour-trigger').on('click', function () {
            self.tour.start();
          });
        }
        // if (window.localStorage && window.localStorage.getItem('startTour') && (flag !== true)) {
        //   return;
        // } else {
        //   this.tour.start();
        //   window.localStorage.setItem('startTour', true);
        // }
      }
    }]);
    return Site;
  }(_Base3.default);

  var instance = null;

  function getInstance() {
    if (!instance) {
      instance = new Site();
    }
    return instance;
  }

  function run() {
    var site = getInstance();
    site.run();
  }

  exports.Site = Site;
  exports.run = run;
  exports.getInstance = getInstance;
  exports.default = Site;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Plugin/asscrollable', ['exports', 'Plugin'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('Plugin'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.Plugin);
    global.PluginAsscrollable = mod.exports;
  }
})(this, function (exports, _Plugin2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _Plugin3 = babelHelpers.interopRequireDefault(_Plugin2);

  var NAME = 'scrollable';

  var Scrollable = function (_Plugin) {
    babelHelpers.inherits(Scrollable, _Plugin);

    function Scrollable() {
      babelHelpers.classCallCheck(this, Scrollable);
      return babelHelpers.possibleConstructorReturn(this, (Scrollable.__proto__ || Object.getPrototypeOf(Scrollable)).apply(this, arguments));
    }

    babelHelpers.createClass(Scrollable, [{
      key: 'getName',
      value: function getName() {
        return NAME;
      }
    }, {
      key: 'render',
      value: function render() {
        var $el = this.$el;

        $el.asScrollable(this.options);
      }
    }], [{
      key: 'getDefaults',
      value: function getDefaults() {
        return {
          namespace: 'scrollable',
          contentSelector: "> [data-role='content']",
          containerSelector: "> [data-role='container']"
        };
      }
    }]);
    return Scrollable;
  }(_Plugin3.default);

  _Plugin3.default.register(NAME, Scrollable);

  exports.default = Scrollable;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Plugin/slidepanel', ['exports', 'jquery', 'Plugin'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'), require('Plugin'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Plugin);
    global.PluginSlidepanel = mod.exports;
  }
})(this, function (exports, _jquery, _Plugin2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var _Plugin3 = babelHelpers.interopRequireDefault(_Plugin2);

  var NAME = 'slidePanel';

  var SlidePanel = function (_Plugin) {
    babelHelpers.inherits(SlidePanel, _Plugin);

    function SlidePanel() {
      babelHelpers.classCallCheck(this, SlidePanel);
      return babelHelpers.possibleConstructorReturn(this, (SlidePanel.__proto__ || Object.getPrototypeOf(SlidePanel)).apply(this, arguments));
    }

    babelHelpers.createClass(SlidePanel, [{
      key: 'getName',
      value: function getName() {
        return NAME;
      }
    }, {
      key: 'render',
      value: function render() {
        if (typeof _jquery2.default.slidePanel === 'undefined') {
          return;
        }
        if (!this.options.url) {
          this.options.url = this.$el.attr('href');
          this.options.url = this.options.url && this.options.url.replace(/.*(?=#[^\s]*$)/, '');
        }

        this.$el.data('slidePanelWrapAPI', this);
      }
    }, {
      key: 'show',
      value: function show() {
        var options = this.options;

        _jquery2.default.slidePanel.show({
          url: options.url
        }, options);
      }
    }], [{
      key: 'getDefaults',
      value: function getDefaults() {
        return {
          closeSelector: '.slidePanel-close',
          mouseDragHandler: '.slidePanel-handler',
          loading: {
            template: function template(options) {
              return '<div class="' + options.classes.loading + '">\n                    <div class="loader loader-default"></div>\n                  </div>';
            },
            showCallback: function showCallback(options) {
              this.$el.addClass(options.classes.loading + '-show');
            },
            hideCallback: function hideCallback(options) {
              this.$el.removeClass(options.classes.loading + '-show');
            }
          }
        };
      }
    }, {
      key: 'api',
      value: function api() {
        return 'click|show';
      }
    }]);
    return SlidePanel;
  }(_Plugin3.default);

  _Plugin3.default.register(NAME, SlidePanel);

  exports.default = SlidePanel;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Plugin/switchery', ['exports', 'Plugin', 'Config'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('Plugin'), require('Config'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.Plugin, global.Config);
    global.PluginSwitchery = mod.exports;
  }
})(this, function (exports, _Plugin2, _Config) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _Plugin3 = babelHelpers.interopRequireDefault(_Plugin2);

  var NAME = 'switchery';

  var SwitcheryPlugin = function (_Plugin) {
    babelHelpers.inherits(SwitcheryPlugin, _Plugin);

    function SwitcheryPlugin() {
      babelHelpers.classCallCheck(this, SwitcheryPlugin);
      return babelHelpers.possibleConstructorReturn(this, (SwitcheryPlugin.__proto__ || Object.getPrototypeOf(SwitcheryPlugin)).apply(this, arguments));
    }

    babelHelpers.createClass(SwitcheryPlugin, [{
      key: 'getName',
      value: function getName() {
        return NAME;
      }
    }, {
      key: 'render',
      value: function render() {
        if (typeof Switchery === 'undefined') {
          return;
        }
        new Switchery(this.$el[0], this.options);
      }
    }], [{
      key: 'getDefaults',
      value: function getDefaults() {
        return {
          color: (0, _Config.colors)('primary', 600)
        };
      }
    }]);
    return SwitcheryPlugin;
  }(_Plugin3.default);

  _Plugin3.default.register(NAME, SwitcheryPlugin);

  exports.default = SwitcheryPlugin;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Plugin/bootstrap-select', ['exports', 'Plugin'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('Plugin'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.Plugin);
    global.PluginBootstrapSelect = mod.exports;
  }
})(this, function (exports, _Plugin2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _Plugin3 = babelHelpers.interopRequireDefault(_Plugin2);

  var NAME = 'selectpicker';

  var Selectpicker = function (_Plugin) {
    babelHelpers.inherits(Selectpicker, _Plugin);

    function Selectpicker() {
      babelHelpers.classCallCheck(this, Selectpicker);
      return babelHelpers.possibleConstructorReturn(this, (Selectpicker.__proto__ || Object.getPrototypeOf(Selectpicker)).apply(this, arguments));
    }

    babelHelpers.createClass(Selectpicker, [{
      key: 'getName',
      value: function getName() {
        return NAME;
      }
    }], [{
      key: 'getDefaults',
      value: function getDefaults() {
        return {
          style: 'btn-select',
          iconBase: 'icon',
          tickIcon: 'wb-check'
        };
      }
    }]);
    return Selectpicker;
  }(_Plugin3.default);

  _Plugin3.default.register(NAME, Selectpicker);

  exports.default = Selectpicker;
});
(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Plugin/bootstrap-sweetalert', ['exports', 'Plugin'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('Plugin'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.Plugin);
    global.PluginBootstrapSweetalert = mod.exports;
  }
})(this, function (exports, _Plugin2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _Plugin3 = babelHelpers.interopRequireDefault(_Plugin2);

  var NAME = 'sweetalert';

  var Sweetalert = function (_Plugin) {
    babelHelpers.inherits(Sweetalert, _Plugin);

    function Sweetalert() {
      babelHelpers.classCallCheck(this, Sweetalert);
      return babelHelpers.possibleConstructorReturn(this, (Sweetalert.__proto__ || Object.getPrototypeOf(Sweetalert)).apply(this, arguments));
    }

    babelHelpers.createClass(Sweetalert, [{
      key: 'getName',
      value: function getName() {
        return NAME;
      }
    }, {
      key: 'render',
      value: function render() {
        this.$el.data('sweetalertWrapApi', this);
      }
    }, {
      key: 'show',
      value: function show() {
        if (typeof swal === 'undefined') {
          return;
        }

        swal(this.options);
      }
    }], [{
      key: 'api',
      value: function api() {
        return 'click|show';
      }
    }]);
    return Sweetalert;
  }(_Plugin3.default);

  _Plugin3.default.register(NAME, Sweetalert);

  exports.default = Sweetalert;
});