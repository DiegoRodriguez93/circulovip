var app = {
    // Application Constructor
    initialize: function() {
        document.addEventListener('deviceready', this.onDeviceReady.bind(this), false);
    },

    // deviceready Event Handler
    //
    // Bind any cordova events here. Common events are:
    // 'pause', 'resume', etc.
    onDeviceReady: function() {
        this.receivedEvent('deviceready');
/*         var push = PushNotification.init({
            android: {}
        });

        push.on('registration', function(data) {
            // data.registrationId
            console.log('id= '+data.registrationId);
        });

        push.on('notification', function(data) {
            alert("Title:" + data.title + " Message:" + data.message);
        });

        push.on('error', function(e) {
             console.log(e.message) 
        }); */
        "use strict";

        Capacitor.Plugins.PushNotifications.register();
        Capacitor.Plugins.PushNotifications.addListener('registration', function (token) {
          console.log('Push registration success, token: ' + token.value);
        });
        Capacitor.Plugins.PushNotifications.addListener('registrationError', function (error) {
          console.log('Error on registration: ' + JSON.stringify(error));
        });
        Capacitor.Plugins.PushNotifications.addListener('pushNotificationReceived', function (notification) {
          console.log('Push received: ' + JSON.stringify(notification));
        });
        Capacitor.Plugins.PushNotifications.addListener('pushNotificationActionPerformed', function (notification) {
            console.log('Push received background: ' + JSON.stringify(notification));

        });
        Capacitor.Plugins.PushNotifications.removeAllDeliveredNotifications();
    },

    // Update DOM on a Received Event
    receivedEvent: function(id) {}
};

app.initialize();