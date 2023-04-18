const Tello = require('../../node_modules/@harleylara/tello-js/src/tello');


module.exports = {
  run: async function() {
    
    async function sendCmdWithDelay(cmd, delaySeconds) {
      await drone.sendCmd(cmd);
      await new Promise(resolve => setTimeout(resolve, delaySeconds * 1000));
    }
    
    const drone = new Tello();
    drone.connect();
    drone.sendCmd('streamon');
    drone.initFfmpeg();
    drone.sendCmd('takePicture');
    await new Promise(resolve => setTimeout(resolve, 5000)); // Attendre 5 secondes pour que la photo soit prise et envoyée en streaming
    const photo = drone.getFrame(); // Récupérer la dernière frame de la vidéo en cours
    /*sendCmdWithDelay('takeoff', 2);
    sendCmdWithDelay('forward 50', 4); 
    sendCmdWithDelay('right 50', 6); 
    sendCmdWithDelay('land', 8);   */
    
  }
};
