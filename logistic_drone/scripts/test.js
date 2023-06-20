const Tello = require('../../node_modules/@harleylara/tello-js/src/tello');
const drone = new Tello();

drone.connect();
drone.sendCmd("battery?").