import { app, BrowserWindow } from 'electron'
const PDFWindow = require('electron-pdf-window')

/**
 * Set `__statics` path to static files in production;
 * The reason we are setting it here is that the path needs to be evaluated at runtime
 */
if (process.env.PROD) {
  global.__statics = require('path').join(__dirname, 'statics').replace(/\\/g, '\\\\')
}

if(require('electron-squirrel-startup')) app.quit();

let mainWindow

function createWindow () {
  /**
   * Initial window options
   */
  mainWindow = new BrowserWindow({
    width: 1000,
    height: 600,
    minHeight: 600,
    minWidth:1280,
    useContentSize: true,
    webPreferences: { experimentalFeatures: true },
  })

  //PDFWindow.addSupport(mainWindow)

  mainWindow.loadURL(process.env.APP_URL)

  mainWindow.on('closed', () => {
    mainWindow = null
  })
}

app.on('ready', createWindow)

app.on('window-all-closed', () => {
  if (process.platform !== 'darwin') {
    app.quit()
  }
})

app.on('activate', () => {
  if (mainWindow === null) {
    createWindow()
  }
})
