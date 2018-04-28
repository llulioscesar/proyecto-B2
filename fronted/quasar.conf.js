// Configuration for your app

module.exports = function (ctx) {
  return {
    // app plugins (/src/plugins)
    plugins: [
      'axios',
      'moment'
    ],
    css: [
      'app.styl'
    ],
    extras: [
      ctx.theme.mat ? 'roboto-font' : null,
      'material-icons'
      // 'ionicons',
      // 'mdi',
      // 'fontawesome'
    ],
    supportIE: true,
    vendor: {
      add: [],
      remove: []
    },
    build: {
      scopeHoisting: true,
      vueRouterMode: 'history',
      // gzip: true,
      // analyze: true,
      // extractCSS: false,
      // useNotifier: false,
      extendWebpack (cfg) {
      }
    },
    devServer: {
      // https: true,
      // port: 8080,
      open: true // opens browser window automatically
    },
    // framework: 'all' --- includes everything; for dev only!
    framework: {
      components: [
        'QLayout',
        'QLayoutHeader',
        'QLayoutDrawer',
        'QPageContainer',
        'QPage',
        'QToolbar',
        'QToolbarTitle',
        'QBtn',
        'QIcon',
        'QSearch',
        'QField',
        'QChipsInput',
        'QAutocomplete',
        'QCheckbox',
        'QCard',
        'QCardTitle',
        'QCardMain',
        'QCardMedia',
        'QCardSeparator',
        'QCardActions',
        'QList',
        'QListHeader',
        'QItem',
        'QItemMain',
        'QItemSeparator',
        'QItemSide',
        'QItemTile',
        'QStepper',
        'QStep',
        'QStepperNavigation',
        'QModal',
        'QPopover',
        'QProgress',
        'QTimeline',
        'QTimelineEntry',
        'QFab',
        'QFabAction',
        'QPageSticky',
        'QTabs',
        'QTab',
        'QTabPane',
        'QRouteTab',
        'QPullToRefresh',
        'QContextMenu',
        'QInput',
        'QTooltip',
        'QDatetime',
        'QResizeObservable'
      ],
      directives: [
        'Ripple',
        'BackToTop',
        'CloseOverlay'
      ],
      // Quasar plugins
      plugins: [
        'Notify',
        'LocalStorage',
        'Dialog',
        'ActionSheet',
        'CloseOverlay',
        'Loading',
        'QInnerLoading',
      ]
    },
    animations: 'all',
    animations: [],
    pwa: {
      cacheExt: 'js,html,css,ttf,eot,otf,woff,woff2,json,svg,gif,jpg,jpeg,png,wav,ogg,webm,flac,aac,mp4,mp3',
      manifest: {
        // name: 'Quasar App',
        // short_name: 'Quasar-PWA',
        // description: 'Best PWA App in town!',
        display: 'standalone',
        orientation: 'portrait',
        background_color: '#ffffff',
        theme_color: '#027be3',
      }
    },
    cordova: {
      // id: 'org.cordova.quasar.app'
    },
    electron: {
      extendWebpack (cfg) {
        // do something with cfg
      },
      packager: {
        platform: 'win32',
        arch: 'ia32'
        // OS X / Mac App Store
        // appBundleId: '',
        // appCategoryType: '',
        // osxSign: '',
        // protocol: 'myapp://path',

        // Window only
        // win32metadata: { ... }
      }
    },

    // leave this here for Quasar CLI
    starterKit: '1.0.2'
  }
}
