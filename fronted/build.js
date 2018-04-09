var electronInstaller = require('electron-winstaller');
//https://ezgif.com/add-text/
//Alegra
//Venty
resultPromise = electronInstaller.createWindowsInstaller({
    appDirectory: 'dist/electron-ios/Pos-win32-ia32/',
    outputDirectory: 'dist/installers/',
    authors: 'jcesar.co Julio Cesar Caicedo Santos',
    exe: 'Pos.exe',
    loadingGif: 'resources/instalando.gif',
    noMsi: false,
    setupExe: 'FatVentasInstaller.exe',
    setupIcon: "resources/icono.ico",
    iconUrl: "https://raw.githubusercontent.com/llulioscesar/Distribuciones-Olivar-Sur/master/resources/icono.ico"
  });

resultPromise.then(() => console.log("It worked!"), (e) => console.log(`No dice: ${e.message}`));
