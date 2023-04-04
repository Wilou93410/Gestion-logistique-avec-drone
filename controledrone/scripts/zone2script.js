const Tello = require('../../src/tello');


module.exports = {
  run: function() {
    
    async function sendCmdWithDelay(cmd, delaySeconds) {
      await drone.sendCmd(cmd);
      await new Promise(resolve => setTimeout(resolve, delaySeconds * 1000));
    }
    
    const drone = new Tello();
    drone.connect();
    drone.sendCmd('streamon');
    drone.initFfmpeg();
    sendCmdWithDelay('takeoff', 2);
    sendCmdWithDelay('forward 50', 4); 
    sendCmdWithDelay('right 50', 6); 
    sendCmdWithDelay('land', 8);   
    
  }
};
